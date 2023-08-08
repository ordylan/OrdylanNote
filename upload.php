<?php
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
if($_POST["pass"] != "ordylan"){exit("<script>alert('Wrong Password!');window.location.href = 'https://on.ordylan.com/';</script>");}
if(!$_POST["title"]){exit("<script>alert('No Title!');window.location.href = 'https://on.ordylan.com/';</script>");}
header("Content-Type: text/html; charset=UTF-8");
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);//shijianchuo
$notenumber = count($_FILES["File"]["name"]);
for($i=0;$i<$notenumber;$i++){
$FileTmp_Name = $_FILES["File"]["tmp_name"][$i];
$fname = $msectime."_".($i+1)."_".rand(100000,999999).".".explode('.',$_FILES["File"]["name"][$i])[count(explode('.',$_FILES["File"]["name"][$i]))-1];
move_uploaded_file($FileTmp_Name, "images/".$fname);
$aaa = $aaa."https://on.ordylan.com/images/".$fname."|";
}
if(strstr($aaa, ".|")){$aaa = "";}
$allnotenote = file('allnotes.ordylandata');
$allnotenote = $allnotenote[0];
$allnotenote = $allnotenote + 1;
$bijibiji = $_POST["title"]."{[(<||>)]}".$msectime."{[(<||>)]}".$_POST["about"]."{[(<||>)]}".$aaa;

$tagnotenoteall = file('tags/00.ordylandata');
$tagnotenoteall = $tagnotenoteall[0];
$tagnotenoteall = $tagnotenoteall.$allnotenote.",";
$wjjjj = fopen('tags/00.ordylandata',"w");
fwrite ($wjjjj,$tagnotenoteall);
fclose($wjjjj);

if($_POST["tag"]>=10&&$_POST["tag"]<=20){
$tagnotenoteall = file('tags/10.ordylandata');
$tagnotenoteall = $tagnotenoteall[0];
$tagnotenoteall = $tagnotenoteall.$allnotenote.",";
$wjjjj = fopen('tags/10.ordylandata',"w");
fwrite ($wjjjj,$tagnotenoteall);
fclose($wjjjj);  
}
if($_POST["tag"]>=20&&$_POST["tag"]<=30){
$tagnotenoteall = file('tags/20.ordylandata');
$tagnotenoteall = $tagnotenoteall[0];
$tagnotenoteall = $tagnotenoteall.$allnotenote.",";
$wjjjj = fopen('tags/20.ordylandata',"w");
fwrite ($wjjjj,$tagnotenoteall);
fclose($wjjjj);  
}

if(!$_POST["tag"] || $_POST["tag"] == 1 || $_POST["tag"] == 10){}else{
if(file_exists('tags/'.$_POST["tag"].'.ordylandata')){
$tagnotenote = file('tags/'.$_POST["tag"].'.ordylandata');
$tagnotenote = $tagnotenote[0];
$tagnotenote = $tagnotenote.$allnotenote.",";
$wjjjj = fopen('tags/'.$_POST["tag"].'.ordylandata',"w");
fwrite ($wjjjj,$tagnotenote);
fclose($wjjjj);  
}
}



$wjjjj = fopen('images/search_img_scan_text/'.$allnotenote.'.ordylandata',"w");
fwrite ($wjjjj,"图片扫描文本-----未上传");
fclose($wjjjj);

$wjjjj = fopen('notes/'.$allnotenote.'.ordylandata',"w");
fwrite ($wjjjj,$bijibiji);
fclose($wjjjj);
$wjjjj = fopen('allnotes.ordylandata',"w");
fwrite ($wjjjj,$allnotenote);
fclose($wjjjj);
$logF->addlogs(1,"提交笔记:$allnotenote","成功","笔记提交|/upload.php");
echo "<script>alert('Success!');window.location.href = 'https://on.ordylan.com/noteview/notes/".$allnotenote."?up=true';</script>";
?>