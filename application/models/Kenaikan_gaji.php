<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kenaikan_gaji extends CI_Model
{
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('kenaikan_gaji');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function getAllData()
    {
        $this->datatables->select('j.id, k.nama_karyawan, j.jumlah_kenaikan, j.total_gaji, j.total_gaji');
        $this->datatables->from('kenaikan_gaji j');
        $this->datatables->join('karyawan k', 'k.id_karyawan = j.id_karyawan', 'left');
        return $this->datatables->generate();
    }

    public function addData($data)
    {
        $this->db->insert('kenaikan_gaji', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('kenaikan_gaji ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('kenaikan_gaji');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('kenaikan_gaji', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kenaikan_gaji');
    }
}

/* End of file Kenaikan_gaji.php */
