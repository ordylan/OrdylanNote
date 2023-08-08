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










<div id="mydiv" style="top: 34px; left: 127px;">
 <div id="mydivheader"><div style="position:absolute;left:1%;"><!--选择讲义:--><input type="file" id="pdfff" onchange="onInputFileChangepdf();"></div>讲义框<bottum onclick="document.getElementById('mydiv').style.display='none';" style="position:absolute;right:1%;">[最小化]</bottum></div><div class="resizeL"></div><div class="resizeT"></div><div class="resizeR"></div><div class="resizeB"></div><div class="resizeLT"></div><div class="resizeTR"></div><div class="resizeBR"></div><div class="resizeLB"></div><iframe src="" id="paperr" style="width: 100%;height: 92.5%;"></iframe>
    </div>
    <style>
        #mydiv {
            position: absolute;
            z-index: 99;
            background-color: #f1f1f1;
            text-align: center;
            border: 1px solid #d3d3d3;
            width: 70%;
            height: 70%;
        }
        
        #mydivheader {
            padding: 1%;
            cursor: move;
            z-index: 100;
            background-color: #FFA600;
            color: #fff;
        }
        #mydiv .resizeBR{position:absolute;width:14px;height:14px;right:0;bottom:0;overflow:hidden;cursor:nw-resize;/*background:url(images/resize.png) */no-repeat;}
#mydiv .resizeL,#mydiv .resizeT,#mydiv .resizeR,#mydiv .resizeB,#mydiv .resizeLT,#mydiv .resizeTR,#mydiv .resizeLB{position:absolute;background:#000;overflow:hidden;opacity:0;filter:alpha(opacity=0);}
#mydiv .resizeL,#mydiv .resizeR{top:0;width:5px;height:100%;cursor:w-resize;}
#mydiv .resizeR{right:0;}
#mydiv .resizeT,#mydiv .resizeB{width:100%;height:5px;cursor:n-resize;}
#mydiv .resizeT{top:0;}
#mydiv .resizeB{bottom:0;}
#mydiv .resizeLT,#mydiv .resizeTR,#mydiv .resizeLB{width:8px;height:8px;background:#FF0;}
#mydiv .resizeLT{top:0;left:0;cursor:nw-resize;}
#mydiv .resizeTR{top:0;right:0;cursor:ne-resize;}
#mydiv .resizeLB{left:0;bottom:0;cursor:ne-resize;}
    </style>
    <script>
