<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->library('upload');
        if(empty($this->session->userdata('id_user')) || $this->session->userdata('id_user') == ''){
        	echo '<script>alert("Silahkan login terlebih dahulu!!");window.location.href = "'.base_url().'";</script>';
        }
        
    }

	public function index()
	{
		// var_dump("expression");exit();
		$data = array(
			'page' => 'user/index',
			'link' => 'user',
			'script' => 'user/script',
			'data_user' => $this->db->query("select * from tb_user")
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function tambah(){
		$data = array(
			'page' => 'user/tambah',
			'link' => 'user',
			'script' => 'user/script'
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function store(){
		$data = array(
			'nama'	=> $this->input->post('nama', true),
			'email'	=> $this->input->post('email', true),
			'no_hp'	=> $this->input->post('no_hp', true),
			'alamat'	=> $this->input->post('alamat', true),
			'password'	=> password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'level'=> $this->input->post('level', true),
			'jenis_kelamin'=> $this->input->post('jk', true),
		);
		$save = $this->db->insert('tb_user', $data);
		if($save){
			echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'user";</script>';
		}else{
			echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
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