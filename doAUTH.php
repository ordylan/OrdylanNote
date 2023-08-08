<?php
//doAUTH.php_验证模块
/*
require_once 'doAUTH.php';
$AUTHf = new AUTH_FUNCTION();
$onpass = $AUTHf->checklogin();

$AUTHf->login($passcode,$passnumber);
*/
class AUTH_FUNCTION{
    public function login($passcode,$passnumber){
     $pc = openssl_encrypt($passcode, 'AES-128-ECB', "ORDYLAN_Note_PASSCODE_CCCCC", 0);
     setcookie("ON_PASS_NUMBER", $passnumber ,time() + 99 * 365 * 24 * 3600,"/",'.on.ordylan.com');
     setcookie("ON_PASS_CODE", $pc ,time() + 99 * 365 * 24 * 3600,"/",'.on.ordylan.com');
     $passs = md5("ORDYLANNOTE_PASS_ID_NEWWWWWW_".$passnumber."__".$passcode."_TRUE");
     setcookie("ON_PASS",  $passs,time() + 99 * 365 * 24 * 3600,"/",'.on.ordylan.com');
   }
     public function checklogin(){
         $pc = openssl_decrypt($_COOKIE["ON_PASS_CODE"], 'AES-128-ECB', "ORDYLAN_Note_PASSCODE_CCCCC", 0);
         $passsss = md5("ORDYLANNOTE_PASS_ID_NEWWWWWW_".$_COOKIE["ON_PASS_NUMBER"]."__".$pc."_TRUE");
         if($_COOKIE["ON_PASS"] == $passsss){
             $op = "true";
         }
         else{
             $op = "false";
         }
        if($op == "true" && $pc != "odpass"){
             $op = "false";
             echo "<script>alert(\"超时请重新LOGIN! \");</script>";
        }
        return $op;
    }
}
