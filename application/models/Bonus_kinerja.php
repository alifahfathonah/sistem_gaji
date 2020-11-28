<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bonus_kinerja extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('b.id, k.nama_karyawan, j.nama_jabatan, b.nilai_kpi, b.jumlah_bonus, b.total_gaji, b.create_date');
        $this->datatables->from('bonus_kinerja b');
        $this->datatables->join('karyawan k', 'k.id_karyawan = b.id_karyawan', 'left');
        $this->datatables->join('golongan g', 'g.id = k.id_golongan', 'left');
        $this->datatables->join('jabatan j', 'j.id = k.id_jabatan', 'left');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('bonus_kinerja');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function getTingkatJabatan()
    {
        $this->db->select('*');
        $this->db->from('tingkat_jabatan');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }


    public function addData($data)
    {
        $this->db->insert('bonus_kinerja', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('bonus_kinerja ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('bonus_kinerja');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('bonus_kinerja', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bonus_kinerja');
    }
}

/* End of file Bonus_kinerja.php */