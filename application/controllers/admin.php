<?php
defined('BASEPATH') or exit ('NO direct script access allowed');

class admin extends CI_controller{
	function __construct(){
		parent ::__construct();
		// cek login
		if ($this ->session->userdata('status') != "login"){
			redirect(base_url().'welcome?pesan=belumlogin');
		}
	}

	function index(){
		$data['transaksi'] = $this->db->query("select * from transaksi order by id_pinjam desc limit 10")->result();
		$data['anggota'] = $this->db->query("select * from anggota order by id_anggota desc limit 10")->result();
		$data['buku'] = $this->db->query("select * from buku order by id_buku desc limit 10")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
	}
	
	function buku(){
		$data['buku'] = $this->m_perpus->get_data('buku')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/databuku',$data);
		$this->load->view('admin/footer');
	}


	function logout(){
		$this->session->sess_destroy();
		redirect(base_url(). 'welcome?pesan=logout');
	}

	function ganti_password(){
		$this->load->view('admin/header');
		$this->load->view('admin/ganti_password');
		$this->load->view('admin/footer');
	}

	function ganti_password_act(){
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');

		$this->form_validation->set_rules('pass_baru','password baru','required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass','ulangi password','required');
		if($this->form_validation->run() != false){

			$data = array('password' => md5($pass_baru));
			$w = array('id_admin'=> $this->session->userdata('id'));

			$this->m_perpus->update_data($w,$data,'admin');
			redirect(base_url(). 'admin/ganti_password?pesan=berhasil');
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/ganti_password');
			$this->load->view('admin/footer');
		}
	}
    function tambah_buku(){
        $data['kategori']=$this->m_perpus->get_data('kategori')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/tambahbuku',$data);
		$this->load->view('admin/footer');
	}
    function tambah_buku_act(){
        $tgl_input=date('y-m-d');
        $id_kategori=$this->input->post('id_kategori');
        $judul=$this->input->post('judul_buku');
        $pengarang=$this->input->post('pengarang');
        $penerbit=$this->input->post('penerbit');
        $thn_terbit=$this->input->post('thn_terbit');
        $isbn=$this->input->post('isbn');
        $jumlah_buku=$this->input->post('jumlah_buku');
        $lokasi=$this->input->post('status_buku');
        $status=$this->input->post('status');
        $this->form_validation->set_rules('id_kategori','Kategori','required');
        $this->form_validation->set_rules('judul_buku','Judul Buku','required');
        $this->form_validation->set_rules('status','Status Buku','required');
        if($this->form_validation->run() != false){
          $config['upload_path']='./assets/upload/';
            $config['allowed_types']='jpg|png|jpeg';
            $config['max_size']='2048';
            $config['file_name']='gambar'.time();
            
            $this->load->library('upload',$config);
            
            if($this->upload->do_upload('foto')){
                $image=$this->upload->data();
                $data=array(
                'id_kategori'=>$id_kategori,
                    'judul_buku'=>$judul,
                    'pengarang'=>$pengarang,
                    'penerbit'=>$penerbit,
                    'thn_terbit'=>$thn_terbit,
                    'isbn'=>$isbn,
                    'jumlah_buku'=>$jumlah_buku,
                    'lokasi'=>$lokasi,
                    'gambar'=>$image['file_name'],
                    'tgl_input'=>$tgl_input,
                    'status_buku'=>$status
                );
                $this->m_perpus->insert_data($data,'buku');
                redirect(base_url().'admin/buku');
            }else{
                $this->session->set_flashdata('alert','Anda Blum memilih Foto');
            }
        }else{
            $data['kategori']=$this->m_perpus->get_data('kategori')->result();
            $this->load->view('admin/header');
            $this->load->view('admin/tambahbuku',$data);
            $this->load->view('admin/footer');
        }
    }
    function edit_buku($id){
		$where = array('id_buku' => $id);
		$data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=k.id_kategori and B.id_buku='$id'")->result();
		$data['kategori'] = $this->m_perpus->get_data('kategori')->result();
		//$data['buku'] = $this->m_perpus->edit_data($where,'buku')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/edit_buku',$data);
		$this->load->view('admin/footer');
	}

