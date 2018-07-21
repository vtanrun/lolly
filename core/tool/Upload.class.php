<?php

namespace tools;

use Lolly\Lolly;

class Upload{
    private $conf;
    private $file;
    private $suffix = [];
    private $size = 10240;
    private $fname;
    private $error;

    public static function UploadFile($file){
        if(isset($_FILES[$file])){
            return new self($file);
        }else{
            return false;
        }
    }

    public function __construct($file){
        $this->conf = require(Lolly . 'app/config/tools.php');
        $this->conf = $this->conf['upload'];

        $this->suffix = $this->conf['UP_ALLOWED'];
        $this->size = $this->conf['MaxSize'];

        $this->file = $_FILES[$file];
        $this->fname = $_FILES[$file]['name'];
    }

    public function Allowed($suffix){
        if(is_array($suffix)){
            $this->suffix = $suffix;
        }elseif(is_string($suffix)){
            $this->suffix = [$suffix];
        }
        return $this;
    }

    public function MaxSize($size){
        if(is_int($size)){
            $this->size = $size;
        }
        return $this;
    }

    public function FileName($name,$var){
        if(is_string($name)){
            if(is_array($var)){
                $file_name = $name;
                foreach($var as $v){
                    $file_name = preg_replace('/{}/',$v,$file_name,1);
                }
            }else{
                $file_name = $name;
                $file_name = preg_replace('/{}/',$v,$file_name,1);
            }
        }
        $this->fname = $file_name;
        return $this;
    }

    public function write($path = null){

        switch($this->file['error']){
            case 0: $this->error = ''; break;
            case 1: $this->error = '超出了php.ini中文件大小'; break;
            case 2: $this->error = '超出了MAX_FILE_SIZE的文件大小'; break;
            case 3: $this->error = '文件被部分上传'; break;
            case 4: $this->error = '没有文件上传'; break;
            case 5: $this->error = '文件大小为0'; break;
            default: $this->error = '上传失败'; break;
        }

        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if($this->file['error'] == 0){
            if(in_array($extension,$this->suffix)){
                if($this->file["size"] < $this->size){
                    if($path = null){
                        $fpath = Lolly . 'app/upload' . $this->fname;
                    }else{
                        $fpath = Lolly . 'app/upload' . $path . '/' . $this->fname;
                    }
                    move_uploaded_file($this->file['tmp_name'],$fpath);
                }else{
                    $this->error = '上传的文件过大';
                }
            }else{
                $this->error = '不允许上传的文件类型';
            }
        }
    }

    public function error(){
        return $this->error;
    }

}