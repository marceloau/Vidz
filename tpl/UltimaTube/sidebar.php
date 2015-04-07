<div id="sidebar" class="hide"> 
<div class="sidescroll">
<?php echo '<div class="searchWidget visible-phone hidden-tablet hidden-desktop" style="margin:10px 3px;">
            <form action="" method="get" id="searchform" onsubmit="location.href=\''.site_url().show.'/\' + encodeURIComponent(this.tag.value).replace(/%20/g, \'+\'); return false;">
                <input type="text" name="tag" id="suggest-videos" value="'._lang("Search videos").'" onfocus="if (this.value == \''._lang("Search videos").'\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \''._lang("Search videos").'\';}" />
             <button type="submit" class="btn btn-primary pull-right"><i class="icon-search"></i></button>
			</form>       
		</div>'
?>
<?php 
//The menu	
echo '<div class="sidebar-nav blc"><ul>
<li class="lihead"><a href="javascript:void(0)"><i class="icon-youtube-play"></i> '._lang('Browse Videos').'</a>
<ul>
<li><a href="'.list_url(browse).'" title="'._lang('New Media').'"><i class="icon-exchange"></i> '._lang('Recent').'</a></li>
	<li><a href="'.list_url(mostviewed).'" title="'._lang('Most Viewed').'"><i class="icon-list-ol"></i> '._lang('Most Viewed').'</a></li>
	<li><a href="'.list_url(promoted).'" title="'._lang('Featured').'"><i class="icon-check"></i> '._lang('Featured').'</a></li>
	<li><a href="'.list_url(mostliked).'" title="'._lang('Most Liked').'"><i class="icon-heart"></i> '._lang('Most Liked').'</a></li>	
	<li><a href="'.list_url(mostcom).'" title="'._lang('Most Commented').'"><i class="icon-comment"></i> '._lang('Most Commented').'</a></li>	
</ul>
</li>
<li class="lihead"><a href="'.site_url().channels.'"><i class="icon-indent"></i>'._lang('Video Channels').'</a>'.the_nav().'</li>';
if(get_option('musicmenu') == 1 ) {
echo '<li class="lihead"><a href=""><i class="icon-headphones"></i>'._lang('Music Channels').'</a> '.the_nav(2).'</li>';
}
if(get_option('imagesmenu') == 1 ) {
echo '<li class="lihead"><a href=""><i class="icon-picture-o"></i>'._lang('Image Categories').'</a>'.the_nav(3).'</li>';
}


$postsx = $db->get_results("select title,pid,pic from ".DB_PREFIX."posts ORDER BY title ASC ".this_limit()."");
 /* The posts lists */
 if($postsx) {
echo '<li><a href="'.site_url().blog.'"><i class="icon-file-text-o"></i>'._lang('Articles').'</a>
	<ul>';
	echo '<li><a href="'.site_url().blog.'" title="'._("All articles").'"> <i class="icon-folder-open-o"></i> '._("All articles").'</a></li>';

	foreach ($postsx as $px) {
	if(isset($px->pic) && !nullval($px->pic)) {$pic = '<img src="'.thumb_fix($px->pic, true, 23, 23).'">';} else {$pic = '<i class="icon-circle-thin"></i>';}
echo '<li><a href="'.article_url($px->pid, $px->title).'" title="'._html($px->title).'"> '.$pic.' '._cut(_html($px->title),24).'</a></li>';

	
	}

  echo '  </ul>   
    </li>
 ';
}
$pagesx = $db->get_results("select title,pid,pic from ".DB_PREFIX."pages WHERE menu = '1' ORDER BY title ASC ".this_limit()."");
 /* The pages lists */
 if($pagesx) {
echo '<li class="lihead"><a href="javascript:void(0)"><i class="icon-picture-o"></i>'._lang('Pages').'</a>
	<ul>';
	foreach ($pagesx as $px) {
	if(isset($px->pic) && !nullval($px->pic)) {$pic = '<img src="'.thumb_fix($px->pic, true, 23, 23).'">';} else {$pic = '<i class="icon-circle-thin"></i>';}

echo '<li><a href="'.page_url($px->pid, $px->title).'" title="'._html($px->title).'">'.$pic.' '._cut(_html($px->title),24).'</a></li>';

	
	}

  echo '  </li>';
}
echo '</ul></div>';
/* End of menu */
?>

