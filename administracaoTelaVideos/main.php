<?php
/**
   Decoded and  Nulled by Mr Qaidi
   www.qaidi.info
   special thanks to ayoups share this script with us
 **/

error_reporting( E_ALL );
require_once( '../load.php' );
ob_start(  );

if (is_admin(  )) {
	if (!defined( 'ADM' )) {
		define( 'ADM', ABSPATH . '/' . ADMINCP );
	}

	require_once( ADM . '/adm-functions.php' );
	require_once( ADM . '/adm-hooks.php' );
	admin_header(  );



	function get_domain($url) {
		$pieces = parse_url( $url );
		$domain = (isset( $pieces['host'] ) ? $pieces['host'] : '');

		if (preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs )) {
			return $regs['domain'];
		}

		return false;
	}





	require_once( ADM . '/core.php' );
}
else {
	exit( '<a href=\'' . site_url(  ) . 'login\'>You are not the administrator of this TelaVideos based website. Please login with the administrator account</a>' );
}

echo '
<div class="container-fluid" style="border-top: 1px solid #d4d4d4;">
<div class="row-fluid">
<div class="span2 nomargin" style="padding: 20px">
' . show_logo(  ) . '
</div>
<div class="span8 footer-content">
' . apply_filters( 'tfc', get_option( 'site-copyright' ) ) . '
</div>
</div>
</div>';
ob_end_flush(  );
?>
