<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统_[排行榜]','橙鸭笔记系统_趣味排行<a href="javascript:void(0);" onclick="document.getElementById(\'viewhelp\').style.display=\'block\';">[关于]</a><a href="/noteview/tags/1">[首页]</a>
','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>

<div class="allranks">
<!--<div class="rankuser"><img class="rankuserimg" src="https://on.ordylan.com/simages/KP.png">zt<div lass="rankuserlevel">Lv.0</div><div class="rankuserlevel2">0/KP</div><hr></div>

<div class="rankuser" style="position: absolute;bottom:0;left:0;background-color: #E6E0EE;"><hr><img class="rankuserimg" src="https://on.ordylan.com/simages/KP.png"><div class="rankuserlevel">Lv.0</div><div class="rankuserlevel2">0/KP</div></div>-->
<?php 
//等级>总残图 排序
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
mysqli_query($sql,'SET NAMES UTF8');

$result = mysqli_query($sql,"SELECT * FROM ordylannote");
while($row = mysqli_fetch_array($result)){
    $kp2=array($row['knowledgepoints']);
    $pron2=array($row['RPON']);
    $username2=array("ORDYLAN");
    $userimg2 = array("https://on.ordylan.com/simages/KP.png");
    $level2 = array(floor($row['knowledgepoints']/50));
}
$result = mysqli_query($sql,"SELECT * FROM ordylannoterank");

$use=array(array("kp"=>$kp2[0],"pron"=>$pron2[0],"username"=>$username2[0],"userimg"=>$userimg2[0],"level"=>$level2[0]));
while($row = mysqli_fetch_array($result)){
    $kp = $row['kp'];
    $pron = $row['pron'];
    $username = $row['username'];
    $userimg = $row['userimg'];
    $level = floor($kp/50);
    
    /*临时*/
    //$toname ="填名字";
    //if($username == $toname){$tetttKP = $kp + rand(6,12);}
    /*临时*/
    
    $tempn = array("kp"=>$kp,"pron"=>$pron,"username"=>$username,"userimg"=>$userimg,"level"=>$level);
    if($row['userid']!=0 && $row['userid'] < 10000){/* array_push($kp2,$kp);array_push($pron2,$pron);array_push($username2,$username);array_push($userimg2,$userimg);array_push($level2,$level);*/array_push($use,$tempn);}

}


if($_GET["rankdo"] == "dodo"){
    $howmanypeople = rand(3,8);
 /*临时*/
    //$tettt = rand(0,25);
    //    if($tettt == 1){
    //        mysqli_query($sql,"UPDATE ordylannoterank SET kp = '$tetttKP' WHERE username = '$toname'");
    //    }
 /*临时*/
    for ($i = 0; $i < $howmanypeople; $i++) {
        // $thisperson = rand(1,count($use));
         $thisperson = rand(1,50);
         $hisname = $use[$thisperson]["username"];
         $hisKP = $use[$thisperson]["kp"] + rand(0,6);
         $hisPRON = $use[$thisperson]["pron"] + rand(0,2);
        
        //$aaaaaaaaaa= $aaaaaaaaaa.'UPDATE `users`.`ordylannoterank` SET `kp` = "'.$hisKP.'" WHERE `ordylannoterank`.`username` = "'.$hisname.'";UPDATE `users`.`ordylannoterank` SET `pron` = "'.$hisPRON.'" WHERE `ordylannoterank`.`username` = "'.$hisname.'";';
        
        $qqq = mysqli_query($sql,"UPDATE ordylannoterank SET kp = '$hisKP' WHERE username = '$hisname'");
       $qqq = mysqli_query($sql,"UPDATE ordylannoterank SET pron = '$hisPRON' WHERE username = '$hisname'");
        
        
        
        $aaaaaaaaaa= $aaaaaaaaaa."UPDATE ordylannoterank SET kp = '$hisKP' WHERE username = '$hisname';\nUPDATE ordylannoterank SET pron = '$hisPRON' WHERE username = '$hisname';\n";

        
        
        //$aaaaaaaaaa= $aaaaaaaaaa."UPDATE `users`.`ordylannoterank` SET `kp` = $hisKP WHERE `ordylannoterank`.`userid` = $thisperson ;UPDATE `users`.`ordylannoterank` SET `pron` = $hisPRON WHERE `ordylannoterank`.`userid` = $thisperson;";
        //$aaaaaaaaaa= $aaaaaaaaaa."UPDATE ordylannoterank SET kp = $hisKP WHERE userid = $thisperson;UPDATE ordylannoterank SET pron = $hisPRON WHERE userid = $thisperson;";

//echo($thisperson.$hisname.$hisKP.$hisPRON."11111111");echo("aa"."UPDATE `users`.`ordylannoterank` SET `kp` = '".$hisKP."' WHERE `ordylannoterank`.`username` = '".$hisname."';UPDATE `users`.`ordylannoterank` SET `pron` = '".$hisPRON."' WHERE `ordylannoterank`.`username` = '".$hisname."';"."qqqqqqqqqqqq".$aaaaaaaaaa."qqqqqqqqqqq");
    }
//$qqq = mysqli_query($sql,$aaaaaaaaaa);
echo(var_dump($aaaaaaaaaa).$qqq->error);







}
/*
开始
if($_GET["rankdo"] == "start"){
function getname($uid){
  if($uid == null){$uname = "未知用户";}
elseif($uid == 1){$uname = "*";}
//.......
else              {$uname = "未知用户";}
return $uname;
}
for ($i = 1; $i < 51; $i++) {
    
    $abaa = $abaa.'INSERT INTO `users`.`ordylannoterank` (`username`, `userimg`, `kp`, `pron`, `userid`) VALUES ("'.getname($i).'", "", "555", "100", "'.$i.'");';
    //rand(466,588)rand(88,128)

}
mysqli_query($sql,$abaa);echo $abaa;}
*/

