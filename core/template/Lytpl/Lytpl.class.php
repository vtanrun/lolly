<?php

namespace Lytpl;

require("Parser.class.php");

/*
 * Lytpl 核心代码
 */

class Lytpl{
    private $tpl;
    private $config;
    private $lsym;
    private $rsym;
    private $path;
    private $type;
    private $vars = [];

    public function __construct($path,$vars,$type='public'){

        $this->path = $path;
        $this->vars = $vars;
        $this->type = $type;
        $this->config = require(Lolly . "app/config/template.php");

        if(! @$this->tpl = file_get_contents(Lolly . 'app/view/'.$type.'/' . $path)){
            $this->tpl = '';
        }

        $this->lsym = $this->config["LEFT_SYM"];
        $this->rsym = $this->config["RIGHT_SYM"];

    }

    private function compile(){

        $parser = new Parser($this->tpl);
        $this->tpl = $parser->parse();

        $hz = explode('.',$this->path);
        @$dir = dirname(Lolly."core/template/Lytpl/compile/".$this->type."/". $hz[0] .".php");
        @mkdir($dir,0777,true);
        @file_put_contents(Lolly."core/template/Lytpl/compile/".$this->type."/". $hz[0] .".php",$this->tpl);


    }

    public function display(){
        $this->compile();

        require(Lolly . "core/template/Lytpl/compile/".$this->type."/".explode('.',$this->path)[0].".php");
        $code = ob_get_contents();
        ob_clean();
        return $code;
    }

    public static function render_tpl($path,$vars){
        $lytpl = new \Lytpl\Lytpl($path,$vars);
        return $lytpl->display();
    }

    public static function render_err($code,$vars){
        $lytpl = new \Lytpl\Lytpl($code . '.html',$vars,'error');
        return $lytpl->display();
    }
}