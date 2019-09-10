<?php
defined('BASEPATH') OR die('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->library('upload');
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

	public function gedungAll(){
		$query = $this->db->query("select * from tb_gedung");
		echo json_encode($query->result());
	}

	public function paketAll(){
		$query = $this->db->query("select * from tb_paket");
		echo json_encode($query->result());
	}

	public function gedungRow(){
		$id_gedung = $this->input->post('id_gedung');
		$query = $this->db->query("select * from tb_gedung where id_gedung = '$id_gedung'");
		echo json_encode($query->row());
	}

	public function paketRow(){
		$id_paket = $this->input->post('id_paket');
		$query = $this->db->query("select * from tb_paket where id_paket = '$id_paket'");
		echo json_encode($query->row());
	}

	public function paketResult(){
		$id_paket = $this->input->post('id_paket');
		$query = $this->db->query("select * from tb_paket where id_paket = '$id_paket'");
		echo json_encode($query->result());
	}


	public function ketersediaanGedung(){
		$firstdate = '2019-09-08 06:06:00';
		$enddate = '2019-09-09 23:59:59';;
		$id_gedung = $this->input->post('id_gedung');

		$query = $this->db->query("select * from tb_pesan_gedung")
		if($query){
			$result = array(
				'status' => 'sukses',
				'message' => 'Transaksi berhasil dilakukan'
			);
			echo json_encode($result);
		}else{
			$result = array(
				'status' => 'gagal',
				'message' => 'Transaksi gagal dilakukan'
			);
			echo json_encode($result);
		}

	}

	public function orderGedung(){
		$data = array(
			'id_paket'	=> $this->input->post('id_paket', true),	
			'id_user'	=> $this->input->post('id_user', true),	
			'jam_sewa_awal'	=> $this->input->post('jam_sewa_awal', true),	
			'jam_sewa_akhir'	=> $this->input->post('jam_sewa_akhir', true),
			'tanggal_sewa'	=> $this->input->post('tanggal_sewa', true),
			'status'	=> 'active',
		);
		$save = $this->db->insert('tb_pesan_gedung', $data);
		if($save){
			$result = array(
				'status' => 'sukses',
				'message' => 'Transaksi berhasil dilakukan'
			);
			echo json_encode($result);
		}else{
			$result = array(
				'status' => 'gagal',
				'message' => 'Transaksi gagal dilakukan'
			);
			echo json_encode($result);
		}
	}

	public function updatePesanGedungToExpired(){
		$data = array(
			'status'	=> 'expired',
		);

		$save = $this->db->update('tb_pesan_gedung', $data, array('id_pesan' => $this->input->post('id_pesan', true)));
		if($save){
			$result = array(
				'status' => 'sukses',
				'message' => 'Pemesanan gedung berhasil diupdate expired'
			);
			echo json_encode($result);
		}else{
			$result = array(
				'status' => 'gagal',
				'message' => 'Pemesanan gedung gagal diupdate expired'
			);
			echo json_encode($result);
		}
	}

	public function addBooking(){

		$config ['upload_path'] = './file_upload/';
        $config ['allowed_types'] = 'jpg|jpeg|JPG|JPEG|png|PNG';
        $config ['max_size'] = '2000';
        $config ['file_name'] = date("YmdHis");
        $this->upload->initialize($config);

        $query = $this->db->query("select * from tb_transaksi where type_transaksi = '".$this->input->post('type_transaksi', true)."'");
        if($query->num_rows() != 0){
        	$result = array(
				'status' => 'gagal',
				'message' => 'anda sudah mengupload bukti pembayaran '.$this->input->post('type_transaksi', true)
			);
			echo json_encode($result);
            die();
        }else{
	        if(!$this->upload->do_upload('gambar')){
	            // $msg = array('status' => 'failed', 'text' => '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>'.$this->upload->display_errors().'</div>' );
	            // echo json_encode($msg);
	            $result = array(
					'status' => 'gagal',
					'message' => $this->upload->display_errors()
				);
				echo json_encode($result);
	            die();
	        }else{
	        	$this->upload->do_upload('gambar');
	        	$upload_data = $this->upload->data();
		        $lampiran = $upload_data['file_name'];
		        $data1 = array(
					'id_user'	=> $this->input->post('id_user', true),
					'nama_file'	=> $upload_data['file_name'],
				);
				
				$this->db->trans_begin();
				$save = $this->db->insert('tb_file_upload', $data1);
			    $data2 = array(
					'id_user'	=> $this->input->post('id_user', true),
					'id_file_upload'	=> $this->db->insert_id(),	
					'type_transaksi'	=> $this->input->post('type_transaksi', true),	
					'jumlah_bayar'	=> $this->input->post('jumlah_bayar', true),	
					'tanggal_bayar'	=> date('y-m-d H:i:s'),
					'status_bayar'	=> $this->input->post('status_bayar', true),
				);
				$save = $this->db->insert('tb_transaksi', $data2);
				$data3 = array(
					'status'	=> 'ordered',
				);
				$this->db->update('tb_pesan_gedung', $data3, array('id_pesan' => $this->input->post('id_pesan', true)));
				if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$result = array(
						'status' => 'gagal',
						'message' => 'Transaksi gagal dilakukan'
					);
					echo json_encode($result);
				}else{
					$this->db->trans_commit();
					$result = array(
						'status' => 'sukses',
						'message' => 'Transaksi berhasil dilakukan'
					);
					echo json_encode($result);
				}
	        }	
	    }	
	}
}