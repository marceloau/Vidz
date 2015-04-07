<?php the_sidebar(); ?>
<div class="main-holder pad-holder row-fluid nomargin">
<h3 class="loop-heading"><span><?php echo $heading;?></span></h3>
<?php 
$posts = $db->get_results($vq);
if ($posts) {
?>
<div class="span7">
<ul class="blog-list list-unstyled">
<?php foreach ($posts as $ar) {
echo '
<li>
<div class="block block-inline">
<div class="box-generic">
	
<div class="media margin-none">
<a class="text-primary" href="'.article_url($ar->pid, $ar->title).'" title="'._html($ar->title).'"><h5 class="strong">'._html($ar->title).'</h5></a>
					<div class="row-fluid blog-holder">';
					if(isset($ar->pic) && !nullval($ar->pic)) {
					echo '	<div class="blog-image">							
								<div class="text-center ">
										<a href="'.article_url($ar->pid, $ar->title).'" title="'._html($ar->title).'"><img src="'.thumb_fix($ar->pic).'"></a>
								</div>							
						</div>';
						}
					echo '	<div class="blog-text">							
							'._html(_cut(strip_tags($ar->content),560)).'...
							
						</div>
						<a class="pull-right btn btn-default" href="'.article_url($ar->pid, $ar->title).'" title="'._html($ar->title).'">'._lang("Read More").'</a>
					</div>
				</div></div>
</div></li>';

}
?>


</ul>


<?php
}

$a->show_pages($pagestructure);

?>
</div>
<div class="span4">
<?php $populars = $db->get_results("select * from ".DB_PREFIX."postcats order by cat_id DESC limit 0,10000");;
if($populars) {
echo '<h3>'._lang("Blog categories").'</h3>';
foreach ($populars as $popular) {
echo '
<div class="media-list">
<a class="tipE pull-left" title="'.$popular->cat_name.'" href="'.bc_url($popular->cat_id , $popular->cat_name).'"><img src="'.thumb_fix($popular->picture, true, 103, 154).'" alt="'.$popular->cat_name.'" /></a>
<span class="pop-title"><a title="'.$popular->cat_name.'" href="'.bc_url($popular->cat_id , $popular->cat_name).'">'._cut(_html($popular->cat_name), 15).'</a></span>';
echo '
<div class="clearfix"></div>
</div>';
}
}
?>
</div>
</div>