<?php
if(!$_GET["gettexta"]){
        $iddd=$_GET["id"];
        $notenum = file('allnotes.ordylandata');
        $notenum = $notenum[0];
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle")){$KINDLEJS = '<script src="/main.js"></script>';}
    if($_GET["fromnote"] && file_exists($_GET["mode"]."/".$_GET["fromnote"].'.ordylandata')){$backidddd = $_GET["fromnote"];}else$backidddd=$iddd;
    if($_GET["ga"] != "true") {$abababbbb=$abababbbb. "<a href=\"/noteview/tags/1\">[首页]</a>";$tk = str_ireplace("+","%2B",openssl_encrypt(rand(128,360)."|KP_".rand(6,16).";RPON_".rand(1,5), 'AES-128-ECB', "ORDYLAN_Note_AWARD_GET", 0));$abababbbb=$abababbbb. "<a href=\"/getaward/".$_GET["mode"]."/".$_GET["id"]."?token=".$tk."\">[奖]</a><a href=\"javascript:void(0);\" onclick=\"changenote(".$notenum.");\">[随机]</a>";} else {$abababbbb= " [浏览得奖励!]";}if($_GET["mode"] == "tags" && $_GET["imageall"] != "true" && $_GET["id"] != "1") {$abababbbb=$abababbbb. "<a href=\"?imageall=true\">[展全图]</a>";} elseif($_GET["mode"] == "tags" && $_GET["imageall"] == "true" && $_GET["id"] != "1") {$abababbbb=$abababbbb. "<a href=\"/noteview/tags/".$_GET["id"]."\">[取消展全图]</a>";}if($_GET["mode"] == "notes") {$abababbbb=$abababbbb. "<!--<a href=\"javascript:void(0);\" onclick=\"cache()\">[缓存]</a>-->";}require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统V2','橙鸭笔记系统'.$abababbbb,'href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath + \'#notee_'.$backidddd.'\');"',$KINDLEJS,"");

}
?>
<?php
$mode = $_GET["mode"];
$idd = $_GET["id"];
if($mode == "tags" && $idd=="1"){
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
mysqli_query($sql,'SET NAMES UTF8');
$result = mysqli_query($sql,"SELECT * FROM ordylannote");
while($row = mysqli_fetch_array($result)){$RPON = $row['RPON'];$knowledgepoints = $row['knowledgepoints'];$level = floor($knowledgepoints/50);$boxnum = $row['boxnum'];}
$sql->close();
print<<<my
<div id="mybag" style="display: none; overflow: scroll;">
<a href="javascript:void(0);" onclick="document.getElementById('mybag').style.display='none';">[<span class="onicon_close"></span>关闭]</a>
<p>我的等级: Lv{$level}({$knowledgepoints})</p><br><p>我的笔记残图: {$RPON}枚</p>
<br><p>我的宝箱: {$boxnum}个</p>
</div>
my;
}
//if($mode == "collections"){$mode2 = "tags";}//新-合集

