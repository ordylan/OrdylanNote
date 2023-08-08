<?php
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
if($_POST["pass"] != "ordylan"){exit("<script>alert('Wrong Password!');window.location.href = 'https://on.ordylan.com/';</script>");}
header("Content-Type: text/html; charset=UTF-8");
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);//shijianchuo
$notenumber = count($_FILES["File"]["name"]);
for($i=0;$i<$notenumber;$i++){
$FileTmp_Name = $_FILES["File"]["tmp_name"][$i];
$fname = "replenish_".$msectime."_".($i+1)."_".rand(100000,999999).".".explode('.',$_FILES["File"]["name"][$i])[count(explode('.',$_FILES["File"]["name"][$i]))-1];
move_uploaded_file($FileTmp_Name, "images/".$fname);
$aaa = $aaa."https://on.ordylan.com/images/".$fname."|";
}
if(strstr($aaa, ".|")){$aaa = "失败,文件不存在";exit;}
$logF->addlogs(1,"上传文件:$aaa","成功","文件上传|/upfile.php");
echo "<a href=\"/noteview/tags/1\">[回首页]</a><br>".$aaa."<script>alert('文件上传成功!');</script>";
?>