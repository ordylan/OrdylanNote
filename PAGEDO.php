<?php
//PAGEDO.php_头模块
/*
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD("橙鸭笔记系统V2","$pagetitle","$pagebackurl","","");?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
*/

class HEAD_FUNCTION{
    //$addtext1,$addtext2暂时不用
    public function AddHRAD($htmltitle,$pagetitle,$pagebackurl,$addtext1,$addtext2){//print_r( $_SERVER);
        //if($_SERVER["HTTP_ORDYLAN_GETHTML"] != "true1"){
    if($_POST["GETTTHTML"] != "true1"){
print<<<HEAD
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/1.css">
<link rel="manifest" href="/manifest.json">
<title>{$htmltitle}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="theme-color" content="#E6E6E6">
<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
{$addtext1}
</head>
<body>
<div id="mmm">
<header><div id="backurll"><a {$pagebackurl}><img src="/back.png" id="b" alt="back"></a></div><h1 id="oes">{$pagetitle}</h1></header>
<!--新js[临时换位置, 原来在<head>里面{\$addtext1}上面的位置]-->
<script src="/updatejs.js"></script><script>if(!localStorage.ON_MAINJS){localStorage.ON_MAINJS_NowUpdate="true";var xhr2=new XMLHttpRequest();xhr2.open('GET',"/main.js?"+Number(new Date()),true);xhr2.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");xhr2.onload=function(e){if(this.status===200||this.status===304){localStorage.ON_MAINJS=xhr2.responseText;window.location.reload()}};xhr2.send()}else{eval(localStorage.ON_MAINJS)}</script>
{$addtext2}
<div id="main" style="display: block;">
HEAD;
    }
        else{
$htmltitle = addslashes($htmltitle);$pagetitle = addslashes($pagetitle);$pagebackurl = addslashes($pagebackurl);$addtext1 = addslashes($addtext1);$addtext2 = addslashes($addtext2);
print<<<HEAD
<div id="titleeee"><script>document.title="{$htmltitle}";document.getElementById("oes").innerHTML="{$pagetitle}";document.getElementById("backurll").innerHTML="<a {$pagebackurl}><img src='/back.png' id='b' alt='back'></a>";</script></div>
HEAD;
        }
   }
    public function AddFOOT(){
        //if($_SERVER["HTTP_ORDYLAN_GETHTML"] != "true1"){
    if($_POST["GETTTHTML"] != "true1"){
        //http_response_code(888);
print<<<FOOT

<!--Test-->
<hr>
<div>[测字体: <input type="checkbox" id="ttfont" onchange="if(document.getElementById('ttfont').checked) {localStorage.ON_Temp_Font_set='true';location.reload();} else {localStorage.ON_Temp_Font_set='false';location.reload();}">]</div><!--<div id="temptime">{Time}</div>-->
<iframe src="/Tempsentence.php?1" id="testttting" style="width: 46%;height: 46%;border: none;-webkit-scrollbar {display: none;}"></iframe>
<img src="https://onimagecloud.ordylan.com/GKTimeImg.png?fromCloseGK.html" alt="GKimg" style="height:46%">
<script>
/*
//临时clock
setInterval(function () {
var currentTime = new Date();
currentTime.setMinutes(currentTime.getMinutes() + 100);
var year = currentTime.getFullYear();
var month = ('0' + (currentTime.getMonth() + 1)).slice(-2);
var day = ('0' + currentTime.getDate()).slice(-2);
var hours = ('0' + currentTime.getHours()).slice(-2);
var minutes = ('0' + currentTime.getMinutes()).slice(-2);
var seconds = ('0' + currentTime.getSeconds()).slice(-2);
document.getElementById("temptime").innerHTML=year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;},1000);*/
//临时juzi
document.getElementById("testttting").src = '/Tempsentence.php?'+Number(new Date());
//临时字体
if (localStorage.getItem('ON_Temp_Font_set') == 'true') {
    document.getElementById('ttfont').checked = true;
    document.body.style.fontFamily = 'aa';
}</script>
<!--Test-->

</div>

</div></body></html>
FOOT;
    }
        else{
print<<<tt
<!--SUCCESS_GETaaaa-->
tt;
        }
   }
}




