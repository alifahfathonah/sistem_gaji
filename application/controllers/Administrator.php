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
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th3  = '<div style="font-size:12px;">' . $row->nama_golongan . '</div>';
                $th4  = '<div style="font-size:12px;">' . $row->jumlah_gaji_pokok . '</div>';
                $th5  = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th6  = '<div style="font-size:12px;">' . rupiah_format($row->gaji_tambahan) . '</div>';
                $th7  = '<div style="font-size:12px;">' . rupiah_format($row->total_potongan) . '</div>';
                $th8  = '<div style="font-size:12px;">' . rupiah_format($row->total_gaji) . '</div>';
                $th9  = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $th10 = get_btn_export('print("' . $id . '")');
                $th11 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Gaji_bulanan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gaji_tambahan", "Gaji Tambahan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));
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
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gaji_tambahan", "Gaji Tambahan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']             = htmlspecialchars($this->input->post('id'));
                $getGaji          = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']    = htmlspecialchars($this->input->post('id_karyawan'));
                $data['gaji_tambahan']  = htmlspecialchars($this->input->post('gaji_tambahan'));
                $data['total_potongan'] = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']     = (($getGaji[0]->jumlah_gaji_pokok + $this->input->post('gaji_tambahan')) - $this->input->post('total_potongan'));
                $data['create_date']    = $this->input->post('create_date');
                $result['messages']       = '';
                $result           = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Gaji_bulanan->update($data['id'], $data);
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

    public function printGajiBulanan($id)
    {
        $this->load->library('pdfgenerator');
        $view['getSlipGaji'] = $this->Gaji_bulanan->getSlipGaji($id);
        $this->load->view('page_admin/exportGajiBulanan', $view);
    }
}

/* End of file Administrator.php */
