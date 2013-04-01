<?php

namespace Qp;

class QPush {

    protected static  $instance = 0;
    private $value;
    private $width;
    private $height;
    private $fontSize;
    private $styleId;
    private $style;
    private $class;
    private $id;
    private $body;
    private $onClick;

    private $styleClass = array('default'=>'QPushDefault');

    function __construct($value = 'QPush', $width = '150px', $height = '30px', $fontSize = '14px', $class = '', $style = '', $styleId = 'default'){

        $this->id = self::$instance++;

        $onClick = "alert('This QPush_$this->id');";

        $this->fontSize = $fontSize;
        $this->value = $value;
        $this->width = $width;
        $this->height= $height;
        $this->onClick = $onClick;
        $this->styleId = $styleId;
        $this->style = $style;
        $this->class = $class;
    }

    function setClass($class){
        $this->class = $class;
    }

    function setStyle($style){
        $this->style = $style;
    }

    function setSize($width, $height){
        $this->height = $width;
        $this->width = $height;
    }

    function setWidth($width){
        $this->width = $width;
    }

    function setHeight($height){
        $this->height = $height;
    }

    function setValue($value){
        $this->value = $value;
    }

    function setOnClick($onClick){
        $this->onClick = $onClick;
    }

    function getElement(){
        return "document.getElementById('$this->id')";
    }

    function setId($id){
        $this->id = $id;
    }

    function getStyle($dir, $case){
        $dirClass = __DIR__;
        $dirFile = $dir;
        $outDir =  str_replace($dirFile.'/', '', $dirClass);

        if($case == 'style')
            echo "<style type='text/css'>@import '$outDir/styleQPush.css';</style>
";
        elseif($case == 'import')
            echo "@import '$outDir/styleQPush.css';
";
    }

    function show(){
        $nameStyle = $this->styleClass[$this->styleId];

        $style = "style='width: {$this->width}; height: {$this->height}; font-size: {$this->fontSize}; {$this->style};'";
        $this->body = "<input id='QPush_$this->id' type='button' class='$nameStyle $this->class' $style value='$this->value' onclick=\"$this->onClick\">\n";

        return $this->body;
    }
}

//echo "<script>alert('$this->id')</script>";