<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
        parent::__construct();
	}

	public function login()
	{
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

	public function tambah(){
		$data = array(
			'page' => 'user/tambah',
			'link' => 'user',
			'script' => 'user/script'
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function signup(){
		$data = array(
			'nama'	=> $this->input->post('nama', true),
			'email'	=> $this->input->post('email', true),
			'no_hp'	=> $this->input->post('no_hp', true),
			'alamat'	=> $this->input->post('alamat', true),
			'password'	=> password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'level'=> 'User',
			'jenis_kelamin'=> $this->input->post('jenis_kelamin', true),
		);
		$save = $this->db->insert('tb_user', $data);
		if($save){
			$return = array('status' => 'sukses', 'message' => 'Sukses mendaftar...');
			echo json_encode($return);
		}else{
			$return = array('status' => 'gagal', 'message' => 'Gagal mendaftar !!');
			echo json_encode($return);
		}
	}

	public function hapus($id){
		$hapus = $this->db->delete('tb_user', array('id_user' => $id));
		if($hapus){
			echo '<script>alert("Berhasil dihapus!!");window.history.back();</script>';
		}else{
			echo '<script>alert("Gagal dihapus!!");window.history.back();</script>';
		}
	}

	public function edit($id){
		$data = array(
			'page' => 'user/edit',
			'link' => 'user',
			'script' => 'user/script',
			'data_user' => $this->db->query("select * from tb_user where id_user = '$id'")
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function update(){
		if($this->input->post('password', true) == ''){
			$data = array(
				'nama'	=> $this->input->post('nama', true),
				'email'	=> $this->input->post('email', true),
				'no_hp'	=> $this->input->post('no_hp', true),
				'alamat'	=> $this->input->post('alamat', true),
				'level'=> $this->input->post('level', true),
				'jenis_kelamin'=> $this->input->post('jk', true),
			);
		}else{
			$data = array(
				'nama'	=> $this->input->post('nama', true),
				'email'	=> $this->input->post('email', true),
				'no_hp'	=> $this->input->post('no_hp', true),
				'alamat'	=> $this->input->post('alamat', true),
				'password'	=> password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
				'level'=> $this->input->post('level', true),
				'jenis_kelamin'=> $this->input->post('jk', true),
			);
		}
		$save = $this->db->update('tb_user', $data, array('id_user' => $this->input->post('id_user', true)));
		if($save){
			echo '<script>alert("Berhasil diupdate!!");window.location.href = "'.base_url().'user";</script>';
		}else{
			echo '<script>alert("Gagal diupdate!!");window.history.back();</script>';
		}
	}
}