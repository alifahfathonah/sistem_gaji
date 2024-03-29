<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru_terbaik extends CI_Model
{
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('guru_terbaik');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function countGuruTerbaik()
    {
        $this->db->select('count(gt.id) as tot_guru, k.nama_karyawan, YEAR(gt.create_date) as tahun');
        $this->db->from('guru_terbaik gt');
        $this->db->join('karyawan k ', 'k.id_karyawan = gt.id_karyawan', 'left');
        $this->db->group_by('gt.id_karyawan');
        $this->db->where('YEAR(gt.create_date)', date('Y'));
        $this->db->where('MONTH(gt.create_date)', date('m'));
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
        $this->datatables->select('gt.id , k.nama_karyawan, gt.upload_portofolio, gt.keterangan, gt.jumlah_bonus, gt.create_date, gt.create_date');
        $this->datatables->from('guru_terbaik gt');
        $this->datatables->join('karyawan k', 'k.id_karyawan = gt.id_karyawan', 'left');
        return $this->datatables->generate();
    }

    public function getSlipGaji($id)
    {
        $this->db->select('gt.id , k.nama_karyawan, gt.upload_portofolio, gt.keterangan, gt.jumlah_bonus, gt.create_date, gt.create_date');
        $this->db->from('guru_terbaik gt');
        $this->db->join('karyawan k', 'k.id_karyawan = gt.id_karyawan', 'left');
        $this->db->where('gt.id', $id);
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('guru_terbaik', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function simpan_upload($upload_portofolio, $id_karyawan, $keterangan, $jumlah_bonus, $total_gaji, $create_date)
    {
        $data['id_karyawan']       = $id_karyawan;
        $data['upload_portofolio'] = $upload_portofolio;
        $data['keterangan']        = $keterangan;
        $data['jumlah_bonus']      = $jumlah_bonus;
        $data['total_gaji']        = $total_gaji;
        $data['create_date']       = $create_date;
        $result              = $this->db->insert('guru_terbaik', $data);
        return $result;
    }
    public function get_by_id($id)
    {
        return $this->db->get_where('guru_terbaik ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('guru_terbaik');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function updateGbr($id, $data)
    {
        $this->_deleteImage($id);
        return $this->db->query('update guru_terbaik set upload_portofolio="' . $data . '" where id="' . $id . '"');
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('guru_terbaik', $data);
        return $this->db->affected_rows();
    }

    public function _deleteImage($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_portofolio)[0];
        return array_map('unlink', glob(FCPATH . "gambar/$filename.*"));
    }
    function delete($id)
    {
        $this->_deleteImage($id);
        $this->db->where('id', $id);
        $this->db->delete('guru_terbaik');
    }
}

/* End of file Guru_terbaik.php */
