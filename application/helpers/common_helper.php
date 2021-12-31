<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('func_check_login')) {

    function func_check_login() {
        $CI = & get_instance();
        $sessionArr = $CI->session->userdata('login');
        $userId = $sessionArr->id;
        #echo "<PRE>";print_r($CI->session->userdata());exit;
        if(!empty($userId)){
            $sql = $CI->db->get_where('tbl_user', array('id' => $userId));
            if($sql->num_rows() != "1"){
                $this->CI->session->sess_destroy();
                $this->CI->session->set_flashdata('message', '<div id="message">Enter Email Address or Password.</div>');
                redirect(base_url().'login');
            }
        }
        else{
            redirect(base_url().'login');
        }
    }
}
