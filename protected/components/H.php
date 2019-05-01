<?php

class H
{

  public function p($array)
  {
    echo "<pre>";
    var_dump($array);
    die("</pre>");
  }

  public function import ($path)
  {
    return Yii::app()->yexcel->readActiveSheet($path);
  }

}