<?php

namespace Qp;

class QPush {

    protected static  $instance = 0;
    private $value;
    private $width;
    private $height;
    private $styleId;
    private $id;
    private $body;
    private $onClick;

    private $styleClass = array('black'=>'QPushBlack', 'red'=>'QPushRed', 'green'=>'QPushGreen');

    function __construct($width = '150', $height = '30', $styleId = 'black', $value = 'QPush'){

        $this->id = self::$instance++;

        $onClick = "alert('This QPush_$this->id');";

        $this->value = $value;
        $this->width = $width;
        $this->height= $height;
        $this->onClick = $onClick;
        $this->styleId = $styleId;
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

        $style = "";
        if($this->width != '150' && $this->height != '30')
            $style = "style='width: {$this->width}px; height: {$this->height}px;'";
        elseif($this->width != '150')
            $style = "style='width: {$this->width}px;'";
        elseif($this->height != '30')
            $style = "style='height: {$this->height}px;'";

        $this->body = "<input id='QPush_$this->id' type='button' class='$nameStyle' $style value='$this->value' onclick=\"$this->onClick\">\n";

        echo "$this->body";
        return $this->body;
    }
}

//echo "<script>alert('$this->id')</script>";