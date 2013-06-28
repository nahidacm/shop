<?php
/**
 * Description of AdminAccessControl
 *
 * @author Nahid
 */
class AdminAccessControl {
    
    var $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    function isAdmin( $args ){
        
        if( $this->CI->uri->segment(1)=='admin' ){
            
            if( $this->CI->uri->segment(3)!='login' ){
                if( !$this->CI->session->userdata( 'admin_user_name' ) ){
                    redirect ('admin/home/login');
                }
            }
            
            
        }
        
    }
}

?>
