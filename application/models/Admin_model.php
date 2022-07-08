<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getProduk()
    {
        $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
        $this->db->order_by('id_produk');
        return $this->db->get('produk b')->result_array();
    }

    public function getPembelian($limit = null, $id_produk = null, $range = null)
    {
        $this->db->select('*, g.nama as nama_supplier, b.nama as nama_produk');
        $this->db->join('user u', 'bm.user_id = u.id_user');
        $this->db->join('supplier g', 'bm.supplier_id = g.id_supplier');
        $this->db->join('produk b', 'bm.produk_id = b.id_produk');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_produk != null) {
            $this->db->where('id_produk', $id_produk);
        }


        if ($range != null) {
            $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
            $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
        }

        $this->db->order_by('id_pembelian', 'DESC');
        return $this->db->get('pembelian bm')->result_array();
    }

    public function getPemesanan($limit = null, $id_produk = null, $range = null, $konsumen_id = false)
    {
        $this->db->select('*, b.nama nama_produk');
        $this->db->join('user u', 'bk.user_id = u.id_user');
        $this->db->join('produk b', 'bk.produk_id = b.id_produk');
        // $this->db->join('konsumen k', 'k.id_konsumen = bk.id_konsumen');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_produk != null) {
            $this->db->where('id_produk', $id_produk);
        }

        // if ($konsumen_id == true) {
        //     $this->db->where('id_konsumen', $konsumen_id);
        // }

        if ($range != null) {

            $this->db->where('tanggal' . ' >=', $range['mulai']);
            $this->db->where('tanggal' . ' <=', $range['akhir']);

        }
        $this->db->order_by('id_pemesanan', 'DESC');
        $resault = $this->db->get('pemesanan bk')->result_array();
        // echo $this->db->last_query();
        return $resault;
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function chartPembelian($bulan)
    {
        $like = 'T-BM-' . date('y') . $bulan;
        $this->db->like('id_pembelian', $like, 'after');
        return count($this->db->get('pembelian')->result_array());
    }

    public function chartPemesanan($bulan)
    {
        $like = 'T-BK-' . date('y') . $bulan;
        $this->db->like('id_pemesanan', $like, 'after');
        return count($this->db->get('pemesanan')->result_array());
    }

    public function laporan($table, $mulai, $akhir)
    {
        $tgl = $table == 'pembelian' ? 'tanggal_masuk' : 'tanggal_keluar';
        $this->db->where($tgl . ' >=', $mulai);
        $this->db->where($tgl . ' <=', $akhir);
        $resault =$this->db->get($table)->result_array();
        $this->db->order_by('id_pembelian', 'DESC');
        return $this->db->get('pembelian bm')->result_array();
    }

    public function cekStok($id)
    {
        return $this->db->get_where('produk b', ['id_produk' => $id])->row_array();
    }
}
