<?
if(!session_id()) session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username']))   header("Location:https://remunerasi.fisip.ui.ac.id/koperasi/login/logout.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Beranda - Koperasi Simpan Pinjam FISIP UI</title>
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="assets/theme_admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="assets/theme_admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="assets/theme_admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/theme_admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        
    
    <link href="assets/theme_admin/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />   

    <link href="assets/theme_admin/css/custome.css" rel="stylesheet" type="text/css" />   

    <!-- jQuery 2.0.2 -->
    <script src="assets/theme_admin/js/jquery.min.js"></script>   
    <!-- Bootstrap -->
    <script src="assets/theme_admin/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="assets/theme_admin/js/jqClock.min.js" type="text/javascript"></script>

    
    <!-- AdminLTE App -->
    <script src="assets/theme_admin/js/AdminLTE/app.js" type="text/javascript"></script>

    <?include('script.php');?>


</head>
<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            KSP FISIP UI
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">

                    <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown messages-menu" title="Pengajuan Pinjaman">
        <a href="pengajuan">
            <i class="fa fa-envelope"></i>
            <span class="badge bg-green" style="font-size: 14px;"><i class="fa fa-check-circle"></i></span>
        </a>
    </li>
    


<li class="dropdown notifications-menu" title="Jatuh Tempo">
        
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-warning"></i>
        <span class="badge bg-green" style="font-size: 14px;"><i class="fa fa-check-circle"></i></span>
    </a>
                <ul class="dropdown-menu">
        <li class="header bg-light-blue h_tengah">Notifikasi</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li>
                    <a>
                    <div class="pull-left" style="font-size: 35px; padding: 0 15px; width: 27px;">
                        <i class="fa fa-check-circle" style="color: green;"></i>
                    </div>
                    <div style="padding: 20px 5px 0 5px; height: 35px;">
                        <p>Saat ini tidak ada Notifikasi</p>
                     </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="footer"><a href="#">View all</a></li> -->
    </ul>

<script type="text/javascript">
    $(document).ready(function() {
        $(".slimScrollDiv").height(100);
    });

</script>

    </li>   
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>admin <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!--<li><a href="ubah_password"> <i class="fa fa-key"></i>Ubah Password</a></li>-->
                            <li><a href="login/logout"> <i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left" id="wrapper">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">                
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                                <!-- search form -->
                <a href="" class="logo">
                    <!-- Add the class icon to your logo image or logo icon to add the margining -->
                     <div style="text-align:center;"><!--<img height="50" src="assets/theme_admin/img/logo2.png">--></div>
                </a>
            <!-- /.search form -->
            <?include('menu.php');?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">                
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <span id="beranda-head">Beranda</span> 
                    <small> Menu Utama </small><span class="spinner"></span>
                </h1>
                <ol class="breadcrumb">
                    <li> 
                        <i class="fa fa-calendar"></i> 12 December 2016 &nbsp; 
                        <i class="fa fa-clock-o"></i> <span  class="jam"></span>
                    </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                
<style type="text/css">
    .row * {
        box-sizing: border-box;
    }
    .kotak_judul {
         border-bottom: 1px solid #fff; 
         padding-bottom: 2px;
         margin: 0;
    }
</style>

<div id="data">
 <!--               <h4 class="page-header">
                Selamat Datang
                <small>
                Hai, admin Silahkan pilih menu disamping untuk mengoprasikan aplikasi
                </small>
                </h4>

                <div class="row" style="margin: 0 -15px;">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h2 class="kotak_judul"> Pinjaman Kredit</h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Transaksi Bulan Ini </td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan">
                                            <strong style="font-size: 20px;">
                                                0                           </strong>
                                        </td>
                                        <td> &nbsp;Jml Tagihan Tahun Ini</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan">
                                            <strong style="font-size: 20px;"> 0</strong>
                                        </td>
                                        <td> &nbsp; Sisa Tagihan Tahun Ini </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a class="small-box-footer" href="lap_kas_pinjaman">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h2 class="kotak_judul"> Simpanan Desember 2016 </h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Simpanan Anggota</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Penarikan Tunai</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Jumlah Simpanan </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios7-briefcase-outline"></i>
                            </div>
                            <a class="small-box-footer" href="lap_simpanan">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h2 class="kotak_judul"> Kas Bulan Desember 2016
                                 </h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">
                                        0 
                                    </strong></td>
                                        <td> &nbsp; Debet</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">
                                        0 
                                        </strong></td>
                                        <td> &nbsp; Kredit</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Jumlah </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a class="small-box-footer" href="lap_saldo">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h2 class="kotak_judul"> Data Anggota</h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Anggota Aktif</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Anggota Tidak Aktif</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Jumlah Anggota</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a class="small-box-footer" href="lap_anggota">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h2 class="kotak_judul"> Data Peminjam</h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Peminjam</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Sudah Lunas</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">0</strong></td>
                                        <td> &nbsp; Belum Lunas </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <a class="small-box-footer" href="pinjaman">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h2 class="kotak_judul"> Data Pengguna</h2>
                                <table>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">
                                        3                   </strong></td>
                                        <td> &nbsp; User Aktif</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">
                                        0                       </strong></td>
                                        <td> &nbsp; User Non-Aktif</td>
                                    </tr>
                                    <tr>
                                        <td class="h_kanan"><strong style="font-size: 20px;">3</strong></td>
                                        <td> &nbsp; Jumlah User </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icon">
                                <i class="fa  fa-users"></i>
                            </div>
                            <a class="small-box-footer" href="user">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
-->
</div>

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
</body>
</html>