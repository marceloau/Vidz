<?php $router = uri::getInstance();
function com(){
global $router;
return toDb($router->component());

}
function token(){
global $router;
return toDb($router->fragment(1));
}

function token_id(){
global $page,$router;
//echo $page;
switch(com()){
case video:
return intval($router->fragment(1));
break;
case profile:
return intval($router->fragment(2));
break;
case note:
return intval($router->fragment(1));
break;
default:
return intval($router->fragment(2));
break;
}
}

class uri {
    /*
     * @var array $fragments
     */
    public static $fragments = array();

    /*
    * @var object $instance
    */
    private static $instance = null;

    /**
     *
     * Return URI instance
     *
     * @access public
     *
     * @return object
     *
     */
    public static function getInstance()
    {
         if(is_null(self::$instance))
         {
             self::$instance = new uri;
         }
        return self::$instance;
    }


    /**
     *
     * @the constructor is set to private so
     * @so nobody can create a new instance using new
     *
     */
    private function __construct()
    {
        /*** put the string into array ***/
        self::$fragments =  @explode(url_split, _get('rp'));
    }

    /**
     * @get uri fragment 
     *
     * @access public
     *
     * @param string $key:The uri key
     *
     * @return string on success
     *
     * @return bool false if key is not found
     *
     */
    public function fragment($key)
    {
        if(array_key_exists($key, self::$fragments))
        {
            return self::$fragments[$key];
        }
        return false;
    }

	  public function component()
    {
        return self::$fragments["0"];
    }

    /**
     *
     * @__clone
     *
     * @access private
     *
     */
    private function __clone()
    {
    }
}

?>