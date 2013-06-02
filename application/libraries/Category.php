<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * class summary:
  ------------------
 * ->add_new( 'Jhila', 3 , 'Dhakaya Birani', '');
  ->delete(19);
  ->update(6,5,'Halua Fight');

  ->add_new($parent , $name , $desc , $icon )  // add new category
  ->delete($id,$deleteItems) // delete existing category and all sub-categories And also possible to delete all items associated with it ($deleteItems=1)
  ->update($id , $parent , $name  , $desc  , $icon  ) // update existing category
  ->build_list($id=0,$collapsed="") // return array with the categories ordered by name , it could be collapsed by setting $collapsed="collapsed".
  ->browse_by_id($id) // return array with sub categories under a specific category only.
  ->fetch ($id) // return existing category info.
  ->count_categories($id) // get sub categories count below a TOP-LEVEL category $id.
  ->count_items($id) // get the count of items associated to a category and its sub-categories. [needs the 2 variables to be set...  $itemsTable,$CID_FieldName]
 */

class Category {

    var $CI;
    var $HtmlTree;
    var $name_prefix = "----"; // this is the prefix which will be added to the category name depending on its position usually use space.
    var $table_name = "category";
    //var $itemsTable = "items";  // this is the name of the table which contain the items associated to the categories
    //var $CID_FieldName = "id";  // this is the field name in the items table which refere to the ID of the item's category.
    // use the following keys into the $HtmlTree varialbe.
    var $fields = array(
        // field => field name in database ( sql structure )
        "id" => "id",
        "position" => "position",
        "name" => "c_name",
        "desc" => "c_desc",
        "icon" => "c_icon",
        "group" => "c_group",
    );
    /*     * ************************************************
      --- NO CHANGES TO BE DONE BELOW ---
     * ************************************************ */
    var $c_list = array();  // DON'T CHANGE THIS
    var $Group = 0;   // DON'T CHANGE THIS

    public function __construct() {
        $this->CI = & get_instance();
        $this->HtmlTree = array(
            "header" => '',
            "body" => '<label class="checkbox">
                        [prefix] <input type="checkbox" name="caregory_ids[]" value="[id]">[name]
                        </label>',
            "body_selected" => '<label class="checkbox">
                        [prefix] <input type="checkbox" name="caregory_ids[]" value="[id]" checked>[name]
                        </label>',
            "footer" => '',
        );
    }

    function add_new($name, $parent = 0, $desc = '', $icon = '') {  // add new category
        // lets get the position from the $parent value
        $position = $this->get_position($parent);

        $data = array(
            'c_name' => $name,
            'c_desc' => $desc,
            'c_icon' => $icon,
            'c_group' => $this->Group
        );

        $this->CI->db->insert($this->table_name, $data);

        $last_insert_id = $this->CI->db->insert_id();
        $position .= $last_insert_id . ">";

        $this->CI->db->update($this->table_name, array('position' => $position), array('id' => $last_insert_id));
    }

    function delete($id) {
        $position = $this->get_position($id);

        $this->CI->db->like('position', $position, 'after')
                ->delete($this->table_name);
    }

    function update($id, $parent = 0, $name = 0, $desc = 0, $icon = 0, $group = 0) {
        // lets see if there is a change on the group
        if ($group == 0) {
            $this_category = $this->fetch($id);
            $group = $this_category['c_group'];
        }

        // lets get the current position
        $position = $this->get_position($id);
        $new_position = $this->get_position($parent) . $id . ">";

        if ($position != $new_position) {
            // then we update all the sub_categories position to be still under the current category
            $query = $this->CI->db->like('position', $position, 'after')
                    ->get($this->table_name);

            foreach ($query->result_array() as $sub) {
                $new_sub_position = str_replace($position, $new_position, $sub['position']);
                $this->CI->db->update($this->table_name, array('position' => $new_sub_position), array('id' => $sub['id']));
            }
        }
        // finally update the category position.
        $this->CI->db->update($this->table_name, array('position' => $new_position), array('id' => $position));

        $data = array();

        // lets see what changes should be done and add it to the sql query.
        foreach ($this->fields as $field => $field_name) {
            if ($field == 'id')
                continue;  // no change will be done on the id
            if ($field == 'position')
                continue; // position change have been done in the section above

            $data[$field_name] = $$field;
        }

        $this->CI->db->update($this->table_name, $data, array('id' => $id));
    }

    function build_list($id = 0, $collapsed = "") { //return an array with the categories ordered by position
        $RootPos = "";
        $this->c_list = array();

        if ($id != 0) {
            $this_category = $this->fetch($id);
            $positions = explode(">", $this_category['position']);
            $RootPos = $positions[0];
        }

        // lets fetch the root categories
        $this->CI->db->where("position RLIKE "."'^([0-9]+>){1,1}$' AND c_group = $this->Group")
                    ->order_by('c_name');
        $query = $this->CI->db->get($this->table_name);

        foreach ($query->result_array() as $root) {
            $root["prefix"] = $this->get_prefix($root['position']);
            $this->c_list[$root['id']] = $root;

            if ($RootPos == $root['id'] AND $id != 0 AND $collapsed != "") {
                $this->list_by_id($id);
                continue;
            } else {

                // lets check if there is sub-categories
                if ($collapsed == "" AND $id == 0) {
                    $has_children = $this->has_children($root['position']);
                    if ($has_children == TRUE)
                        $this->get_children($root['position'], 0);
                }
            }
        }
        return $this->c_list;
    }

