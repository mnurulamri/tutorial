<?
if(!session_id()) session_start();


include('../koneksi/conn.php');

//set variabel query
$tgl = $_SESSION['tgl'];
$bulan = $_SESSION['bulan'];
$tahun = $_SESSION['tahun'];
$pegawai = $_SESSION['pegawai'];

//set tanggal
$tanggal = DateToIndo();
$array = explode(' ', DateToIndo());
$periode = $array[1]." ".$array[2];
$tahun = $array[2];

// Get data records from table.
$sql = "SELECT b.bulan, c.norek as norek, c.nama as nama, c.gender, a.*
        FROM x_pot a
        INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
        LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
        WHERE a.tgl = '$tgl' AND a.kd_bulan = '$bulan' AND a.tahun = '$tahun' AND c.flag_pegawai = '$pegawai'
        ORDER BY a.kd_bulan, a.tgl, c.nama";

$result = mysql_query($sql) or die(mysql_errno());
$data = array();
/*while ($row = mysql_fetch_array($result)) {
    $data[] = $row;
}*/

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=lampiran.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

// Make column labels. (at line 3)
/*
$xlsRow = 0;
for($i = 0; $i < mysql_num_fields($result); $i++){
    $col = mysql_field_name($result, $i);
    xlsWriteLabel($xlsRow,$i,$col);
}
*/

if ($pegawai == 0) {
    $no_surat = 'Lampiran Surat Nomor:        /H2.D4.02/KEU.05/'.$tahun;
    xlsWriteLabel(0, 0, $no_surat);
} else {
    $no_surat = 'Lampiran Surat Nomor:        /UN2.F14.M3/KEU.04.00/'.$tahun;
    xlsWriteLabel(0, 0, $no_surat);
}

//cetak header
xlsWriteLabel(3,0,'NO');
xlsWriteLabel(3,1,'NAMA');
xlsWriteLabel(3,2,'NAMA BANK');
xlsWriteLabel(3,3,'NO REKENING');
xlsWriteLabel(3,4,'TOTAL');

// Put data records from mysql by while loop.
/*
$xlsRow = 1;
while($rows = mysql_fetch_array($result)){
    for($i = 0; $i < mysql_num_fields($result); $i++){          
        $col = mysql_field_name($result, $i);
        xlsWriteLabel($xlsRow,$i,$rows[$col]);
    }
    $xlsRow++;
}
*/

$total = 0;
$grandtotal = 0;
$xlsRow = 4;
$no = 1;

while($v = mysql_fetch_array($result)){
    
    $total = $v['dplk']+
            $v['simpanan_wajib'] +
            $v['simpanan_sukarela'] +
            $v['cicilan_koperasi'] +
            $v['jasa'] +
            $v['bkc'] +
            $v['bsm'] +
            $v['bke'] +
            $v['danamon'] +
            $v['bri'] +
            $v['bukopin'] +
            $v['amal'];
    
    $grandtotal += $total;
    
    if ($total > 0) {
        xlsWriteLabel($xlsRow, 0, $no);
        xlsWriteLabel($xlsRow, 1, $v['nama']);
        xlsWriteLabel($xlsRow, 2, 'BNI');
        xlsWriteLabel($xlsRow, 3, $v['norek']);
        xlsWriteNumber($xlsRow, 4, $total);
        $xlsRow++;
        $no++;        
    }
}

xlsWriteLabel($xlsRow, 3, 'TOTAL');
xlsWriteNumber($xlsRow, 4, $grandtotal);

xlsEOF();
exit();

// Functions for export to excel.
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}

function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}

function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
}

function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

function xlsWriteString( $Row , $Col , $Value )
{
    $L = strlen( $Value );
    echo pack( "ssssss" , 0x204 , 8 + $L , $Row , $Col , 0x0 , $L );
    echo $Value;
    return;
}

function DateToIndo() { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
    
        $tahun = date("Y"); 
        $bulan = date("m"); 
        $tgl   = date("d"); 
        
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
}

//fungsi terbilang
function Terbilang($x)
{
    $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
        return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
        return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
        return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
        return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
        return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>