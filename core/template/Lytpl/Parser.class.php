<?php

namespace Lytpl;

/*
 * Lytpl 转译器
 */

class Parser{
    public $config;
    private $tpl;
    private $lsym;
    private $rsym;

    public function __construct($tpl){
        $this->config = require(Lolly . "app/config/template.php");
        $this->tpl = "<?php
         include_once Lolly.'core/template/Lytpl/common/GlobalFun.php';
                  
         foreach(\$this->vars as \$k=>\$v){\$\$k = \$v;} 
         ?>\n" . $tpl;

        $this->lsym = $this->config["LEFT_SYM"];
        $this->rsym = $this->config["RIGHT_SYM"];
    }
    public function parse(){
        $pattern = Array(
            '/'.$this->lsym.'\s?\$(.+?)\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?import\s(\"|\')(.+?)(\"|\')\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?if\s(.+?)\s?'.$this->rsym.'/',
            '/'.$this->lsym.'\s?elif\s(.+?)\s?'.$this->rsym.'/',
            '/'.$this->lsym.'\s?else\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?for\s(.+?)\s?'.$this->rsym.'/',
            '/'.$this->lsym.'\s?while\s(.+?)\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?loop\s\$(.+?)\(\$(.+?),\$(.+?)\)\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?(.+?)\((.*?)\)\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?(.+?)\:\s?'.$this->rsym.'/',
            '/'.$this->lsym.'\s?go\s(.+?)\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?break\:\s?'.$this->rsym.'/',

            '/'.$this->lsym.'\s?\#(.*?)\s?'.$this->rsym.'/',
            '/'.$this->lsym.'\s?end\s?'.$this->rsym.'/',
        );
        $repattern = Array(
            '<?php echo $$1; ?>',

            '<?php include_once "$2"?>',

            '<?php if($1){ ?>',
            '<?php }else{ ?>',
            '<?php }elseif($1){ ?>',

            '<?php for($1){ ?>',
            '<?php while($1){ ?>',

            '<?php foreach($$1 as $$2 => $$3){ ?>',

            '<?php $1($2); ?>',

            '<?php $1: ?>',
            '<?php goto $1; ?>',

            '<?php break; ?>',

            '<?php // $1 ?>',
            '<?php } ?>'
        );
        $reptpl = preg_replace($pattern, $repattern, $this->tpl);
        return $reptpl;
    }
}