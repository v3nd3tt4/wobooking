<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terbooking extends CI_Controller {

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
        $this->load->Model('Model');
        if(empty($this->session->userdata('id_user')) || $this->session->userdata('id_user') == ''){
        	echo '<script>alert("Silahkan login terlebih dahulu!!");window.location.href = "'.base_url().'";</script>';
        }
        
    }

    public function index()
	{
		$query = $this->db->query("SELECT * from tb_pesan_gedung left join tb_paket on tb_paket.id_paket = tb_pesan_gedung.id_paket left join tb_gedung on tb_paket.id_gedung = tb_gedung.id_gedung where status in ('pending', 'ordered') order by tanggal_sewa ASC");
		// var_dump("expression");exit();
		$data = array(
			'page' => 'terbooking/index',
			'link' => 'booked',
			'script' => 'terbooking/script',
			'data_transaksi' => $query
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function detail($id_pesan){
		$query = $this->db->query("SELECT * from tb_pesan_gedung left join tb_paket on tb_paket.id_paket = tb_pesan_gedung.id_paket left join tb_gedung on tb_paket.id_gedung = tb_gedung.id_gedung where id_pesan = '$id_pesan'");

		$query2 = $this->db->query("SELECT * from tb_transaksi left join tb_file_upload on tb_file_upload.id_file_upload = tb_transaksi.id_file_upload where  id_pesan_gedung = '$id_pesan'");


		$data = array(
			'page' => 'terbooking/detail_trx',
			'link' => 'booked',
			'script' => 'terbooking/script',
			'data_transaksi' => $query,
			'data_bukti' => $query2
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

}