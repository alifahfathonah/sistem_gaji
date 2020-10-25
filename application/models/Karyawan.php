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
}

/* End of file Karyawan.php */
