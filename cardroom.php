<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD('橙鸭笔记系统V2','橙鸭笔记系统[卡牌馆]<a href="/noteview/tags/1">[回首页]</a>','href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>

    
    <?php
    $sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);mysqli_query($sql,'SET NAMES UTF8');$result = mysqli_query($sql,"SELECT * FROM ordylannotecard");
    $awardlist = Array('exam/yw','exam/sx','exam/yy','exam/wl','exam/hx','exam/sw','exam/dl','exam/zz','exam/ls','exam/all'); 
    while($row = mysqli_fetch_array($result)){
        for ($i = 0; $i < count($awardlist); $i++) {
             ${"cardnum_".$awardlist[$i]} = $row[$awardlist[$i]];
        }
    }
    for ($i = 0; $i < count($awardlist); $i++) {
        if(${"cardnum_".$awardlist[$i]} > 0){
            echo "<div class='card' style='border:3px solid #000;'><img src='/simages/cards/".$awardlist[$i].".png'><p>x".${'cardnum_'.$awardlist[$i]}."</p></div>";
        }
    }

$sql->close();
    ?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
