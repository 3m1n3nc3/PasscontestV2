<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Datatables extends MY_Controller {
    public function index()
    {
        // $this->load->view('datatable');
    }

    /**
     * This is for management purpose purpose, this function will fetch all the contestants for a given contest
     * @param  [string] $contest_id [the id of the contest to query]
     * @param  [string] $status     [the type of contestant to return active or pending]
     * @return [null]               [echoes a json object for use with datatables]
     */ 
    public function fetch_contestants($contest_id = null, $status = null)
    {
        $this->db->select('*, contestants.active AS approved');

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'username', 
            2=>'dob', 
            3=>'gender', 
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }   
            $this->db->group_end();              
        }

        $this->db->limit($length,$start);

        if ($contest_id) { 
            $this->db->where('contestants.contest_id', $contest_id); 
        } 

        if ($status !== null) { 
            $this->db->where('contestants.active', $status); 
        } 
        $this->db->join('users', 'users.id = contestants.contestant_id', 'left');
        $users = $this->db->get("contestants");
        $data = array(); 
        foreach($users->result() as $rows)
        {

            $_user = $this->account_data->fetch($rows->contestant_id);
            $data[]= array(
                '<a href="'.site_url('profile/info/'.$rows->contestant_id).'">'.$_user['name'].'</a>',
                date_diff(date_create($rows->dob), date_create('now'))->y, 
                ucwords($rows->category), 
                date('d/m/Y', strtotime($rows->date)), 
                '<div class="d-flex">
                    <a href="'.site_url('profile/data/'.$rows->contestant_id).'" class="btn btn-sm btn-icon btn-info mr-1 identifier">
                        <i class="fas fa-user fa-fw"></i>
                    </a>'.
                    (!$rows->approved ? 
                    '<a href="javascript:void(0)" 
                        class="btn btn-sm btn-success mr-1 identifier" 
                        data-accept="'.$rows->contestant_id.'" 
                        onclick="acceptItem({type: \'contestant\', action: 1, id: '.$rows->contestant_id.', contest_id: '.$rows->contest_id.', init: \'dt\'})">
                        Accept
                    </a>' : 
                    '<a href="javascript:void(0)" 
                        class="btn btn-sm btn-danger mr-1 identifier" 
                        data-reject="'.$rows->contestant_id.'" 
                        onclick="acceptItem({type: \'contestant\', action: 0, id: '.$rows->contestant_id.', contest_id: '.$rows->contest_id.', init: \'dt\'})">
                        Reject
                    </a>').
                '</div>',
                20 => 'tr_'.$rows->id

            );     
        }
        $total_contestants = $this->totalContestants($contest_id, $status);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_contestants,
            "recordsFiltered" => $total_contestants,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    /**
     * This is for management purpose purpose, this function will count all the contestants for a given contest
     * @param  [string] $contest_id [the id of the contest to query]
     * @param  [string] $status     [the type of contestant to return active or pending]
     * @return [string]             a number representing the number of available contestants for a given contest
     */ 
    public function totalContestants($contest_id = null, $status = null)
    {   
        if ($contest_id) { 
            $this->db->where('contestants.contest_id', $contest_id); 
        } 

        if ($status !== null) { 
            $this->db->where('contestants.active', $status); 
        } 
        $this->db->join('users', 'users.id = contestants.id', 'left');
        $query = $this->db->select("COUNT(*) as num")->get("contestants");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    /**
     * This is for management purpose purpose, this function will fetch all the contests available on the site
     * @param  [string] $filter [filters the contests to return by active, inactive, featured and recommended] 
     * @return [null]           [echoes a json object for use with datatables]
     */ 
    public function fetch_contests($filter = null)
    {
        $this->db->select('*, contests.status AS active');

        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'title', 
            1=>'vote_cost', 
            3=>'country', 
            4=>'date_created', 
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }   
            $this->db->group_end();              
        }

        $this->db->limit($length,$start); 

        if (isset($filter)) {
            if ($filter == '0') {
                $this->db->where('status', '0'); 
            } elseif ($filter == '1') {
                $this->db->where('status', '1'); 
            } elseif ($filter == 'featured') {
                $this->db->where('featured', '1'); 
            } elseif ($filter == 'recommended') {
                $this->db->where('recommend', '1'); 
            }
        }

        $contests = $this->db->get("contests");
        $data = array(); 
        foreach($contests->result() as $rows)
        { 
            $data[]= array(
                '<a href="'.site_url('manage/admin/update_contest/'.$rows->id).'">'.$rows->title.'</a>',
                pass_currency(3, my_config('site_currency')).number_format($rows->vote_cost*my_config('credit_rate'), 2),
                ucwords(count($this->contestant_model->get(['contest_id' => $rows->id]))), 
                ucwords($rows->country), 
                date('d/m/Y', strtotime($rows->date_created)),
                '<a href="javascript:void(0)" 
                    class="btn btn-sm btn-danger mr-1 deleter" 
                    data-delete="'.$rows->id.'" 
                    onclick="deleteItem({type: \'contest\', action: 1, id: '.$rows->id.', init: \'dt\'})">
                    Delete
                </a>'
                ,
                20 => 'tr_'.$rows->id

            );     
        }
        $total_contests = $this->totalContests($filter);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_contests,
            "recordsFiltered" => $total_contests,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }


    /**
     * This is for management purpose purpose, this function will count all the contests available on the site
     * @param  [string] $filter [filters the contests to return by active, inactive, featured and recommended] 
     * @return [string]         a number representing the number of available contests on the site
     */ 
    public function totalContests($filter = null)
    {    
        if (isset($filter)) {
            if ($filter == '0') {
                $this->db->where('status', '0'); 
            } elseif ($filter == '1') {
                $this->db->where('status', '1'); 
            } elseif ($filter == 'featured') {
                $this->db->where('featured', '1'); 
            } elseif ($filter == 'recommended') {
                $this->db->where('recommend', '1'); 
            }
        }

        $query = $this->db->select("COUNT(*) as num")->get("contests");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    /**
     * This is for management purpose purpose, this function will fetch all the users available on the site
     * @param  [string] $filter [filters the users to return by active, inactive, featured and recommended] 
     * @return [null]           [echoes a json object for use with datatables]
     */ 
    public function fetch_users($filter = null)
    { 
        $draw   = intval($this->input->post("draw"));
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'username',  
            1=>'email',
            1=>'country'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $this->db->group_start();
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }   
            $this->db->group_end();              
        }

        $this->db->limit($length,$start); 

        if (isset($filter)) {
            if ($filter == '0') {
                $this->db->where('active', '0'); 
            } elseif ($filter == '1') {
                $this->db->where('active', '1'); 
            } elseif ($filter == 'featured') {
                $this->db->where('featured', '1'); 
            } elseif ($filter == 'banned') {
                $this->db->where('banned', '1'); 
            }
        }

        $users = $this->db->get("users");
        $data = array(); 
        foreach($users->result() as $rows)
        { 
            $_user = $this->account_data->fetch($rows->id);

            $data[]= array(
                '<a href="'.site_url('manage/admin/update_user/'.$rows->id).'">'.$_user['name'].'</a>', 
                $rows->email, 
                ucwords($rows->country), 
                count($this->contestant_model->get(['contestant_id' => $rows->id])) . ' - ' .
                '<span class="text-info">'.$this->passcontest->vote_counter(['contestant_id' => $rows->id]).'</span>',
                '<a href="javascript:void(0)" 
                    class="btn btn-sm btn-danger mr-1 deleter" 
                    data-delete="'.$rows->id.'" 
                    onclick="deleteItem({type: \'user\', action: 1, id: '.$rows->id.', init: \'dt\'})">
                    Delete
                </a>'
                ,
                20 => 'tr_'.$rows->id

            );     
        }
        $total_users = $this->totalUsers($filter);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_users,
            "recordsFiltered" => $total_users,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }


    /**
     * This is for management purpose purpose, this function will count all the users available on the site
     * @param  [string] $filter [filters the users to return by active, inactive, featured and recommended] 
     * @return [string]         a number representing the number of available users on the site
     */ 
    public function totalUsers($filter = null)
    {     
        if (isset($filter)) {
            if ($filter == '0') {
                $this->db->where('active', '0'); 
            } elseif ($filter == '1') {
                $this->db->where('active', '1'); 
            } elseif ($filter == 'featured') {
                $this->db->where('featured', '1'); 
            } elseif ($filter == 'banned') {
                $this->db->where('banned', '1'); 
            }
        }

        $query = $this->db->select("COUNT(*) as num")->get("users");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

}
