<?php
header('Content-Type: text/html; charset=UTF-8');
$host = "localhost";    $user = "fvytbumr_marcelo";     $bdd = "fvytbumr_telavideos";   $password="marcelo2207";  
mysql_connect($host, $user,$password);
mysql_select_db($bdd);
mysql_query("SET NAMES utf8");
 
/* Method for making URLs Seo Friendly */ 
function nice_url($url) {
$string ='';
//$url = check_invalid_utf8($url);
// translate other languages
$url = url_translate($url);
// remove all chars
$url = preg_replace("/[^a-z0-9]+/","-",strtolower($url));
//remove doubled -
$url = str_replace(array('-----','----','---','--'),'-', $url);
return urlencode(strtolower($url));
}
function url_translate($string) {
$specialchars = array(
		// Latin
		'�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C', 
		'�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I', 
		'�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', 'O' => 'O', 
		'�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', 'U' => 'U', '�' => 'Y', '�' => 'TH', 
		'�' => 'ss', 
		'�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c', 
		'�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i', 
		'�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', 'o' => 'o', 
		'�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', 'u' => 'u', '�' => 'y', '�' => 'th', 
		'�' => 'y',
 
		// Latin symbols
		'�' => '(c)',
 
		// Greek
		'?' => 'A', '?' => 'B', 'G' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', 'T' => '8',
		'?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
		'?' => 'R', 'S' => 'S', '?' => 'T', '?' => 'Y', 'F' => 'F', '?' => 'X', '?' => 'PS', 'O' => 'W',
		'?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
		'?' => 'Y',
		'a' => 'a', '�' => 'b', '?' => 'g', 'd' => 'd', 'e' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
		'?' => 'i', '?' => 'k', '?' => 'l', '�' => 'm', '?' => 'n', '?' => '3', '?' => 'o', 'p' => 'p',
		'?' => 'r', 's' => 's', 't' => 't', '?' => 'y', 'f' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
		'?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
		'?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
 
		// Turkish
		'S' => 'S', 'I' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', 'G' => 'G',
		's' => 's', 'i' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', 'g' => 'g', 
 
		// Russian
		'?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
		'?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
		'?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
		'?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => '', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
		'?' => 'Ya',
		'?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
		'?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
		'?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
		'?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => '', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
		'?' => 'ya',
 
		// Ukrainian
		'?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
		'?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
 
		// Czech
		'C' => 'C', 'D' => 'D', 'E' => 'E', 'N' => 'N', 'R' => 'R', '�' => 'S', 'T' => 'T', 'U' => 'U', 
		'�' => 'Z', 
		'c' => 'c', 'd' => 'd', 'e' => 'e', 'n' => 'n', 'r' => 'r', '�' => 's', 't' => 't', 'u' => 'u',
		'�' => 'z', 
 
		// Polish
		'A' => 'A', 'C' => 'C', 'E' => 'e', 'L' => 'L', 'N' => 'N', '�' => 'o', 'S' => 'S', 'Z' => 'Z', 
		'Z' => 'Z', 
		'a' => 'a', 'c' => 'c', 'e' => 'e', 'l' => 'l', 'n' => 'n', '�' => 'o', 's' => 's', 'z' => 'z',
		'z' => 'z',
 
		// Latvian
		'A' => 'A', 'C' => 'C', 'E' => 'E', 'G' => 'G', 'I' => 'i', 'K' => 'k', 'L' => 'L', 'N' => 'N', 
		'�' => 'S', 'U' => 'u', '�' => 'Z',
		'a' => 'a', 'c' => 'c', 'e' => 'e', 'g' => 'g', 'i' => 'i', 'k' => 'k', 'l' => 'l', 'n' => 'n',
		'�' => 's', 'u' => 'u', '�' => 'z'
	);
return strtr($string,$specialchars);
}
$res = mysql_query("SELECT * FROM vibe_videos ORDER BY id DESC LIMIT 30000");
header("Content-Type: text/xml;charset=utf-8");
$urlActu = "";
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
<?php
while ($row = mysql_fetch_array($res)) {
    $urlActu="http://".$_SERVER["HTTP_HOST"]."/video/".$row['id']."/".nice_url($row['title']).'/';
?>
<url><loc><?php echo $urlActu; ?></loc></url>
<?php } ?>
</urlset>