<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
	{
        $token = $this->input->post('token');
		if(!empty($token))
		{
                        
            $this->form_validation->set_rules('token', 'Token', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
		
			if ( $this->form_validation->run() == true)
			{
                
                $email      = $this->input->post('email');
                $password   = sha1($this->input->post('password'));
                
                $user =  $this->Authentication_model->authenticateUser($email,$password);
               
               if(isset($user[0]->username ))
               {

                    $data = [
                                "username"		=>	$user[0]->username 	            ,
                                "email"			=>	$user[0]->email 	            ,
                                "password"		=>	$user[0]->password              ,
                                "phone"			=>	$user[0]->phone 	            ,
                                "status"		=>	$user[0]->status 	            ,
                                "created_on"	=>	$user[0]->created_on 			,
                                "updated_on"	=>	$user[0]->updated_on 			
                            ];


                    $this->session->set_userdata($data);             
                    redirect('users/index'); 
                
                }
                else 
                {
                   $this->data['message']['error'] = "Email or Password do not match !"; 
                   $this->load->view('authentication/login',$this->data);
                }

			}
			else 
			{
				$this->data['message'] = $this->form_validation->error_array();
                $this->load->view('authentication/login',$this->data);
			}
		}
		else 
		{
			 $this->load->view('authentication/login');
			
		}
    }
    
    public function signOut() 
    {
        $this->session->sess_destroy();
        redirect('authentication/index'); 
    }
}