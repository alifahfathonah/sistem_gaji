<script>
    console.log('test')
    document.addEventListener("DOMContentLoaded", function(event) {
        table = $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            "dom": 'Bfrtip',
            "buttons": [
                'excel', 'print'
            ],
            "ajax": {
                "url": "<?php echo site_url('administrator/bonusLebaran/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });

    var save_method;

    function updateAllTable() {
        table.ajax.reload();
    }

    function pesan() {
        alert('Sorry, you can not use this feature, You are not allowed to access it !');
    }

    function print(id) {
        window.open("<?php echo base_url('administrator/slipBonusLebaran') ?>/" + id, '_blank');
    }

    function tambah() {
        save_method = 'add';
        $('#form_inputan')[0].reset();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $('#modal').modal('show');
        $('.reset').show();
    }

    function ubah(id) {
        save_method = 'update';
        $('#form_inputan')[0].reset();
        $('#modal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/bonusLebaran/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="id_karyawan"]').val(data.id_karyawan);
                $('[name="uang_transport"]').val(data.uang_transport);
                $('[name="tunjangan_kinerja"]').val(data.tunjangan_kinerja);
                $('[name="tunjangan_jabatan"]').val(data.tunjangan_jabatan);
                $('[name="uang_extra_kurikuler"]').val(data.uang_extra_kurikuler);
                $('[name="uang_lembur"]').val(data.uang_lembur);
                $('[name="bonus_lain"]').val(data.bonus_lain);
                $('[name="total_potongan"]').val(data.total_potongan);
                $('[name="create_date"]').val(data.create_date);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }



    function hapus(id) {
        swal({
                title: "Apakah Yakin Akan Dihapus?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/bonusLebaran/delete'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        updateAllTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            });
    }


    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>administrator/bonusLebaran/addData';
        } else {
            url = '<?php echo base_url() ?>administrator/bonusLebaran/update';
        }
        swal({
                title: "Apakah anda sudah yakin ?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                cancelButtonText: "Kembali",
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $('#form_inputan').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            $('#modal').modal('hide');
                        } else {
                            $.each(data['messages'], function(key, value) {
                                var element = $('#' + key);
                                element.closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('#text-error')
                                    .remove();
                                element.after(value);
                            });
                        }
                        swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    }

                });
            });
    }
</script>
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Gaji Bulanan</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button class="btn btn-primary btn-sm" type="button" onclick="tambah()">
                    <li class="fa fa-plus"></li> Tambah Data</button>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="text-right">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="data" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="font-size: 10px;">No</th>
                                        <th style="font-size: 10px;">Tools</th>
                                        <th style="font-size: 10px;">Nama Karyawan</th>
                                        <th style="font-size: 10px;">Nama Jabatan</th>
                                        <th style="font-size: 10px;">Total Gaji Bonus</th>
                                        <th style="font-size: 10px;">Create Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <li class="fa fa-list"></li> Form Data Penggajian
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
            <div class="modal-body">
                <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Nama Karyawan<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <select name="id_karyawan" id="id_karyawan" class="form-control has-feedback-left">
                                    <option value="">Pilih Karyawan</option>
                                    <?php foreach ($getKaryawan as $r) : ?>
                                        <option value="<?php echo $r->id_karyawan; ?>"><?php echo $r->nama_karyawan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Create Date<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d'); ?>" class="form-control has-feedback-left" readonly>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm" onclick="simpan()">Simpan</button>

            </div>
            <?php echo form_close() ?>
        </div>

    </div>
</div>