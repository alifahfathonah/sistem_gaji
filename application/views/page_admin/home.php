<!-- Styles -->

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />


<!-- Chart Bar -->
<script>
    var chart = AmCharts.makeChart("chartdiv2", {
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
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
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

<div class="right_col" role="main">
    <div class="row">
        <h4>Dashboard</h4>
    </div>
    <!-- top tiles -->
    <div class="row" style="display: inline-block;">
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

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-12">
                        <h5>Statistik Kinerja Karyawan <small>(Dilihat dari data bonus Guru Terbaik)</small></h5>
                    </div>

                </div>
                <div class="col-md-12 col-sm-9 ">
                    <div id="chartdiv2" class="demo-placeholder"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>

</div>