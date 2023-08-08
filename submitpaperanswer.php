<?php
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
if($_POST["pass"] != "ordylan"){exit("<script>alert('Wrong Password!');window.location.href = 'https://on.ordylan.com/p/".$_GET["pid"]."';</script>");}
header("Content-Type: text/html; charset=UTF-8");
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);//shijianchuo

if(!file_exists("@Upload_PAPER/".$_GET["pid"].".ordylandata")){exit("<script>alert('试卷不存在!');window.location.href = 'https://on.ordylan.com/p/';</script>");}

$notenumber = count($_FILES["File"]["name"]);
for($i=0;$i<$notenumber;$i++){
$FileTmp_Name = $_FILES["File"]["tmp_name"][$i];
$fname = $_GET["pid"]."_".$msectime."_".($i+1)."_".rand(100000,999999).".".explode('.',$_FILES["File"]["name"][$i])[count(explode('.',$_FILES["File"]["name"][$i]))-1];
move_uploaded_file($FileTmp_Name, "@Upload_PAPER/answers/".$fname);
$aaa = $aaa."https://on.ordylan.com/@Upload_PAPER/answers/".$fname."|";
}
if(strstr($aaa, ".|")){$aaa = "";}


$tagnotenoteall = file("@Upload_PAPER/".$_GET["pid"].".ordylandata");
$tagnotenoteall = $tagnotenoteall[0];
$tagnotenoteall = $tagnotenoteall.$aaa;
$wjjjj = fopen("@Upload_PAPER/".$_GET["pid"].".ordylandata","w");
fwrite ($wjjjj,$tagnotenoteall);
fclose($wjjjj);  

$logF->addlogs(1,"提交试卷答案:".$_GET["pid"]." >> ".$aaa,"成功","试卷答案提交|/submitpaperanswer.php");
echo "<script>alert('Success!');window.location.href = 'https://on.ordylan.com/p/".$_GET["pid"]."';</script>";
?>