var dragMinWidth = 100;
var dragMinHeight = 100;
var get = {
  byId: function(id) {
    return typeof id === "string" ? document.getElementById(id) : id
  },
  byClass: function(sClass, oParent) {
    var aClass = [];
    var reClass = new RegExp("(^| )" + sClass + "( |$)");
    var aElem = this.byTagName("*", oParent);
    for (var i = 0; i < aElem.length; i++) reClass.test(aElem[i].className) && aClass.push(aElem[i]);
    return aClass
  },
  byTagName: function(elem, obj) {
    return (obj || document).getElementsByTagName(elem)
  }
};
function resize(oParent, handle, isLeft, isTop, lockX, lockY)
{
  handle.onmousedown = function (event)
  {
    var event = event || window.event;
    var disX = event.clientX - handle.offsetLeft;
    var disY = event.clientY - handle.offsetTop;  
    var iParentTop = oParent.offsetTop;
    var iParentLeft = oParent.offsetLeft;
    var iParentWidth = oParent.offsetWidth;
    var iParentHeight = oParent.offsetHeight;
    document.onmousemove = function (event)
    {
      var event = event || window.event;
      var iL = event.clientX - disX;
      var iT = event.clientY - disY;
      var maxW = document.documentElement.clientWidth - oParent.offsetLeft - 2;
      var maxH = document.documentElement.clientHeight - oParent.offsetTop - 2;          var iW = isLeft ? iParentWidth - iL : handle.offsetWidth + iL;
      var iH = isTop ? iParentHeight - iT : handle.offsetHeight + iT;
      isLeft && (oParent.style.left = iParentLeft + iL + "px");
      isTop && (oParent.style.top = iParentTop + iT + "px");
      iW < dragMinWidth && (iW = dragMinWidth);
      iW > maxW && (iW = maxW);
      lockX || (oParent.style.width = iW + "px");
      iH < dragMinHeight && (iH = dragMinHeight);
      iH > maxH && (iH = maxH);
      lockY || (oParent.style.height = iH + "px");
      if((isLeft && iW == dragMinWidth) || (isTop && iH == dragMinHeight)) document.onmousemove = null;
      return false;  
    };
    document.onmouseup = function ()
    {
      document.onmousemove = null;
      document.onmouseup = null;
    };
    return false;
  }
};
window.onload = window.onresize = function ()
{
  var oDrag = document.getElementById("mydiv");
 // var oTitle = get.byClass("title", oDrag)[0];
  var oL = get.byClass("resizeL", oDrag)[0];
  var oT = get.byClass("resizeT", oDrag)[0];
  var oR = get.byClass("resizeR", oDrag)[0];
  var oB = get.byClass("resizeB", oDrag)[0];
  var oLT = get.byClass("resizeLT", oDrag)[0];
  var oTR = get.byClass("resizeTR", oDrag)[0];
  var oBR = get.byClass("resizeBR", oDrag)[0];
  var oLB = get.byClass("resizeLB", oDrag)[0];
  //drag(oDrag, oTitle);
  //四角
  resize(oDrag, oLT, true, true, false, false);
  resize(oDrag, oTR, false, true, false, false);
  resize(oDrag, oBR, false, false, false, false);
  resize(oDrag, oLB, true, false, false, false);
  //四边
  resize(oDrag, oL, true, false, false, true);
  resize(oDrag, oT, false, true, true, false);
  resize(oDrag, oR, false, false, false, true);
  resize(oDrag, oB, false, false, true, false);
  oDrag.style.left = (document.documentElement.clientWidth - oDrag.offsetWidth) / 2 + "px";
  oDrag.style.top = (document.documentElement.clientHeight - oDrag.offsetHeight) / 2 + "px";
}
        //Make the DIV element draggagle:
        dragElement(document.getElementById("mydiv"));
        
        function dragElement(elmnt) {
          var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
          if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
          } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
          }
        
          function dragMouseDown(e) {
            e = e || window.event;
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
          }
        
          function elementDrag(e) {
            e = e || window.event;
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
          }
        
          function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
          }
        }
    </script>
    
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
function jt() {
var canvas = document.createElement('canvas');
var canvasCtx = canvas.getContext('2d');
var video = document.getElementById('video_id');
canvas.width = video.offsetWidth;
canvas.height = video.offsetHeight;
canvasCtx.fillStyle = '#222125';
canvasCtx.fillRect(0, 0, canvas.width, canvas.height);
var imgWidth = Math.min(canvas.width, video.videoWidth * canvas.height / video.videoHeight);
var imgHeight = Math.min(canvas.height, video.videoHeight * canvas.width / video.videoWidth);
canvasCtx.drawImage(
  video,
  0,
  0,
  video.videoWidth,
  video.videoHeight,
  (canvas.width - imgWidth) / 2,
  (canvas.height - imgHeight) / 2,
  imgWidth,
  imgHeight,
);

var imgURL = canvas.toDataURL('image/jpeg');

var kname = document.getElementById("kname").value;

var dlLink = document.createElement('a');
dlLink.download = 'biji_'+ kname + "_"+ Number(new Date())+".jpg"; // 文件名
dlLink.href = imgURL;
dlLink.dataset.downloadurl = ['image/jpeg', dlLink.download, dlLink.href].join(':');
document.body.appendChild(dlLink);
dlLink.click();
document.body.removeChild(dlLink);
/*
var arr = imgURL.split(','),
    mime = arr[0].match(/:(.*?);/)[1],
    bstr = atob(arr[1]),
    n = bstr.length,
    u8arr = new Uint8Array(n);
while (n--) {
    u8arr[n] = bstr.charCodeAt(n);
}
var file = new File([u8arr], "1.1", {type: mime});
file.lastModifiedDate = new Date();
console.info(file);
*/


/*
var xhr = new XMLHttpRequest();
xhr.open('POST', 'StudyPlace.php?t='+Number(new Date()), true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
xhr.onload = function (e) {
if (this.status == 200 || this.status == 304) {

}
};
xhr.send("imgname="+"test测试"+"&img64="+imgURL+"&");

*/
}


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

