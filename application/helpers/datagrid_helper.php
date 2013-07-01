<?php

/**
 * Dynamic datagrid class.
 * 
 * Generates a complete datagrid using array data.
 * 
 * @author Mahmudur Rahman <nahidacm@gmail.com>
 * 
 * @property array $_data The main data array.
 */
class Datagrid {

    private $CI;
    private $_data;
    private $_headers = array();
    private $_table_property = '';
    private $_primary_key_index;
    private $_actions = array();

    /**
     * 
     * @param array $data sets the data for datagrid
     */
    function __construct($data = array()) {
        $this->CI = & get_instance();
        $this->setData($data);
    }
    
    function setData( $data ){
        $this->_data = $data;
    }

    /**
     * @return null Nothing to return
     */
    function getGridHtml() {
        if (empty($this->_data))
            exit('Nothing to render...');

        $html = '';
        $html .= '<table ' . $this->_table_property . '>';
        $html .= '<thead>
                <tr>';
        foreach ($this->_headers as $header) {
            $html .= '<td>' . $header . '</td>';
        }
        if (!empty($this->_actions))
            $html .= '<td>Action</td>';

        $html .= '</tr>
            </thead>';

        $html .= '<tbody>';
        foreach ($this->_data as $row) {
            
            $html .= '<tr>';
            foreach ($this->_headers as $header_index=>$header_val ) {
                
                $html .= '<td>' . $row[$header_index] . '</td>';
            }
            if (!empty($this->_actions)){
                $html .= '<td>';
                $html .= $this->getActionColumn( $row[$this->_primary_key_index] );
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';

        $html .= '</table>';
        
        return $html;
    }

    /**
     * Only those records whose titles/header are set willl be shown.
     * 
     * And also table columns will render based on this header title order.
     * 
     * @param array $grid_headers Grid headers array
     * @return Datagrid returns self object
     */
    function setHeader($grid_headers ) {
        $this->_headers = $grid_headers;
        return $this;
    }

    /**
     * set table properties as string for example: "class="some_class" id="some_id" width="200"".
     * 
     * @param string $property table properties
     * @return Datagrid returns self object
     */
    function setTableProperty($property) {
        $this->_table_property = $property;
        return $this;
    }

    /**
     * 
     * @param string $primary_key_index the array index, which will be used to identify each unique row.
     */
    function setPrimaryKeyIndex($primary_key_index) {
        $this->_primary_key_index = $primary_key_index;
    }

    /**
     * set the data for Action column.
     * 
     * @param array $actions See the following array structure
     * 
     * <code>
     *  $actions = array(
     *      'edit'=>array(
     *           'title' => 'Edit',
     *          'url' => 'product/edit',
     *           'class' => 'edit_action'
     *     ),
     *      'edit'=>array(
     *           'title' => 'View',
     *           'url' => 'product/view',
     *           'class' => 'view_action'
     *     ),
     *   );
     * </code>
     * 
     * @return Datagrid Self object
     */
    function setActions($actions) {
        $this->_actions = $actions;
        return $this;
    }

    function getActionColumn($current_key) {
        $html = '';
        
        foreach ( $this->actions as $action ){
            $html = '<a href=' . $this->CI->base_url( $action['url'] . '/' . $current_key ) . '" 
            class="' . $action['class'] . '">' . $action['title'] . '</a>';
        }

        return $html;
    }

}