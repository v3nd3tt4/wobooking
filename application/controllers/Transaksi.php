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

	public function detail($id_pesan){
		$query = $this->db->query("SELECT * from tb_pesan_gedung left join tb_paket on tb_paket.id_paket = tb_pesan_gedung.id_paket left join tb_gedung on tb_paket.id_gedung = tb_gedung.id_gedung where id_pesan = '$id_pesan'");

		$query2 = $this->db->query("SELECT * from tb_transaksi left join tb_file_upload on tb_file_upload.id_file_upload = tb_transaksi.id_file_upload where  id_pesan_gedung = '$id_pesan'");


		$data = array(
			'page' => 'transaksi/detail_trx',
			'link' => 'transaksi',
			'script' => 'transaksi/script',
			'data_transaksi' => $query,
			'data_bukti' => $query2
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function validasi_pembayaran($id_transaksi){
		$query2 = $this->db->query("SELECT * from tb_transaksi left join tb_file_upload on tb_file_upload.id_file_upload = tb_transaksi.id_file_upload where  id_transaksi = '$id_transaksi'");

		$data = array(
			'page' => 'transaksi/validasi_trx',
			'link' => 'transaksi',
			'script' => 'transaksi/script',
			'data_bukti' => $query2
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function store_validasi_trx(){
		$id_trx = $this->input->post('id_transaksi', true);
		$validasi = $this->input->post('validasi', true);
		$type = $this->input->post('type_transaksi', true);
		$data = array(
			'status_bayar' => $validasi
		);

		if($type == 'DP'){
			if($validasi == 'Valid'){
				$status_pembayaran = 'DP Tervalidasi';
				$status_pemesanan = 'ordered';
			}else if($validasi == 'Tidak Valid'){
				$status_pembayaran = 'DP Tidak Tervalidasi';
				$status_pemesanan = 'pending';
			}
		}else{
			if($validasi == 'Valid'){
				$status_pembayaran = 'Sudah Lunas';
				$status_pemesanan = 'ordered';
			}else if($validasi == 'Tidak Valid'){
				$status_pembayaran = 'Pelunasan Tidak Tervalidasi';
				$status_pemesanan = 'pending';
			}
		}
		$this->db->trans_begin();
		$data2 = array(
			'status' => $status_pemesanan,
			'status_pembayaran' => $status_pembayaran
		);
		$this->db->update('tb_pesan_gedung', $data2, array('id_pesan' => $this->input->post('id_pesan_gedung', true)));

		$save = $this->db->update('tb_transaksi', $data, array('id_transaksi' => $this->input->post('id_transaksi', true)));
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
		}else{
			$this->db->trans_commit();
			echo '<script>alert("Berhasil disimpan!!");window.history.back();</script>';
		}
	}
}