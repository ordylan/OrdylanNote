<?php
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass != "true"){
exit('<a href="/"><img src="/back.png"alt="back"></a>
<a href="/passport.php">请登录</a><br>
<a href="javascript:void(0);" onclick="">[缓存笔记文本+注册SW(未登录时禁用)]</a><br>
<a href="javascript:void(0);" onclick="bb()">[注销SW]</a><br>
<a href="javascript:void(0);" onclick="cc()">[重新加载main.js]</a><br>
<a href="javascript:void(0);" onclick="dd()">[重置笔记系统]</a><br>
<script>
function bb(){localStorage.ON_SW = "false";
navigator.serviceWorker.getRegistrations().then(function(registrations) {
 for(let registration of registrations) {
  registration.unregister();alert("successfully, 请刷新页面");
} })}
function cc(){
  var xhr2 = new XMLHttpRequest();
        xhr2.open(\'GET\', "/main.js?t=" + Number(new Date()) , true);
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
        xhr2.onload = function (e) {
            if (this.status === 200 || this.status === 304) {
                localStorage.ON_MAINJS = xhr2.responseText;window.location.reload();
                //eval(localStorage.ON_MAINJS);
                alert("加载js successfully");
            }
        };
        xhr2.onprogress = function (e) {
            console.log("js加载进度", (e.loaded/e.total*100).toFixed(2) + \'%\')
        };
        xhr2.send();
}
function dd(){
localStorage.ON_SW = "false";

localStorage.clear();

const clearCookies = document.cookie.split(\';\')
.forEach(cookie => document.cookie = 
cookie.replace(/^ +/, \'\')
.replace(/=.*/, `=;expires=${new Date(0).toUTCString()};path=/`));
if(\'caches\' in window) {
//caches.delete("v1.0.0");
caches.delete("ON");
}navigator.serviceWorker.getRegistrations().then(function(registrations) {
 for(let registration of registrations) {
  registration.unregister();
} })
alert("成功重置!");
window.location.href="https://on.ordylan.com/";
}
</script>
');}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/1.css">
<title>[Add-Note] OD_Note_System</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<script src="/TweenMax.min.js"></script>-->
<!--新js-->
<script src="/updatejs.js"></script><script>if(!localStorage.ON_MAINJS){localStorage.ON_MAINJS_NowUpdate="true";var xhr2=new XMLHttpRequest();xhr2.open('GET',"/main.js?"+Number(new Date()),true);xhr2.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");xhr2.onload=function(e){if(this.status===200||this.status===304){localStorage.ON_MAINJS=xhr2.responseText;window.location.reload()}};xhr2.send()}else{eval(localStorage.ON_MAINJS)}</script>
</head>
<body>
<div id="mmm">
<header><a href="/"><img src="/back.png" id="b" alt="back"></a><h1 id="oes">OD_Note_System</h1></header>
<div id="main" style="display: block;">
<hr>--Note--<a href="note_cut.html">[Cut Note]</a><a href="img_text.php">[Img add text]</a>
<form action="upload.php" enctype="multipart/form-data" method="post" id="a1">
<h2>Note Title: <input type="text" name="title"><br>
Note Introduction: <input type="text" name="about">引用笔记:"@_NOTE[笔记id];"<br>
Add Photos: <input type="file" name="File[]" multiple="multiple"><br>
Note Tag: <input type="number" name="tag">(Tag Id)<br>
Password: <input type="password" name="pass" id="pass" autocomplete="off"><br></h2>
<input type="submit">
</form><hr>
--Replenish--
<form action="upfile.php" enctype="multipart/form-data" method="post" id="a2">
<h2>
Replenish Photos: <input type="file" name="File[]" multiple="multiple"><br>
Password: <input type="password" name="pass" id="pass2" autocomplete="off"><br></h2>
<input type="submit">
</form><hr><br>
--Upload Paper--
<form action="uploadpaper.php" enctype="multipart/form-data" method="post" id="a2">
<h2>Paper Title: <input type="text" name="title"><br>
Paper Id: <input type="number" name="nmodeid"><br>
Paper File: <input type="file" name="File[]" multiple="multiple"><br>
Password: <input type="password" name="pass" id="pass3" autocomplete="off"><br></h2>
<input type="submit">
</form><hr>
--Develop--<br>
<a href="javascript:void(0);" onclick="aa('allnotetext')">[缓存笔记文本+注册SW(看笔记用,上传请不要点)]</a><br>
<a href="javascript:void(0);" onclick="bb()">[注销SW]</a><br>
<a href="javascript:void(0);" onclick="cc()">[重新加载main.js]</a><br>
<a href="javascript:void(0);" onclick="dd()">[重置笔记系统]</a><br>
笔记合集示例: https://on.ordylan.com/noteview/collections/62,61,60,59,58,
<script>
document.getElementById("a1").action=document.getElementById("a1").action+"?"+Number(new Date());
document.getElementById("a2").action=document.getElementById("a2").action+"?"+Number(new Date());
function aa(a){
    localStorage.ON_SW = "true";
    if('serviceWorker' in navigator){
        navigator.serviceWorker.register('/sw.php?do=' + a)
            .then(resitration => {
                console.log("register" , resitration);
                alert("successfully, 请刷新页面");
            }).catch(err => console.error(err));
    }
}
function bb(){localStorage.ON_SW = "false";
navigator.serviceWorker.getRegistrations().then(function(registrations) {
 for(let registration of registrations) {
  registration.unregister();alert("successfully, 请刷新页面");
} })}
function cc(){
  var xhr2 = new XMLHttpRequest();
        xhr2.open('GET', "/main.js" , true);
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
        xhr2.onload = function (e) {
            if (this.status === 200 || this.status === 304) {
                localStorage.ON_MAINJS = xhr2.responseText;window.location.reload();
               // eval(localStorage.ON_MAINJS);
                alert("加载js successfully");
            }
        };
        xhr2.onprogress = function (e) {
            console.log("js加载进度", (e.loaded/e.total*100).toFixed(2) + '%')
        };
        xhr2.send();
}
function dd(){
localStorage.ON_SW = "false";

localStorage.clear();

const clearCookies = document.cookie.split(';')
.forEach(cookie => document.cookie = 
cookie.replace(/^ +/, '')
.replace(/=.*/, `=;expires=${new Date(0).toUTCString()};path=/`));
if('caches' in window) {
//caches.delete("v1.0.0");
caches.delete("ON");
}navigator.serviceWorker.getRegistrations().then(function(registrations) {
 for(let registration of registrations) {
  registration.unregister();
} })
alert("成功重置!");
window.location.href="https://on.ordylan.com/";
}
    if(localStorage.ON_PWD){document.getElementById("pass").value = localStorage.ON_PWD;}
    if(localStorage.ON_PWD2){document.getElementById("pass2").value = localStorage.ON_PWD2;}
    if(localStorage.ON_PWD3){document.getElementById("pass3").value = localStorage.ON_PWD3;}

        
setInterval(function(){baocun();},300)
function baocun(){
    localStorage.ON_PWD = document.getElementById("pass").value;
    localStorage.ON_PWD2 = document.getElementById("pass2").value;
    localStorage.ON_PWD3 = document.getElementById("pass3").value;

}
</script>
</div>
</body>
</html>
