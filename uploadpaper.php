<?php
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
if($_POST["pass"] != "ordylan"){exit("<script>alert('Wrong Password!');window.location.href = 'https://on.ordylan.com/addnote.php';</script>");}
if(!$_POST["title"] || !$_POST["nmodeid"]){exit("<script>alert('No Title Or File!');window.location.href = 'https://on.ordylan.com/addnote.php';</script>");}
header("Content-Type: text/html; charset=UTF-8");
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);//shijianchuo
$notenumber = count($_FILES["File"]["name"]);
if($notenumber != 1){exit("<script>alert('文件太多了, 一次只有一个哦!');window.location.href = 'https://on.ordylan.com/addnote.php';</script>");}
if(file_exists("@Upload_PAPER/".$_POST["nmodeid"].".ordylandata")){exit("<script>alert('试卷已存在, 正在跳转>>');window.location.href = 'https://on.ordylan.com/p/".$_POST["nmodeid"]."';</script>");}



$FileTmp_Name = $_FILES["File"]["tmp_name"][0];
$fname = $_POST["nmodeid"]."_".$_POST["title"].".".explode('.',$_FILES["File"]["name"][0])[count(explode('.',$_FILES["File"]["name"][0]))-1];
move_uploaded_file($FileTmp_Name, "@Upload_PAPER/papers/".$fname);
$aaa = "https://on.ordylan.com/@Upload_PAPER/papers/".$fname;

$bijibiji = $_POST["title"]."{[(<||>)]}".$msectime."{[(<||>)]}".$aaa."{[(<||>)]}";

$tagnotenoteall = file('tags/10001.ordylandata');
$tagnotenoteall = $tagnotenoteall[0];
$tagnotenoteall = $tagnotenoteall.$_POST["nmodeid"].",";
$wjjjj = fopen('tags/10001.ordylandata',"w");
fwrite ($wjjjj,$tagnotenoteall);
fclose($wjjjj);

$wjjjj = fopen('@Upload_PAPER/'.$_POST["nmodeid"].'.ordylandata',"w");
fwrite ($wjjjj,$bijibiji);
fclose($wjjjj);
$logF->addlogs(1,"提交试卷:".$_POST["nmodeid"],"成功","试卷提交|/uploadpaper.php");
echo "<script>alert('Success!');window.location.href = 'https://on.ordylan.com/p/".$_POST["nmodeid"]."';</script>";
?>