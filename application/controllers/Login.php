<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	 * @see https://codeigniter.com/gedung_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->library('upload');
        if($this->session->userdata('id_user')!=''){
        	echo '<script>alert("Anda sudah login!!");window.location.href = "'.base_url().'srtdash";</script>';
        }
        
    }
	public function index()
	{
		// var_dump("expression");exit();
		$data = array(
			'page' => 'login',
		);
		$this->load->view('login', $data);
	}
	public function proses_login()
	{
		$username = $this->input->post('username', true);
    	$password = $this->input->post('password', true);

    	$get = $this->db->query("select * from tb_user where email = '$username' ");

    	if($get->num_rows() == 0){
	        echo '<script>alert("Username tidak ditemukan!!");window.history.back();</script>';
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
    			
					echo '<script>alert("Berhasil login!!");window.location.href = "'.base_url().'srtdash";</script>';
					
			} else {
			    echo '<script>alert("Password salah!!");window.history.back();</script>';
			}
    	}
	}

	public function logout(){
    	session_destroy();
    	echo '<script>alert("Berhasil Keluar!");window.location.href = "'.base_url().'";</script>';
    }
}