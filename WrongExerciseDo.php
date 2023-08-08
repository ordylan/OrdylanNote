<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统_错题练习','ON错题刷<a href="/noteview/tags/1">[S首]</a><a href="/WED/">[首]</a><a href="/WED/?showall=true">[全]</a><a href="/WED/?showall=hidden">[藏]</a><a href="javascript:void(0);" onclick="document.getElementById(\'map\').style.display=\'block\';">[据点]</a>','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath'."+'#Q_".$_GET["id"]."'".');"',"","");?>

    
    
<?php
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass != "true"){
    echo "<p>你还未登录! 功能使用将受限!<br><a href=\"/passport.php\">去登录</a>";
}
else{
if ($_GET["up"] == "true") {
   if(!$_POST["s"] || $_POST["u"] ||$_POST["ai"]){exit("<script>alert('No Title Or File!');window.location.href = 'https://on.ordylan.com/WrongExerciseDo.php';</script>");}
    $sqlinfo = file('SqlPass.ordylandata');
    $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
    $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
    mysqli_query($sql,'SET NAMES UTF8');
    $ALL = mysqli_query($sql,"SELECT COUNT(*) FROM `WED`");
    $ALL = mysqli_fetch_array($ALL)[0] + 1;
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    if(count($_FILES["u"]["name"]) != 1 || count($_FILES["ai"]["name"]) != 1){exit("<script>alert('文件太多了, 一次只有一个哦!');window.location.href = 'https://on.ordylan.com/WrongExerciseDo.php';</script>");}
    
    $FileTmp_Name = $_FILES["u"]["tmp_name"][0];
    $fname1 = "Q_".$ALL.".".explode('.',$_FILES["u"]["name"][0])[count(explode('.',$_FILES["u"]["name"][0]))-1];
    move_uploaded_file($FileTmp_Name, "images/WEDimages/".$fname1); 
if(!strstr($fname1."|",".|")){
    $aaaa1 = "https://on.ordylan.com/images/WEDimages/$fname1";
}
    $FileTmp_Name = $_FILES["ai"]["tmp_name"][0];
    $fname2 = "A_".$ALL.".".explode('.',$_FILES["ai"]["name"][0])[count(explode('.',$_FILES["ai"]["name"][0]))-1];
    move_uploaded_file($FileTmp_Name, "images/WEDimages/".$fname2);
if(!strstr($fname2."|",".|")){
    $aaaa2 = "https://on.ordylan.com/images/WEDimages/$fname2";
}
    mysqli_query($sql,"INSERT INTO `on`.`WED` (`id`, `s`, `u`, `i`, `ai`, `a`, `d`, `r`) VALUES ('$ALL', '".$_POST["s"]."', '$aaaa1', '".$_POST["i"]."', '$aaaa2', '".$_POST["a"]."', '$msectime', '0');");
    $sql->close();
    exit("<script>window.location.href = 'https://on.ordylan.com/WED/$ALL';</script>");
}
else{
    if($_GET["id"]){
    $sqlinfo = file('SqlPass.ordylandata');
    $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
    $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
    mysqli_query($sql,'SET NAMES UTF8');
        $ALL = mysqli_query($sql,"SELECT COUNT(*) FROM `WED`");
    $ALL = mysqli_fetch_array($ALL)[0];
    if($_GET["r"] == "t"){
      mysqli_query($sql,"UPDATE WED SET r='1' WHERE id=".$_GET["id"]);
    echo("<script>alert('已隐藏');</script>");
    }
    elseif ($_GET["r"] == "f") {
      mysqli_query($sql,"UPDATE WED SET r='0' WHERE id=".$_GET["id"]);
    echo("<script>alert('已恢复');</script>");
    }
    elseif ($_GET["r"] == "s") {
      mysqli_query($sql,"UPDATE WED SET r='99' WHERE id=".$_GET["id"]);
     echo("<script>alert('已收藏');</script>");//测试 , 别用
    }
    $result = mysqli_query($sql,"SELECT * FROM WED WHERE id=".$_GET["id"]);
    while($row = mysqli_fetch_array($result)){
                $subjecttag = $row['s'];
        $subjecttag = str_ireplace(array('11','12','13','14','15','16','17','18','19','21','22','23','24','25','26','27','28','29'), array('<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/5.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/5.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.4.png">'), $subjecttag);
    $iiiiiii = str_ireplace(array('{GOODQ}','{EASYW}','{STAR}'), array('<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/goodq.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/easyw.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/favourite.png">'), $row['i']);

        if($row['u']){$taaa = "<img src='".$row['u']."' id='imagee'>";}else{$taaa="";}
        if($row['ai']){$taaa2 = "<img src='".$row['ai']."' id='imagee'>";}else{$taaa2="";}
        $timu = "<a href='?r=t&id=".$_GET["id"]."'>[隐藏该题]</a><p>Subject: ".$subjecttag."<br>Intruduction: ".$iiiiiii."<br>".date("Y-m-d H:i:s",($row['d']/1000))."</p>".$taaa."<br><input type=\"text\" id='aa'><a href=\"javascript:void(0);\" onclick=\"document.getElementById('showa').style.display='block';ca ();\">[提交答案]</a><div id='showa' style=\"display: none;\"><p>Answer: <br>".$row['a']."</p>".$taaa2."</div><script>
        function ca (){
            var ra=\"".addslashes($row['a'])."\";
            if (document.getElementById('aa').value == ra){
                alert('你答对了');
            }
            else{
                alert('你答错了');
            }
        }
        
        </script>";
        }
    $sql->close();
    /*新-图云水印*/
$timu = str_replace("https://on.ordylan.com/images/", "https://onimagecloud.ordylan.com/NoteImg/", $timu);
/*新-图云水印*/
  print<<<a
<br><a href="javascript:void(0);" onclick="change({$ALL});">[随机练习]</a>{$timu}
a;
    }
    else{
            $sqlinfo = file('SqlPass.ordylandata');
    $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
    $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
    mysqli_query($sql,'SET NAMES UTF8');
    $ALL = mysqli_query($sql,"SELECT COUNT(*) FROM `WED`");
    $ALL = mysqli_fetch_array($ALL)[0];
    $result = mysqli_query($sql,"SELECT * FROM WED");
                $shownum =0;

    while($row = mysqli_fetch_array($result)){
        $taaaaya = $row['r'];$aabba="&gt;展示题目库&lt;";
        if($_GET["showall"] == "true"){$taaaaya = 0;$aabba="&gt;全部题目库&lt;";}
        elseif($_GET["showall"] == "hidden"){
            if($taaaaya == 0){$taaaaya = 1;$aabba="&gt;隐藏题目库&lt;";}else $taaaaya = 0;}
        if($taaaaya == 0){
            $shownum ++;
            if($row['r'] != 0){
                $taaana = "<a href='?r=f&id=".$row['id']."'>[重新展示该题]</a>";
            }else {$taaana = "";}
        if($row['u']){$taaa = "<img src='".$row['u']."' id='imagee'>";}else{$taaa="";}
        $subjecttag = $row['s'];
        $subjecttag = str_ireplace(array('11','12','13','14','15','16','17','18','19','21','22','23','24','25','26','27','28','29'), array('<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/5.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/4.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/5.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.1.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.2.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.3.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/6.4.png">'), $subjecttag);
    $iiiiiii = str_ireplace(array('{GOODQ}','{EASYW}','{STAR}'), array('<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/goodq.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/easyw.png">','<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/favourite.png">'), $row['i']);

        $timu = "<div id=\"Q_".$row['id']."\">".$taaana."<a href='/WED/".$row['id']."'>[GO>".$row['id']."]</a><p>Subject: ".$subjecttag."<br>Intruduction: ".$iiiiiii."<br>".date("Y-m-d H:i:s",($row['d']/1000))."</p>".$taaa."</div><hr>".$timu;}
        }
        
    if(!$_GET["showall"]){ $tipppppp="还剩".$shownum."题, 加油!";  if($shownum==0){$tipppppp="恭喜你完成了全部错题!!";}
}
            $timu = $tipppppp."<a href=\"javascript:void(0);\" onclick=\"change($ALL);\">[随机练习]</a><hr>".$timu;
/*新-图云水印*/
$timu = str_replace("https://on.ordylan.com/images/", "https://onimagecloud.ordylan.com/NoteImg/", $timu);
/*新-图云水印*/
print<<<a
<a href="#upload">[上传题]</a><p>你现在在: {$aabba} ! </p><hr>
{$timu}
<div id="upload">
--Upload Q--
<form action="/WrongExerciseDo.php?up=true" enctype="multipart/form-data" method="post">
<h2>
*Subject: <input type="number" name="s"><br>
Introduction<!--(好题前面加<a href="javascript:void(0);" onclick="document.getElementsByName('i').value+='{GOODQ}';">{GOODQ}</a>)-->: <input type="text" name="i"><br>
Q Image: <input type="file" name="u[]" ><br>
Q Answer({AAA}分割): <input type="text" name="a"><br>
Q Answer Image: <input type="file" name="ai[]" multiple="multiple"><br>
</h2>
<input type="submit">
</form><hr>
<div>Tags:<br>{STAR}_<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/favourite.png"><br>{EASYW}_<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/easyw.png"><br>{GOODQ}_<img class="tinytag" src="https://on.ordylan.com/simages/tinytags/goodq.png"></div>
</div>
a;
    $sql->close();
}
    
}}
?>

