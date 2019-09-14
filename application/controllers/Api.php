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
		$return = array();
		$query = $this->db->query("select * from tb_gedung");
		if($query->num_rows() == 0){
			$return = array('status' => 'gagal', 'message' => 'Data tidak ada !!');	 
			echo json_encode($return);
		}else{
			$return = array('status' => 'sukses', 'message' => 'Data ada...', 'listGedung'=>$query->result());
			echo json_encode($return);
		}
	
	}

	public function pesananPaketRow(){
		$return = array();
		$id_user = $this->input->post('id_user');
		$query = $this->db->query("select tpg.*, 
					tp.id_paket as id_paket_ori, tp.nama_paket,
					tg.id_gedung as id_gedung_ori, tg.nama_gedung, tg.no_telp as no_telp_gedung, tg.gambar as gambar_gedung,
					tg.alamat as alamat_gedung from tb_pesan_gedung tpg
					inner join tb_paket tp on tp.id_paket=tpg.id_paket
					inner join tb_gedung tg on tg.id_gedung=tp.id_gedung
					where id_user = '$id_user'");
		if($query->num_rows() == 0){
			$return = array('status' => 'gagal', 'message' => 'Data tidak ada !!');	 
			echo json_encode($return);
		}else{
			$return = array('status' => 'sukses', 'message' => 'Data ada...', 'listPaket'=>$query->result());
			echo json_encode($return);
		}
	
	}

	public function paketRow(){
		$return = array();
		$id_gedung = $this->input->post('id_gedung');
		$query = $this->db->query("select * from tb_paket where id_gedung = '$id_gedung'");

		$paket = array();
		$i=0;
		foreach ($query->result() as $key) {
			$tot = 0;
			$paket[$i] =array(
				'id_paket' => $key->id_paket,
				'nama_paket' => $key->nama_paket,
			);

			$query_ket = $this->db->query("select * from tb_keterangan where id_paket = '".$key->id_paket."'");
			$ket_paket = array();

			foreach ($query_ket->result() as  $value) {
				$tot += $value->harga_ket;
				array_push($ket_paket,array(
					'id_keterangan' => $value->id_ket,
					'nama_keterangan' => $value->nama_ket,
					'harga_keterangan' => $value->harga_ket,
				));
			}
		
			$paket [$i]['keterangan'] = $ket_paket;
			$paket [$i]['tot'] = $tot;
			$i++;
		}

		
		if($query->num_rows() == 0){
			$return = array('status' => 'gagal', 'message' => 'Data tidak ada !!');	 
			echo json_encode($return);
		}else{
			$return = array('status' => 'sukses', 'message' => 'Data ada...', 'paket' =>$paket);
			echo json_encode($return);
		}
	}

	public function ketersediaanGedung($firstdate,$id_gedung){
		$id_gedung = $this->input->post('id_gedung');
		$query = $this->db->query("SELECT * from tb_pesan_gedung tpg
		inner join tb_paket tp on tp.id_paket=tpg.id_paket
		inner join tb_gedung tg on tg.id_gedung=tp.id_gedung
		where tg.id_gedung='$id_gedung' and tpg.tanggal_sewa='$firstdate' and (tpg.status = 'active' or tpg.status = 'ordered')");
		if($query->num_rows() == 0){
			return true;
		}else{
			return false;
		}

	}

	//mem booking gedung sebelum bayar apa-apa
	public function orderGedung(){
		$firstdate = $this->input->post('tanggal_sewa', true);
		$id_gedung = $this->input->post('id_gedung', true);
		if(!$this->ketersediaanGedung($firstdate, $id_gedung)){
			$result = array(
				'status' => 'gagal',
				'message' => 'gedung tidak tersedia'
			);
			echo json_encode($result);
            die();
		}else{
			$data = array(
				'id_paket'	=> $this->input->post('id_paket', true),	
				'id_user'	=> $this->input->post('id_user', true),	
				'jam_sewa_awal'	=> $this->input->post('jam_sewa_awal', true),	
				'jam_sewa_akhir'	=> $this->input->post('jam_sewa_akhir', true),
				'tanggal_sewa'	=> $firstdate,
				'nama_pemesan'	=> $this->input->post('nama_pemesan', true),
				'keterangan'	=> $this->input->post('keterangan', true),
				'status'	=> 'pending',
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
		
	}

	//mengedit orderan menjadi expired
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

	//upload bukti bayar
	public function addBooking(){
		$firstdate = $this->input->post('firstdate', true);
		$id_gedung = $this->input->post('id_gedung', true);
		if(!$this->ketersediaanGedung($firstdate,$id_gedung)){
			$result = array(
				'status' => 'gagal',
				'message' => 'gedung tidak tersedia'
			);
			echo json_encode($result);
            die();
		}
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
					'id_pesan_gedung'	=> $this->input->post('id_pesan_gedung', true),
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

	//list transaksi
	public function listTransaksi(){
		$id_user = $this->input->post('id_user');
		$data = array(
			'status'	=> 'expired',
		);
		$query = $this->db->query("SELECT * from tb_pesan_gedung where id_user = '$id_user' and DATE_ADD(NOW(), INTERVAL 2 HOUR) < waktu_pesan");
		$result = array();
		foreach ($query->result() as $value) {
			$biaya =0;
			$query2 = $this->db->query("SELECT tb_paket.id_paket, tb_paket.nama_paket, tb_pesan_gedung.id_pesan,
			tb_pesan_gedung.jam_sewa_awal,
			tb_pesan_gedung.jam_sewa_akhir, tb_pesan_gedung.tanggal_sewa, tb_pesan_gedung.status, 
			tb_pesan_gedung.nama_pemesan, tb_pesan_gedung.keterangan, tb_gedung.nama_gedung from tb_paket 
			left join tb_pesan_gedung on tb_pesan_gedung.id_paket=tb_paket.id_paket
			left join tb_gedung on tb_gedung.id_gedung = tb_paket.id_gedung
			 where tb_paket.id_paket = '".$value->id_paket."'");


			$result = $query2->result();
		}
		if($query->num_rows() != 0){
			$result = array(
				'status' => 'sukses',
				'message' => 'Transaksi ditemukan',
				'result' => $result
			);
			echo json_encode($result);
		}else{
			$result = array(
				'status' => 'gagal',
				'message' => 'Transaksi tidak ditemukan'
			);
			echo json_encode($result);
		}
	}
}
