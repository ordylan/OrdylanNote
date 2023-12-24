<?php if($_GET["imageall"] != "true"){$AA=  "<a href=\"?imageall=true\">[展示图]</a>";}else{$AA= "<a href=\"/s/".$_GET["note"]."\">[隐藏图]</a>";}require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统V2[搜索笔记]','搜索-笔记系统<a href="/noteview/tags/1">[首页]</a>'.$AA,'href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>
<script>
 function updateUrl(key, value){
var newurl = updateQueryStringParameter(key, value)
 window.history.replaceState({path: newurl},'', newurl);}
  function updateQueryStringParameter(key, value) {
var uri = window.location.href
if(!value) {return uri;}
var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");var separator = uri.indexOf('?') !== -1 ? "&" : "?";if (uri.match(re)) {return uri.replace(re, '$1' + key + "=" + value + '$2');}else {return uri + separator + key + "=" + value;}}
</script>
<p>Search For Something: <input type="text" id="note"><a href="javascript:void(0);" onclick="window.location.href = 'https://on.ordylan.com/s/' + document.getElementById('note').value;">[GO!]</a> | <a href="javascript:void(0);" onclick="updateUrl('img', 'true');window.location.href = window.location.href;">[开启</a>/<a href="javascript:void(0);" onclick="updateUrl('img', 'false');window.location.href = window.location.href;">关闭]</a>图片搜索</p><br>
<?php
if($_GET["note"]){
$notenum = file('allnotes.ordylandata');
$notenum = $notenum[0];
   for ($i = $notenum; $i > 0 ; $i--) {
    $notteee = file("notes/".$i.'.ordylandata')[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $bt = $notteee[0];
    $sj = "".date("Y-m-d H:i:s",intval($notteee[1]/1000))."";
    $zy = $notteee[2];
    $tp = $notteee[3];
    $tp = str_replace("https://on.ordylan.com/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
    $tp = str_replace("https://ordylan.com/HSP/ON/v2/images/", "https://onimagecloud.ordylan.com/NoteImg/", $tp);
    $tp = explode('|', $tp);
    for ($j = 0; $j < count($tp)-1; $j++) {
        if(strstr($_SERVER['HTTP_USER_AGENT'],"Kindle")){$tpi = $tpi.'<img src="'.$tp[$j].'" id="imagee" alt="note_image_'.($j+1).'_scantext_'.$tpi2.'">';}else{
         $tpi = $tpi.'<img data-src="'.$tp[$j].'" id="imagee" alt="note_image_'.($j+1).'_scantext_[隐藏]'.'" class="lazyload" src="/simages/loading.gif">';}
    }
    if($tp[0] == "HTML_MODE"){
        $tpi = "";
        $tpi = '<!--<base href="/images/htmls/'.$i.'/">-->';
        $fffi1 = fopen("images/htmls/".$i."/index.html", 'r');
        while(!feof($fffi1)){$tpi = $tpi.fgets($fffi1);}
        fclose($fffi1);
}
if($_GET["img"] == "true"){
if(file_exists("images/search_img_scan_text/".$i.".ordylandata")){
        $fffi2 = fopen("images/search_img_scan_text/".$i.".ordylandata", 'r');
            while(!feof($fffi2)){
          $tpi2 = $tpi2.fgets($fffi2);
            }
        fclose($fffi2);
//$aaaaaaa1 = "strstr(\$bt, \$_GET['note']) || strstr(\$tpi2, \$_GET['note']) || strstr(\$zy, \$_GET['note']) || strstr(\$sj, \$_GET['note'])|| strstr(\$notteee[1], \$_GET['note'])";
}
//else {$aaaaaaa1 = "strstr(\$bt, \$_GET['note']) || strstr(\$zy, \$_GET['note']) || strstr(\$sj, \$_GET['note'])|| strstr(\$notteee[1], \$_GET['note'])";}

}
if(strstr($bt, $_GET['note']) || strstr($tpi2, $_GET['note']) || strstr($zy, $_GET['note']) || strstr($sj, $_GET['note'])|| strstr($notteee[1], $_GET['note'])){
    $bt = "<p>".$bt."</p>";
    $zy = "<p>".$zy."</p>";
    $bt = str_replace($_GET["note"], '<strong><font color="#FF0000">'.$_GET["note"].'</font></strong>', $bt);
    $zy = str_replace($_GET["note"], '<strong><font color="#FF0000">'.$_GET["note"].'</font></strong>', $zy);
    //$bt = str_replace($_GET["note"], '</p><p style="color:red;">'.$_GET["note"].'</p><p>', $bt);
    //$zy = str_replace($_GET["note"], '</p><p style="color:red;">'.$_GET["note"].'</p><p>', $zy);

    
    /*$tpi2 = str_split($tpi2, 1);
    for ($j = 0; $j < count($tpi2); $j++) {
        $tpi3 = $tpi3."<p>".$tpi2[$j]."</p>";
    }
    $tpi2 = $tpi3;
    $tpi2 = str_ireplace(array('<p>','</p>'), array('PPPPP<<<','PPPPP>>>'), $tpi2);*/
    $tpi2 = str_ireplace(array('<','>','&','"','\'',' ','PPPPP<<<','PPPPP>>>'), array('&lt;','&gt;','&amp;','&quot;','&qpos;','&nbsp;','<p>','</p>'), $tpi2);

    if(strstr($tpi2, $_GET['note'])){$bt = "<strong><font color=\"#FF0000\">[图片匹配]</font></strong>".$bt."";
        $tpi2 = str_ireplace($_GET['note'], "<strong><font color=\"#FF0000\">".$_GET['note']."</font></strong>", $tpi2);
    }
    if(strstr($sj, $_GET["note"]) || strstr($notteee[1], $_GET["note"])){$sj = '<strong><font color="#FF0000">'.$sj.'</font></strong>';}
    if($_GET["imageall"] != "true"){ $tpi = "图片过多已隐藏! 点击上方\"详情>\"查看完整笔记或在顶部标题处选择\"展示全部图片\"!";}
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass == "false"){$bt = "你好啊, 你提供的令牌无法确认你是主人, 非常抱歉! ";$sj = "解决方案:";$zy = "1.在<a href=\"/passport.php\">[这里]</a>输入6位正确数字以证明(查看全部笔记).";$tpi = "图片获取失败.";}
    
if($onpass != "false"){echo "<p style='display:block;' id='textmode'>".$tpi2."</p>";}

    print<<<NOTE2
<script>console.log('Note_Search');</script>
<div id="notee_{$i}">
<h2 id="titlee">{$bt}<a href="/noteview/notes/{$i}">[详情>]</a></h2>
<h3 id="timee">{$sj}</h3>
<h3 id="aboutt">{$zy}</h4>
{$tpi}
<hr>
</div>
NOTE2;
$tpi = "";$tpi2="";
}
else{$tpi = "";$tpi2="";}
   }
}

$aaa = addslashes($_GET["note"]);
print<<<SCRIPT
<a href="#" style="width: 50px;height: 50px;text-align: center;font-weight: bold;text-decoration: none;position: fixed;bottom: 150px;right: 20px;z-index: 2000;background-color: #44b2fe;">↑</a>
<style>p{display: inline-block;margin-top:0;}</style>
<script>
 document.getElementById('note').value = "{$aaa}";
</script>
SCRIPT;
?>
<hr>
No More
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
