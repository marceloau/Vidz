<div id="channel-content" class="main-holder pad-holder span8 top10 nomargin">
<?php 
$heading = '';
$heading_meta = '';
$heading_meta .= '
<div class="hcontainer">
<img class="pic" src="'.thumb_fix($channel->picture, true, 60, 60).'" />
<div class="hmeta">
<span class="arrow"></span>
<div class="body">
<h1>'._html($channel->cat_name).'</h1>
'._html($channel->cat_desc).'
</div>
</div>
<div class="clearfix"></div>
</div>
';
if($subchannels) { 
$heading_meta .= ' <div class="fake-padding black-slider">
<ul id="carousel" class="elastislide-list">';
foreach ( $subchannels as $more ) { 
$heading_meta .= '<li>
<a href="'.channel_url($more->cat_id,$more->cat_name).'" title="'.$more->cat_name.'" class="tipS">
<img alt="'.$more->cat_name.'" class="round-thumbs" src="'.thumb_fix($more->picture, true, 120, 120).'"></a>
</li>';			
}
$heading_meta .= '</ul></div>';
}
$options = DB_PREFIX."videos.id,".DB_PREFIX."videos.media,".DB_PREFIX."videos.title,".DB_PREFIX."videos.user_id,".DB_PREFIX."videos.thumb,".DB_PREFIX."videos.views,".DB_PREFIX."videos.liked,".DB_PREFIX."videos.duration,".DB_PREFIX."videos.nsfw";
$vq = "select ".$options.", ".DB_PREFIX."users.name as owner FROM ".DB_PREFIX."videos LEFT JOIN ".DB_PREFIX."users ON ".DB_PREFIX."videos.user_id = ".DB_PREFIX."users.id WHERE ".DB_PREFIX."videos.category in (SELECT cat_id from ".DB_PREFIX."channels where cat_id = '".$channel->cat_id."' or child_of = '".$channel->cat_id."' ) and ".DB_PREFIX."videos.pub > 0 ORDER BY ".DB_PREFIX."videos.id DESC ".this_offset(bpp());
$kill_infinite = true;
include_once(TPL.'/video-loop.php');
$a = new pagination;	
$a->set_current(this_page());
$a->set_first_page(true);
$a->set_pages_items(7);
$a->set_per_page(bpp());
$a->set_values($count->nr);
$a->show_pages($canonical.'&p=');
?>
</div>
<?php if (!is_ajax_call()) { right_sidebar();  } ?>