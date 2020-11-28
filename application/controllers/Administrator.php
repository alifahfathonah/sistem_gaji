<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(array('Gaji_bulanan', 'Karyawan', 'Jabatan', 'Golongan', 'Tingkat_jabatan', 'Bonus_kinerja'));
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
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = get_btn_export('print("' . $id . '")');
                $th4  = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th5  = '<div style="font-size:12px;">' . $row->nama_golongan . '</div>';
                $th6  = '<div style="font-size:12px;">' . rupiah_format($row->gaji_pokok) . '</div>';
                $th7  = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th8  = '<div style="font-size:12px;">' . rupiah_format($row->uang_transport) . '</div>';
                $th9  = '<div style="font-size:12px;">' . rupiah_format($row->tunjangan_kinerja) . '</div>';
                $th10 = '<div style="font-size:12px;">' . rupiah_format($row->tunjangan_jabatan) . '</div>';
                $th11 = '<div style="font-size:12px;">' . rupiah_format($row->uang_extra_kurikuler) . '</div>';
                $th12 = '<div style="font-size:12px;">' . rupiah_format($row->uang_lembur) . '</div>';
                $th13 = '<div style="font-size:12px;">' . rupiah_format($row->bonus_lain) . '</div>';
                $th14 = '<div style="font-size:12px;">' . rupiah_format($row->total_potongan) . '</div>';
                $th15 = '<div style="font-size:12px;">' . rupiah_format($row->total_gaji) . '</div>';
                $th16 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16));
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
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Gaji_bulanan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                   = htmlspecialchars($this->input->post('id'));
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
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

    public function bonusKinerja($param = '', $id = '')
    {
        $view['title']           = 'Gaji Bulanan';
        $view['pageName']        = 'bonusKinerja';
        $view['getKaryawan']     = $this->Karyawan->getData();
        $view['getGajiTambahan'] = $this->Gaji_bulanan->getGajiTambahan();
        if ($param == 'getAllData') {
            $dt    = $this->Bonus_kinerja->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id  = $row->id;
                $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3 = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th4 = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th5 = '<div style="font-size:12px;">' . ($row->nilai_kpi) . ' % </div>';
                $th6 = '<div style="font-size:12px;">' . rupiah_format($row->jumlah_bonus) . '</div>';
                $th7 = '<div style="font-size:12px;">' . rupiah_format($row->total_gaji) . '</div>';
                $th8 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Bonus_kinerja->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nilai_kpi", "Nilai KPI", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $getGajiPokok   = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']  = htmlspecialchars($this->input->post('id_karyawan'));
                $data['nilai_kpi']    = htmlspecialchars($this->input->post('nilai_kpi'));
                $data['jumlah_bonus'] = ($getGajiPokok[0]->jumlah_gaji_pokok * ($data['nilai_kpi'] / 100));
                $data['total_gaji']   = ($getGajiPokok[0]->total_gaji + $data['jumlah_bonus']);
                $data['create_date']  = $this->input->post('create_date');
                $result['messages']     = '';
                $result         = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Bonus_kinerja->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nilai_kpi", "Nilai KPI", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']           = htmlspecialchars($this->input->post('id'));
                $getGajiPokok   = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']  = htmlspecialchars($this->input->post('id_karyawan'));
                $data['nilai_kpi']    = htmlspecialchars($this->input->post('nilai_kpi'));
                $data['jumlah_bonus'] = ($getGajiPokok[0]->jumlah_gaji_pokok * ($data['nilai_kpi'] / 100));
                $data['total_gaji']   = ($getGajiPokok[0]->total_gaji + $data['jumlah_bonus']);
                $data['create_date']  = $this->input->post('create_date');
                $result['messages']     = '';
                $result         = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Bonus_kinerja->update($data['id'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Bonus_kinerja->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index', $view);
    }


    public function bonusLebaran($param = '', $id = '')
    {
        $view['title']           = 'Gaji Bulanan';
        $view['pageName']        = 'bonusLebaran';
        $view['getKaryawan']     = $this->Karyawan->getData();
        $view['getGajiTambahan'] = $this->Gaji_bulanan->getGajiTambahan();
        if ($param == 'getAllData') {
            $dt    = $this->Gaji_bulanan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id;
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = get_btn_export('print("' . $id . '")');
                $th4  = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th5  = '<div style="font-size:12px;">' . $row->nama_golongan . '</div>';
                $th6  = '<div style="font-size:12px;">' . $row->jumlah_gaji_pokok . '</div>';
                $th7  = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th8  = '<div style="font-size:12px;">' . ($row->uang_transport) . '</div>';
                $th9  = '<div style="font-size:12px;">' . ($row->tunjangan_kinerja) . '</div>';
                $th10 = '<div style="font-size:12px;">' . ($row->tunjangan_jabatan) . '</div>';
                $th11 = '<div style="font-size:12px;">' . ($row->uang_extra_kurikuler) . '</div>';
                $th12 = '<div style="font-size:12px;">' . ($row->uang_lembur) . '</div>';
                $th13 = '<div style="font-size:12px;">' . ($row->bonus_lain) . '</div>';
                $th14 = '<div style="font-size:12px;">' . ($row->total_potongan) . '</div>';
                $th15 = '<div style="font-size:12px;">' . ($row->total_gaji) . '</div>';
                $th16 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16));
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
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Gaji_bulanan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                   = htmlspecialchars($this->input->post('id'));
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((is_numeric($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
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

    public function bonusGuruTerbaik($param = '', $id = '')
    {
        $view['title']           = 'Gaji Bulanan';
        $view['pageName']        = 'bonusGuruTerbaik';
        $view['getKaryawan']     = $this->Karyawan->getData();
        $view['getGajiTambahan'] = $this->Gaji_bulanan->getGajiTambahan();
        if ($param == 'getAllData') {
            $dt    = $this->Gaji_bulanan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id;
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = get_btn_export('print("' . $id . '")');
                $th4  = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th5  = '<div style="font-size:12px;">' . $row->nama_golongan . '</div>';
                $th6  = '<div style="font-size:12px;">' . $row->jumlah_gaji_pokok . '</div>';
                $th7  = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th8  = '<div style="font-size:12px;">' . ($row->uang_transport) . '</div>';
                $th9  = '<div style="font-size:12px;">' . ($row->tunjangan_kinerja) . '</div>';
                $th10 = '<div style="font-size:12px;">' . ($row->tunjangan_jabatan) . '</div>';
                $th11 = '<div style="font-size:12px;">' . ($row->uang_extra_kurikuler) . '</div>';
                $th12 = '<div style="font-size:12px;">' . ($row->uang_lembur) . '</div>';
                $th13 = '<div style="font-size:12px;">' . ($row->bonus_lain) . '</div>';
                $th14 = '<div style="font-size:12px;">' . ($row->total_potongan) . '</div>';
                $th15 = '<div style="font-size:12px;">' . ($row->total_gaji) . '</div>';
                $th16 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16));
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
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Gaji_bulanan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("id_karyawan", "Nama Karyawan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_transport", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_kinerja", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tunjangan_jabatan", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_extra_kurikuler", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("uang_lembur", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("bonus_lain", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_potongan", "Total Potongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                   = htmlspecialchars($this->input->post('id'));
                $getGaji                = $this->Gaji_bulanan->getGaji($this->input->post('id_karyawan'));
                $data['id_karyawan']          = htmlspecialchars($this->input->post('id_karyawan'));
                $data['uang_transport']       = htmlspecialchars($this->input->post('uang_transport'));
                $data['tunjangan_kinerja']    = htmlspecialchars($this->input->post('tunjangan_kinerja'));
                $data['tunjangan_jabatan']    = htmlspecialchars($this->input->post('tunjangan_jabatan'));
                $data['uang_extra_kurikuler'] = htmlspecialchars($this->input->post('uang_extra_kurikuler'));
                $data['uang_lembur']          = htmlspecialchars($this->input->post('uang_lembur'));
                $data['bonus_lain']           = htmlspecialchars($this->input->post('bonus_lain'));
                $data['total_potongan']       = htmlspecialchars($this->input->post('total_potongan'));
                $data['total_gaji']           = ((is_numeric($getGaji[0]->total_gaji) + ($this->input->post('uang_transport')) + ($this->input->post('tunjangan_kinerja')) + ($this->input->post('tunjangan_jabatan')) + ($this->input->post('uang_extra_kurikuler')) + ($this->input->post('uang_lembur')) + ($this->input->post('bonus_lain'))) - ($this->input->post('total_potongan')));
                $data['create_date']          = $this->input->post('create_date');
                $result['messages']             = '';
                $result                 = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
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


    public function golongan($param = '', $id = '')
    {
        $view['title']       = 'Golongan Gaji';
        $view['pageName']    = 'golonganGaji';
        $view['getJabatan']  = $this->Jabatan->getData();
        $view['getGolongan'] = $this->Tingkat_jabatan->getData();
        if ($param == 'getAllData') {
            $dt    = $this->Golongan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id;
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = '<div style="font-size:12px;">' . ($row->level) . '</div>';
                $th4  = '<div style="font-size:12px;">' . ($row->nama_golongan) . '</div>';
                $th5  = '<div style="font-size:12px;">' . ($row->nama_jabatan) . '</div>';
                $th6  = '<div style="font-size:12px;">' . rupiah_format($row->jumlah_gaji_pokok) . '</div>';
                $th7  = '<div style="font-size:12px;">' . rupiah_format($row->t_jalan_jalan) . '</div>';
                $th8  = '<div style="font-size:12px;">' . rupiah_format($row->t_kesehatan) . '</div>';
                $th9  = '<div style="font-size:12px;">' . rupiah_format($row->t_pelatihan) . '</div>';
                $th10 = '<div style="font-size:12px;">' . rupiah_format($row->t_cuti_tahunan) . '</div>';
                $th11 = '<div style="font-size:12px;">' . rupiah_format($row->t_study_banding) . '</div>';
                $th12 = '<div style="font-size:12px;">' . rupiah_format($row->t_umroh) . '</div>';
                $th13 = '<div style="font-size:12px;">' . rupiah_format($row->total_gaji) . '</div>';
                $th14 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Golongan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("level", "Level", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jumlah_gaji_pokok", "Jumlah Gaji Pokok", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_jalan_jalan", "Tunjangan Jalan-jalan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_kesehatan", "Tunjangan Kesehatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_pelatihan", "Tunjangan Pelatihan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_cuti_tahunan", "Tunjangan cuti Tahunan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_study_banding", "Tunjangan Study Banding", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_umroh", "Tunjangan Umroh", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_tingkat_jabatan", "Golongan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_jabatan", "Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['level']              = htmlspecialchars($this->input->post('level'));
                $data['jumlah_gaji_pokok']  = htmlspecialchars($this->input->post('jumlah_gaji_pokok'));
                $data['t_jalan_jalan']      = htmlspecialchars($this->input->post('t_jalan_jalan'));
                $data['t_kesehatan']        = htmlspecialchars($this->input->post('t_kesehatan'));
                $data['t_pelatihan']        = htmlspecialchars($this->input->post('t_pelatihan'));
                $data['t_cuti_tahunan']     = htmlspecialchars($this->input->post('t_cuti_tahunan'));
                $data['t_study_banding']    = htmlspecialchars($this->input->post('t_study_banding'));
                $data['t_umroh']            = htmlspecialchars($this->input->post('t_umroh'));
                $data['total_gaji']         = ($data['jumlah_gaji_pokok'] + $data['t_jalan_jalan'] + $data['t_kesehatan'] + $data['t_pelatihan'] + $data['t_cuti_tahunan'] + $data['t_study_banding'] + $data['t_umroh']);
                $data['id_tingkat_jabatan'] = htmlspecialchars($this->input->post('id_tingkat_jabatan'));
                $data['id_jabatan']         = htmlspecialchars($this->input->post('id_jabatan'));
                $data['create_date']        = $this->input->post('create_date');
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Golongan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("level", "Level", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_golongan", "Nama Golongan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jumlah_gaji_pokok", "Jumlah Gaji Pokok", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_jalan_jalan", "Tunjangan Jalan-jalan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_kesehatan", "Tunjangan Kesehatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_pelatihan", "Tunjangan Pelatihan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_cuti_tahunan", "Tunjangan cuti Tahunan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_study_banding", "Tunjangan Study Banding", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("t_umroh", "Tunjangan Umroh", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("total_gaji", "Total Gaji", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_tingkat_jabatan", "Golongan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_jabatan", "Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                 = htmlspecialchars($this->input->post('id'));
                $data['level']              = htmlspecialchars($this->input->post('level'));
                $data['nama_golongan']      = htmlspecialchars($this->input->post('nama_golongan'));
                $data['jumlah_gaji_pokok']  = htmlspecialchars($this->input->post('jumlah_gaji_pokok'));
                $data['t_jalan_jalan']      = htmlspecialchars($this->input->post('t_jalan_jalan'));
                $data['t_kesehatan']        = htmlspecialchars($this->input->post('t_kesehatan'));
                $data['t_pelatihan']        = htmlspecialchars($this->input->post('t_pelatihan'));
                $data['t_cuti_tahunan']     = htmlspecialchars($this->input->post('t_cuti_tahunan'));
                $data['t_study_banding']    = htmlspecialchars($this->input->post('t_study_banding'));
                $data['t_umroh']            = htmlspecialchars($this->input->post('t_umroh'));
                $data['total_gaji']         = htmlspecialchars($this->input->post('total_gaji'));
                $data['id_tingkat_jabatan'] = htmlspecialchars($this->input->post('id_tingkat_jabatan'));
                $data['id_jabatan']         = htmlspecialchars($this->input->post('id_jabatan'));
                $data['create_date']        = $this->input->post('create_date');
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Golongan->update($data['id'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Golongan->delete($id);
            // $this->B_user_log_model->addLog(userLog('Hapus Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' menghapus 1 data pada data pelanggan', $this->session->userdata('id')));

            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index', $view);
    }

    function jabatan($param = '', $id = '')
    {
        $view['title']             = 'Jabatan';
        $view['pageName']          = 'jabatan';
        $view['getJabatan']        = $this->Jabatan->getData();
        $view['getTingkatJabatan'] = $this->Jabatan->getTingkatJabatan();
        if ($param == 'getAllData') {
            $dt    = $this->Jabatan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id  = $row->id;
                $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3 = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th4 = '<div style="font-size:12px;">' . $row->tingkat_jabatan . '</div>';
                $th5 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Jabatan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("nama_jabatan", "Nama Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tingkat_jabatan", "Tingkat Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['nama_jabatan']       = htmlspecialchars($this->input->post('nama_jabatan'));
                $data['id_tingkat_jabatan'] = htmlspecialchars($this->input->post('tingkat_jabatan'));
                $data['create_date']        = htmlspecialchars($this->input->post('create_date'));
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Jabatan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("nama_jabatan", "Nama Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tingkat_jabatan", "Tingkat Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                 = htmlspecialchars($this->input->post('id'));
                $data['nama_jabatan']       = htmlspecialchars($this->input->post('nama_jabatan'));
                $data['id_tingkat_jabatan'] = htmlspecialchars($this->input->post('tingkat_jabatan'));
                $data['create_date']        = htmlspecialchars($this->input->post('create_date'));
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Jabatan->update($data['id'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Jabatan->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index', $view);
    }

    function tingkatJabatan($param = '', $id = '')
    {
        $view['title']      = 'Tingkat Jabatan';
        $view['pageName']   = 'tingkatJabatan';
        $view['getJabatan'] = $this->Tingkat_jabatan->getData();
        if ($param == 'getAllData') {
            $dt    = $this->Tingkat_jabatan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id  = $row->id;
                $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3 = '<div style="font-size:12px;">' . $row->nama . '</div>';
                $th4 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]    = gathered_data(array($th1, $th2, $th3, $th4));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Tingkat_jabatan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("nama", "Nama Tingkatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['nama']        = htmlspecialchars($this->input->post('nama'));
                $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Tingkat_jabatan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("nama", "Nama Tingkatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']          = htmlspecialchars($this->input->post('id'));
                $data['nama']        = htmlspecialchars($this->input->post('nama'));
                $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                $result['messages']    = '';
                $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Tingkat_jabatan->update($data['id'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Tingkat_jabatan->delete($id);
            $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
            echo json_encode(array('result' => $result));
            die;
        }
        $this->load->view('index', $view);
    }

    function karyawan($param = '', $id = '')
    {
        $view['title']       = 'Karyawan';
        $view['pageName']    = 'karyawan';
        $view['getJabatan']  = $this->Jabatan->getData();
        $view['getGolongan'] = $this->Tingkat_jabatan->getData();
        if ($param == 'getAllData') {
            $dt    = $this->Karyawan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id   = $row->id_karyawan;
                $th1  = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2  = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3  = '<div style="font-size:12px;">' . $row->role . '</div>';
                $th4  = '<div style="font-size:12px;">' . $row->nama_karyawan . '</div>';
                $th5  = '<div style="font-size:12px;">' . $row->tgl_lahir . '</div>';
                $th6  = '<div style="font-size:12px;">' . $row->jk . '</div>';
                $th7  = '<div style="font-size:12px;">' . ($row->email) . '</div>';
                $th8  = '<div style="font-size:12px;">' . ($row->no_hp) . '</div>';
                $th9  = '<div style="font-size:12px;">' . ($row->alamat) . '</div>';
                $th10 = '<div style="font-size:12px;">' . ($row->id_jabatan) . '</div>';
                $th11 = '<div style="font-size:12px;">' . ($row->jurusan) . '</div>';
                $th12 = '<div style="font-size:12px;">' . ($row->universitas) . '</div>';
                $th13 = '<div style="font-size:12px;">' . ($row->pendidikan_terakhir) . '</div>';
                $th14 = '<div style="font-size:12px;">' . ($row->tahun_masuk) . '</div>';
                $th15 = '<div style="font-size:12px;">' . ($row->status) . '</div>';
                $th16 = '<div style="font-size:12px;">' . ($row->gambar) . '</div>';
                $th17 = '<div style="font-size:12px;">' . ($row->id_golongan) . '</div>';
                $th18 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]     = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16, $th17, $th18));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Karyawan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("role", "Role Pengguna", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_karyawan", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_lahir", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jk", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("email", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("password", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_hp", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat", "Alamat", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_jabatan", "Id Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jurusan", "Jurusan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("universitas", "Universitas", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("pendidikan_terakhir", "Pendidikan Terakhir", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tahun_masuk", "Tahun Masuk", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("status", "Status", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_golongan", "Id Golongan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['role']                = htmlspecialchars($this->input->post('role'));
                $data['nama_karyawan']       = htmlspecialchars($this->input->post('nama_karyawan'));
                $data['tgl_lahir']           = htmlspecialchars($this->input->post('tgl_lahir'));
                $data['jk']                  = htmlspecialchars($this->input->post('jk'));
                $data['email']               = htmlspecialchars($this->input->post('email'));
                $data['password']            = htmlspecialchars($this->input->post('password'));
                $data['no_hp']               = htmlspecialchars($this->input->post('no_hp'));
                $data['alamat']              = htmlspecialchars($this->input->post('alamat'));
                $data['id_jabatan']          = htmlspecialchars($this->input->post('id_jabatan'));
                $data['jurusan']             = htmlspecialchars($this->input->post('jurusan'));
                $data['universitas']         = htmlspecialchars($this->input->post('universitas'));
                $data['pendidikan_terakhir'] = htmlspecialchars($this->input->post('pendidikan_terakhir'));
                $data['tahun_masuk']         = htmlspecialchars($this->input->post('tahun_masuk'));
                $data['status']              = htmlspecialchars($this->input->post('status'));
                $data['gambar']              = htmlspecialchars($this->input->post('gambar'));
                $data['id_golongan']         = htmlspecialchars($this->input->post('id_golongan'));
                $data['create_date']         = $this->input->post('create_date');
                $result['messages']            = '';
                $result                = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                $this->Karyawan->addData($data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("role", "Role Pengguna", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("nama_karyawan", "Tambahan Transport", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tgl_lahir", "Tambahan tunjangan kinerja", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jk", "Tambahan tunjangan jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("email", "Tambahan tunjangan extrakurikuler", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("password", "Tambahan Tunjangan Lembur", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("no_hp", "Tunjangan hari raya", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("alamat", "Alamat", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_jabatan", "Id Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("jurusan", "Jurusan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("universitas", "Universitas", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("pendidikan_terakhir", "Pendidikan Terakhir", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tahun_masuk", "Tahun Masuk", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("status", "Status", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gambar", "Gambar", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("id_golongan", "Id Golongan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id_karyawan']         = htmlspecialchars($this->input->post('id_karyawan'));
                $data['role']                = htmlspecialchars($this->input->post('role'));
                $data['nama_karyawan']       = htmlspecialchars($this->input->post('nama_karyawan'));
                $data['tgl_lahir']           = htmlspecialchars($this->input->post('tgl_lahir'));
                $data['jk']                  = htmlspecialchars($this->input->post('jk'));
                $data['email']               = htmlspecialchars($this->input->post('email'));
                $data['password']            = htmlspecialchars($this->input->post('password'));
                $data['no_hp']               = htmlspecialchars($this->input->post('no_hp'));
                $data['alamat']              = htmlspecialchars($this->input->post('alamat'));
                $data['id_jabatan']          = htmlspecialchars($this->input->post('id_jabatan'));
                $data['jurusan']             = htmlspecialchars($this->input->post('jurusan'));
                $data['universitas']         = htmlspecialchars($this->input->post('universitas'));
                $data['pendidikan_terakhir'] = htmlspecialchars($this->input->post('pendidikan_terakhir'));
                $data['tahun_masuk']         = htmlspecialchars($this->input->post('tahun_masuk'));
                $data['status']              = htmlspecialchars($this->input->post('status'));
                $data['gambar']              = htmlspecialchars($this->input->post('gambar'));
                $data['id_golongan']         = htmlspecialchars($this->input->post('id_golongan'));
                $data['create_date']         = $this->input->post('create_date');
                $result['messages']            = '';
                $result                = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Karyawan->update($data['id_karyawan'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'delete') {
            $this->Karyawan->delete($id);
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
