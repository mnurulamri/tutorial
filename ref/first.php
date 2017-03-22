<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/font-awesome-4.6.1/css/font-awesome.css"/>
<link href="lib/fancy.css" rel="stylesheet">
<script type="text/javascript" src="../../lib/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../lib/jsdatepick/jsDatePick.min.1.3.js"></script>

<script type="text/javascript" src="../../lib/datepicker/js/bootstrap-datepicker.js"></script>
<link href="../../lib/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="../../remun/js/jquery.formatCurrency.js" type="text/javascript"></script>

 <script>
 $(document).ready(function () {
    

  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        //overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        //overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  }); 

$('.test').click(function(){
    $('.test-menu').toggle();
});

  /*--------------------------*/

$(document).on('click', '.setor_simpanan, .bayar-cicilan', function(){
    $('.bayar').toggle();
});

//bayar cicilan
$(document).on('click', '.simpan', function(){
    var id_anggota = $('#data_peminjam').val();
    var tgl = $('#tgl').val();
    var pokok = $('#pokok').val();
    var jasa = $('#jasa').val();

    $.ajax({
        type: "POST",
        url: "pinjaman/add_cicilan.php",
        data: {id_anggota:id_anggota, tgl:tgl, pokok:pokok, jasa:jasa},
        success: function(data){
            $('#result').html(data);
        }
    }); 
    //alert(id_anggota+' '+ pokok +' '+jasa);
});

//setoran simpanan
$(document).on('click', '.simpan_setoran', function(){
    var id_anggota = $('#data_anggota').val();
    var tgl = $('#tgl').val();
    var wajib = $('#wajib').val();
    var sukarela = $('#sukarela').val();

    $.ajax({
        type: "POST",
        url: "simpanan/add_simpanan.php",
        data: {id_anggota:id_anggota, tgl:tgl, wajib:wajib, sukarela:sukarela},
        success: function(data){
            $('#result').html(data);
        }
    }); 
    //alert(id_anggota+' '+ pokok +' '+jasa);
});

    $( '#wrapper' ).on('click', '#simpanan, #pinjaman, #pinjaman_anggota, #pengajuan, #cicilan, #potongan, #data_pengajuan', function() {     
        alert($(this).attr( 'rel' ));
        $.post($(this).attr( 'rel' ), function(data){$('#data').html(data);} );
        return false;
    }); 

    $(document).on('change','#cari_anggota', function(){
        //$('#id_anggota').val($('#cari_anggota').val());
        var text = $('#cari_anggota').val();
        text = text.split(' - ');
        id_anggota = text[0];
        $('#id_anggota').val(id_anggota);

        $.ajax({
            type: "POST",
            url: "pinjaman/sisa_pinjaman.php",
            data: {id_anggota:id_anggota},
            success: function(data){
                $('#sisa_pinjaman').val(data);
                var num = data.replace(/./g, function(c, i, a) {
                        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                    });
                
                $('#v_sisa_pinjaman').val(num);
            }
        });     
         
        return false;
    });

    $(document).on('click', '#simpan_pengajuan', function(){
        var text = $('#cari_anggota').val();
        text = text.split(' - ');
        var id_anggota = text[0];
        $('#id_anggota').val(id_anggota);
        var tgl = $('#tgl').val();
        var sisa_pinjaman = $('#sisa_pinjaman').val();
        var jml_pinjaman = $('#jml_pinjaman').val();
        var akumulasi_pinjaman = $('#akumulasi_pinjaman').val();
        var lama_cicilan = $('#lama_cicilan').val();
        var cicilan_perbulan = $('#cicilan_perbulan').val();
        var jasa = $('#jasa').val();
        var alasan = $('#alasan').val();
        alert(id_anggota+' ' +tgl + ' '+sisa_pinjaman +' ' +jml_pinjaman+' ' + akumulasi_pinjaman +' ' +cicilan_perbulan +' ' +jasa+ ' '+ alasan)
        $.ajax({
            type: "POST",
            url: "pinjaman/pengajuan/add_pengajuan.php",
            data: {
                    id_anggota:id_anggota, 
                    tgl:tgl, 
                    sisa_pinjaman:sisa_pinjaman, 
                    jml_pinjaman:jml_pinjaman, 
                    akumulasi_pinjaman:akumulasi_pinjaman, 
                    lama_cicilan:lama_cicilan, 
                    cicilan_perbulan:cicilan_perbulan,
                    jasa:jasa,
                    alasan:alasan
                },
            success: function(data){
                $('#test_hasil').html(data);
            }
        }); 
        //alert(id_anggota+' '+ pokok +' '+jasa);
    });


});
 </script>

  <html>
    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       Brand
                    </a>
                </li>
                <li>
                    <a href="#" rel="home">Home</a>
                </li>
                <li>
                    <a href="#" rel="simpanan" id="simpanan">Simpanan</a>
                </li>
				<?
				if($_SESSION['username'] == 'mnurulamri'){
					echo '<li><a href="potongan/upload_simpanan.php" rel="" id="upload_simpanan">&nbsp;&nbsp;Upload Simpanan</a></li>';
				}
				?>
                <li class="">
                    <div href="#" class="dropdown-toggle test" data-toggle="dropdown" style="color:#fff; margin-left:30px; font-size:14px;padding-top:10px;padding-bottom:10px">Pinjaman<span class="caret"></span></div>
                    <ul class="dropdown-menu test-menu" role="menu">
                        <li role="presentation" class="divider"></li>
                        <li><a href="#" rel="pinjaman" id="pinjaman">&nbsp;&nbsp;Buku Pinjaman</a></li>
                        <li><a href="#" rel="pinjaman/pengajuan/" id="pengajuan">&nbsp;&nbsp;Pengajuan Pinjaman</a></li>
                        <li><a href="#" rel="pinjaman/pengajuan/pengajuan.php" id="data_pengajuan">&nbsp;&nbsp;Data Pengajuan Pinjaman</a></li>
                        <li role="presentation" class="divider"></li>
                    </ul>
                </li>   
                <li>
                    <a href="#" rel="potongan" id="potongan">Potongan</a>
                </li>
                <li>
                    <a target="_blank" href="bnihistori">History Transaksi BNI</a>
                </li>     
                <li>
                    <a href="https://remunerasi.fisip.ui.ac.id/koperasi/login/logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper-x">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container" style="width:95%;">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div id="data">