<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru_terbaik extends CI_Model
{
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('jabatan');
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

    public function getAllData()
    {
        $this->datatables->select('gt.id , k.nama_karyawan, gt.upload_portofolio, gt.keterangan, gt.jumlah_bonus, gt.total_gaji, gt.create_date, gt.create_date');
        $this->datatables->from('guru_terbaik gt');
        $this->datatables->join('karyawan k', 'k.id_karyawan = gt.id_karyawan', 'left');
        return $this->datatables->generate();
    }

    public function addData($data)
    {
        $this->db->insert('jabatan', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('jabatan ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('jabatan', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jabatan');
    }
}

/* End of file Guru_terbaik.php */
