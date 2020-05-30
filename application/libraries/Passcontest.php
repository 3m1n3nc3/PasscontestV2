<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Passcontest {

    function __construct() 
    {
        $this->CI = & get_instance();
    }

    /**
     * Counts the total votes that a user or contest has acquired in course of the contest
     * @param  array $data      Specifies the vote scope to fetch 
     *                          ['contest_id'] will fetch all votes for specified contest
     *                          ['contestant_id'] will fetch all votes for specified contestant
     *                          Specifying both will fetch votes for specified user in the specified contest
     * @return string           numeric string representing the number of votes
     */
    public function vote_counter($data = array())
    { 
        $votes = $this->CI->contest_model->getVotes($data);
        $votes_count = 0;

        foreach ($votes as $v)
        {
            if ($v['count'] > 1)
            {
                $votes_count += $v['count'];
            }
        }

        $votes_count = $votes_count > 1 ? $votes_count : count($votes);
        $votes_count = $votes_count > 0 ? $votes_count : 0;

        return $votes_count;
    }

    /**
     * The vote_bar() creates a vote button and another button showing, important messages,
     * the number of vote for a particular contestant in a contest and a link tho view all voters
     * @param  array $data      Specifies the vote scope to fetch 
     *                          ['contest_id'] will fetch all votes for specified contest
     *                          ['contestant_id'] will fetch all votes for specified contestant
     *                          Both have to be set
     * @return string           formated html representing the buttons
     */
    public function vote_bar($data = array())
    {    
        $votes_count   = $this->vote_counter($data);

        $endpoint      = (isset($data['contestant_id']) ? 'contestant' : (isset($data['voter_id']) ? 'voter' : 'contest'));
        $endpoint_id   = (isset($data['contestant_id']) ? $data['contestant_id'] : (isset($data['voter_id']) ? $data['voter_id'] : $data['contest_id']));
        $contest_id    = isset($data['contest_id']) ? $data['contest_id'] : null;
        $contestant_id = isset($data['contestant_id']) ? $data['contestant_id'] : null;

        $voter       = $this->CI->logged_user;
        $contest     = $this->CI->contest_model->get($contest_id);
        $contestants = $this->CI->contestant_model->get(['contest_id' => $contest_id]);
        $credit_bal  = $this->credit($voter['id']);
 
        $data   = '<span id="msg_'.$contestant_id.'"></span><hr>';

        $out_of_credit_notice = (
            !$this->CI->logged_user ? sprintf(lang('guest_login_to_vote'), my_config('ip_interval')) : sprintf(lang('insufficient_vote_credit'), my_config('credit_name'))
        );

        $buy_credit_button = (
            !$this->CI->logged_user ? lang('login_to_vote') : lang('buy').' '.$this->CI->my_config->item('credit_name')
        );

        if ($contest['allow_vote']) 
        {
            if ($contestant_id) 
            { 
                $data  .= (
                    ($credit_bal >= $contest['vote_cost']) || $this->CI->ip->guestVoter($contest_id, $contestant_id) ? 
                    '<a href="javascript:void(0)" class="btn btn-primary pass mx-1" id="vote_button_'.$contestant_id.'" 
                        onclick="add_vote({\'contest\':'.$contest_id.', \'contestant\':'.$contestant_id.'})">
                        <i class="fas fa-thumbs-up"></i> '.lang('vote').'
                    </a>' : 
                    alert_notice( $out_of_credit_notice, 'warning', $contestant_id ) . 
                    '<a href="'.site_url('user/account/credit/buy').'" class="btn btn-primary pass mx-1" id="buy_button_'.$contestant_id.'">
                        <i class="fas '.($this->CI->logged_user ? 'fa-credit-card' : 'fa-user').'"></i> '.$buy_credit_button.'
                    </a>'
                );
            }           
        } 
        else 
        {
            $data .= alert_notice( lang('voting_closed'), 'info', $contestant_id );
        }

        $data  .= 
        '<a href="'.site_url('contest/voters/'.$contest_id.'/'.$endpoint.'/'.$endpoint_id).'" class="btn btn-primary pass mx-1">
            <span data-votes-count="'.$votes_count.'" id="user_vote_count_'.$contestant_id.'">'.$votes_count.'</span> '.lang('votes').'
        </a>';

        if (!$contestant_id) 
        {
            $data  .= 
            '<a href="'.site_url('contest/contestants/'.$contest_id).'" class="btn btn-primary pass mx-1">
                <span id="contestants_count_'.$contest_id.'">'.count($contestants).'</span> '.lang('contestants').'
            </a>
            <br>
            <a href="'.site_url('manage/contest/contestants/'.$contest_id.'/all').'" class="btn btn-block btn-info pass mx-1">
                <i class="fas fa-crown"></i> '.lang('manage').'
            </a>';
        }
        return $data;
    }

    /**
     * [credit this function handles credits]
     * @param  string|array $user_id the id of the user or object to fetch
     * @param  string $action  get: get the credit records for the select user_id
     *                         balance: get the credit balance for the select user_id
     *                         array('update'): update the balance for the select user_id
     *                         array('pay'): Validate a credit token and update the users balance
     * @return string/bool     
     */
    public function credit($user_id = ' ', $action = 'balance')
    { 
        $credit    = array(); $response = null;
        $curr_symb = pass_currency(3, my_config('site_currency'));
        $crc       = my_config('credit_code');
        
        // Fetch the users data
        $user    = $this->CI->account_data->fetch($user_id); 
 
        // Fetch the users credit balance
        $credit = $this->CI->user_model->get_credit($user_id, 1); 

        if ($action == 'get')
        {
            $response = $credit; 
            // If the users balance is not empty show the balance
            $response['actual_value'] = $n_format = number_format(($credit['balance'] * my_config('credit_rate')), 2);
            $response['balance']      = $n_format = number_format(($credit['balance']), 2); 
        } 
        elseif ($action == 'balance')
        {
            // Show the users balance only, with no other records
            if (isset($credit['balance'])) {
                $response = $credit['balance'];
            }
        } 
        elseif ($action == 'get_units')
        {
            // Get the available units and explode to an array
            $units = my_config('credit_units');
            return explode(',', $units); 
        } 
        elseif (is_array($action)) 
        {
            if (isset($action['action'])) 
            {
                if ($action['action'] == 'update') 
                {   
                    // If an id is set, update that record instead
                    if (isset($credit['id']) || isset($action['id'])) {
                        $data['id']  = $credit['id'];
                    }

                    // If a token is available update the data
                    if (isset($action['last_token'])) {
                        $data['last_token'] = $action['last_token'];
                    }

                    // Prepare the users new balance (Credit records)
                    $data['user_id'] = $user_id;
                    $data['date']    = date('Y-m-d H:i:s');
                    $data['balance'] = $action['balance'];

                    // Update the users balance (Credit records)
                    if ($this->CI->user_model->add_credit($data)) {
                        $response = $data['balance'];
                    }
                }
                elseif ($action['action'] == 'pay')
                {   
                    $response = $this->CI->credit_model->check($action);
                    if ($response && $response['value']>0 && $response['used_by'] === NULL) 
                    {   
                        // Update the token to show it has been used
                        $use['id']       = $response['id'];
                        $use['used_by']  = $add['user_id'] = $user['id'];
                        $use['used_date'] = date('Y-m-d');
                        $this->CI->credit_model->add($use); 

                        // Apply the credit bonus as well
                        $bonus   = my_config('credit_bonus');
                        $balance = $credit['balance'] + round($response['value'] / my_config('credit_rate'));

                        // Add the new credit amount on the user's current credit
                        $add['action']     = 'update'; 
                        $add['last_token'] = $response['key'];
                        $add['balance']    = $balance + $bonus;
                        $this->credit($user['id'], $add);
                        
                        // Prepare the data and notify the user of success
                        $response['status']  = 'success';
                        $response['balance'] = $add['balance'];
                        $response['msg']     = sprintf(lang('recharge_success'), $curr_symb.$response['value'], $response['balance'].' '.$crc);
                    } 
                    elseif ($response['used_by']) 
                    {
                        // Tell the user that the token has already been used
                        $response['status'] = 'error';
                        $response['msg']    = lang('recharge_already_used');
                    }
                    else 
                    {
                        // Tell the user that the token was invalid
                        $response['status'] = 'error';
                        $response['msg']    = lang('recharge_invalid');
                    }   
                }
            }
        } 
        else 
        {
            return;
        }
        return $response;
    }


    /**
     * Generates Credit tokens and saves them to database or just print by requirement
     * @param  integer $quantity The amount of tokens to generate
     * @param  string  $action   What to do with the generates tokens, setting this to save will save the tokens
     * @param  array   $param     Contains extra parameters to pass to the database
     * @return array             contains a message for the user and another array containing the generated keys
     */
    public function generate_token($quantity = 0, $param = array(), $action = '')
    {     
        if ($quantity == 0) {
            $quantity = 1;
        }
        $keys = [];
        for ($i=1; $i <= $quantity; $i++) { 
            $keys[] .=  generate_token(1,3,5,'');
        }         

        if ($action == 'save') {
            foreach ($keys as $key) {

                $data['key'] = $key;
         
                if (isset($param['value'])) {
                    $data['value'] = $param['value'];
                }
                 
                if (isset($param['contest_id'])) {
                    $data['contest_id'] = $param['contest_id'];
                }
                 
                if (isset($param['agent_id'])) {
                    $data['agent_id'] = $param['agent_id'];
                }

                $this->CI->credit_model->add($data);
            }
        }

        $format_keys = '';
        foreach ($keys as $key) {
            $format_keys .= '
            <div class="text-info">
                '.$key.
                '<span class="text-primary mx-4">'.
                    pass_currency(3, my_config('site_currency')).
                    (isset($param['value']) ? $param['value'] : '').
                '</span>
            </div>';
        }

        $format_keys = 
        '<div class="col-md-12">
          <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">'.lang('generated') . ' ' . lang('keys').'</h5> 
            </div>
            <div class="card-body">
              '.$format_keys.'
            </div>
          </div>
        </div>';

        $generated = ($action == 'save' ? lang('generated_and_saved') : lang('generated'));
        return array( 
            'message' => sprintf(lang('count_keys_were'), count($keys), $generated), 
            'keys' => $keys,
            'format_keys' => $action !== 'save' ? $format_keys : ''
        ); 
    }


    /**
     * [entry_requests this function will check for new entry request across all specified contests]
     * @param  array  $contest_array [An array of all the contests available to check]
     * @return [string]                [a string containing a url to all the contests passing the notification]
     */
    public function entry_requests($contest_array = array(), $format = null)
    {
        $pending = [];
        foreach ($contest_array as $cp) { 
            $pend = $this->CI->contestant_model->get(['active' => '0', 'contest_id' => $cp['id'], 'join' => 'contests', 'index' => 'id'], 1); 
            if ($pend) {
                $pending[] = $pend;
            }
        } 

        $links = [];
        if (isset($pending)) {
            foreach ($pending AS $req) {
                $links[] .= '<a href="'.site_url('manage/contest/contestants/'.$req['contest_id'].'/0').'">'.$req['title'].'</a>';
            }
        }
        $pending_links = implode(', ', $links);

        $notification = sprintf(lang('pending_contest_entry'), count($pending), $pending_links);
        if ($format) {
            if ($format) {
                $alert = (stripos($format, 'alert') === false ? 'alert-'.$format : $format);
            } else {
                $alert = 'alert-secondary';
            }
            return
            '<div class="d-flex alert '.$alert.' mt-4 container">
                <i class="fas fa-info-circle fa-3x float-left mr-2"></i>
                <div class="font-weight-bold">'.$notification.'</div>
            </div>';
        }
        return $notification;
    }

    /**
     * [basic_profile fetches data from both contests and users and unifies on on same array to ensure DRY on similar indexes]
     * @param  string  $id   [id of the contest or user to fetch]
     * @param  integer $type [Type of data being requested, 1 for contests and 0 for users]
     * @return [array]        [contains a unified named array keys for both contests and user basic data]
     */
    public function basic_profile($id = '', $type = 0)
    {   
        if ($type === 1) 
        {
            $fetch = $this->CI->contest_model->get($id); 
        } 
        else 
        {
            $fetch = $this->CI->account_data->fetch($id); 
        }

        $profile['facebook']  = $fetch['facebook'];
        $profile['twitter']   = $fetch['twitter'];
        $profile['instagram'] = $fetch['instagram'];
        $profile['name']        = @variable_switch($fetch['title'], $fetch['name']);
        $profile['description'] = @variable_switch($fetch['slug'], $fetch['bio']);
        $profile['avatar']    = $fetch['avatar'];
        $profile['cover']     = $fetch['cover'];
        $profile['id']        = $fetch['id'];

        if ($type === 1) 
        {
            $link = site_url('contest/details/'.$fetch['safelink']);
        } 
        elseif (isset($fetch['username'])) 
        {
            $link = site_url('profile/info/'.$fetch['username']);
        }
        
        $profile['link'] = $link;
        $profile['type'] = $type;

        return $profile;
    }
} 
