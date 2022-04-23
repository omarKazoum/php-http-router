<?php
class Router{
    private static $getPaths=[];
    private static $postPaths=[];
    private static $args=[];

    /**
     *
     * @param $path a string expression like /users/{d}
     * @return void
     */
    public static function get($pathIndication,$callback){
        self::$getPaths[$pathIndication]=$callback;
    }
    public static function post($pathIndication,$callback){
        self::$postPaths[$pathIndication]=$callback;
    }
    public static function match($uriIndication,$requestPath){
        $uriIndication=preg_replace('#^/#','',$uriIndication);
        $uriIndication=preg_replace('#/$#','',$uriIndication);
        $requestPath=preg_replace('#^/#','',$requestPath);
        $requestPath=preg_replace('#/$#','',$requestPath);

        preg_match_all("#\{([^/]+)\}#",$uriIndication,$uriIndicationNames);
        $uriRegex=preg_replace("#\{([^/]+)\}#",'([^/]+)',$uriIndication);
        $uriRegex='#^'.$uriRegex.'$#';
        if(preg_match($uriRegex,$requestPath,$matches)){
            self::$args=[];
            for($i =1;$i<count($matches);$i++){
                $GLOBALS[$uriIndicationNames[1][$i-1]]=$matches[$i];
                self::$args[]=$matches[$i];
            }
            return true;
        }
        return false;
    }
    public static function processIncomingRequest(){
        $foundRout=false;
        $requestUri=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $paths=$_SERVER['REQUEST_METHOD']==='GET'?self::$getPaths:($_SERVER['REQUEST_METHOD']==='POST'?self::$postPaths:null);
        if($paths===null){
            throw new Exception('method not supported');
        }
        foreach ($paths as $uriIndication => $callback){
            if(self::match($uriIndication,$requestUri)){
                call_user_func_array($callback,self::$args);
                $foundRout=true;
            }
        }
        if(!$foundRout){
            //should redirect to 404 page
            die('url not found');
        }
    }
}