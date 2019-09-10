<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gedung extends CI_Controller {

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
        if(empty($this->session->userdata('id_user')) || $this->session->userdata('id_user') == ''){
        	echo '<script>alert("Silahkan login terlebih dahulu!!");window.location.href = "'.base_url().'";</script>';
        }
        
    }
	public function index()
	{
		// var_dump("expression");exit();
		$data = array(
			'page' => 'gedung/index',
			'link' => 'gedung',
			'script' => 'gedung/script',
			'data_gedung' => $this->db->query("select * from tb_gedung")
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function tambah(){
		$data = array(
			'page' => 'gedung/tambah',
			'link' => 'gedung',
			'script' => 'gedung/script'
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function store(){
		
        	$config ['upload_path'] = './file_upload/';
	        $config ['allowed_types'] = 'jpg|jpeg|JPG|JPEG|png|PNG';
	        $config ['max_size'] = '2000';
	        $config ['file_name'] = date("YmdHis");
	        $this->upload->initialize($config);

	        if(!$this->upload->do_upload('gambar')){
	            // $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
	            // echo json_encode($msg);
	            echo '<script>alert("'.$this->upload->display_errors().'");window.location.href = "'.base_url().'gedung";</script>';
	            exit();
	        }else{
	        	$this->upload->do_upload('gambar');
	        	$upload_data = $this->upload->data();
		        $lampiran = $upload_data['file_name'];
		        $data = array(
					'nama_gedung'	=> $this->input->post('nama', true),
					'no_telp'	=> $this->input->post('no_telp', true),
					'gambar'	=> $upload_data['file_name'],
					'alamat'	=> $this->input->post('alamat', true),
				);
				$save = $this->db->insert('tb_gedung', $data);
				if($save){
					echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'gedung";</script>';
				}else{
					echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
				}
	        }
	}

	public function hapus($id){
		$hapus = $this->db->delete('tb_gedung', array('id_gedung' => $id));
		if($hapus){
			echo '<script>alert("Berhasil dihapus!!");window.history.back();</script>';
		}else{
			echo '<script>alert("Gagal dihapus!!");window.history.back();</script>';
		}
	}

	public function edit($id){
		$data = array(
			'page' => 'gedung/edit',
			'script' => 'gedung/script',
			'data_gedung' => $this->db->query("select * from tb_gedung where id_gedung = '$id'")
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function update(){
		if (!is_uploaded_file($_FILES['gambar']['tmp_name'])) {
			$data = array(
				'nama_gedung'	=> $this->input->post('nama', true),
				'no_telp'	=> $this->input->post('no_telp', true),
				'alamat'	=> $this->input->post('alamat', true),
			);
			$save = $this->db->update('tb_gedung', $data, array('id_gedung' => $this->input->post('id_gedung', true)));
			if($save){
				echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'gedung";</script>';
			}else{
				echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
			}
		}else{
			$config ['upload_path'] = './file_upload/';
	        $config ['allowed_types'] = 'jpg|jpeg|JPG|JPEG|png|PNG';
	        $config ['max_size'] = '2000';
	        $config ['file_name'] = date("YmdHis");
	        $this->upload->initialize($config);

	        if(!$this->upload->do_upload('gambar')){
	            // $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
	            // echo json_encode($msg);
	            echo '<script>alert("'.$this->upload->display_errors().'");window.location.href = "'.base_url().'gedung";</script>';
	            exit();
	        }else{
	        	$this->upload->do_upload('gambar');
	        	$upload_data = $this->upload->data();
		        $data = array(
					'nama_gedung'	=> $this->input->post('nama', true),
					'no_telp'	=> $this->input->post('no_telp', true),
					'gambar'	=> $upload_data['file_name'],
					'alamat'	=> $this->input->post('alamat', true),
				);
				$save = $this->db->update('tb_gedung', $data, array('id_gedung' => $this->input->post('id_gedung', true)));
				if($save){
					echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'gedung";</script>';
				}else{
					echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
				}
	        }
	    }
	}

	public function paket ($id){
		$data = array(
			'page' => 'gedung/paket',
			'link' => 'gedung',
			'id_gedung' => $id,
			'script' => 'gedung/script',
			'data_gedung' => $this->db->query("select * from tb_gedung where id_gedung = '$id'"),
			'data_paket' => $this->db->query("select * from tb_paket where id_gedung = '$id'"),
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function tambah_paket($id){
		$data = array(
			'page' => 'gedung/tambah_paket',
			'link' => 'gedung',
			'script' => 'gedung/script',
			'id_gedung' => $id
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function store_paket(){
		$data = array(
			'id_gedung'		=> $this->input->post('id_gedung', true),
			'nama_paket'		=> $this->input->post('nama_paket', true),
			'harga_paket'	=> $this->input->post('harga_paket', true),
		);
		$save = $this->db->insert('tb_paket', $data);
		if($save){
			echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'gedung/paket/'.$this->input->post('id_gedung', true).'";</script>';
		}else{
			echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
		}
	}

	public function edit_paket($id_gedung, $id_paket){
		$data = array(
			'page' => 'gedung/edit_paket',
			'script' => 'gedung/script',
			'link' => 'gedung',
			'id_gedung' => $id_gedung,
			'id_paket' => $id_paket,
			'data_paket' => $this->db->query("select * from tb_paket where id_paket = '$id_paket'")
		);
		$this->load->view('template_srtdash/wrapper', $data);
	}

	public function update_paket(){
		$data = array(
			// 'id_gedung'		=> $this->input->post('id_gedung', true),
			'nama_paket'		=> $this->input->post('nama_paket', true),
			'harga_paket'	=> $this->input->post('harga_paket', true),
		);
		$save = $this->db->update('tb_paket', $data, array('id_paket' => $this->input->post('id_paket', true)));
		if($save){
			echo '<script>alert("Berhasil disimpan!!");window.location.href = "'.base_url().'gedung/paket/'.$this->input->post('id_gedung', true).'";</script>';
		}else{
			echo '<script>alert("Gagal disimpan!!");window.history.back();</script>';
		}
	}

	public function hapus_paket($id){
		$hapus = $this->db->delete('tb_paket', array('id_paket' => $id));
		if($hapus){
			echo '<script>alert("Berhasil dihapus!!");window.history.back();</script>';
		}else{
			echo '<script>alert("Gagal dihapus!!");window.history.back();</script>';
		}
	}
}