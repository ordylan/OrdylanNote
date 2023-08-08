<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统_内部功能','笔记系统_内部功能<a href="/noteview/tags/1">[首]</a>','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>
<?php
  require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();
if($onpass != "true"){
    echo "<p>你还未登录! 功能使用将受限!<br><a href=\"/passport.php\">去登录</a>";
}
else{
print<<<a
<!--<a href="/StudyPlace.php?vlist=get&PANid=G">[视频表]</a>-->
<a href="/TempLis.php">[Ttask]</a>
<a href="https://ordylan.com/HSP/NewStudy/" data-cp="no">[课表]</a>
<a href="/StudyPlace.php?log=get">[系统日志]</a>
<a href="/WrongExerciseDo.php">[错题刷]</a>
<a href="https://onimagecloud.ordylan.com/cloudsetting.php" data-cp="no">[图云后台]</a>


a;
}
?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>