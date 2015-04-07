<?php the_sidebar(); ?>
<div id="default-content" class="main-holder pad-holder span12 top10">
<?php if(com() == "login" || com() == "register") { 
echo '<ul class="aregister share-body">';
if(get_option('allowfb') == 1 ) {
echo '<li class="facebook"><a  href="'.site_url().'index.php?action=login&type=facebook" title="'._lang('Facebook login').'"><i class="icon-facebook-sign"></i><span>'._lang('Facebook').'</a></span></li>';
}
if(get_option('allowtw') == 1 ) {
echo '<li class="twitter"><a href="'.site_url().'index.php?action=login&type=twitter" title="'._lang('Twitter login').'"><i class="icon-twitter"></i><span>'._lang('Twitter').'</span></a></li>';
}
if(get_option('allowg') == 1 ) {
echo '  <li class="googleplus"><a href="'.site_url().'index.php?action=login&type=google" title="'._lang('Google login').'"><i class="icon-google-plus-sign"></i><span>'._lang('Google').'</span></a></li>';
}
if(com() == "login" ) {
echo '<li class="pinterest"><a  href="'.site_url().'login/&do=forgot" title="'._lang('Forgot password').'"><i class="icon-envelope"></i><span>'._lang('Recover').'</span></a></li> ';
}
  if((com() == "login" ) && get_option('allowlocalreg') == 1 ) {
echo' <li class="linkedin"><a href="'.site_url().'register/" class="login-more"><i class="icon-double-angle-right"></i><span>'._lang('Classic registration').'</span>  </a></li>';
          }
echo '</ul>';
 } ?>
<?php echo default_content(); ?>
</div>
