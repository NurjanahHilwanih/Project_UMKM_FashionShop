<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = "Produk";
        $data['produk'] = $this->admin->getProduk();
        $this->template->load('templates/dashboard', 'produk/data', $data);
    }

    private function _config()
    {
        $image_path = realpath(APPPATH . '../assets/upload');
        $config['upload_path']      = $image_path;
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = '5000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Jenis Produk', 'required');
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|trim|numeric');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|trim|numeric');
    }

    public function add()
    {
        $this->_validasi();
        $this->_config();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Produk";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');

            // Mengenerate ID Produk
            $kode_terakhir = $this->admin->getMax('produk', 'id_produk');
            $kode_tambah = substr($kode_terakhir, -2, 2);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 2, '0', STR_PAD_LEFT);
            $data['id_produk'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'produk/add', $data);
        } else {

            $input = $this->input->post(null, true);
            if (empty($_FILES['foto']['name'])) {
                $save = $this->admin->insert('produk', $input);
                if ($save) {
                    set_pesan('data berhasil disimpan.');
                    redirect('produk');
                } else {
                    set_pesan('data gagal disimpan', false);
                    redirect('produk/add');
                }
            } else {
                if ($this->upload->do_upload('foto') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    $input['foto'] = $this->upload->data('file_name');
                    $save = $this->admin->insert('produk', $input);
                    if ($save) {
                        set_pesan('data berhasil disimpan.');
                        redirect('produk');
                    } else {
                        set_pesan('data gagal disimpan', false);
                        redirect('produk/add');
                    }
                }
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "produk";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
            $data['produk'] = $this->admin->get('produk', ['id_produk' => $id]);
            $this->template->load('templates/dashboard', 'produk/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('produk', 'id_produk', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('produk');
            } else {
                set_pesan('data gagal diedit.');
                redirect('produk/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('produk', 'id_produk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('produk');
    }
    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        //return $query;
        output_json($query);
    }
}
