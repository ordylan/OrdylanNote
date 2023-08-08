<?php
//Shell自执行 清空临时数据库
if($_GET["CLEARDATTTA"] == "ononoonhhhhh"){
    $sqlinfo = file('SqlPass.ordylandata');
    $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
    $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
    mysqli_query($sql,'SET NAMES UTF8');
    mysqli_query($sql,"UPDATE ordylannote SET dailyview1='';");
    mysqli_query($sql,"UPDATE ordylannote SET dailyview2='';");
    mysqli_query($sql,"UPDATE ordylannote SET dailyview3='';");
    mysqli_query($sql,"UPDATE ordylannote SET checkin='';");
    $sql->close();
}
//dolog.php_日志模块
/*
require_once 'dolog.php';
$logF = new LOG_FUNCTION();

$logF->addlogs(1,"上传文件:$aaa","成功","文件上传|/upfile.php");
*/
class LOG_FUNCTION{
    public function addlogs($fileid,$logtextq,$tipstext,$modetext){
        /*if($fileid == 1) $file = "log.ordylandata";
        $logfile = fopen($file, 'r');
        $logtext = fread($logfile, filesize($file));
        fclose($logfile);
        $logtext = "<tr><td>".$tipstext."</td><td>".$modetext."</td><td>".$logtextq."</td><td>".date('m/d/Y h:ia')."</td><td>".$_SERVER["REMOTE_ADDR"]."</td></tr>\n".$logtext;
        $logfile = fopen($file, 'w');
        fwrite($logfile, $logtext);
        fclose($logfile);*/
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        $sqlinfo = file('SqlPass.ordylandata');
        $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
        $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
        mysqli_query($sql,'SET NAMES UTF8');
        $result = mysqli_query($sql,"INSERT INTO `on`.`onlogs` (`tips`, `nameurl`, `logtext`, `time`, `ip`) VALUES ('$tipstext', '$modetext', '$logtextq', '$msectime', '".$_SERVER["REMOTE_ADDR"]."')");
        $sql->close();
   }
    public function readlogs($fileurl){
        /*
        $logfile = fopen($fileurl, 'r');
        $logtext = fread($logfile, filesize($fileurl));
        fclose($logfile);
        $logtext = "old log<table border=\"1\"><tbody><tr><td>提示</td><td>项目名称|路径</td><td>日志文字</td><td>时间</td><td>IP</td></tr>".$logtext."</tbody></table>";

        */
        $sqlinfo = file('SqlPass.ordylandata');
        $sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);$sqlinfo = str_replace("\n","", $sqlinfo);
        $sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
        mysqli_query($sql,'SET NAMES UTF8');
        

      ///  $result = mysqli_query($sql,"SELECT * FROM onlogs");
     $ALL = mysqli_query($sql,"SELECT COUNT(*) FROM `onlogs`");
     $ALL = mysqli_fetch_array($ALL)[0]-100;
      $result =  mysqli_query($sql,"select * from onlogs limit $ALL,100");
     $q=$ALL;
        while($row = mysqli_fetch_array($result)){$q++;
            //if($ALL-$q<100){
            $logtext = "<tr><td>".$q."</td><td>".$row['tips']."</td><td>".$row['nameurl']."</td><td>".$row['logtext']."</td><td>".date("Y-m-d H:i:s",($row['time']/1000))."</td><td>".$row['ip']."</td></tr>".$logtext;}
       // }
        $sql->close();
        $logtext = "<table border=\"1\" style='word-break: break-all;'><tbody><tr><td>序号(最后100条)</td><td>提示</td><td>项目名称|路径</td><td>日志文字</td><td>时间</td><td>IP</td></tr>".$logtext."</tbody></table>";
        
        $logtext = str_replace("https://on.ordylan.com/images/", "{FilePath}", $logtext);

        return $logtext;
   }
}
