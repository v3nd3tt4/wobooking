<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model');
	}

	public function login(){
		$username = $this->input->post('email', true);
    	$password = $this->input->post('password', true);

    	$get = $this->db->query("select * from tb_user where email = '$username' ");

    	if($get->num_rows() == 0){
	        $return = array('status' => 'gagal', 'message' => 'Username tidak ditemukan !!');
			echo json_encode($return);
    	}else{
    		$hash = $get->row()->password;
    		if (password_verify($password, $hash)) {
    			$sess = array(
					'id_user' => $get->row()->id_user,
					'nama' => $get->row()->nama,
					'email' => $get->row()->email,
					'no_hp' => $get->row()->no_hp,
					'alamat' => $get->row()->alamat,
    				'level' => $get->row()->level,
    				'jenis_kelamin' => $get->row()->jenis_kelamin,
    			);
    			$this->session->set_userdata($sess);
    			$return = array('status' => 'sukses', 'message' => 'Login berhasil...', 'listUser'=>$sess);
				echo json_encode($return);
			} else {
			    $return = array('status' => 'gagal', 'message' => 'Password salah !!');
				echo json_encode($return);
			}
    	}
	}

	public function kirimUser(){    
		$nama = $this->input->post('nama', true);
		$alamat = $this->input->post('alamat', true);
		$email = $this->input->post('email', true);
		$no_hp = $this->input->post('no_hp', true);
		$password = $this->input->post('password', true);
		$jenis_kelamin = $this->input->post('jenis_kelamin', true);
		
		$return = array();
	  
		$user = array(
		  'nama' => $nama,
		  'alamat' => $alamat,
		  'jenis_kelamin' => $jenis_kelamin,
		  'email' => $email,
		  'no_hp' => $no_hp,
		  'password' => password_hash($password, PASSWORD_DEFAULT),
		  'level' => "User",
		);
		
		$cek_user = $this->Model->ambil('email',$email,'tb_user')->row();
		
		
		if(!isset($cek_user->email) OR trim($cek_user->email) == ""){
		  $simpan_register = $this->Model->simpan_data($user, 'tb_user');      
	
		  if($simpan_register){
			$return = array('status' => 'sukses', 'message' => 'Sukses mendaftar...');
			echo json_encode($return);
		  }else{
			$return = array('status' => 'gagal', 'message' => 'Gagal mendaftar !!');
			echo json_encode($return);
		  }
		}else {
			$return = array('status' => 'gagal', 'message' => 'Email Sudah Terdaftar !!');	 
			echo json_encode($return);
		}
	} 
}