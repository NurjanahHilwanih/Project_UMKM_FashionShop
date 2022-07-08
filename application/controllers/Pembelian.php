<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Pembelian";
        $data['produkmasuk'] = $this->admin->getPembelian();
        $this->template->load('templates/dashboard', 'pembelian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('produk_id', 'Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Pembelian";
            $data['supplier'] = $this->admin->get('supplier');
            $data['produk'] = $this->admin->get('produk');

            // Mendapatkan dan men-generate kode transaksi Pembelian
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('pembelian', 'id_pembelian', $kode);
            $kode_tambah = substr($kode_terakhir, -2, 2);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 2, '0', STR_PAD_LEFT);
            $data['id_pembelian'] = $kode . $number;

            $this->template->load('templates/dashboard', 'pembelian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pembelian', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('pembelian');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('pembelian/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pembelian', 'id_pembelian', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('produkmasuk');
    }
}
