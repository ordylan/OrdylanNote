<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('[试卷厅]橙鸭笔记系统V2','试卷厅_橙鸭笔记系统<a href="/noteview/tags/1">[首页]</a>',' href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath + \'#notee_'.$_GET["id"].'\');"',"","");?>
    
<?php
$idd = $_GET["id"];

  require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($idd){
if(!file_exists("@Upload_PAPER/".$idd.'.ordylandata')){echo "<br>Paper Not Found.";exit;}
else{
    //if($mode == "tags" && $idd == "1")
    $notteee = file("@Upload_PAPER/".$idd.'.ordylandata')[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = date("Y-m-d H:i:s",intval($notteee[1]/1000));
    $url = $notteee[2];
    $tp = $notteee[3];$tp = explode('|', $tp);
    for ($i = 0; $i < count($tp)-1; $i++) {
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle")){$tpi = $tpi.'<img src="'.$tp[$i].'" id="imagee" alt="note_image_'.($i+1).'">';}else{
         $tpi = $tpi.'<img data-src="'.$tp[$i].'" id="imagee" alt="note_image_'.($i+1).';'.'" class="lazyload" src="https://s3.bmp.ovh/imgs/2022/08/02/a8d168a207bd70fe.gif">';}
    }
//$tpi2 = addslashes($tpi2);
header('Content-Type:text/html;charset=utf-8');
if($_GET["token"] != md5("ORDYLANNOTE_token_PAPER_ID".$idd."_PASS") && $onpass == "false"){$tpi = "[提交的答案图片获取失败]";$url = "";$bt = "试卷标题[Err:NoPass]";$sj = "1970-01-01 08:00:00";$tokenthis = "";$token = $_GET["token"];}else{$tokenthis = "该试卷分享链接:https://on.ordylan.com/p/".$idd."?token=".md5("ORDYLANNOTE_token_PAPER_ID".$idd."_PASS")."<textarea id=\"input\" style=\"position: absolute;top: -999999px;z-index:-9999;\"></textarea><script>function copyText(a) {if(a==\"1\"){var text = \"https://on.ordylan.com/p/".$idd."?token=".md5("ORDYLANNOTE_token_PAPER_ID".$idd."_PASS")."\"}else if(a==\"2\"){var text = \"你好啊, 我这边有一份名为".$bt."的好试卷, 特地分享给你看看, 请查收~\\n试卷链接:https://on.ordylan.com/p/".$idd."?token=".md5("ORDYLANNOTE_token_PAPER_ID".$idd."_PASS")."\"};var input = document.getElementById(\"input\");input.value = text;input.select();document.execCommand(\"copy\");}</script><button onclick=\"copyText(1)\">复制分享链接</button><button onclick=\"copyText(2)\">复制分享话术</button>";$token=md5("ORDYLANNOTE_token_PAPER_ID".$idd."_PASS");}


if($onpass != "false"){
$hhhh = '<form action="/submitpaperanswer.php?pid='.$idd.'" enctype="multipart/form-data" method="post">
<h2>
提交的答案: <input type="file" name="File[]" multiple="multiple"><br>
提交密码: <input type="password" name="pass" id="pass" autocomplete="off"><br></h2>
<input type="submit">
</form>';
}
else{$hhhh = '未登录';}
print<<<NOTE
<div id="notee_{$idd}">
<h2 id="titlee">[{$idd}] {$bt}</h2>
<h3 id="timee">{$sj}</h3>
{$tokenthis}
<h3 id="aboutt"><a href="{$url}" target="_blank">[下载试卷]</a>|<a href="javascript:void(0);" onclick="document.getElementById('mailp').style.display='block';">[邮件试卷]</a>|<a href="javascript:void(0);" onclick="document.getElementById('upanswer').style.display='block';">[提交答案]</a></h3>

<div id="mailp" style="display:none;">
--邮件发送试卷--<a href="javascript:void(0);" onclick="document.getElementById('mailp').style.display='none';">[关闭]</a>
收邮件地址<input type="email" id="ememail"><br>
<button onclick='smail()'>发邮件</button>
</div>
<script>
function smail(){
       var xhr = new XMLHttpRequest();
        xhr.open('GET', "/sendpaper.php?mode=paper&to="+document.getElementById("ememail").value+"&id={$idd}&token={$token}" , true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
        xhr.onload = function (e) {
            if (this.status === 200 || this.status === 304) {
  if(xhr.responseText == "Successfully !!"){alert("发送好了哦");}
  else{alert("可能发送失败了!"+xhr.responseText);}
        };
        xhr.onprogress = function (e) {
            console.log("进度", (e.loaded/e.total*100).toFixed(2) + '%')
        };}
        xhr.send();
        }
</script>
<div id="upanswer" style="display:none;">
--提交答案啊--<a href="javascript:void(0);" onclick="document.getElementById('upanswer').style.display='none';">[关闭]</a>
{$hhhh}
</div>
{$tpi}
<!--<hr>-->
</div>
NOTE;

}
}
else{
    $notteee = file("tags/10001.ordylandata")[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = date("Y-m-d H:i:s",intval($notteee[1]/1000));
    $zy = $notteee[2];
    $tp = $notteee[3];
print<<<NOTE
<div id="notee_">
<h2 id="titlee">{$bt}</h2>
<h3 id="timee">{$sj}</h3>
<h3 id="aboutt">{$zy}</h3>
<hr>
</div>
NOTE;

$tn = $notteee[3]."000002,000001,";
$tn = explode(',', $tn);
for ($i = count($tn)-2; $i > -1 ; $i--) {
if(file_exists("@Upload_PAPER/".$tn[$i].'.ordylandata'))
    $notteee = file("@Upload_PAPER/".$tn[$i].'.ordylandata')[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = date("Y-m-d H:i:s",intval($notteee[1]/1000));
    $url = $notteee[2];
if($onpass == "false"){$url = "";$bt = "试卷标题[Err:NoPass]";$sj = "1970-01-01 08:00:00";}
if($tn[$i] == "000001"){$tttt = "置顶试卷";$uuurl = '<a href="'.$tn[$i].'">[立刻查看]</a>';}
elseif($tn[$i] == "000002"){$tttt = "置顶试卷";$uuurl = '<a href="'.$tn[$i].'">[点击进入_在下一页点下载试卷]</a>';}
else {$tttt = $tn[$i];$uuurl = '<a href="'.$url.'" target="_blank">[下载试卷]</a>';}

print<<<NOTE2
<div id="notee_{$tn[$i]}">
<h2 id="titlee">[{$tttt}] {$bt}<a href="/p/{$tn[$i]}">[更多>]</a></h2>
<h3 id="timee">{$sj}</h3>
<h3 id="aboutt">{$uuurl}</h4>

<hr>
</div>
NOTE2;
}}

?>
<script>
    if(localStorage.ON_EMAIL){document.getElementById("ememail").value = localStorage.ON_EMAIL;}
    if(localStorage.ON_PWD4) {document.getElementById("pass").value = localStorage.ON_PWD4;}

setInterval(function(){baocun();},300)
function baocun(){
            localStorage.ON_EMAIL = document.getElementById("ememail").value;

    localStorage.ON_PWD4 = document.getElementById("pass").value;

}lazyload();</script>
<a href="#" style="width: 50px;height: 50px;text-align: center;font-weight: bold;text-decoration: none;position: fixed;bottom: 150px;right: 20px;z-index: 2000;background-color: #44b2fe;">↑</a>
<script>
</script>

<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>