<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Srtdash extends CI_Controller {

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
			'page' => 'dashboard_srtdash'
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}
}