if(!$mode || !$idd){echo "<div id=\"app\"></div> 
<script src=\"https://ordylan.com/js/newan/pixi.min.js\"></script>
<script src=\"https://ordylan.com/js/newan/pixi-spine.js\"></script>
<script>setTimeout(\"window.location.href = '/noteview/tags/1';\",2345);
const app = new PIXI.Application({
    backgroundColor:0xE6E6E6,
    antialias:true,
    width:document.documentElement.clientWidth,
    height:document.documentElement.clientHeight
});
document.getElementById('app').appendChild(app.view);//div
let loader = PIXI.loader.add('ordylan','/simages/firstpagespine/on_load.json');
       var skinwidth = 1501.74;//这里写一个自适应,要换成皮肤长宽
       var skinheight = 1169.41;//原理很简单,一点小学数学知识+平面直角坐标系知识即可
var beishu1 = document.documentElement.clientWidth/skinwidth;//2个缩放比例
var beishu2 = document.documentElement.clientHeight/skinheight;//理解成相似图形即可
if(beishu1 > beishu2){//比较选小的,防止出屏幕
    var beishu = beishu2;
}
else if(beishu1 == beishu2){
    var beishu = beishu1;
}
else if (beishu1 < beishu2){
    var beishu = beishu1;
}
loader.load((loader,res)=>{
    let ordylan = new PIXI.spine.Spine(res.ordylan.spineData),
        options = [''];
    ordylan.scale.set(beishu);//放大倍数s
    ordylan.state.setAnimation(0,'pen2',true);//loop你的动画名字 true 为循环播放
    ordylan.x = skinwidth*beishu/2;//O点在中间,所以xy 坐标 长宽除以二(导出记得把动画放在中央)
    ordylan.y = skinheight*beishu/2;
app.stage.addChild(ordylan);
});

</script>";exit;}
if($mode == "@Upload_PAPER"){header( "Location: /p/".$idd);exit;}
if(!file_exists($mode."/".$idd.'.ordylandata')&&$mode != "collections"){header("HTTP/1.1 404 Not Found");echo "<br>Note Not Found.";exit;}
else{
  require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
//if($mode == "tags" && $idd == "1")
    if($mode != "collections"){
    $notteee = file($mode."/".$idd.'.ordylandata')[0];}
    else{ $notteee = "笔记自定义合集{[(<||>)]}0{[(<||>)]}——笔记合集——{[(<||>)]}";}
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = date("Y-m-d H:i:s",intval($notteee[1]/1000));
    $zy = $notteee[2];
if(preg_match_all("/@_NOTE\[(\d+)\];/",$zy,$matches)){
for ($w = 0; $w < count($matches[0]); $w++) {
    $notteeea = file("notes/".$matches[1][$w].'.ordylandata')[0];
    $notteeea = explode('{[(<||>)]}', $notteeea);
    $bta = $notteeea[0];
$zy = str_replace($matches[0][$w], '<a href="/noteview/notes/'.$matches[1][$w].'?fromnote='.$idd.'">[引用:'.$bta.']</a>', $zy);
}
}
    $tp = $notteee[3];
    if($_GET["fromnote"] && file_exists($mode."/".$_GET["fromnote"].'.ordylandata')){$BACKKKK='<br><a href="/noteview/notes/'.$_GET["fromnote"].'">[返回笔记:'.$_GET["fromnote"].']</a>';}
/*新-图云水印*/
$tp = str_replace("https://on.ordylan.com/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
$tp = str_replace("https://ordylan.com/HSP/ON/v2/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
/*新-图云水印*/
$loadimg = "/simages/loading.gif";
    $tp22 = $notteee[3];
    $tp = explode('|', $tp);

    if(file_exists("images/search_img_scan_text/".$idd.".ordylandata")){
        $fffi2 = fopen("images/search_img_scan_text/".$idd.".ordylandata", 'r');
            while(!feof($fffi2)){
          $tpi2 = $tpi2.fgets($fffi2);
            }
        fclose($fffi2);
}
//$tpi2 = addslashes($tpi2);
header('Content-Type:text/html;charset=utf-8');
print<<<NOTEa
<fieldset id="developb" style="display:none;"><legend>开发2</legend><a href="?up=true&imageall=true">[展示调试信息]</a>
<a href="?imgaa=t&imageall=true">[禁用后加载]</a>
</fieldset>
<script>
function nonet() {if(document.getElementById('textmode')){document.getElementById('textmode').style.display='block';}}
function net() {if(document.getElementById('textmode')){document.getElementById('textmode').style.display='none';}}
 /*   var el = document.body;
    if (el.addEventListener) {
       window.addEventListener("online", function () {net();}, true);  
       window.addEventListener("offline", function () {nonet();}, true);  
    }
    else if (el.attachEvent) {  
       window.attachEvent("ononline", function () {net();});  
       window.attachEvent("onoffline", function () {nonet();});  
    }  
    else {  
       window.ononline = function () {net();};  
       window.onoffline = function () {nonet();};  
    }
*/
if(localStorage.ON_MAINJS){
var xhr = new XMLHttpRequest();
xhr.open('GET', '/images/Net?t=' + Number(new Date()), true);
xhr.onload = function (e) {
if (this.status == 200 || this.status == 304) {
net();
}
    else{nonet();};
}
xhr.send();
}
 </script>
NOTEa;

//$tpi2 = "";
    for ($i = 0; $i < count($tp)-1; $i++) {
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle") || $_GET["imgaa"] == "t"){$tpi = $tpi.'<img src="'.$tp[$i].'" id="imagee" alt="note_image_'.($i+1).'">';}else{
         $tpi = $tpi.'<img data-src="'.$tp[$i].'" id="imagee" alt="note_image_'.($i+1).';SCANTEXT_图片扫描版见上'.'" class="lazyload" src="'.$loadimg.'">';}
    }
     if($tp[0] == "HTML_MODE"){
                 $tpi = '<!--<base href="/images/htmls/'.$idd.'/">-->';

            $fffi = fopen("images/htmls/".$idd."/index.html", 'r');
            while(!feof($fffi)){
         //echo fgets($fffi).'\n';
          $tpi = $tpi.fgets($fffi);
            }
        fclose($fffi);
             
         }

if($mode == "notes" && $_GET["token"] != md5("ORDYLANNOTE_token_NOTE_ID".$idd."_PASS") && $onpass == "false"){$bt = "你好啊, 你提供的令牌无法确认你是主人, 非常抱歉! ";$tpi2 = "[图片扫描文本获取失败]";$sj = "解决方案:";$zy = "1.在<a href=\"/passport.php\">[这里]</a>输入6位正确数字以证明(查看全部笔记).<br>2.在本页添加get参数\"token\"并提供32位正确的token(查看当前笔记).<br>3.询问该笔记的分享链接.";$tpi = "";$tpi2 = "";for($i = 0; $i < count($tp)-1; $i++) {$tpi = $tpi.'<img id="imagee" class="|#nopass#|" data-src="|#nopass#|" alt="未通过pass" src="'.$loadimg.'">';}$tokenthis = "";$tp22 = "Get Image Faild! No Login.";}else{$tokenthis = "<div id='share'><span class=\"onicon_share2\"></span>该笔记分享链接:https://on.ordylan.com/noteview/notes/".$idd."/".md5("ORDYLANNOTE_token_NOTE_ID".$idd."_PASS")."</div><textarea id=\"input\" style=\"position: absolute;top: -999999px;z-index:-9999;\"></textarea><script>function copyText(a) {if(a==\"1\"){var text = \"https://on.ordylan.com/noteview/notes/".$idd."/".md5("ORDYLANNOTE_token_NOTE_ID".$idd."_PASS")."\"}else if(a==\"2\"){var text = \"你好啊, 我这边有一份关于".$bt."的好笔记, 特地分享给你看看, 请查收~\\n笔记链接:https://on.ordylan.com/noteview/notes/".$idd."/".md5("ORDYLANNOTE_token_NOTE_ID".$idd."_PASS")."\"};var input = document.getElementById(\"input\");input.value = text;input.select();document.execCommand(\"copy\");}</script><button onclick=\"copyText(1)\">复制分享链接</button><button onclick=\"copyText(2)\">复制分享话术</button>";}

$tpi2 = str_ireplace(array('<','>','&','"','\'',' '), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;'), $tpi2);
if($mode != "tags"){echo "<div style='display:block;' id='textmode' name='textmode'>".$tpi2."</div><script>document.getElementById(\"developb\").style.display=\"block\";</script>";}

if($mode == "tags" || $mode == "collections"){$tokenthis = "";}
$tp22 = str_replace("https://on.ordylan.com/images/", "", $tp22);
$tp22 = str_replace("https://ordylan.com/HSP/ON/v2/images/", "", $tp22);
$Temp_1 = addslashes($bt);
$Temp_2 = addslashes($zy);
$Temp_3 = addslashes($tp22);
$Temp_1 = str_ireplace(array('<','>','&','"','\'',' '), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;'), $Temp_1);
$Temp_2 = str_ireplace(array('<','>','&','"','\'',' '), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;'), $Temp_2);
$Temp_3 = str_ireplace(array('<','>','&','"','\'',' '), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;'), $Temp_3);
$Temp_4 = count($tp)-1;
if($mode == "notes"){}
print<<<NOTEa

<script>
function cache(){
    if('serviceWorker' in navigator){
        navigator.serviceWorker.register('/sw.php?do=noteimg&id={$idd}')
            .then(resitration => {
                console.log("register" , resitration);
            }).catch(err => console.error(err));
    }}
</script>
NOTEa;
//unlogintip
if($onpass == "false" && !$_GET["token"]){
    echo '<div id="unl" style="display: block; position: absolute; top: 3%; left: 20%; width: 60%; height: 90%; overflow: scroll; background: rgb(230, 230, 230); border: 3px solid rgb(0, 0, 0); z-index: 20;"><a href="javascript:void(0);" onclick="document.getElementById(\'unl\').style.display=\'none\';">[<span class="onicon_close"></span>关闭]</a><!--<div style=" position: relative;width: 100%;height:100%; padding: 0;padding-bottom: calc(100%*783.57/1072.93);">--><iframe src="/simages/newtipshaha/?123" id="tipss" style=" width: 100%;height:100%;" scrolling="no"></iframe><!--</div>--><p>你还未登录! 功能使用将受限!<br><a href="/passport.php">去登录</a><br>(代码可能会在未来开源, 开发了数千小时呢~)</p></div><script>/*document.getElementsByTagName("canvas")[0].style.height=document.getElementsByTagName("canvas")[0].style.width+9999;*/document.getElementById("tipss").style.height=document.getElementById("tipss").clientWidth*783.57/1072.93+"px";</script>';
}

if($_GET["up"] == "true"){print<<<NOTE
<script>alert('^Note_Information\\n^^Note Name: {$Temp_1}\\n^^Note Id: {$idd}\\n^^Note Create Time: {$notteee[1]} ($sj)\\n^^Note About: {$Temp_2}\\n^^Note Image Id: (Img Total: {$Temp_4})\\n{$Temp_3}\\n');</script>
<div style="word-break:break-all;">Note_Information<hr>Note Name: {$Temp_1}<hr>Note Id: {$idd}<hr>Note Create Time: {$notteee[1]} ($sj)<hr>Note About: {$Temp_2}<hr>Note Image Id: (Img Total: {$Temp_4})<br>{$Temp_3}<hr></div>

NOTE;
}

$tokena = md5("ODheji_SHarE_IdS_".$_GET["id"]."_TTTTTTaaaaa_");$tokena = str_ireplace(array('o','l','z'), array('0','1','2'), $tokena);
if($mode == "collections" && $onpass != "false"){$HEJITOKENN= "<div id='share'><span class=\"onicon_share2\"></span>该笔记合集链接:https://on.ordylan.com/noteview/collections/".$idd."/".$tokena."?imgaa=t&imageall=true</div><textarea id=\"input\" style=\"position: absolute;top: -999999px;z-index:-9999;\"></textarea><script>function copyText(a) {if(a==\"1\"){var text = \"https://on.ordylan.com/noteview/collections/".$idd."/".$tokena."?imgaa=t&imageall=true\"}else if(a==\"2\"){var text = \"你好啊, 我这边有一份笔记合集, 特地分享给你看看, 请查收~\\n笔记合集链接:https://on.ordylan.com/noteview/collections/".$idd."/".$tokena."?imgaa=t&imageall=true\"};var input = document.getElementById(\"input\");input.value = text;input.select();document.execCommand(\"copy\");}</script><button onclick=\"copyText(1)\">复制分享链接</button><button onclick=\"copyText(2)\">复制分享话术</button>";
}

if(!$_GET["gettexta"]){
print<<<NOTE
<div id="notee_{$tn[$i]}">
<h2 id="titlee">{$bt}</h2>
<h3 id="timee">{$sj}</h3>
<h3 id="aboutt">{$zy}</h3>
{$tokenthis}
{$BACKKKK}
{$HEJITOKENN}
{$tpi}
<!--<hr>-->
</div>

<script>console.log('Note_Information\\n_________\\nNote Name: {$Temp_1}\\n_________\\nNote Id: {$idd}\\n_________\\nNote Create Time: {$notteee[1]} ($sj)\\n_________\\nNote About: {$Temp_2}\\n_________\\nNote Image Id: {$Temp_3}\\n(Img Total: {$Temp_4})\\n_________\\n');</script>
NOTE;
}
$tpi = "";$tpi2 = "";
////////////////////////////////////////////////////////////
//if($_GET["gettexta"]){
if($idd != "1"){
if($mode == "tags" || $mode == "collections"){
print<<<NOTE
<hr>
<p>临时设置: [<a href="javascript:void(0);" onclick='var div_array = document.getElementsByName("textmode");for(i=0;i<div_array.length;i++){div_array[i].style.display = "block";}'>展示</a>|<a href="javascript:void(0);" onclick='var div_array = document.getElementsByName("textmode");for(i=0;i<div_array.length;i++){div_array[i].style.display = "none";}
'>隐藏</a>]图片扫描版文本</p>
<hr><script>document.getElementById("developb").style.display="block";</script>
NOTE;

if($mode == "collections"){$tn = $_GET["id"];}else{$tn = $notteee[3];}
$tn = explode(',', $tn);
for ($i = count($tn)-2; $i > -1 ; $i--) {
if(file_exists("notes/".$tn[$i].'.ordylandata'))
    $notteee = file("notes/".$tn[$i].'.ordylandata')[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = date("Y-m-d H:i:s",intval($notteee[1]/1000));
    $zy = $notteee[2];

if(preg_match_all("/@_NOTE\[(\d+)\];/",$zy,$matches)){
for ($w = 0; $w < count($matches[0]); $w++) {
    $notteeea = file("notes/".$matches[1][$w].'.ordylandata')[0];
    $notteeea = explode('{[(<||>)]}', $notteeea);
    $bta = $notteeea[0];
$zy = str_replace($matches[0][$w], '<a href="/noteview/notes/'.$matches[1][$w].'?fromnote='.$tn[$i].'">[引用:'.$bta.']</a>', $zy);
}
}
    $tp = $notteee[3];
/*新-图云水印*/
$tp = str_replace("https://on.ordylan.com/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
$tp = str_replace("https://ordylan.com/HSP/ON/v2/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
/*新-图云水印*/
    $tp = explode('|', $tp);

$tpi2 = "[图片扫描文本]";//隐藏扫描文本
    if($_GET["imageall"] == "true"){
    for ($j = 0; $j < count($tp)-1; $j++) {
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle") || $_GET["imgaa"] == "t"){$tpi = $tpi.'<img src="'.$tp[$j].'" id="imagee" alt="note_image_'.($j+1).'">';}else{
         $tpi = $tpi.'<img data-src="'.$tp[$j].'" id="imagee" alt="note_image_'.($j+1).';SCANTEXT_'.$tpi2.'" class="lazyload" src="'.$loadimg.'">';}
    } 
    if($tp[0] == "HTML_MODE"){
                 $tpi = '<!--<base href="/images/htmls/'.$idd.'/">-->';
            $fffi = fopen("images/htmls/".$tn[$i]."/index.html", 'r');
            while(!feof($fffi)){
         //echo fgets($fffi).'\n';
          $tpi = $tpi.fgets($fffi);
            }
        fclose($fffi);
         }}else{$tpi = "图片过多已隐藏!点击上方\"更多>\"查看完整笔记或在顶部标题处选择\"展示全部图片\"!";}
    
if(file_exists("images/search_img_scan_text/".$tn[$i].".ordylandata")){
        $fffi2 = fopen("images/search_img_scan_text/".$tn[$i].".ordylandata", 'r');
            while(!feof($fffi2)){
          $tpi2 = $tpi2.fgets($fffi2);
            }
        fclose($fffi2);
}

if($onpass == "false"){
if($mode == "tags")$aqq="t";
if($_GET["token"] != $tokena && $mode == "collections" ) $aqq="t";
if($aqq=="t"){$bt = "你好啊, 你提供的令牌无法确认你是主人, 非常抱歉! ";$tpi2 = "[图片扫描文本获取失败o]";$sj = "解决方案:";$zy = "1.在<a href=\"/passport.php\">[这里]</a>输入6位正确数字以证明(查看全部笔记).";$tpi = "";$tpi2 = "";if($_GET["imageall"] == "true"){for($j = 0; $j < count($tp)-1; $j++) {$tpi = $tpi.'<img id="imagee" class="|#nopass#|" data-src="|#nopass#|" alt="未通过pass" src="'.$loadimg.'">';}}else{$tpi = "图片过多已隐藏!点击上方\"更多>\"查看完整笔记或在顶部标题处选择展示全部图片!";}}
}
$tpi2 = str_ireplace(array('<','>','&','"','\'',' '), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;'), $tpi2);
print<<<NOTE2
<div id="notee_{$tn[$i]}">
<h2 id="titlee">{$bt}<a href="/noteview/notes/{$tn[$i]}">[更多>]</a></h2>
<h3 id="timee">{$sj}</h3>
<h3 id="aboutt">{$zy}</h3>
{$tpi}
<div style='display:none;' name='textmode' id="textmode">{$tpi2}</div>
<hr>
</div>
NOTE2;
$tpi = "";$tpi2 = "";
//}


}}}

}
?>
<?php
if(!$_GET["gettexta"]){
if($_GET["mode"] == "tags" && $_GET["id"] != "1")$abc=1;else$abc=2;
if($_GET["imageall"]=="true"){$abca ="&imageall=true";}
print<<<FOOTER
<a href="#" style="width: 50px;height: 50px;text-align: center;font-weight: bold;text-decoration: none;position: fixed;bottom: 150px;right: 20px;z-index: 2000;background-color: #44b2fe;">↑</a>
<script>
/*if("1"=="{$abc}"){
        var xhrnote = new XMLHttpRequest();
        xhrnote.open('GET', window.location.pathname + "?gettexta=true{$abca}" , true);
        xhrnote.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;");
        xhrnote.onload = function (e) {
            if (this.status === 200 || this.status === 304) {
                document.getElementById("main").innerHTML = document.getElementById("main").innerHTML + xhrnote.responseText;lazyload();
            }
        };
        xhrnote.onprogress = function (e) {
            console.log("笔记加载进度", (e.loaded/e.total*100).toFixed(2) + '%')
        };
        xhrnote.send();
}*/
function changenote(n){
var noteid = Math.floor(Math.random()*n)+1;
changepage('odin',"/noteview/notes/"+noteid);
}
</script>
FOOTER;
}
?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>