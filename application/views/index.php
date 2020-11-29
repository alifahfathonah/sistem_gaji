<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title><?php echo $title; ?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Sweetalert -->
    <link href="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- Date Picker -->
    <link href="<?php echo base_url() . 'assets/' ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url() . 'assets/' ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->

    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">



    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
        .amcharts-chart-div a {
            display: none !important;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-bar-chart"></i> <span>Payroll Sys... </span>
                        </a>

                    </div>

                    <div class="clearfix"></div>
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <div style="width:100%" class="badge bg-blue text-left">
                                Sistem Pengelolaan Gaji
                            </div>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-home"></i> Home/Dashboard </a></li>
                                <li><a><i class="fa fa-edit"></i> <span class="fa fa-chevron-down"></span>Gaji Bulanan </span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url('administrator/gaji_bulanan') ?>">Daftar Gaji Bulanan</a></li>
                                        <li><a href="<?php echo base_url('administrator/laporan_gaji_bulanan') ?>">Laporan</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url('administrator/bonusKinerja') ?>"><i class="fa fa-desktop"></i> Bonus Kinerja</span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/bonusLebaran') ?>"><i class="fa fa-table"></i> Bonus Lebaran </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/bonusGuruTerbaik') ?>"><i class="fa fa-bar-chart-o"></i> Bonus Guru Terbaik </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/kenaikanGaji') ?>"><i class="fa fa-clone"></i>Data Kenaikan Kerja </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/golongan') ?>"><i class="fa fa-pie-chart" style="color:red"></i>Golongan Gaji </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/jabatan') ?>"><i class="fa fa-pie-chart" style="color:red"></i>Jabatan </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/tingkatJabatan') ?>"><i class="fa fa-pie-chart" style="color:red"></i>Golongan Jabatan </span></a>
                                </li>
                                <li><a href="<?php echo base_url('administrator/karyawan') ?>"><i class="fa fa-pie-chart" style="color:red"></i>Data Karyawan </span></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" style="width: 100%;background-color: brown;color: #ccc;" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout !
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-user"></span> John Doe
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;">Change Password</a>
                                    <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <?php include 'page_admin/' . $pageName . '.php' ?>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/') ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/') ?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets/') ?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets/') ?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/') ?>vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('assets/') ?>vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('assets/') ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('assets/') ?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/') ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Date picker -->
    <script src="<?php echo base_url() . 'assets/' ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() . 'assets/' ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/') ?>build/js/custom.min.js"></script>

</body>

</html>