<?
#set token
/*
include('token.php');
if(!isset($_SESSION['username']) || empty($_SESSION['username']))	header("Location:index.php");
checkToken();

if($_SESSION["semester"] == "gasal"){
	$bulan = array("HadirSeptember","HadirOktober","HadirNovember","HadirDesember","HadirJanuari");
	$header = array("Hadir September","Hadir Oktober","Hadir November","Hadir Desember","Hadir Januari");
} else {
	$bulan = array("HadirFebruari","HadirMaret","HadirApril","HadirMei","HadirJuni","HadirJuli");
	$header = array("Hadir Februari","Hadir Maret","Hadir April","Hadir Mei","Hadir Juni","Hadir Juli");
}

include("bulan.php");
*/

if(!session_id()) session_start();
$text = $_SESSION['flag'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>Potongan BNI</title>
<link rel="stylesheet" type="text/css" href="../../remun/grid/gt_grid_height_test.css" />
<link rel="stylesheet" type="text/css" href="../../remun/grid/skin/vista/skinstyle.css" />
<script type="text/javascript" src="../../remun/grid/gt_msg_en.js"></script>
<script type="text/javascript" src="../../remun/grid/gt_grid_all.js"></script>
<script type="text/javascript" src="../../remun/grid/flashchart/fusioncharts/FusionCharts.js"></script>
<script type="text/javascript" src="../../remun/grid/calendar/calendar.js"></script>
<script type="text/javascript" src="../../remun/grid/calendar/calendar-setup.js"></script>
<script src="../../remun/highlight/jssc3.js" type="text/javascript"></script>
<link href="../../remun/highlight/style.css" rel="stylesheet" type="text/css" />
<!--
<link rel="stylesheet" href="/search/autocomplete.css" type="text/css" media="screen">
<script src="/search/jquery.js" type="text/javascript"></script>
<script src="/search/dimensions.js" type="text/javascript"></script>
<script src="/search/searchPengajar.js" type="text/javascript"></script>
<script src="/search/searchMataKuliah.js" type="text/javascript"></script>
-->

<script>
/*$(document).ready(function(){
});
if(document.getElementById("gridbox").complete) {
                alert('test');
            }*/
</script>

<script type="text/javascript" >

//==============================================================================================================
var grid_demo_id = "myGrid1";
var dsOption= {
	fields :[ //name pada fields bersifat case sensitive, jadi sesuaikan dengan nama atribut dari table
		{name: 'id'},
		{name: 'tgl'},
		{name: 'bulan'},
		{name: 'tahun'},
		{name: 'id_anggota'},
		{name: 'norek'},
		{name: 'nama'},
		{name: 'dplk'},
		{name: 'simpanan_wajib'},
		{name: 'simpanan_sukarela'},		
		{name: 'cicilan_koperasi'},		
		{name: 'jasa'},		
		{name: 'bkc'},
		{name: 'bsm'},
		{name: 'bke'},		
		{name: 'danamon'},		
		{name: 'bri'},		
		{name: 'bukopin'},
		{name: 'amal'},
		{name: 'total', type: 'int', initValue: function(record){
										var hadir0 = parseInt(record['dplk']);
										var hadir1 = parseInt(record['simpanan_wajib']);
										var hadir2 = parseInt(record['simpanan_sukarela']);
										var hadir3 = parseInt(record['cicilan_koperasi']);
										var hadir4 = parseInt(record['jasa']);
										var hadir5 = parseInt(record['bkc']);
										var hadir6 = parseInt(record['bsm']);
										var hadir7 = parseInt(record['bke']);
										var hadir9 = parseInt(record['bri']);
										var hadir10 = parseInt(record['bukopin']);
										var hadir11 = parseInt(record['danamon']);
										var hadir12 = parseInt(record['amal']);

										var total = hadir0 + hadir1 + hadir2 + hadir3 + hadir4 + hadir5 + hadir6 + hadir7 + hadir9 + hadir10 + hadir11 + hadir12;									
										//var total = 0;
										return total;
							     }
		},
		{name: 'realisasi'},
		{name: 'cicilan_kop_ke'},
		{name: 'cicilan_kop_jml'}
	],
	recordType : 'object'
}

function tes(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var drop = "drop..";
		var color = "dark-gray";		
		if (value == 0){
			return "<span style='color:red;'><strong>" + drop + "</strong></span>";
		} else {
			return "<span style='color:" + color + ";'>" + no + "</span>";
		}		
}

function styleaktual(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "green";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function styleseptember(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "#CC0000";		
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function styledesember(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "#3300FF";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function stylenovember(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "#3366FF";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function styleoktober(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "magenta";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function styletotal(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "#105952";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

function stylewajibhadir(value ,record,columnObj,grid,colNo,rowNo){
		var no = record[columnObj.fieldIndex];
		var color = "#FF6600";
		return "<span style='color:" + color + ";'><strong>" + no + "</strong></span>";
}

	function format(value ,record,columnObj,grid,colNo,rowNo){ 
	    var number = record[columnObj.fieldIndex];
	    var num = number.replace(/./g, function(c, i, a) {
	            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
	        });
	    return num;
	    //alert(num);
	}

	function format_total(value ,record,columnObj,grid,colNo,rowNo){ 
										hadir0 = parseInt(record['dplk']);
										hadir1 = parseInt(record['simpanan_wajib']);
										hadir2 = parseInt(record['simpanan_sukarela']);
										hadir3 = parseInt(record['cicilan_koperasi']);
										hadir4 = parseInt(record['jasa']);
										hadir5 = parseInt(record['bkc']);
										hadir6 = parseInt(record['bsm']);
										hadir7 = parseInt(record['bke']);
										hadir8 = parseInt(record['danamon']);
										hadir9 = parseInt(record['bri']);
										hadir10 = parseInt(record['bukopin']);
										hadir11 = parseInt(record['danamon']);
										hadir12 = parseInt(record['amal']);

										var total = hadir0 + hadir1 + hadir2 + hadir3 + hadir4 + hadir5 + hadir6 + hadir7 + hadir8 + hadir9 + hadir10 + hadir11 + hadir12;
										//hadir10 = hadir10.replace(/,/g, '');
									    //hadir11 = hadir11.replace(/,/g, '');
									    //var totalhadir = hadir10 + hadir11;
									    var number = record[columnObj.fieldIndex];
									    var num = number.replace(/./g, function(c, i, a) {
									            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
									        });
									    return num;
	}

function format_test(value ,record,columnObj,grid,colNo,rowNo){
	var amal = parseInt(record['amal']);
    var number = record[columnObj.fieldIndex];
    var num = number.replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    return num;/**/
    //return number;
}
//===========================================  SEMESTER GASAL ===================================================

var colsOption = [ //id pada colsOption bersifat case sensitive, jadi sesuaikan dengan nama atribut dari table
{id: 'id' , header: "ID", width :30, frozen:true},
{id: 'tgl', header: "Tgl", width :30, frozen:true},
{id: 'bulan', header: "Bulan", width :80, hidden:false, frozen:true, renderer: tes},
{id: 'tahun', header: "Tahun", width :40, frozen:true},
{id: 'id_anggota', header: "ID Anggota", width :80, frozen:true},
{id: 'norek', header: "No. Rek", width :80, frozen:true},
{id: 'nama', header: "Nama Anggota", width :180, frozen:true},
{id: 'dplk', header: "DPLK", width :90, frozen:false, editor: {type:"<?=$text?>"}, renderer: format},
{id: 'simpanan_wajib', header: "Simp. Wajib", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'simpanan_sukarela', header: "Simp. Sukarela", editor: {type:"<?=$text?>"}, width :105, renderer: format},
{id: 'cicilan_koperasi', header: "Cicilan Kop.", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'jasa', header: "Jasa", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'bkc', header: "BKC", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'bsm', header: "BSM", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'bke', header: "BKE", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'danamon', header: "Danamon", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'bri', header: "BRI", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'bukopin', header: "Bukopin", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'amal', header: "Amal", editor: {type:"<?=$text?>"}, width :90, renderer: format_test},
{id: 'total', header: "Total", editor: {type:""}, width :90},
{id: 'realisasi', header: "Realisasi", editor: {type:"<?=$text?>"}, width :90, renderer: format},
{id: 'cicilan_kop_ke', header: "Cicilan Ke", editor: {type:"<?=$text?>"}, width :90, renderer: styleoktober},
{id: 'cicilan_kop_jml', header: "Juml Bln", editor: {type:"<?=$text?>"}, width :90, renderer: styleseptember}
];

var gridOption={
	id : grid_demo_id,
	loadURL : 'controller.php',
	saveURL : 'controller.php',
	exportURL : 'potongan_bni.php',	
	width: "100%",  //"100%", // 700,
	height: "600px",  //"100%", // 330,
	container : 'gridbox',
	replaceContainer : true,
	encoding : 'UTF-8', // Sigma.$encoding(),
	dataset : dsOption ,
	columns : colsOption ,
	clickStartEdit : true ,
	showIndexColumn : true,
	pageSize:10000,
	reloadAfterSave: true,
	submitUpdatedFields: true,
	resizable : true,
	skin : "vista",
	/*onComplete : function(){clock.start()},  */
	toolbarContent : 'reload | save '
};

var mygrid = new Sigma.Grid( gridOption );
Sigma.Util.onLoad(function(){mygrid.render()});

//////////////////////////////////////////////////////////
/*
function logout(){	
	window.location = 'index.php';
}

*/
</script>

</head>

<?php //include("menu.php"); ?>

<body style="background:#eee">
	<div style="text-align:center; color:rgb(49,132,155); font-size:14px; font-family:arial"><b>Data Potongan BNI Per Tanggal <?=$_SESSION['tgl'].'-'.$_SESSION['bulan'].'-'.$_SESSION['tahun']?><b>
	</div>

	<div style="text-align:right; margin-right:12px">
		<a href="../../tcpdf/examples/surat_potongan_bni.php"><button>cetak surat</button></a>
		<a href="lampiran_surat.php"><button>cetak lampiran</button></a>
	</div>

	<div id="content">
		<div id="bigbox" style="margin:15px;display:!none;">
			<div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
		</div>
	</div>
</body>
</html>