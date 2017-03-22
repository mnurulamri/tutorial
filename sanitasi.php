<?
function sanitasi($string){
	$string = stripslashes($string);
	$string = htmlentities($string);
	$string = htmlspecialchars($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}
?>