<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller 
{
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();

        
        $is_mainteness_mode_on = (isset($this->settings_data->is_mainteness_mode_on) && $this->settings_data->is_mainteness_mode_on == "YES") ? "YES": "NO";

        if($is_mainteness_mode_on == "YES")
        {   
            if (current_url() != base_url()) 
            {
                return redirect(base_url());
            }
            
            $this->load->view('maintenance_view',array());
            die();
        } 

        $this->add_external_css(
                                    array
                                    (
                                        base_url("assets/front/css/bootstrap.min.css"), 
                                        base_url("assets/front/css/all.min.css"), 
                                        base_url("assets/front/css/summernote-bs4.min.css"), 
                                        base_url("assets/front/css/jquery.datetimepicker-full.css"), 
                                        base_url("assets/front/css/dataTables.bootstrap4.min.css"), 
                                        base_url("assets/front/css/select2.min.css"), 
                                        base_url("assets/front/css/all.min.css"), 
                                        base_url("assets/front/css/cookiealert.css"),
                                        base_url("assets/front/css/noty.css"),
                                        base_url("assets/front/css/sweetalert.css"),
                                        base_url("assets/front/css/component.css"),
                                        base_url("assets/front/css/slick.css"),
                                        base_url("assets/front/css/slick-theme.css"),
                                        base_url("assets/front/css/custom.css"),

                                    )
                                );
        $this->add_external_js(
                                array(
                                        base_url("assets/front/js/jquery.min.js"), 
                                        base_url("assets/front/js/jquery-ui.min.js"), 
                                        base_url("assets/front/js/popper.js"), 
                                        base_url("assets/front/js/tooltip.js"), 
                                        base_url("assets/front/js/bootstrap.min.js"), 
                                        base_url("assets/front/js/jquery.nicescroll.min.js"),
                                        base_url("assets/front/js/summernote-bs4.min.js"),
                                        base_url("assets/front/js/jquery.datetimepicker.full.min.js"),
                                        base_url("assets/front/js/jquery.dataTables.min.js"), 
                                        base_url("assets/front/js/dataTables.bootstrap4.min.js"), 
                                        base_url("assets/front/js/select2.min.js"), 
                                        base_url("assets/front/js/noty.min.js"),
                                        base_url("assets/front/js/commonjs.js"), 
                                        base_url("assets/front/js/jquery-ui.min.js"), 
                                        base_url("assets/front/js/cookiealert.js"),
                                        base_url("assets/front/js/sweetalert-dev.js"),
                                        base_url("assets/front/js/modernizr.custom.js"), 
                                        base_url("assets/front/js/jquery.dlmenu.js"), 
                                        base_url("assets/front/js/bootstrap-notify.min.js"), 
                                        base_url("assets/front/js/slick.min.js"), 
                                    )
                                );


        // declare main template
        $this->template = "template.php";
    }
}