	function update_buku(){
		$id = $this->input->post('id');
		$id_kategori = $this->input->post('id_kategori');
		$judul = $this->input->post('judul_buku');
		$pengarang = $this->input->post('pengarang');
		$penerbit = $this->input->post('penerbit');
		$thn_terbit = $this->input->post('thn_terbit');
		$isbn = $this->input->post('isbn');
		$jumlah_buku = $this->input->post('jumlah_buku');
		$lokasi = $this->input->post('lokasi');
		$status = $this->input->post('status');
		$old_pict = $this->input->post('old_pict');
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
		$this->form_validation->set_rules('judul_buku', 'Judul Buku' ,'required|min_length[4]');
		$this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[4]');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[4]');
		$this->form_validation->set_rules('thn_terbit', 'Tahun Terbit', 'required|min_length[4]');
		$this->form_validation->set_rules('isbn', 'Nomer ISBN', 'required|numeric');
		$this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric');
		$this->form_validation->set_rules('lokasi', 'Lokasi Buku', 'required|min_length[4]');
		$this->form_validation->set_rules('status', 'Status Buku', 'required');

		if($this->form_validation->run() != false){
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'gambar'.time();

			$this->load->library('upload', $config);

			$where = array('id_buku' => $id);
			$data= array(
				'id_kategori' => $id_kategori,
				'judul_buku' => $judul,
				'pengarang' => $pengarang,
				'penerbit' => $penerbit,
				'thn_terbit' => $thn_terbit,
				'isbn' => $isbn,
				'jumlah_buku' => $jumlah_buku,
				'lokasi' => $lokasi,
				'gambar' => $image['file_name'],
				'status_buku' => $status
			);
			@unlink('./assets/upload/',$old_pict);
			if($this->upload->do_upload('foto')){
				//proses upload gambar
				$image = $this->upload->data();
				unlink('assets/upload/'.$this->input->post('old_pict', TRUE));
				$data['gambar'] = $image['file_name'];

				$this->m_perpus->update_data($where, $data,'buku');
			}else {
				$this->m_perpus->update_data($where, $data,'buku');
			}

			$this->m_perpus->update_data($where,$data,'buku');
			redirect(base_url().'admin/buku');
		}else {
			$where = array('id_buku' => $id);
			$data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
			$data['kategori'] =$this->m_perpus->get_data('kategori')->result();
			//$data['buku'] = $this->m_perpus->edit_data($where,'buku')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/editbuku',$data);
			$this->load->view('admin/footer');
		}
	}
    function hapus_buku($id){
		$where = array('id_buku'=>$id);
		$this->m_perpus->delete_data($where,'buku');
		redirect(base_url().'admin/buku');
	}
    
    function peminjaman(){
        $data['peminjaman']=$this->db->query("SELECT * FROM transaksi T, buku B, anggota A WHERE T.id_buku=B.id_buku and T.id_anggota=A.id_anggota")->result();
        
        $this->load->view('admin/header');
        $this->load->view('admin/peminjaman',$data);
        $this->load->view('admin/footer');
    }
    function transaksi_add(){
        $w=array('status_buku'=>'1');
        $data['buku']=$this->m_perpus->edit_data($w,'buku')->result();
        $data['anggota']=$this->m_perpus->get_data('anggota')->result();
        $data['transaksi']=$this->m_perpus->get_data('transaksi')->result();
        
        $this->load->view('admin/header');
        $this->load->view('admin/tambah_peminjaman',$data);
        $this->load->view('admin/footer');
    }
    function transaksi_add_act(){
    $tanggal_pencatatan=date('Y-m-d H:i:s');
        $anggota=$this->input->post('anggota');
        $buku=$this->input->post('buku');
        $tgl_pinjam=$this->input->post('tgl_pinjam');
        $tgl_kembali=$this->input->post('tgl_kembali');
        $denda=$this->input->post('denda');
        $this->form_validation->set_rules('anggota','Anggota','required');
        $this->form_validation->set_rules('buku','Buku','required');
        $this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
        $this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
        $this->form_validation->set_rules('denda','Denda','required');
        
        if($this->form_validation->run() != false){
			$data= array(
				'tgl_pencatatan' => $tanggal_pencatatan,
				'id_anggota' => $anggota,
				'id_buku' => $buku,
				'tgl_pinjam' => $tgl_pinjam,
				'tgl_kembali' => $tgl_kembali,
				'denda' => $denda,
				'tgl_pengembalian' => '0000-00-00',
				'total_denda' => '0',
				'status_pengembalian' => '0',
				'status_peminjaman' => '0'
			);
				$this->m_perpus->insert_data($data,'transaksi');
			$d=array('status_buku'=>'0','tgl_input'=>substr($tanggal_pencatatan,0,10));
            $w=array('id_buku'=>$buku);
				$this->m_perpus->update_data($w, $d,'buku');
            redirect(base_url().'admin/peminjaman');
			}else{
            $w=array('status_buku'=>'1');
            $data['buku']=$this->m_perpus->edit_data($w,'buku')->result();
            $data['anggota']=$this->m_perpus->get_data('anggota')->result();
            
            $this->load->view('admin/header');
            $this->load->view('admin/tambah_peminjam',$data);
            $this->load->view('admin/footer');
        }


    }
    function hapus_peminjaman($id){
       $w=array('id_pinjam'=>$id);
        $data=$this->m_perpus->edit_data($w,'transaksi')->row();
        $ww=array('id_buku'=>$data->id_buku);
        $data2=array('status_buku'=>'1');
        $this->m_perpus->update_data($ww, $data2,'buku');
        $this->m_perpus->delete_data($w, 'transaksi');
        redirect(base_url().'admin/peminjaman');
    }
    //function transaksi_selesai($id){    
    //}
    
    function anggota(){
        $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
        $this->load->view('admin/header');
        $this->load->view('admin/anggota',$data);
        $this->load->view('admin/footer');
    }
    function anggota_add(){
        $data['anggota']=$this->m_perpus->get_data('anggota')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/tambahanggota',$data);
		$this->load->view('admin/footer');
    }
    function anggota_add_act(){
        $nama_anggota=$this->input->post('nama_anggota');
        $gender=$this->input->post('gender');
        $no_telp=$this->input->post('no_telp');
        $alamat=$this->input->post('alamat');
        $emali=$this->input->post('emali');
        $password=$this->input->post('password');
        $this->form_validation->set_rules('nama_anggota','Nama Anggota','required');
        $this->form_validation->set_rules('gender','Jenis Kelamin','required');
        $this->form_validation->set_rules('no_telp','No Telpon','required');
        $this->form_validation->set_rules('alamat','alamat','required');
        $this->form_validation->set_rules('emali','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() != false){
                $data=array(
                'nama_anggota'=>$nama_anggota,
                    'gender'=>$gender,
                    'no_telp'=>$no_telp,
                    'alamat'=>$alamat,
                    'emali'=>$emali,
                    'password'=>md5($password)
                );
                $this->m_perpus->insert_data($data,'anggota');
                redirect(base_url().'admin/anggota');
            }else{
                $this->session->set_flashdata('alert','Data Masih Kosong');
            
        }
            $data['anggota']=$this->m_perpus->get_data('anggota')->result();
            $this->load->view('admin/header');
            $this->load->view('admin/tambahanggota',$data);
            $this->load->view('admin/footer');
        
    }
    function hapus_anggota($id){
		$where = array('id_anggota'=>$id);
		$this->m_perpus->delete_data($where,'anggota');
		redirect(base_url().'admin/anggota');
	}
    
}
