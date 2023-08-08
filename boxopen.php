<?php
require_once 'dolog.php';
$logF = new LOG_FUNCTION();
if ($_GET["open"] == "true") {
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);mysqli_query($sql,'SET NAMES UTF8');$result = mysqli_query($sql,"SELECT * FROM ordylannote");while($row = mysqli_fetch_array($result)){$boxnum = $row['boxnum'];$RPONa = $row['RPON'];$knowledgepointsa = $row['knowledgepoints'];$ischeckin = $row['checkin'];}
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($boxnum > 0 && $onpass != "false"){//有个bug xianbuxiu
 session_start();
 if($_GET["mode"] == "kppron"){
 $awardmode = rand(1,100);
 if($awardmode>0&&$awardmode<31){$awardid=2;$count1=rand(8,20);}//kp
 elseif($awardmode>30&&$awardmode<61){$awardid=3;$count2=rand(2,8);}//tu
 else{$awardid=1;$count1=rand(5,15);$count2=rand(1,5);}//2
 $_SESSION['awardlevel'] = $awardid;
mysqli_query($sql,"UPDATE ordylannote SET knowledgepoints='".($knowledgepointsa+$count1)."';");
mysqli_query($sql,"UPDATE ordylannote SET RPON='".($RPONa+$count2)."';");
if($ischeckin){mysqli_query($sql,"UPDATE ordylannote SET boxnum='".($boxnum-1)."';");$abababaa=1;}
else{mysqli_query($sql,"UPDATE ordylannote SET checkin='true';");}
$logF->addlogs(1,"开箱得到点|图:kp_".$count1."(共".($knowledgepointsa+$count1)."个);pron_".$count2."(共".($RPONa+$count2)."个);(剩余宝箱".($boxnum-$abababaa)."个)","成功","开箱游戏|/boxopen.php");
  //  header('Location: https://on.ordylan.com/openbox.php?'.time());
  }
 elseif($_GET["mode"] == "card"){{
     $awardlist = Array('exam/yw','exam/sx','exam/yy','exam/wl','exam/hx','exam/sw','exam/dl','exam/zz','exam/ls','exam/all'); 
     $awardmode = rand(0,count($awardlist)-1);
     $hard = rand(1,10);
     /*$awardmode = 9;测试
     $hard = 6;*/
     //zk临时
     //     $hard = 6;

     if($awardmode == 9){
        if($hard != 6){//稀有卡概率1%
        $sql->close();
            exit("<script>window.location.href = 'https://on.ordylan.com/boxopen.php?open=true&mode=card';</script>");
        }
     }
     $result1 = mysqli_query($sql,"SELECT * FROM ordylannotecard");
     while($row1 = mysqli_fetch_array($result1)){$abcccc = $row1[$awardlist[$awardmode]];}
     mysqli_query($sql,"UPDATE ordylannotecard SET `".$awardlist[$awardmode]."`='".($abcccc+1)."';");
     //echo "UPDATE ordylannotecard SET ".$awardlist[$awardmode]."='".($abcccc+1)."';";
 $_SESSION['awardlevel'] = "files/".$awardlist[$awardmode]."";
if($ischeckin){mysqli_query($sql,"UPDATE ordylannote SET boxnum='".($boxnum-1)."';");$abababaa=1;}
else{mysqli_query($sql,"UPDATE ordylannote SET checkin='true';");}
$logF->addlogs(1,"开箱得到卡:".$awardlist[$awardmode]."(共".($abcccc+1)."张);(剩余宝箱".($boxnum-$abababaa)."个)","成功","开箱游戏|/boxopen.php");
  //  header('Location: https://on.ordylan.com/openbox.php?mode=card&'.time());
}}}
 else{
   echo "<script>alert('宝箱不足(或未登录),快去看笔记!');//window.location.href = 'https://on.ordylan.com/openbox.php';</script>";

}
$sql->close();
//exit;   

if($_GET["mode"] == "card"){
    $animations = "/simages/open_box_file/card/chouka.json";
}
elseif($_GET["mode"] == "kppron"){
    $animations = "/simages/open_box_file/chouka.json";
}
print <<<SPINE
<title>橙鸭笔记系统V2[开箱]</title>
<div id="app" style="z-index: 998;position:fixed;top:0;left:0;">

</div> <a href="javascript:void(0);" onclick="openaa();" id="kaika" style="width:100%;height:100%;position: fixed;z-index: 1000;top:0;left:0;display:none"><img style="width:100%;height:100%;position: fixed;z-index: 1000;top:0;left:0;" src="https://ordylan.com/toumbtn.png"></a>

<a href="/boxopen.php" style="position: fixed;z-index: 2001;top:0;left:0;height:10%;"><img src="/back.png" id="b" alt="back" style="position: fixed;z-index: 2001;top:0;left:0;"></a>

<script src="https://ordylan.com/js/newan/pixi.min.js"></script>
<script src="https://ordylan.com/js/newan/pixi-spine.js"></script>
<script>
const app = new PIXI.Application({
  //  backgroundColor:0xE6E6E6,
    antialias:true,transparent: true ,
    width:document.documentElement.clientWidth,
    height:document.documentElement.clientHeight
});
document.getElementById('app').appendChild(app.view);//div
let loader = PIXI.loader.add('ordylan','{$animations}');//OD.json你的json
       var skinwidth = 400;//这里写一个自适应,要换成皮肤长宽
       var skinheight = 400;//原理很简单,一点小学数学知识+平面直角坐标系知识即可
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
    ordylan.state.setAnimation(0,'chouka',false);//loop你的动画名字 true 为循环播放
    ordylan.x = skinwidth*beishu/2;//O点在中间,所以xy 坐标 长宽除以二(导出记得把动画放在中央)
    ordylan.y = skinheight*beishu/2;
app.stage.addChild(ordylan);
});

setTimeout("document.getElementById('kaika').style.display='block';",3000);
function openaa(){
document.getElementById('kaika').style.display='none';
    loader.load((loader,res)=>{
    let ordylan = new PIXI.spine.Spine(res.ordylan.spineData),
        options = [''];
    ordylan.scale.set(beishu);
    ordylan.state.setAnimation(0,'open',false);
    ordylan.x = skinwidth*beishu/2;
    ordylan.y = skinheight*beishu/2;
app.stage.addChild(ordylan);});
//setTimeout("document.getElementById('kaika').style.display='block';",3000);

}
/*
*/
</script>
SPINE;
}
?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统V2[开箱]','橙鸭笔记系统V2[开箱]<a href="/noteview/tags/1">[回首页]</a>','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>

    <p>你共有<?php $sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);mysqli_query($sql,'SET NAMES UTF8');$result = mysqli_query($sql,"SELECT * FROM ordylannote");while($row = mysqli_fetch_array($result)){$boxnum = $row['boxnum'];$ischeckin = $row['checkin'];}$sql->close();if($ischeckin){$aaasasa = 0;}else{$aaasasa = 1;}echo $boxnum."个宝箱!<br>
    概率表:知识点(8~20个) 30% <br>
           笔记残图(2~8个) 30% <br>
     笔记残图(1~5个) + 知识点(5~15个) 40%<br>
     {每日有1次免费开宝箱机会(背包内需要有宝箱),你当前还剩".$aaasasa."次!}<br>
  <a href=\"?open=true&mode=kppron\" data-cp=\"no\">[马上开箱!]</a><a href=\"?open=true&mode=card\" data-cp=\"no\">[新模式-抽符卡]</a></p>";?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>