<a href="#" style="width: 50px;height: 50px;text-align: center;font-weight: bold;text-decoration: none;position: fixed;bottom: 150px;right: 20px;z-index: 2000;background-color: #44b2fe;">↑</a>
<div id="map" style="display:none;height:100%;width:100%;top:0;position:fixed;z-index:888;"><!--<img src="/simages/map.svg?t=" style="height:100%" id="bmap"/>--><iframe src="#" id="bigmap" style="width: 100%;height: 100%;"></iframe><a href="javascript:void(0);" onclick="document.getElementById('map').style.display='none';"  style="top:0;position:fixed;z-index:900;left:0;">[关闭]</a><a href="/simages/map.svg?newpage" id="bigmapopen" style="top:0;position:fixed;z-index:900;right:0;" target="_blank">[新页面看大图]</a><!--<a href="javascript:void(0);" onclick="document.getElementById('bmap').src+=Number(new Date());" style="bottom:0;position:fixed;z-index:900;left:0;">[刷新地图]</a>--></div>
<script>//document.getElementById("bmap").src="/simages/map.svg?t="+Number(new Date());
document.getElementById("bigmap").src="/simages/map.svg?t="+Number(new Date());document.getElementById("bigmapopen").href="/simages/map.svg?t="+Number(new Date());
function change(n){
var noteid = Math.floor(Math.random()*n)+1;
changepage('odin',"/WED/"+noteid);
}</script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
