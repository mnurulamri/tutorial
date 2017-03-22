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

<script src="autocomplete_edit_realisasi.js" type="text/javascript"></script>-->


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
		{name: 'total'},
		{name: 'realisasi'},
		{name: 'metode'},
		{name: 'tgl_posting'},
		{name: 'no_cabang'},
		{name: 'no_jurnal'},
		{name: 'admin_bank'},
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
										hadir10 = parseInt(record['danamon']);
										hadir11 = parseInt(record['amal']);

										var totalhadir = hadir0 + hadir1 + hadir2 + hadir3 + hadir4 + hadir5 + hadir6 + hadir7 + hadir8 + hadir9 + hadir10 + hadir11;
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
{id: 'id' , header: "ID", width :30, frozen:false},
{id: 'tgl', header: "Tgl", width :30, frozen:false},
{id: 'bulan', header: "Bulan", width :80, hidden:false, frozen:false, renderer: tes},
{id: 'tahun', header: "Tahun", width :40, frozen:false},
{id: 'id_anggota', header: "ID Anggota", width :80, frozen:false},
{id: 'norek', header: "No. Rek", width :80, frozen:false},
{id: 'nama', header: "Nama Anggota", width :180, frozen:false},
{id: 'total', header: "Total", editor: {type:""}, width :90, renderer: format},
{id: 'realisasi', header: "Realisasi", editor: {type:"text"}, width :90, renderer: format},
{id: 'metode', header: "Metode", editor: {type:"text"}},
{id: 'tgl_posting', header: "Tgl Potsing", editor: {type:"text"}},
{id: 'no_cabang', header: "Branch", editor: {type:"text"}, width :90},
{id: 'no_jurnal', header: "Jornal No", editor: {type:"text"}, width :90},
{id: 'admin_bank', header: "Admin bank", editor: {type:"text"}, width :90},
{id: 'cicilan_kop_ke', header: "Cicilan Ke", editor: {type:"text"}, width :90, renderer: styleoktober},
{id: 'cicilan_kop_jml', header: "Juml Bln", editor: {type:"text"}, width :90, renderer: styleseptember}
];

var gridOption={
	id : grid_demo_id,
	loadURL : 'controller_realisasi.php',
	saveURL : 'controller_realisasi.php',
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

<?php //include("menu.php"); 

//set variabel tanggal
$tgl = $_SESSION['tgl'];
$bulan = $_SESSION['bulan'];
$tahun = $_SESSION['tahun'];
$vtahun = substr($tahun, -2);

include('../koneksi/conn.php');
$sql = "SELECT DISTINCT substr(post_date,1,11) as post_date 
		FROM x_histori_bni 
		WHERE substr(post_date,4,2) = '$bulan' AND (substr(post_date,7,4) = '$tahun' OR substr(post_date,7,2) = '$vtahun')";

$result = $mysqli->query($sql)  or die($mysqli->error) ;

while ($row = $result->fetch_object()) {
	$post_date[] = $row;
}
?>

<body style="background:#eee">
	<div style="text-align:center; font-family:verdana; color:#fff; background:rgb(49,132,155); padding-top:2px; padding-bottom:2px">
		<b>Edit Data Yang Berhasil di Potong Per Tanggal <?=$tgl.'-'.$bulan.'-'.$tahun?></b>
	</div>
	
	<div>
		<!--
		<span>
			<a href="input_from_trans_bni.php" class="button"><button>Input data dari transaksi histori BNI</button></a>
		</span>
		-->
		<div style="display:table-row">
			<div style="display:table-cell">
				<form name="set_tgl_posting" action="input_from_trans_bni_2.php" method="post">
					<h4 style="font-family:arial">
						Set Tanggal Posting
					<select name="tgl_posting">
						<?
						foreach ($post_date as $k => $v) {	
							$posisi = strpos($v->post_date, ' ');
							$tgl_posting = substr($v->post_date, 0, $posisi);
							echo '<option value="'.$tgl_posting.'">'.$tgl_posting.'</option>';
						}
						?>
					</select>
					<input type="submit" value="generate" name="submit"/>
					</h4>
				</form>
			</div>

			<div style="display:table-cell">&nbsp;&nbsp;&nbsp;</div>

			<div style="display:table-cell">
				<b style="font-family:arial">Set Tanggal Posting Per Nama / NomorRekening Anggota</b>
				<input id="nama_anggota" style="font:bold 11px verdana;" type="text" name="nama_anggota" onkeyup="lihat(this.value)"/>
				
			</div>
		</div>
	</div>
	<div id="kotaksugest" style="clear:both"></div>
</body>

<script>
var drz;

function lihat(kata){
	if(kata.length==0){
		document.getElementById("kotaksugest").style.visibility = "hidden";
	}else{
		drz = buatajax();
		var url="input_from_trans_bni_3.php";
		drz.onreadystatechange = stateChanged;
		var params = "q="+kata;
		drz.open("POST",url,true);
		//beberapa http header harus kita set kalau menggunakan POST
		drz.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		drz.setRequestHeader("Content-length", params.length);
		drz.setRequestHeader("Connection", "close");23
		drz.send(params);
	}
}

function buatajax(){
	if (window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject){
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}

function stateChanged(){
	var data;
	if (drz.readyState==4 && drz.status==200){
		data = drz.responseText;
		if(data.length>0){
			document.getElementById("kotaksugest").innerHTML = data;
			document.getElementById("kotaksugest").style.visibility = "";
		}else{
			document.getElementById("kotaksugest").innerHTML = "";
			document.getElementById("kotaksugest").style.visibility = "hidden";
		}
	}
}

function isi(kata){
	document.getElementById("nama_anggota").value = kata;
	//document.getElementById("nama_pengajar").value = kata;
	document.getElementById("kotaksugest").style.visibility = "hidden";
	document.getElementById("kotaksugest").innerHTML = "";
}
</script>
</html>