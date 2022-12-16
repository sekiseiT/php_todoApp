<?php
 
function doDB(){
 
  global $mysqli;
 
  $database = "mydb1";
 
  $mysqli = mysqli_connect('localhost:8889','root', 'root', 'mydb1')
              or die("接続に失敗しました。");
 
  mysqli_select_db($mysqli, $database)
              or die($database . "に接続できません。");
 
  mysqli_set_charset($mysqli, "utf8mb4")
              or die("文字コードの設定に失敗しました。");
 
}
