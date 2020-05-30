<?php 

class MY_Controller extends CI_Controller
{ 

    public function __construct()
    {
        parent::__construct();    

        $logged_user = '';
        if ($this->session->has_userdata('username')) {
            $logged_user = $this->session->userdata('username');
        } elseif (get_cookie('username')) {
            $logged_user = get_cookie('username');
        }
        $this->logged_user  = $this->account_data->fetch($logged_user);
 
        $logged_guest = $this->session->userdata('guest') ? $this->session->userdata('guest') : ''; 
        $this->logged_guest = $this->ip_model->get_visitors($logged_guest);
        $this->ip->ip_login();
    }

}


class Api_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();  

    }


}

class Access_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();  

    }

}

class Frontsite_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();  

    }

}


class Contest_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();   

    }

}


class User_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();   
        $this->account_data->is_logged_in('user');

    }

}


class Admin_Controller extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();    
        $this->account_data->is_logged_in(); 

        $this->is_admin = TRUE; 
 
    }

}
