<?
if(!session_id()) session_start();

$string = $_POST['tgl_pot'];
echo $string;
$array = explode('-', $string);
$tgl = $array[0];
$bulan = $array[1];
$tahun = $array[2];
echo $tgl.$bulan.$tahun;

//kelola tanggal untuk membuat flag updating
$originalDate = "$tahun-$bulan-$tgl";
echo $newDate = date("d-m-Y", strtotime($originalDate));

echo '<br>'; 
  
$date = date('Y-m-d H:i:s');

if($originalDate > $date){
	$flag = 'text';
} else {
	$flag = '';
}

echo $_SESSION['tgl'] = $tgl;
echo $_SESSION['bulan'] = $bulan;
echo $_SESSION['tahun'] = $tahun;
echo $_SESSION['flag'] = $flag;

//include('edit_potongan.php');

header("location: https://remunerasi.fisip.ui.ac.id/koperasi/potongan/edit_realisasi.php");
exit();
?>
