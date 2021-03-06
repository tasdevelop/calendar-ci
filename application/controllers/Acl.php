<?php

class Acl extends MY_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->model('Macl');
    }
    public function index(){
        exit(__FUNCTION__);
    }
    public function fetch(){
        $this->listFolderFiles();
    }
    public function listFolderFiles($dir = null){
        if($dir===null){
            $dir = constant('APPPATH').'controlles/';
        }
        $ffs = scandir($dir);
        unset($ffs[0],$ffs[1]);
        if(count($ffs)<1)
            return;
        $i=0;
        foreach($ffs as $ff){
            if(is_dir($dir.'/'.$ff))
                $this->listFolderFiles($dir.'/'.$ff);
            else if(is_file($dir.'/'.$ff) && strpos($ff,'.php') !== false){
                $classes = $this->get_php_classes(file_get_contents($dir.'/'.$ff));
                include_once($dir.'/'.$ff);
                foreach($classes as $class){
                    $methods = $this->get_class_methods($class,true);
                    foreach($methods as $method){
                        if(isset($method['docComment']['AclName'])){
                            $this->AclModel->save(['class'=>$class,'method'=>$method['name'],'display_name']=>$method['docComment']['AclName']]);
                        }
                    }
                }
            }
            if($i>5)
                break;
            else
                $i++;
        }
    }
    public function get_php_classes($php_code,$methods= false){
        $classes = array();
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for($i=2;$i<$count;$i++){
            if($tokens[$i-2][0] == T_CLASS && $tokens[$i-1][0]==T_WHITESPACE && $tokens[$i][0] == T_STRING){
                $classes[] = $tokens[$i][1];
            }
        }
        return $classes;
    }
    public function get_class_methods($class,$comment = false){
        $r = new ReflectionClass($class);
        foreach($r->getMethods() as $m){
            if($m->class == $class){
                $arr = ['name'=>$m->name];
                if($comment===true){
                    $arr['docComment'] = $this->get_method_comment($r,$m->name);
                }
                $methods[] = $arr;
            }
        }
        return $methods;
    }
    public function get_method_comment($obj,$method){
        $comment = $obj->getMethod($method)->getDocComment();
        $pattern = "#(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_].*)#";
        preg_match_all($pattern, $comment, $matches,PREG_PATTERN_ORDER);
        $comments = [];
        foreach($matches[0] as $match){
            $comment = preg_split('/[\s]/',$match,2);
            $comments[trim($comment[0],'@')] = $comment[1];
        }
        return $comment;
    }
}