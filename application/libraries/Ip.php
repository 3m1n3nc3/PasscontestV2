<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ip {

    function __construct() {
        $this->CI = & get_instance();
    }

    public function get()
    {
        if ( isset($_SERVER['HTTP_CF_CONNECTING_IP']) ) 
        {
            $_SERVER['REMOTE_ADDR']    = $_SERVER['HTTP_CF_CONNECTING_IP'];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } 

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if ( strpos($forward, ',') > 0 ) 
        {
            $forward = explode(',', $forward);
            $ip      = trim($forward[0]);
        }
        else 
        {
            if (filter_var($client, FILTER_VALIDATE_IP)) 
            {
                $ip = $client;
            } 
            elseif (filter_var($forward, FILTER_VALIDATE_IP)) 
            {
                $ip = $forward;
            } 
            else 
            {
                $ip = $remote;
            }
        }
        return $ip;
    }

    // Nigeria: '105.112.177.151', California US: '47.252.13.192';
    public function info()
    {
        $ip = $this->get(); 
        $geo_plugin = @json_decode(
            file_get_contents(
                'http://www.geoplugin.net/json.gp?ip=' . $ip
            )
        );
        if ($geo_plugin) 
        {
            $info = array(
                'city'              => $geo_plugin->geoplugin_city,
                'region'            => $geo_plugin->geoplugin_region,
                'country'           => $geo_plugin->geoplugin_countryName,
                'country_code'      => $geo_plugin->geoplugin_countryCode,
                'continent'         => $geo_plugin->geoplugin_continentName,
                'continent_code'    => $geo_plugin->geoplugin_continentCode,
                'timezone'          => $geo_plugin->geoplugin_timezone,
                'currency_code'     => $geo_plugin->geoplugin_currencyCode,
                'status'            => $geo_plugin->geoplugin_status
            );
        }
        else 
        {
            $info = array(
                'city' => '', 'region' => '', 'country' => '', 'country_code' => '', 'continent' => '', 
                'continent_code' => '', 'timezone'  => '', 'currency_code'  => '', 'status' => ''
            );
        }
        return $info;
    }

    public function save()
    {   
        $ip = $this->get();
        if ($ip !== '127.0.0.1') 
        {
            $ip_info = $this->info();
        }

        $timenow = date('Y-m-d H:m:s', strtotime('NOW'));

        $city       = @$ip_info['city'];
        $region     = @$ip_info['region'];
        $country    = @$ip_info['country'];

        $check_ip = $this->CI->ip_model->get_visitors($ip); //  print_r($check_ip); 

        if ($check_ip && !$this->CI->session->has_userdata('guest')) 
        {
            $save = array( 
                'id' => $check_ip['id'], 'ip' => $ip, 'city' => $city, 'region' => $region, 
                'visits' => ($check_ip['visits']+1), 'country' => $country, 'last_visit' => $timenow 
            );
            $this->CI->ip_model->save_visitor($save);
        }
        elseif ( !$check_ip ) 
        {
            $save = array( 
                'ip' => $ip, 'city' => $city, 'region' => $region, 'country' => $country, 'first_visit' => $timenow, 'last_visit' => $timenow 
            );
            $this->CI->ip_model->save_visitor($save);
        }
    }

    public function ip_login()
    {
        if (!$this->CI->logged_user) 
        {
            if (!$this->CI->session->has_userdata('guest')) 
            {
                $ip       = $this->get();
                $guest    = $this->CI->session->userdata('guest');
                $check_ip = $this->CI->ip_model->get_visitors($ip);
    
                if ($check_ip) 
                {
                    $this->CI->session->set_userdata('guest', $check_ip['ip']);
                } 
                else 
                {
                    $this->save();
                } 
            } 
        }            
        else 
        {
            if ($this->CI->session->has_userdata('guest')) 
            {
                $this->CI->session->unset_userdata('guest');
            }
        }
    }

    public function guestVoter($contest_id = '', $contestant_id = '')
    {
        $guest = $this->CI->logged_guest; 

        $data  = array('voter_id' => $guest['ip'], 'contest_id' => $contest_id, 'contestant_id' => $contestant_id);

        $allow_guest = $this->CI->contest_model->getVotes($data, 1);

        $timenow = date('Y-m-d H:m:s', strtotime('NOW')); 
        $diff    = timeDifference($allow_guest['date'], $timenow);

        if (!$allow_guest || $diff > my_config('ip_interval')) {
            return true;
        }
        return FALSE;
    }

    public function guestUser($ip = '')
    {
        $guest = $this->CI->ip_model->get_visitors($ip);

        $data['id']       = $guest['ip'];
        $data['username'] = $guest['ip'];
        $data['name']     = lang('guest_voter');
        $data['bio']      = lang('guest_voter');
        $data['avatar']   = $data['avatar'] = my_config('guest_avatar');

        return $data;
    }
}
