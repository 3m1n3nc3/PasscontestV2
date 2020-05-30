<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_config {

    function __construct() {
        $this->CI = & get_instance();
    }

    public function item($item, $index = '')
    {   
        $config = $this->CI->setting_model->get_settings($item);
        if ($index == '')
        {
            return $config ? $config : NULL;
        }

        return isset($config[$index], $config[$index][$item]) ? $config[$index][$item] : NULL;
    }

    public function alert($msg = '', $type = 'info', $alt = FALSE)
    {   
        $icon = '';
        if ($type == 'danger' || $type == 'error') {
            $title  = 'Error!';
            $icon   = 'ban';
            $type   = 'danger';
        } elseif ($type == 'warning') {
            $title  = 'Warning!';
            $icon   = 'exclamation-triangle';
        } elseif ($type == 'success') {
            $title  = 'Success';
            $icon   = 'check';
        } else {
            $title  = 'Notice';
            $icon   = 'info-circle';
        }
        $ending = (strpos($msg, '.') || strpos($msg, '!') ? '' : '.');
        if ($msg != '') {
            if ($alt === FALSE) { 
                $alert  = 
                '<div class="alert alert-'.$type.' alert-dismissible rounded">
                    <button type="button" class="close pt-4" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <div class="font-weight-bold"><i class="icon fa fa-'.$icon.' fa-5x"></i> '.$title.'</div>
                    '.$msg.$ending.'
                </div>';
            } else {
                $alert  = 
                '<div class="text-'.$type.' rounded border border-'.$type.' bg-light px-2 my-1 text-center" id="cmsg_'.$alt.'">
                    '.$msg.$ending.'
                </div>';
            }
            return $alert;
        }
        return;
    } 
}
