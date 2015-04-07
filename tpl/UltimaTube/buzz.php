<?php echo the_sidebar(); ?>
<div class="main-holder pad-holder buzz-left nomargin">
<?php 
$count = $db->get_row("Select count(*) as nr from ".DB_PREFIX."activity where user in (select uid from ".DB_PREFIX."users_friends where fid ='".user_id()."')");
$vq = "Select ".DB_PREFIX."activity.*, ".DB_PREFIX."users.avatar,".DB_PREFIX."users.id as pid, ".DB_PREFIX."users.name from ".DB_PREFIX."activity left join ".DB_PREFIX."users on ".DB_PREFIX."activity.user=".DB_PREFIX."users.id where ".DB_PREFIX."activity.user in (select uid from ".DB_PREFIX."users_friends where fid ='".user_id()."') ORDER BY ".DB_PREFIX."activity.id DESC ".this_limit();
include_once(TPL.'/layouts/global_activity.php');	
$pagestructure = canonical().'&p=';
$a = new pagination;	
$a->set_current(this_page());
$a->set_first_page(true);
$a->set_pages_items(7);
$a->set_per_page(bpp());
$a->set_values($count->nr);
$a->show_pages($pagestructure);

?>
</div>
<div class="top10 inline-block buzz-right">
<?php $populars = $cachedb->get_results("SELECT id,avatar,name from ".DB_PREFIX."users where id in (select uid from ".DB_PREFIX."users_friends where fid ='".user_id()."') order by id limit 0,150");
if($populars) {
echo '
<div class="box ">
<div class="box-head">
';
echo '<h4 class="box-heading">'._lang("On this list").'</h4></div>
<div class="box-body">';
foreach ($populars as $popular) {
echo '
<div class="populars bigrow">
<a class="tipE pull-left" title="'.$popular->name.'" href="'.profile_url($popular->id , $popular->name).'"><img src="'.thumb_fix($popular->avatar).'" alt="'.$popular->name.'" /></a>
<span class="pop-title"><a title="'.$popular->name.'" href="'.profile_url($popular->id , $popular->name).'">'._html(_cut($popular->name), 12).'</a></span>';
echo '
<div class="clearfix"></div>
</div>

';
}
echo '</div>';
}
?>
</div>