<div id="caogaoa" style="display:none;">
<style>*{margin:0; padding: 0;}
#drawing-board{background: white;position:fixed; display: block;cursor: crosshair;}
.tools{position: fixed;left:0;bottom: 30px; width:100%;display: flex;justify-content: center;text-align: center}
.tools button{border-radius: 50%;width: 50px;height: 50px; background-color: rgba(255,255,255,0.7);border: 1px solid #eee;outline: none;cursor: pointer;box-sizing: border-box;margin: 0 10px;text-align: center;color:#ccc;line-height: 50px;box-shadow:0 0 8px rgba(0,0,0,0.1); transition: 0.3s;}
.tools button.active,.tools button:active{box-shadow: 0 0 15px #00CCFF; color:#00CCFF;}
.tools button i{font-size: 24px;}
.color-group{position:fixed;width: 30px;left: 30px;top:50%;transform: translate(0,-150px)}
.color-group ul{list-style: none;}
.color-group ul li{width: 30px;height: 30px;margin: 10px 0;border-radius: 50%;box-sizing: border-box;border:3px solid white;box-shadow: 0 0 8px rgba(0,0,0,0.2);cursor: pointer;transition: 0.3s;}
.color-group ul li.active{box-shadow:0 0 15px #00CCFF;}
#range-wrap{position: fixed;top: 50%;right:30px;width: 30px;height: 150px;margin-top: -75px;}
#range-wrap input{transform: rotate(-90deg);width: 150px;height: 20px;margin: 0;transform-origin: 75px 75px;    border-radius: 15px;-webkit-appearance: none;outline: none;position: relative;}
#range-wrap input::after{display: block;content:"";width:0;height: 0;border:5px solid transparent;
    border-right:150px solid #00CCFF;border-left-width:0;position: absolute;left: 0;top: 5px;border-radius:15px; z-index: 0; }
#range-wrap input[type=range]::-webkit-slider-thumb,#range-wrap input[type=range]::-moz-range-thumb{-webkit-appearance: none;}
#range-wrap input[type=range]::-webkit-slider-runnable-track,#range-wrap input[type=range]::-moz-range-track {height: 10px;border-radius: 10px;box-shadow: none;}
#range-wrap input[type=range]::-webkit-slider-thumb{-webkit-appearance: none;height: 20px;width: 20px;margin-top: -1px;background: #ffffff;border-radius: 50%;box-shadow: 0 0 8px #00CCFF;position: relative;z-index: 999;}
</style>

<canvas id="drawing-board" style="background:rgba(255,255,255,0);position:fixed;top:0px;left:0px;z-index:999;"></canvas>
    <div class="color-group" style="z-index:1000;">
        <ul>
            <li id="white" class="color-item" style="background-color: white;"></li>
            <li id="black" class="color-item active" style="background-color: black;"></li>
           <!-- <li id="red" class="color-item" style="background-color: #FF3333;"></li>
            <li id="blue" class="color-item" style="background-color: #0066FF;"></li>
            <li id="yellow" class="color-item" style="background-color: #FFFF33;"></li>
            <li id="green" class="color-item" style="background-color: #33CC66;"></li>
            <li id="gray" class="color-item" style="background-color: gray;"></li>-->
        </ul>
    </div>
    <div id="range-wrap" style="z-index:1000;"><input type="range" id="range" min="1" max="30" value="5" title="调整笔刷粗细"></div>
    <div class="tools" style="z-index:1000;">
        <button id="brush" class="active" title="画笔">画笔</button>
        <button id="eraser" title="橡皮擦">橡皮</button>
        <button id="undo" title="撤销">撤销</button>
        <button id="clear" title="清空">清空</button>
        <button id="exit" title="保存">退出</button>
</div>

<script>
let canvas = document.getElementById("drawing-board");
let ctx = canvas.getContext("2d");
let eraser = document.getElementById("eraser");
let brush = document.getElementById("brush");
let reSetCanvas = document.getElementById("clear");
let aColorBtn = document.getElementsByClassName("color-item");
let save = document.getElementById("exit");
let undo = document.getElementById("undo");
let range = document.getElementById("range");
let clear = false;
let activeColor = 'black';
let lWidth = 4;


setCanvasBg('white');

listenToUser(canvas);

getColor();
/*
window.onbeforeunload = function(){
    return "Reload site?";
};*/



 canvas.width =document.documentElement.clientWidth;
 canvas.height = document.documentElement.clientHeight;
        
function setCanvasBg(color) {
    ctx.fillStyle = color;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "black";
}

function listenToUser(canvas) {
    let painting = false;
    let lastPoint = {x: undefined, y: undefined};

    if (document.body.ontouchstart !== undefined) {
        canvas.ontouchstart = function (e) {
            this.firstDot = ctx.getImageData(0, 0, canvas.width, canvas.height);//在这里储存绘图表面
            saveData(this.firstDot);
            painting = true;
            let x = e.touches[0].clientX;
            let y = e.touches[0].clientY;
            lastPoint = {"x": x, "y": y};
            ctx.save();
            drawCircle(x, y, 0);
        };
        canvas.ontouchmove = function (e) {
            if (painting) {
                let x = e.touches[0].clientX;
                let y = e.touches[0].clientY;
                let newPoint = {"x": x, "y": y};
                drawLine(lastPoint.x, lastPoint.y, newPoint.x, newPoint.y);
                lastPoint = newPoint;
            }
        };

        canvas.ontouchend = function () {
            painting = false;
        }
    } else {
        canvas.onmousedown = function (e) {
            this.firstDot = ctx.getImageData(0, 0, canvas.width, canvas.height);//在这里储存绘图表面
            saveData(this.firstDot);
            painting = true;
            let x = e.clientX;
            let y = e.clientY;
            lastPoint = {"x": x, "y": y};
            ctx.save();
            drawCircle(x, y, 0);
        };
        canvas.onmousemove = function (e) {
            if (painting) {
                let x = e.clientX;
                let y = e.clientY;
                let newPoint = {"x": x, "y": y};
                drawLine(lastPoint.x, lastPoint.y, newPoint.x, newPoint.y,clear);
                lastPoint = newPoint;
            }
        };

        canvas.onmouseup = function () {
            painting = false;
        };

        canvas.mouseleave = function () {
            painting = false;
        }
    }
}

function drawCircle(x, y, radius) {
    ctx.save();
    ctx.beginPath();
    ctx.arc(x, y, radius, 0, Math.PI * 2);
    ctx.fill();
    if (clear) {
        ctx.clip();
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.restore();
    }
}

function drawLine(x1, y1, x2, y2) {
    ctx.lineWidth = lWidth;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    if (clear) {
        ctx.save();
        ctx.globalCompositeOperation = "destination-out";
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.stroke();
        ctx.closePath();
        ctx.clip();
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.restore();
    }else{
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.stroke();
        ctx.closePath();
    }
}

range.onchange = function(){
    lWidth = this.value;
};

eraser.onclick = function () {
    clear = true;
    this.classList.add("active");
    brush.classList.remove("active");
};

brush.onclick = function () {
    clear = false;
    this.classList.add("active");
    eraser.classList.remove("active");
};

reSetCanvas.onclick = function () {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    setCanvasBg('white');
 canvas.width =document.documentElement.clientWidth;
 canvas.height = document.documentElement.clientHeight;
  
};

save.onclick = function () {
document.getElementById("caogaoa").style.display="none";
};

function getColor(){
    for (let i = 0; i < aColorBtn.length; i++) {
        aColorBtn[i].onclick = function () {
            for (let i = 0; i < aColorBtn.length; i++) {
                aColorBtn[i].classList.remove("active");
                this.classList.add("active");
                activeColor = this.style.backgroundColor;
                ctx.fillStyle = activeColor;
                ctx.strokeStyle = activeColor;
            }
        }
    }
}

let historyDeta = [];

function saveData (data) {
    (historyDeta.length === 10) && (historyDeta.shift());// 上限为储存10步，太多了怕挂掉
    historyDeta.push(data);
}

undo.onclick = function(){
    if(historyDeta.length < 1) return false;
    ctx.putImageData(historyDeta[historyDeta.length - 1], 0, 0);
    historyDeta.pop()
};</script>
<!--草稿-->
</div>

<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>