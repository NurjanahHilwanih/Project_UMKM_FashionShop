<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $dataLogin = $this->session->userdata('login_session');

        if (!empty($dataLogin) && $dataLogin['role'] == 'admin') {
            $data['title'] = "Dashboard";
            $data['produk'] = $this->admin->count('produk');
            $data['pembelian'] = $this->admin->count('pembelian');
            $data['pemesanan'] = $this->admin->count('pemesanan');
            $data['supplier'] = $this->admin->count('supplier');
            $data['konsumen'] = $this->admin->count('konsumen');
            $data['stok'] = $this->admin->sum('produk', 'stok');
            $data['produk_min'] = $this->admin->min('produk', 'stok', 10);
            $data['transaksi'] = [
                'pembelian' => $this->admin->getPembelian(5),
                'pemesanan' => $this->admin->getPemesanan(5)
            ];
            //   dd($data);

            // Line Chart
            $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $data['cbm'] = [];
            $data['cbk'] = [];

            foreach ($bln as $b) {
                $data['cbm'][] = $this->admin->chartPembelian($b);
                $data['cbk'][] = $this->admin->chartPemesanan($b);
            }

            $this->template->load('templates/dashboard', 'dashboard', $data);
        } else {
            $data['produk'] = $this->admin->getProduk();
            // echo "<Pre>"; print_r($data); exit;
            
		$data['has_login'] = ($this->session->userdata('login_session') ? $this->session->userdata('login_session') : '');
            $this->load->view('landing_page/index', $data);
        }
    }

    public function landing()
    {
        $this->load->view('landing_page/index');
    }
    public function order()
	{
		if ($this->input->method(TRUE) == 'POST') {
            // echo $this->input->method(TRUE);exit;
            $tanggal = date('Y-m-d');
            $jumlah = $this->input->post('jumlah');
            $produk_id = $this->input->post('produk_id');
            $users_id = $this->session->userdata('login_session')['user'];

            $data   = [
                'tanggal' => $tanggal,
                'jumlah' => $jumlah,
                'produk_id' => $produk_id,
                'user_id' => $users_id,
            ];

            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pemesanan', $data);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('dashboard');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('dashboard');
            }
        }
	}

    public function produk()
    {
    }
}
