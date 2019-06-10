<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_setting');
		$this->load->model('backend/m_usermanagement');
	}

	public function index()
	{
		$this->form_validation->set_rules('fullname_aplikasi', 'Fullname Aplikasi', 'required|trim|matches[fullname_aplikasi]',
			[
				'required'	=> 'Fullname Aplikasi Tidak Boleh Kosong'
			]);
		$this->form_validation->set_rules('username_aplikasi', 'Username Aplikasi', 'required|trim|matches[username_aplikasi]',
			[
				'required'	=> 'Username Aplikasi Tidak Boleh Kosong'
			]);
		$this->form_validation->set_rules('versi_aplikasi', 'Versi', 'required|trim|matches[versi_aplikasi]',
			[
				'required'	=> 'Versi Aplikasi Tidak Boleh Kosong'
			]);
		$this->form_validation->set_rules('hak_cipta', 'Hak Cppta', 'required|trim|matches[hak_cipta]',
			[
				'required'	=> 'Hak CIpta Aplikasi Tidak Boleh Kosong'
			]);
		$this->form_validation->set_rules('url_hakcipta', 'URL Hak Cipta', 'required|trim|matches[url_hakcipta]',
			[
				'required'	=> 'URL Hak Cipta Aplikasi Tidak Boleh Kosong'
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'Pengaturan';
			$sub_title		= '';
			$this->header($title, $sub_title);

			$isi['setting']	= $this->m_setting->getsetting();
			$isi['profile']	= $this->m_usermanagement->getprofile();
			$this->load->view('backend/v_setting', $isi);

			$this->footer();
		}
		else
		{
			$this->updatesetting();
		}
	}

	private function updatesetting()
	{
		$config['upload_path']   = './files/img_aplikasi/';
        $config['file_name']     = $_FILES['foto']['name'];
        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
        $config['max_size']      = 1024;

        $this->load->library('upload');
        $this->upload->initialize($config);

		if (!$this->upload->do_upload('foto')) 
		{
			$update = array (
								'username_aplikasi' => $this->input->post('username_aplikasi'),
								'fullname_aplikasi' => $this->input->post('fullname_aplikasi'),
								'versi_aplikasi' 	=> $this->input->post('versi_aplikasi'),
								'hak_cipta' 		=> $this->input->post('hak_cipta'),
								'url_hakcipta' 		=> $this->input->post('url_hakcipta'),
							);
			$this->db->where('id_aplikasi', $this->input->post('id_aplikasi'))->update('config_application', $update);
			$this->session->set_flashdata('message', 'Pengaturan Aplikasi Berhasil...');
			redirect('backend/setting/view-aplikasi');
		}
		else
		{
			$media     		= $this->upload->data();
            $foto     		= $media['file_name'];

            $query = $this->db->where('id_aplikasi', $this->input->post('id_aplikasi'))->get('config_application');
	        $row_query = $query->row_array();
	        unlink ($link_file);

	        $update = array (
								'username_aplikasi' => $this->input->post('username_aplikasi'),
								'fullname_aplikasi' => $this->input->post('fullname_aplikasi'),
								'icon_aplikasi'		=> $foto,
								'versi_aplikasi' 	=> $this->input->post('versi_aplikasi'),
								'hak_cipta' 		=> $this->input->post('hak_cipta'),
								'url_hakcipta' 		=> $this->input->post('url_hakcipta'),
								
						    );
	        $this->db->where('id_aplikasi', $this->input->post('id_aplikasi'))->update('config_application', $update);
			$this->session->set_flashdata('message', 'Pengaturan Aplikasi Berhasil...');
			redirect('backend/setting/view-aplikasi');
		}
	}

}
