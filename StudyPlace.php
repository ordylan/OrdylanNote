<?php
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);//shijianchuo
if ($_POST["imgname"] && $_POST["img64"]){
exit("开发失败");
/*
    //$base64 = substr($_POST["img64"],23);
    $base64 = $_POST["img64"];
    $base64 = explode(',',$base64)[1];

    
  $img = base64_decode($base64);// header('content-type:image/jpeg;charset="utf-8"');
    //echo($img);
    //$aaooo = "images/TempImgUpload/".$_POST["imgname"].'_'.$msectime.'_'.rand(100000,999999).'.jpg';
    
     $aaooo = "images/TempImgUpload/".$_POST["imgname"].'_'.$msectime.'_'.rand(100000,999999).'.jpg';
    
    $a = file_put_contents($aaooo,$img);
    
    exit("https://on.ordylan.com/".$aaooo);
*/
}
?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统_学习空间','橙鸭笔记系统_学习空间<a href="/noteview/tags/1">[回首页]</a><a href="javascript:void(0);" onclick="viewFullScreen();">[开全屏]</a><a href="javascript:void(0);" onclick="cancelFullScreen();">[退全屏]</a>','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>


视频厅_回车截屏-↑播放-↓暂停-←后退-→前进-~草稿<hr>
<div id="xxsj">timer</div>
选择视频: <input type="file" id="file" onchange="onInputFileChange();">视频名: <input type="text" id="kname"><a href="javascript:void(0);" onclick="jt();">[截图]</a><a href="javascript:void(0);" onclick="document.getElementById('caogaoa').style.display='block';">[草稿]</a><a href="javascript:void(0);" onclick="document.getElementById('mydiv').style.display='block';">[+讲义]</a>
<br/>

<video id="video_id">你的浏览器不能支持HTML5视频</video>


<br><br><br><br>











<div id="studying" style="display: none;"><div id="bstudying"></div><p> 休息时间</p><p>剩余:</p><p id="nowstudy">00:00:00</p><a href="javascript:void(0);" onclick='document.getElementById("video_id").play();document.getElementById("studying").style.display="none";' id="ssstop">[继续学习]</a></div>

<?php
if($_GET["log"] == "get"){
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
echo '<div style="width:100%;height:100%;z-index:999;position:fixed;top:0;left:0;overflow:auto;"><a href="/noteview/tags/1" data-cp="no">back</a>'.$logF->readlogs("log.ordylandata")."</div><script>document.getElementById(\"mmm\").style.display=\"block\";</script>";
}
elseif($_GET["vlist"]=="get"){
        $sqlinfo = file('SqlPass.ordylandata');
        $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
        $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
        mysqli_query($sql,'SET NAMES UTF8');
        
        if($_GET["vlistt"]=="do" && $_GET["vid"]){
            
         $result = mysqli_query($sql,"UPDATE TempVideoViewTotal SET isfinish='1' WHERE id='".$_GET["vid"]."'");
         echo "<script>alert(\"成功!\");window.location.href=\"?vlist=get&PANid=".$_GET["PANid"]."\";</script>";
        }
        $result = mysqli_query($sql,"SELECT * FROM TempVideoViewTotal");
        while($row = mysqli_fetch_array($result)){
            if($row['mode'] == 1){$abaaq  ="中考"; }elseif($row['mode'] == 0){$abaaq  ="学习";}if($row['subject'] == 12){$aabaaq  ="数学"; }elseif($row['subject'] == 14){$aabaaq  ="物理";}elseif($row['subject'] == 15){$aabaaq  ="化学";}if($row['isfinish'] == 1){$aabaaqq  ="<a href='?vlist=get&PANid=".$_GET["PANid"]."&vlistt=do&vid=".$row['id']."' style=\"color:green;\">已完成</a>"; }elseif($row['isfinish'] == 0){$aabaaqq  ="<a href='?vlist=get&PANid=".$_GET["PANid"]."&vlistt=do&vid=".$row['id']."' style=\"color:red;\">未完成</a>"; }elseif($row['isfinish'] == 2){$aabaaqq  ="<a href='?vlist=get&PANid=".$_GET["PANid"]."&vlistt=do&vid=".$row['id']."' style=\"color:yellow;\">不完成</a>"; }elseif($row['isfinish'] == 3){$aabaaqq  ="<a href='?vlist=get&PANid=".$_GET["PANid"]."&vlistt=do&vid=".$row['id']."' style=\"color:yellow;\">暂不完成</a>"; }
            if($row['info']){$aabbaaqq  =$row['info']; }else{$aabbaaqq="无备注";}
            
            $logtext = $logtext."<tr><td>".$abaaq."</td><td>".$aabaaq."</td><td>
            <a href='javascript:void(0);' onclick=\"navigator.clipboard.writeText('".$_GET["PANid"].str_replace("++","\\\\",$row['url'])."');\">".$_GET["PANid"].str_replace("++","\\",$row['url'])."(".$aabbaaqq.")</a></td><td>$aabaaqq</td><td>".$row['id']."</td></tr>";
        }            /*<a href='".$_GET["PANid"].str_replace("++","\\",$row['url'])."' target=\"_blank\">[直接打开]</a> | */
        $sql->close();
        $logtext = "<table border=\"1\"><tbody><tr><td>模式</td><td>学科</td><td>url</td><td>完成</td><td>id</td></tr>".$logtext."</tbody></table>";
    echo '<div style="width:100%;height:100%;z-index:999;"><a href="?1" data-cp="no">back</a>'.$logtext."</div><script>document.getElementById(\"mmm\").style.display=\"none\";</script>";
}
?>
<script>
 localStorage.ON_SP_STUDYING = "false";
