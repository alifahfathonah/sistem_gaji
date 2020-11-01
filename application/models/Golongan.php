<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, level, nama');
        $this->datatables->from('gaji_bulanan b');
        return $this->datatables->generate();
    }

    public function addData($data)
    {
        $this->db->insert('gaji_bulanan', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getGaji($id_golongan)
    {
        $this->db->select('g.nama_golongan, g.jumlah_gaji_pokok');
        $this->db->from('karyawan k');
        $this->db->join('golongan g', 'g.id = k.id_golongan', 'left');
        $this->db->where('k.id_golongan', $id_golongan);
        return $this->db->get()->result();
    }

    public function getGajiTambahan()
    {
        $this->db->select('*');
        $this->db->from('gaji_tambahan');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('gaji_bulanan ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('gaji_bulanan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getSlipGaji($id)
    {
        $this->db->select('b.id, k.nama_karyawan, g.nama_golongan, g.jumlah_gaji_pokok, j.nama_jabatan, b.uang_transport, b.total_gaji,b.total_potongan,b.create_date,b.create_date,b.create_date');
        $this->db->from('gaji_bulanan b');
        $this->db->join('karyawan k', 'k.id_karyawan = b.id_karyawan', 'left');
        $this->db->join('golongan g', 'g.id = k.id_golongan', 'left');
        $this->db->join('jabatan j', 'j.id = g.id_jabatan', 'left');
        $this->db->where('b.id', $id);
        return $this->db->get()->result();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('gaji_bulanan', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gaji_bulanan');
    }
}

/* End of file ModelName.php */