<?php	
if (is_user()) {
/* start my playlists */	
$plays = $db->get_results("SELECT * FROM ".DB_PREFIX."playlists where owner= '".user_id()."' order by views desc limit 0,100");
if($plays) { 
$plnr = $db->num_rows;
?>
<h4 class="li-heading"><?php echo _lang('My Playlists'); ?></h4>

<div class="sidebar-nav blc"><ul>
<?php 
foreach ($plays as $play) {
echo '<li>
<a class="tipW pull-left" href="'.playlist_url($play->id, $play->title).'" original-title="'.$play->title.'" title="'.$play->title.'"><img src="'.thumb_fix($play->picture, true, 27, 27).'">
'._html(_cut($play->title, 24)).'
</a>
</li>';
}
echo '</ul>
</div>';
}	
/* end my playlists */	
/* start my  subscriptions */ 
$followings = $cachedb->get_results("SELECT id,avatar,name,lastlogin from ".DB_PREFIX."users where id in (select uid from ".DB_PREFIX."users_friends where fid ='".user_id()."') order by lastlogin desc limit 0,15");
if($followings) {
$snr = $cachedb->num_rows;
?>

<h4 class="li-heading"><?php echo _lang('My subscriptions'); ?> <a class="pull-right smallh" href="<?php echo profile_url(user_id(), user_name()); ?>&sk=subscribed"><?php echo _("View all"); ?></a></h4>

<div class="sidebar-nav blc"><ul>
<?php

foreach ($followings as $following) {
echo '
<li>
<a class="tipW pull-left" title="'.$following->name.'" href="'.profile_url($following->id , $following->name).'">
<img src="'.thumb_fix($following->avatar, true, 27, 27).'" alt="'.$following->name.'" />'._html(_cut($following->name, 25)).'';
if(date('d-m-Y', strtotime($following->lastlogin)) != date('d-m-Y')) {
echo '<i class="icon-circle-thin offline pull-right"></i>';
} else {
echo '<i class="icon-circle-thin online pull-right"></i>';
}
echo '
</a></li>';
}
echo '</ul>
</div>
';
}
/* end subscriptions */

}

?>	
<?php $users = $cachedb->get_results("SELECT id,name,avatar FROM ".DB_PREFIX."users order by id desc limit 0,20");
if($users) {
$fnr = $cachedb->num_rows;
?>
<h4 class="li-heading"><?php echo _lang('New users'); ?></h4>

<div class="sidebar-nav blc"><ul>
<?php
foreach ($users as $user) {
echo '
<li>
<a class="pull-left" title="'.$user->name.'" href="'.profile_url($user->id , $user->name).'"><img src="'.thumb_fix($user->avatar, true, 27, 27).'" alt="'.$user->name.'" />
'._html(_cut($user->name, 25)).'</a>
</li>
';
}

echo '</ul></div>
';
}
?>								
<?php $plays = $cachedb->get_results("SELECT id,title,picture FROM ".DB_PREFIX."playlists where id in (SELECT distinct playlist FROM ".DB_PREFIX."playlist_data)order by views desc limit 0,20");
if($plays) { 
$plnr = $cachedb->num_rows;
?>

<h4 class="li-heading"><?php echo _lang('Playlists'); ?></h4>

<div class="sidebar-nav blc"><ul>
<?php 
foreach ($plays as $play) {
echo '<li>
<a class="pull-left" href="'.playlist_url($play->id, $play->title).'" original-title="'.$play->title.'" title="'.$play->title.'"><img src="'.thumb_fix($play->picture, true, 27, 27).'">
'._html(_cut($play->title, 25)).'
</a>
</li>';
}
echo '</ul></div>';
}	?>
</div>
</div>