    function list_by_id($id) { //return an array with the categories under the given ID and ordered by name
        $this_category = $this->fetch($id);

        $positions = explode(">", $this_category['position']);
        $pCount = count($positions);
        $i = 0;

        // lets fetch from top to center
        while ($i < $pCount) {
            $pos_id = $positions["$i"];
            if ($pos_id == "") {
                $i++;
                continue;
            }
            $list = $this->browse_by_id($pos_id);

            foreach ($list as $key => $value) {
                $this->c_list["$key"] = $value;
                $ni = $i + 1;
                $nxt_id = $positions[$ni];
                if ($key == $nxt_id)
                    break;
            } $i++;
        }

        //center to end
        $i = $pCount - 1;

        while ($i >= 0) {
            $pos_id = $positions["$i"];
            if ($pos_id == "") {
                $i--;
                continue;
            }
            $list = $this->browse_by_id($pos_id);

            foreach ($list as $key => $value) {
                $ni = $i - 1;
                if ($ni < 0)
                    $ni = 0;
                $nxt_id = $positions[$ni];
                if ($key == $nxt_id)
                    break;
                $this->c_list["$key"] = $value;
            } $i--;
        }
    }

    function browse_by_id($id) { // return array of categories under specific category.
        $children = array();
        $this_category = $this->fetch($id);
        $position = $this_category['position'];
        
        $this->CI->db->where('position RLIKE ', "'^$position(([0-9])+\>){1}$'")
                    ->order_by('c_name');
        $query = $this->CI->db->get($this->table_name);

        while ($child = $query->result_array()) {
            $child["prefix"] = $this->get_prefix($child['position']);
            $children[$child['id']] = $child;
        }
        return $children;
    }
    
    function front_menu_html() {
        
        if(uri_string() == '')
            $home_menu = '<li class="active"><a href="'.  base_url().'">Home</a></li>';
        else
            $home_menu = '<li><a href="'.  base_url().'">Home</a></li>';
        
        $HtmlTree = array(
            "header" => '<ul class="nav">'.$home_menu,
            "body" => '<li><a href="'.  site_url('home/category/[id]').'">[name]</a></li>',
            "body_selected" => '<li class="active"><a href="'.  site_url('home/category/[id]').'">[name]</a></li>',
            "footer" => '</ul>',
        );
        
        $tree = $this->build_list(0); // we have selected to view category
        var_dump($tree);

        $output = "";
        $output .= $HtmlTree['header'];

        if (is_array($tree)) {
            foreach ($tree as $c) {

                if(uri_string() == 'home/category/'.$c['id'])
                    $body = $HtmlTree['body_selected'];
                else
                    $body = $HtmlTree['body'];

                foreach ($this->fields as $name => $field_name) {
                    $body = str_replace("[$name]", $c["$field_name"], $body);
                }
                $body = str_replace("[prefix]", $c['prefix'], $body);

                $output .= $body;
            }
        }

        $output .= $HtmlTree['footer'];
        
        return $output;
    }
    
    function html_output($id = 0, $edit_mood = FALSE, $selected_items = array()) {
        $tree = $this->build_list($id); // we have selected to view category

        $output = "";
        $output .= $this->HtmlTree['header'];

        if (is_array($tree)) {
            foreach ($tree as $c) {

                if($edit_mood && in_array($c['id'], $selected_items))
                    $body = $this->HtmlTree['body_selected'];
                else
                    $body = $this->HtmlTree['body'];

                foreach ($this->fields as $name => $field_name) {
                    $body = str_replace("[$name]", $c["$field_name"], $body);
                }
                $body = str_replace("[prefix]", $c['prefix'], $body);

                $output .= $body;
            }
        }

        $output .= $this->HtmlTree['footer'];
        
        return $output;
    }

    function has_children($position) {

        $this->CI->db->where('position RLIKE '."'^" . $position . "[0-9]+>$'");
        
        $query = $this->CI->db->get($this->table_name);
        
        if ($query->num_rows() >0)
            return TRUE;
        else
            return FALSE;
    }

    function get_children($position, $id = 0) {

        $this->CI->db->where('position RLIKE '."'^" . $position . "[0-9]+>$'")
                ->order_by('c_name');
        $query = $this->CI->db->get($this->table_name);

        foreach ($query->result_array() as $child ) {
            $child["prefix"] = $this->get_prefix($child['position']);

            if ($id != 0) {
                $this->c_list_by_id[$child['id']] = $child;
                $has_children = $this->has_children($child['position']);
                if ($has_children == TRUE) {
                    $this->get_children($child['position']);
                }
                continue;
            } else {

                // lets check if there is sub-categories
                $this->c_list[$child['id']] = $child;
                $has_children = $this->has_children($child['position']);
                if ($has_children == TRUE)
                    $this->get_children($child['position']);
            }
        }
    }

    function fetch($id) {
        $query = $this->CI->db->get_where($this->table_name, array('id' => $id));
        $record = $query->row_array();

        $record["prefix"] = $this->get_prefix($record['position']);
        $position_slices = explode(">", $record['position']);
        $key = count($position_slices) - 3;
        if ($key < 0)
            $key = 0;
        $record["parent"] = $position_slices["$key"];
        return $record;
    }

    function get_prefix($position) {
        $prefix = "";
        $position_slices = explode(">", $position);
        $count = count($position_slices) - 1;
        for ($i = 1; $i < $count; $i++) {
            $prefix .= $this->name_prefix;
        }
        return $prefix;
    }

    function get_position($id) {
        if ($id == 0)
            return "";

        $query = $this->CI->db->get_where($this->table_name, array('id' => $id));
        $record = $query->row_array();

        return $record['position'];
    }

}