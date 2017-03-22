<?
header('Content-Type: application/json');
// The text that the user type in the textbox.
$search_phrase = $_POST["search_key"];
include ('koneksi/conn.php');
//$search_phrase = 'ab';
$data = array();

/* awal 
$sql = "SELECT DISTINCT a.kd_mhs, nm_mhs, program 
		FROM riwayat a, mahasiswa b, organisasi c 
		WHERE a.kd_mhs = b.kd_mhs AND b.kd_org = c.kd_organisasi AND (nm_mhs like '%$search_phrase%' OR a.kd_mhs like '%$search_phrase%')
		ORDER BY substr(b.kd_org,4,2), substr(b.kd_org,1,2), nm_mhs
		LIMIT 10";
*/	

$sql = "SELECT DISTINCT id_anggota, nama 
		FROM x_norek
		WHERE nama like '%$search_phrase%'
		ORDER BY nama";	
		
$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_object($result)){
	$data[] = $row; 
}

echo json_encode($data);

/*
 require_once('../perkuliahan/conn.php');
 $i=0;
$sql = "SELECT DISTINCT a.kd_mhs as kd_mhs, nm_mhs, program 
		FROM riwayat a, mahasiswa b, organisasi c 
		WHERE a.kd_mhs = b.kd_mhs AND b.kd_org = c.kd_organisasi
		ORDER BY substr(b.kd_org,4,2), substr(b.kd_org,1,2), nm_mhs
		LIMIT 10";
$result = mysql_query($sql) or die(mysql_error());
 
 $array = array();
 while($row = mysql_fetch_array($result))
 {
	$i++;
	$userid = $row['kd_mhs'];
	$title = $row['program'];
	$fname = $row['nm_mhs'];
	$mname = substr($row['nm_mhs'],0,1);
	$lname = $row['nm_mhs'];
	$data[$i]['userid'] = $userid;
	$data[$i]['fname'] = $fname;
	$data[$i]['mname'] = $mname;
	$data[$i]['lname'] = $lname;
	$data[$i]['full_name'] = $title.$fname." ".$mname."."." ".$lname;
 }
 echo json_encode($data);*/
?>