<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$users = $this->session->get_userdata();
		
		if(empty($users['email']))
			redirect('authentication/index'); 

	}
	
	public function index()
	{
		$this->data['coulmns'] = 	[
										['name'=>'User Id' ,'width'=> '12%' ],
										['name'=>'Username' ,'width'=> '12%' ],
										['name'=>'Email' ,'width'=> '3%' ],
										['name'=>'Phone' ,'width'=> '3%' ],
										['name'=>'Password' ,'width'=> '7%' ],
										['name'=>'Status' ,'width'=> '5%' ],
										['name'=>'Created at' ,'width'=> '15%' ],
										['name'=>'Updated at' ,'width'=> '15%' ],
										['name'=>'Actions' ,'width'=> '7%' ],
									];
		$this->data['users'] = $this->Users_model->getAllUsers(); 
		$this->load->view('users/users',$this->data);
	}

	public function create()
	{
		$token = $this->input->post('token');
		if(!empty($token))
		{
			$this->form_validation->set_rules('token', 'Token', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
		
			if ( $this->form_validation->run() == true)
			{
				$token = $this->input->post('token');
				$data= 	[
							"username"		=>	$this->input->post('username') 	,
							"email"			=>	$this->input->post('email') 	,
							"password"		=>	sha1($this->input->post('password'))  ,
							"phone"			=>	$this->input->post('phone') 	,
							"status"		=>	$this->input->post('status') 	,
							"created_on"	=>	date("Y-m-d H:i:s") 			,
						];
			
				$this->Users_model->addUsers($data); 
				$this->data['create'] = 1; 
				$this->data['message']['success'] = "User ".$this->input->post('username')." has been succesfully created! "; 
				$this->load->view('users/edit',$this->data);
			}
			else 
			{
				$this->data['message'] = $this->form_validation->error_array();
				$this->data['create'] = 1; 
				$this->load->view('users/edit',$this->data);
			}
		}
		else 
		{
			$this->data['create'] = 1; 
			$this->load->view('users/edit',$this->data);
			
		}
	}

	public function delete( $user_id = null)
	{
		$this->Users_model->deleteUsers( $user_id ); 
		$this->data['coulmns'] = 	[
			['name'=>'User Id' ,'width'=> '12%' ],
			['name'=>'Username' ,'width'=> '12%' ],
			['name'=>'Email' ,'width'=> '3%' ],
			['name'=>'Phone' ,'width'=> '3%' ],
			['name'=>'Password' ,'width'=> '7%' ],
			['name'=>'Status' ,'width'=> '5%' ],
			['name'=>'Created at' ,'width'=> '15%' ],
			['name'=>'Updated at' ,'width'=> '15%' ],
			['name'=>'Actions' ,'width'=> '7%' ],
		];
		$this->data['users'] = $this->Users_model->getAllUsers(); 
		$this->data['message']['success'] = "User has been Succesfully Deleted! "; 
		$this->load->view('users/users',$this->data);


	}

	public function update($user_id=null)
	{
		$token = $this->input->post('token');
		if(!empty($token))
		{
			$data= 	[	
						"user_id"		=>  $user_id								,
						"username"		=>	$this->input->post('username') 			,
						"email"			=>	$this->input->post('email') 			,
						"password"		=>	sha1($this->input->post('password'))	,
						"phone"			=>	$this->input->post('phone') 			,
						"status"		=>	$this->input->post('status') 			,
						"updated_on"	=>	date("Y-m-d H:i:s") 					,
					];
			$this->Users_model->updateUsers($data); 
			$this->data['update'] = 1; 
			$this->data['message']['success'] = "User ".$this->input->post('username')." has been succesfully updated! "; 
			$this->load->view('users/edit',$this->data);
		}
		else 
		{
			$this->data['update'] = 1; 
			$this->data['users'] = $this->Users_model->getUsersById($user_id); 
			$this->load->view('users/edit',$this->data);
		}
	}

}
