<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }
    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('konsumen_id', 'Konsumen', 'required');
        $this->form_validation->set_rules('produk_id', 'Produk', 'required');


        $input = $this->input->post('produk_id', true);
        $stok = $this->admin->get('produk', ['stok', 'id_produk' => $input]);
        $stok_valid = $stok;

        $this->form_validation->set_rules(
            'jumlah_keluar',
            'Jumlah Keluar',
            'required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]',
            [
                'less_than' => 'Jumlah Keluar tidak boleh lebih dari {$stok}'
            ]
        );
    }


    public function index()
    {
        $result =  array();
        $produks = $this->admin->getPemesanan();
        foreach ($produks as $produk) {
            $harga = $produk['harga_jual'];

            $jumlah_keluar = $produk['jumlah'];
            $kalkulasi = $harga * $jumlah_keluar;

            $harga_produk = ["total_harga" => $kalkulasi];

            $result[] = array_merge($harga_produk, $produk);
            //continue;
        }


        $data['title'] = "Pemesanan";
        $data['pemesanan'] = $this->admin->getPemesanan();
        $data['pemesanan'] = $result;

        // dd($data);
        $this->template->load('templates/dashboard', 'pemesanan/data', $data);
    }


    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Pemesanan";
            $data['produk'] = $this->admin->get('produk', null, ['stok >' => 0]);
            $data['konsumen'] = $this->admin->get('konsumen');


            // Mendapatkan dan men-generate kode transaksi Pemesanan
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('pemesanan', 'id_pemesanan', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_pemesanan'] = $kode . $number;

            $this->template->load('templates/dashboard', 'pemesanan/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pemesanan', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('pemesanan');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('pemesanan/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pemesanan', 'id_pemesanan', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('pemesanan');
    }
}
