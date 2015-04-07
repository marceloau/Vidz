<?php /* We build it on top of Enghlish */
$en_terms = $db->get_results("SELECT DISTINCT term from ".DB_PREFIX."langs limit 0,100000", ARRAY_A );
//var_dump($en_terms);
if(isset($_POST["lang-code"])) {
$lang = $_POST["lang-code"];
$ar = array();
$ar["language-name"] = $_POST["language-name"];
foreach ($_POST["term"] as $key=>$value) {
$ar[$key] = $value;
}
add_language($lang ,$ar );
echo '<div class="msg-info">Language '.$lang.' was created.</div>';
header(location: admin_url('langs'));

}
?>