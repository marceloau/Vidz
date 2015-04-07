<?php //Check session start
if (empty($_SESSION)) {
   session_start();
}
// physical path of your root
if( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', str_replace( '\\', '/',  dirname( __FILE__ ) )  );

// physical path of includes directory
if( !defined( 'INC' ) )
	define( 'INC', ABSPATH.'/lib' );
// physical path of theme
if( !defined( 'THEME' ) )
	define( 'THEME', 'UltimaTube' );	
// physical path of themes directory
if( !defined( 'TPL' ) )
	define( 'TPL', ABSPATH.'/tpl/'.THEME);	
// security
if( !defined( 'in_phpvibe' ) )
	define( 'in_phpvibe', true);	
//Include config 
require_once( ABSPATH.'/vibe_config.php' );
require_once( ABSPATH.'/vibe_setts.php' );
//Call database classes
require_once( INC.'/ez_sql_core.php' );
require_once( INC.'/class.ezsql.php' );
//Define global database
$db = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME,DB_HOST,'utf8');
//Define cache class from db (all queryes runed will be cached)
$cachedb = new ezSQL_mysql(DB_USER,DB_PASS,DB_NAME,DB_HOST,'utf8');
if( !defined( 'DB_CACHE' ) ) {
$cachedb->cache_timeout = 3; //Note: this is hours
} else {
$cachedb->cache_timeout = DB_CACHE; 
}
$cachedb->cache_dir = ABSPATH.'/cache';
$cachedb->use_disk_cache = true;
$cachedb->cache_queries = true;
// Include all global functions
require_once( INC.'/functions.plugins.php' );
require_once( INC.'/functions.php' );
require_once( INC.'/functions.user.php' );
require_once( INC.'/functions.html.php' );
require_once( INC.'/functions.kses.php' );
require_once( INC.'/router.php' );
require_once( INC.'/comments.php' );
// Include all global classes
require_once( INC.'/class.upload.php' );
require_once( INC.'/class.providers.php' );
require_once( INC.'/class.pagination.php' );
require_once( INC.'/class.phpmailer.php' );
require_once( INC.'/class.images.php' );
require_once( INC.'/class.youtube.php' );
//Fix some slashes (just in case)
if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}

//Get all global site options
$all_options = get_all_options();

//Get current translation
if(isset($_GET["clang"])) {
$_SESSION['phpvibe-language'] = toDB($_GET["clang"]);
$trans = lang_terms(toDB($_GET["clang"]));
} else {
$trans = lang_terms();
}

/** Twitter API Login **/

//Consumer key
define( 'Tw_Key', get_option('Tw_Key') );
//Consumer secret
define( 'Tw_Secret', get_option('Tw_Secret') );

/** Facebook API Login **/

//App ID/API Key
define( 'Fb_Key', get_option('Fb_Key') );
//App Secret
define( 'Fb_Secret', get_option('Fb_Secret'));

/** Login data **/
define('COOKIEKEY', get_option('COOKIEKEY') );
define('SECRETSALT', get_option('SECRETSALT'));
define( 'COOKIESPLIT', get_option('COOKIESPLIT') );

// Security checks
authByCookie(); 
validate_session();
?>