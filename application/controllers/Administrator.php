<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(array('Gaji_bulanan', 'Karyawan'));
    }

    public function index()
    {
        $view['title']    = 'Dashboard';
        $view['pageName'] = 'home';
        $this->load->view('index', $view);
    }

    public function gaji_bulanan($param = '', $id = '')
    {
        $view['title']           = 'Gaji Bulanan';
        $view['pageName']        = 'gajiBulanan';
        $view['getKaryawan']     = $this->Karyawan->getData();
        $view['getGajiTambahan'] = $this->Gaji_bulanan->getGajiTambahan();
        if ($param == 'getAllData') {
            $dt    = $this->Gaji_bulanan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id;
                $th1  = ++$start;
                $th2  = $row->nama_karyawan;
                $th3  = $row->nama_golongan;
                $th4  = $row->jumlah_gaji_pokok;
                $th5  = $row->nama_jabatan;
                $th6  = $row->gaji_tambahan;
                $th7  = $row->total_potongan;
                $th8  = $row->total_gaji;
                $th9  = $row->create_date;
                $th10 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Gaji_bulanan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("id_karyawan", "No Polisi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gaji_tambahan", "Nama Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Merek Mobil", "trim|required", array('required' => '{field} Wajib diisi !'));
            // $this->form_validation->set_rules("no_hp", "No Hp", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $getGaji          = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']    = htmlspecialchars($this->input->post('id_karyawan'));
                $data['gaji_tambahan']  = htmlspecialchars($this->input->post('gaji_tambahan'));
                $data['total_potongan'] = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']     = (($getGaji[0]->jumlah_gaji_pokok + $this->input->post('gaji_tambahan')) - $this->input->post('total_potongan'));
                $data['create_date']    = $this->input->post('create_date');
                $result['messages']       = '';
                $result           = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Gaji_bulanan->addData($data);
                // $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Memasukkan data pelanggan', $this->session->userdata('id')));
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("no_polisi", "No Polisi", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_pemilik", "Nama Pemilik", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("merek_mobil", "Merek Mobil", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_hp", "No Hp", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['no_polisi']    = htmlspecialchars($this->input->post('no_polisi'));
                $data['nama_pemilik'] = htmlspecialchars($this->input->post('nama_pemilik'));
                $data['merek_mobil']  = htmlspecialchars($this->input->post('merek_mobil'));
                $data['no_hp']        = htmlspecialchars($this->input->post('no_hp'));
                $result['messages']     = '';
                $result         = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Pelanggan_model->update($data['no_polisi'], $data);
                $this->B_user_log_model->addLog(userLog('Ubah Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Melakukan perubahan data pelanggan pada data yang memiliki id = ' . $data['no_polisi'], $this->session->userdata('id')));
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Gaji_bulanan->delete($id);
            // $this->B_user_log_model->addLog(userLog('Hapus Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' menghapus 1 data pada data pelanggan', $this->session->userdata('id')));

            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index', $view);
    }
}

/* End of file Administrator.php */
