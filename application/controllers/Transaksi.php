<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
		// var_dump("expression");exit();
		$data = array(
			'page' => 'transaksi/index',
			'link' => 'transaksi',
			'script' => 'transaksi/script'
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function laporan_range(){
		$first_date = $this->input->post('first_date', true);
		$end_date = $this->input->post('end_date', true);
		if($this->input->post('submit') == 'cek'){


			$query = $this->db->query("SELECT * from tb_pesan_gedung left join tb_paket on tb_paket.id_paket = tb_pesan_gedung.id_paket left join tb_gedung on tb_paket.id_gedung = tb_gedung.id_gedung where status in ('pending', 'ordered') and (tanggal_sewa between '$first_date' and '$end_date') order by tanggal_sewa ASC");

			$data = array(
				'page' => 'transaksi/laporan_range',
				'link' => 'transaksi',
				'script' => 'transaksi/script',
				'data_transaksi' => $query,
				'from' => $first_date,
				'end' => $end_date
			);
			$this->load->view('template_srtdash/wrapper', $data);

		}else{
			$query = $this->db->query("SELECT * from tb_pesan_gedung left join tb_paket on tb_paket.id_paket = tb_pesan_gedung.id_paket left join tb_gedung on tb_paket.id_gedung = tb_gedung.id_gedung where status in ('pending', 'ordered') and (tanggal_sewa between '$first_date' and '$end_date') order by tanggal_sewa ASC");

			$data = array(
				'data_transaksi' => $query,
				'from' => $first_date,
				'end' => $end_date
			);
			$this->load->view('transaksi/cetak', $data);
		}
		

	}
}