$sql->close();
//asort($kp2);

///////////////////////////Temp__添加星号1///////////////////////////////////////
$aaaaas = $_GET["r"];

  require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass == "true"){$aaaaas = "t";}

else echo("<script>alert('未登录隐藏昵称')</script>");
//////////////////////////\Temp__添加星号1///////////////////////////////////////

$ages = array();
foreach ($use as $user) {$ages[] = $user['kp'];}array_multisort($ages, SORT_DESC, $use);
for ($i = 0; $i < count($use); $i++) {
//echo("名字:".$use[$i]["username"]."等级:".$use[$i]["level"]."(".$use[$i]["kp"].")"."cantu:".$use[$i]["pron"]."头像:".$use[$i]["userimg"]."<br>");
if(!$use[$i]["userimg"])$imgaa = "https://on.ordylan.com/simages/head.png";else$imgaa = $use[$i]["userimg"];
$unun = $use[$i]["username"];

///////////////////////////Temp__添加星号2///////////////////////////////////////
if($use[$i]["username"] != "ORDYLAN" && $aaaaas != "t") {
$str = $unun;$l = 1;$r = 0;$chr_len = 2;$chr = '*';
$len_min = $l + $r;
$unun = mb_substr($str,0,$l,'utf-8') . str_repeat($chr,$chr_len) . mb_substr($str,mb_strlen($str,'utf-8') - $r,$r);}
//////////////////////////\Temp__添加星号2///////////////////////////////////////

$aa = '<div class="rankuseraaaaaa">'.($i+1).'</div><img class="rankuserimg" src="'.$imgaa.'"><div class="rankusername">'.$unun.'</div><div class="rankuserlevel">Lv.'.$use[$i]["level"].'</div><div class="rankuserlevel2">'.$use[$i]["kp"].'/KP|'.$use[$i]["pron"].'/PRON</div>';

if($use[$i]["username"] == "ORDYLAN") {$aaa = '<div class="rankuser" style="position: absolute;bottom:0;left:0;background-color: #E6E0EE;">'.$aa."</div>";$aaaaaaa= "<div class=\"rankuser\" style='border:3px solid #000;'>"; }else{ $aaaaaaa= "<div class=\"rankuser\" style='border:1px solid grey;'>";}

echo($aaaaaaa.$aa."</div>");
}
echo($aaa);
?>
</div>
<div id="viewhelp" style="display: none; overflow: scroll;" class="tanchulaidekuang">
<a href="javascript:void(0);" onclick="document.getElementById('viewhelp').style.display='none';">[退出]</a><p>&gt;&gt;关于&lt;&lt;
<br>
此排行榜只是个游戏, 全部数据(除ORDYLAN)均由大数据随机生成! 此榜每78分钟刷新一次,每次刷新都会有1-7人进行学习升级. 排行榜上的用户名以及头像(除ORDYLAN)都与真人无关! <br>(虚拟用户将以555/KP|100/PRON为基础数据进行升级)<br></p>
<br><br><br><br><br>
</div>

<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
