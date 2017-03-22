<?
if(!session_id()) session_start();

$tgl = $_SESSION['tgl'];
$bulan = $_SESSION['bulan'];
$vtahun = $_SESSION['tahun'];
$tahun = str_replace('20', '', $vtahun);

$tgl_posting = $tgl.'/'.$bulan.'/'.$tahun;

if(isset($_POST['submit'])){//to run PHP script on submit
	
	include('../koneksi/conn.php');

	if(!empty($_POST['check_list'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $selected){
			//echo $selected."</br>";
			$array = explode(';', $selected);
			$norek = $array[0];
			$tgl_posting = $array[1];
			$no_cabang = $array[2];
			$no_jurnal = $array[3];
			$realisasi = $array[4];
			$deskripsi = $array[5];
			$id_anggota = $array[6];
			$admin_bank = 1000;

			if (substr($deskripsi, 0, 8) == 'TRANSFER') {
				$metode = 'Pemindahbukuan';
			} else if (substr($deskripsi, 0, 5) == 'SETOR') {
				$metode = 'Setor tunai';
			} else if (substr($deskripsi, 0, 3) == 'TRF') {
				$metode = 'Transfer';
			}

			/*
			echo '<br>';
			echo substr($deskripsi, 0, 8);
			echo '<br>';
			echo '<pre>';
			echo 
			*/
			$sql = "UPDATE x_pot 
						SET 
							metode = '$metode',
							tgl_posting = '$tgl_posting',
							no_cabang = '$no_cabang',
							no_jurnal = '$no_jurnal',
							realisasi = '$realisasi',
							admin_bank = '$admin_bank'
						WHERE tgl = '$tgl' AND kd_bulan = '$bulan' AND tahun = '$vtahun' AND id_anggota = '$id_anggota' ";

			$mysqli->query($sql)  or die($mysqli->error) ;
			/*
			echo '<br>';	
			echo '</pre>';	
			*/
		}
	}

	if(!empty($_POST['check_radio'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_radio'] as $selected){
			//echo $selected."</br>";
			$array = explode(';', $selected);
			$norek = $array[0];
			$tgl_posting = $array[1];
			$no_cabang = $array[2];
			$no_jurnal = $array[3];
			$realisasi = $array[4];
			$deskripsi = $array[5];
			$id_anggota = $array[6];
			$admin_bank = 1000;

			if (substr($deskripsi, 0, 8) == 'TRANSFER') {
				$metode = 'Pemindahbukuan';
			} else if (substr($deskripsi, 0, 5) == 'SETOR') {
				$metode = 'Setor tunai';
			} else if (substr($deskripsi, 0, 3) == 'TRF') {
				$metode = 'Transfer';
			}

			/*
			echo '<br>';
			echo substr($deskripsi, 0, 8);
			echo '<br>';
			echo '<pre>';
			echo 
			*/
			$sql = "UPDATE x_pot 
						SET 
							metode = '$metode',
							tgl_posting = '$tgl_posting',
							no_cabang = '$no_cabang',
							no_jurnal = '$no_jurnal',
							realisasi = '$realisasi',
							admin_bank = '$admin_bank'
						WHERE tgl = '$tgl' AND kd_bulan = '$bulan' AND tahun = '$vtahun' AND id_anggota = '$id_anggota' ";

			$mysqli->query($sql)  or die($mysqli->error) ;
			/*
			echo '<br>';	
			echo '</pre>';	
			*/
		}
	}
}

header("location: edit_realisasi.php");

//$result = $mysqli->query($sql)  or die($mysqli->error) ;

//while ($row = $result->fetch_object()) {
//	$data[] = $row;
//}
?>