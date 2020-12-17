<!-- Styles -->

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />


<!-- Chart Bar -->
<script>
    var chart = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "addClassNames": true,
        "theme": "none",
        "autoMargins": false,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 8,
            "color": "#ffffff"
        },

        "dataProvider": [
            <?php foreach ($countGuruTerbaik as $row) { ?> {
                    "year": "<?php echo $row->nama_karyawan; ?>",
                    "income": <?php echo $row->tot_guru; ?>,
                    "expenses": <?php echo $row->tot_guru; ?>
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'> [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'> [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Expenses",
            "valueField": "expenses",
            "dashLengthField": "dashLengthLine"
        }],
        "categoryField": "year",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        },
        "export": {
            "enabled": true
        }
    });
</script>

<script>
    var chart = AmCharts.makeChart("chartdiv2", {
        "type": "serial",
        "addClassNames": true,
        "theme": "light",
        "autoMargins": false,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "balloon": {
            "adjustBorderColor": false,
            "horizontalPadding": 10,
            "verticalPadding": 8,
            "color": "#FFFFFF"
        },

        "dataProvider": [
            <?php foreach ($getCountBonusKinerja as $row) { ?> {
                    "year": "<?php echo $row->nama_karyawan; ?>",
                    "income": <?php echo $row->nilai_kpi; ?>,
                    "expenses": <?php echo $row->nilai_kpi; ?>
                },
            <?php } ?>
        ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'> [[category]]:<br><span style='font-size:20px;'>[[value]] %</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Pegawai",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[category]]:<br><span style='font-size:20px;'>[[value]] %</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#0000FF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Expenses",
            "valueField": "expenses",
            "dashLengthField": "dashLengthLine"
        }],
        "categoryField": "year",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        },
        "export": {
            "enabled": false
        }
    });
</script>

<div class="right_col" role="main">
    <div class="row">
        <h4>Dashboard</h4>
    </div>
    <!-- top tiles -->
    <div class="row" style="display: inline-block;width:500px;">
        <div class="tile_count">
            <div class="col-md-4 col-sm-4  tile_stats_count bg-blue">
                <span class="count_top "><i class="fa fa-user"></i> Jumlah Karyawan</span>
                <div class="count" style="font-size: 20px;"><?php echo $countKaryawan[0]->jml_karyawan ?></div>
            </div>
            <div class="col-md-4 col-sm-4  tile_stats_count bg-green">
                <span class="count_top"><i class="fa fa-clock-o"></i> Laki-laki </span>
                <div class="count" style="font-size: 20px;"><?php echo $getGenderWoman[0]->tot_gender ?></div>
            </div>
            <div class="col-md-4 col-sm-4  tile_stats_count bg-red">
                <span class="count_top"><i class="fa fa-clock-o"></i> Perempuan </span>
                <div class="count" style="font-size: 20px;"><?php echo $getGenderMan[0]->tot_gender ?></div>
            </div>
        </div>
    </div>
    <!-- /top tiles -->
    <?php if ($this->session->userdata('role') == 'administrator') { ?>
        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Gaji Bulanan</h2>
                        <ul class="nav navbar-right panel_toolbox">
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
                                    <div class="text-right">

                                    </div>
                                    <table id="data" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 10px;">No</th>
                                                <th style="font-size: 10px;">Nama Karyawan</th>
                                                <th style="font-size: 10px;">Email</th>
                                                <th style="font-size: 10px;">No Hp</th>
                                                <th style="font-size: 10px;">Alamat</th>
                                                <th style="font-size: 10px;">Jabatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($showDataIndex as $row) { ?>
                                                <tr>
                                                    <th><?php echo ++$no; ?></th>
                                                    <th><?php echo $row->nama_karyawan; ?></th>
                                                    <th><?php echo $row->email; ?></th>
                                                    <th><?php echo $row->no_hp; ?></th>
                                                    <th><?php echo $row->alamat; ?></th>
                                                    <th><?php echo $row->nama_jabatan; ?></th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php if ($this->session->userdata('role') == 'yayasan' || $this->session->userdata('role') == 'keuangan') { ?>
        <div class="row">
            <div class="col-md-6 col-sm-12 ">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-12">
                            <h5>Kinerja Karyawan <small>(Dilihat dari data bonus Guru Terbaik)</small></h5>
                        </div>

                    </div>
                    <div class="col-md-12 col-sm-9 ">
                        <div id="chartdiv1" class="demo-placeholder"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 ">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-12">
                            <h5>Statistik Bonus Kinerja <small>(Data dipengaruhi oleh nilai KPI)</small></h5>
                        </div>

                    </div>
                    <div class="col-md-12 col-sm-9 ">
                        <div id="chartdiv2" class="demo-placeholder"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>