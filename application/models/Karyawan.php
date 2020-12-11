<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Model
{
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->order_by('id_karyawan', 'desc');
        return $this->db->get()->result();
    }

    public function getAllData()
    {
        $this->datatables->select('id_karyawan,
        role,
        nama_karyawan,
        tgl_lahir,
        jk,
        email,
        no_hp,
        alamat,
        id_jabatan,
        jurusan,
        universitas,
        pendidikan_terakhir,
        tahun_masuk,
        status,
        gambar,
        id_golongan,
        gaji_pokok,
        total_gaji,
        create_date');
        $this->datatables->from('karyawan');
        return $this->datatables->generate();
    }

    public function getDataKaryawanById($id)
    {
        $this->db->select('id_karyawan,gaji_pokok, total_gaji');
        $this->db->from('karyawan');
        $this->db->where('id_karyawan', $id);
        return $this->db->get()->result();
    }

    public function getGajiByGolongan($id)
    {
        $this->db->select('jumlah_gaji_pokok, total_gaji');
        $this->db->from('golongan');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('karyawan', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('karyawan ap', array('ap.id_karyawan' => $id))->result();
    }

    public function getByIdGolongan($id_gol)
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where('id_golongan', $id_gol);
        $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where('id_karyawan', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);
        return $this->db->affected_rows();
    }

    public function updateGaji($id, $data_gaji_pokok, $tot_gaji)
    {
        $gaji_pokok = $data_gaji_pokok;
        $query = $this->db->query('UPDATE karyawan SET gaji_pokok ="' . $gaji_pokok . '", total_gaji ="' . $tot_gaji . '" WHERE id_karyawan="' . $id . '"');
        return $query;
    }

    function delete($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
}

/* End of file Karyawan.php */
