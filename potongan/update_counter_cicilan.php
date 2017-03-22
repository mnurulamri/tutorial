<?
include('../koneksi/conn.php');
$field = $_POST['field'];
$id = $_POST['id'];
$value = $_POST['value'];

echo $field.' '.$id.' '.$value;

$sql = "UPDATE x_pot SET $field = $value WHERE id = $id"; 
$result = $mysqli->query($sql) or die($mysqli->error);
?>