localStorage.ON_SP_TIMETEMP = 0;
localStorage.ON_SP_TIMETEMP_1="0";localStorage.ON_SP_TIMETEMP_2="0";



// 浏览器进入全屏
function viewFullScreen() {
    document.getElementById("video_id").play();
  // 主要，这边要全屏的对象是这个body，如果只是选择点击的对象，比如 e.currentTarget，那么就会变成只有这个按钮全屏
  var docElm = document.documentElement;
  // 浏览器兼容
  if (docElm.requestFullscreen) {
    docElm.requestFullscreen();
  } else if (docElm.msRequestFullscreen) {
    docElm.msRequestFullscreen();
  } else if (docElm.mozRequestFullScreen) {
    docElm.mozRequestFullScreen();
  } else if (docElm.webkitRequestFullScreen) {
    docElm.webkitRequestFullScreen();
  }
};

// 浏览器退出全屏
function cancelFullScreen() {
    document.getElementById("video_id").pause();
  // 浏览器兼容
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitCancelFullScreen) {
    document.webkitCancelFullScreen();
  }
};

function onInputFileChange() {
      var file = document.getElementById('file').files[0];
      var url = URL.createObjectURL(file);
     document.getElementById("kname").value=file.name;
      document.getElementById("video_id").src = url;
viewFullScreen();
}


function onInputFileChangepdf() {
      var file = document.getElementById('pdfff').files[0];
      var url = URL.createObjectURL(file);
      document.onselectstart=function(){return false}
     document.getElementById("paperr").src=url;
}
//setInterval("viewFullScreen();",500);


function ksxx(){localStorage.ON_SP_TIMETEMP = 0;document.getElementById('studying').style.display='block';document.getElementById("video_id").pause();localStorage.ON_SP_TIMETEMP_1="0";localStorage.ON_SP_TIMETEMP_2="0";}


var elevideo = document.getElementById("video_id");
 elevideo.addEventListener('pause', function () {
 localStorage.ON_SP_STUDYING = "false";
 });
 elevideo.addEventListener('playing', function () {
 localStorage.ON_SP_STUDYING = "true";
 });
 elevideo.addEventListener('ended', function () {
 localStorage.ON_SP_STUDYING = "false";
 });

if(!localStorage.ON_SP_TIME){localStorage.ON_SP_TIME=0;}
function aaq() {
document.getElementById("xxsj").innerHTML="总学习时间: "+localStorage.ON_SP_TIME+"s || 距离休息时间还有: "+(3600-localStorage.ON_SP_TIMETEMP)+"s!<a href=\"javascript:void(0);\" onclick='ksxx();'>[提前休息]</a>";
if(localStorage.ON_SP_STUDYING == "true"){localStorage.ON_SP_TIME=Number(localStorage.ON_SP_TIME)+Number(1);localStorage.ON_SP_TIMETEMP=Number(localStorage.ON_SP_TIMETEMP)+Number(1);}
if(localStorage.ON_SP_TIMETEMP >= 3000&&localStorage.ON_SP_TIMETEMP < 3420&&localStorage.ON_SP_TIMETEMP_1!="1"){alert("还有10分钟就要休息了!");localStorage.ON_SP_TIMETEMP_1="1";}
if(localStorage.ON_SP_TIMETEMP >= 3420&&localStorage.ON_SP_TIMETEMP < 3600&&localStorage.ON_SP_TIMETEMP_2!="1"){alert("还有3分钟就要休息了!");localStorage.ON_SP_TIMETEMP_2="1";}
if(localStorage.ON_SP_TIMETEMP >= 3600){ksxx();alert("休息时间");}


}

document.onkeydown= function() {
/*if (window.event && window.event.keyCode == 27){    
         cancelFullScreen();
         event.keyCode = 0;
         event.returnValue = false;
}*/

if (window.event && window.event.keyCode == 13){    
         jt();
         event.keyCode = 0;
         event.returnValue = false;
}

if (window.event && window.event.keyCode == 37){    
         document.getElementById("video_id").currentTime = Number(document.getElementById("video_id").currentTime)-Number(2);
         event.keyCode = 0;
         event.returnValue = false;
}

if (window.event && window.event.keyCode == 39){    
       document.getElementById("video_id").currentTime = Number(document.getElementById("video_id").currentTime)+Number(2);
         event.keyCode = 0;
         event.returnValue = false;
}

if (window.event && window.event.keyCode == 40){    
         document.getElementById("video_id").pause();
         event.keyCode = 0;
         event.returnValue = false;
}

if (window.event && window.event.keyCode == 38){    
          document.getElementById("video_id").play();
         event.keyCode = 0;
         event.returnValue = false;
}
if (window.event && window.event.keyCode == 192){    
document.getElementById('caogaoa').style.display='block';
}
}

setInterval("aaq();",1000);
</script>
<style>
    video#video_id{
        width: 90%;
        /*height: 100%;*/
    }
 div#bstudying{
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height: 100%;
    background: black;
    opacity: 0.7;
    z-index: -2;
}   
div#studying{
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height: 100%;
    color:#E6E6E6;
    z-index: 100;
    font-size: 4.3vh;
}a{
  color:#000000;
  text-decoration:none;
  font-weight:bold;
}

a#ssstop {
  color:#E6E6E6;
  text-decoration:none;
  font-weight:bold;
}
</style>

<!--草稿-->

<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>