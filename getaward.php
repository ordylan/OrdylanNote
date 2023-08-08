<!DOCTYPE html>
<html style="height: 98%">
<head><link rel="stylesheet" type="text/css" href="/1.css">
<title>[看笔记得奖励]橙鸭笔记系统V2</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body style="height: 100%">


<?php
$mode = $_GET["mode"];
$idd = $_GET["id"];
 if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle")){
     echo ("你的设备可能不支持此功能!");
}
  require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass == "false"){echo ("此页面操作失效(未登录)!");}
$api_id = $_GET["token"];
echo ("<script>console.log(\"id: ".$api_id."\");</script>");
$api_key = "ORDYLAN_Note_AWARD_GET";  
$dodo = openssl_decrypt($api_id, 'AES-128-ECB', $api_key, 0);
echo "<script>console.log(\"".$dodo."\");</script>";
$dodo = explode('|', $dodo);
$second = $dodo[0];
$minute = floor($second/60);
$award = $dodo[1];
$award = explode(';', $award);
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
mysqli_query($sql,'SET NAMES UTF8');
$result = mysqli_query($sql,"SELECT * FROM ordylannote");
while($row = mysqli_fetch_array($result)){$RPONa = $row['RPON'];$knowledgepointsa = $row['knowledgepoints'];$dailyview1 = $row['dailyview1'];$dailyview2 = $row['dailyview2'];$dailyview3 = $row['dailyview3'];$boxnum = $row['boxnum'];}
if($_POST["get"] == "true" && $onpass != "false"){
    if(!$dailyview1){
        mysqli_query($sql,"UPDATE ordylannote SET dailyview1='true';");
    }
    elseif(!$dailyview2){
        mysqli_query($sql,"UPDATE ordylannote SET dailyview2='true';");
    }
    elseif(!$dailyview3){
        mysqli_query($sql,"UPDATE ordylannote SET dailyview3='true';");
    }
    else{exit;}
    $abbbxx= rand(1,2);
    mysqli_query($sql,"UPDATE ordylannote SET boxnum='".($boxnum+$abbbxx)."';");
    require_once 'dolog.php';
    $logF = new LOG_FUNCTION();
    $logF->addlogs(1,"看笔记获得宝箱:$abbbxx","成功","看笔记得奖励|/getaward.php");
}
if($dailyview1 && $dailyview2 && $dailyview3){
    exit("你可真勤奋,奖励已经领完啦!<a href=\"/noteview/tags/1\">[回首页]</a>");
}
for ($i = 0; $i < count($award); $i++) {
    $thisaward = explode('_', $award[$i]);
    $thisawardcount = $thisaward[1];
    if($thisaward[0] == "KP"){
        $thisawardname = "知识点";
        $thisawardimage = "/simages/KP.png";
        //if($_POST["get"] == "true" && $onpass != "false"){echo mysqli_query($sql,"UPDATE ordylannote SET knowledgepoints='".($knowledgepointsa+$thisawardcount)."';");echo(11);}
    }
    elseif($thisaward[0] == "RPON"){
        $thisawardname = "笔记残图";
        $thisawardimage = "/simages/RPON.png";
        //if($_POST["get"] == "true" && $onpass != "false"){echo mysqli_query($sql,"UPDATE ordylannote SET RPON='".($RPONa+$thisawardcount)."';");}
    }
    else{
        $thisawardname = "未知";
        $thisawardimage = "#";
        $thisawardcount = 0;
    }
    $thisawardcount = "?";
    $acount = $acount.$thisawardname."x".$thisawardcount.";";
    $image = $image."<img style=\"width: 35%;\" alt=\"\" src=\"".$thisawardimage."\">x".$thisawardcount.";";
}
$sql->close();

$notenum = file('allnotes.ordylandata');
$notenum = $notenum[0];

if(!$dodo){$image = "Token校验失败,请重新进入页面!";}
//echo openssl_decrypt($api_id, 'AES-128-ECB', $api_key, 0);
print<<<AAA
<iframe src="/noteview/{$mode}/{$idd}?ga=true" id="note" style="width: 100%;height: 100%;"></iframe>
<div id="welcome" style=" overflow: scroll;position: absolute;top: 10%;left: 15%;width:70%;height: 80%;background: #E6E6E6;border:3px solid #000; z-index: 5;">
<p>快,来看笔记啦!在此页面欣赏笔记{$minute}分钟,即可领取{$acount}!(现已升级为宝箱)</p>
{$image}
<br><a href="javascript:void(0);" onclick="document.getElementById('welcome').style.display='none';setInterval('start();',1000);start();">[好的,我来啦!]</a>
</div>
<div style="position: absolute;top: 80%;left: 93%;width:5%;height: 5%;background: #E6E6E6;border:2px solid #000; z-index: 10;" id="timer">
剩余{$second}秒,<br>100%
</div>
<div id="finish" style="overflow: scroll;position: absolute;top: 10%;left: 15%;width:70%;height: 80%;background: #E6E6E6;border:3px solid #000; z-index: 6;display:none;">
<p>成功欣赏笔记{$minute}分钟,领取了{$acount},快去看看吧!(现已升级为宝箱)</p><br>
<a href="/noteview/tags/1">[去首页]</a><br>
<a href="javascript:void(0);" onclick="document.getElementById('finish').style.display='none';">[我还没有看完,再看看!]</a><br>
{$image}
</div>

<div id="bbb"><a href="javascript:void(0);" onclick="changenote({$notenum});">[随便看看]</a><a href="/noteview/{$mode}/{$idd}">[退出奖励(进度保留)]</a></div>

<script>
var time = "{$second}";
//if(!window.localStorage){alert(1);}else{alert(2);}
if(!localStorage.ON_TVIEW){
localStorage.ON_TVIEW = time;}

function changenote(n){
var noteid = Math.floor(Math.random()*n)+1;
document.getElementById("note").src="https://on.ordylan.com/noteview/notes/"+noteid+"?ga=true";
}
function start(){
if(localStorage.ON_TVIEW){
    var tm = localStorage.ON_TVIEW;
    localStorage.ON_TVIEW = tm - 1;
    document.getElementById("timer").innerHTML="剩余"+tm+"秒,<br>"+parseInt((tm/time)*100)+"%";
    if(tm == "0"){
        let xhr = new XMLHttpRequest();
            xhr.open("post","/getaward.php?token={$api_id}",true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
            xhr.send("get=true");
            document.getElementById('finish').style.display='block';
            localStorage.ON_TVIEW = "";
    }
}}

</script>
AAA;
?>
<!--	<script src="/TweenMax.min.js"></script>
<script>
if(!localStorage.ON_LastPath) {localStorage.ON_LastPath = window.location.pathname;localStorage.ON_ThisPath = window.location.pathname;}
localStorage.ON_LastPath = localStorage.ON_ThisPath;
if(localStorage.ON_ThisPath != window.location.pathname){localStorage.ON_ThisPath = window.location.pathname;}
localStorage.ON_ThisPath = window.location.pathname;
</script>-->
</body>
</html>

