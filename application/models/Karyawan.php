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
        create_date');
        $this->datatables->from('karyawan');
        return $this->datatables->generate();
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

    function delete($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
}

/* End of file Karyawan.php */
