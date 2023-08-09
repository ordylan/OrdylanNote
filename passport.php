<?php
class PHPGangsta_GoogleAuthenticator
{
    protected $_codeLength = 6;
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }

        $secretkey = $this->_base32Decode($secret);

        // Pack time into binary string
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);

        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;

        $modulo = pow(10, $this->_codeLength);

        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }

        if (strlen($code) != 6) {
            return false;
        }

        for ($i = -$discrepancy; $i <= $discrepancy; ++$i) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($this->timingSafeEquals($calculatedCode, $code)) {
                return true;
            }
        }

        return false;
    }
    protected function _base32Decode($secret)
    {
        if (empty($secret)) {
            return '';
        }
        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);

        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) {
            return false;
        }
        for ($i = 0; $i < 4; ++$i) {
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) {
                return false;
            }
        }
        $secret = str_replace('=', '', $secret);
        $secret = str_split($secret);
        $binaryString = '';
        for ($i = 0; $i < count($secret); $i = $i + 8) {
            $x = '';
            if (!in_array($secret[$i], $base32chars)) {
                return false;
            }
            for ($j = 0; $j < 8; ++$j) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); ++$z) {
                $binaryString .= (($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48) ? $y : '';
            }
        }

        return $binaryString;
}
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '=',  // padding char
        );
    }
    private function timingSafeEquals($safeString, $userString)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($safeString, $userString);
        }
        $safeLen = strlen($safeString);
        $userLen = strlen($userString);

        if ($userLen != $safeLen) {
            return false;
        }

        $result = 0;

        for ($i = 0; $i < $userLen; ++$i) {
            $result |= (ord($safeString[$i]) ^ ord($userString[$i]));
        }
        return $result === 0;
    }
}

require_once 'dolog.php';
$logF = new LOG_FUNCTION();

$ga = new PHPGangsta_GoogleAuthenticator();
$Code = $ga->getCode("ORDYLAN_NOTE");
if($_POST["passnumber"] && $_POST["passcode"]){
if($ga->verifyCode("ORDYLAN_NOTE",$_POST["passnumber"]) && $_POST["passcode"] == "odpass"){
    require_once 'doAUTH.php';
    $AUTHf = new AUTH_FUNCTION();
        $AUTHf->login($_POST["passcode"],$_POST["passnumber"]);
     if($_GET["back"] == "2022sh"){$aaaaa = "https://ordylan.com/HSP/2022_SH_Checklist/";}else{$aaaaa = "https://on.ordylan.com/noteview/tags/1";}
     $logF->addlogs(1,"登录系统: ".$_POST["passnumber"],"成功","通行证|/passport.php");
     echo "<script>alert(\"校验通过,欢迎回家! \");window.location.href = '".$aaaaa."';</script>";
}
else{echo "<script>alert(\"校验未通过! \");</script>";$logF->addlogs(1,"失败登录系统","失败","通行证|/passport.php");}}
if($_GET["pass"] == "true"){$logF->addlogs(1,"获取系统密码: ".$Code,"成功","通行证|/passport.php");echo "<script>alert(\"Now PassCode : ".$Code."\");</script>";}

?>

<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD("橙鸭笔记系统V2_通行证","橙鸭笔记系统[通行证]",'href="javascript:void(0);" onclick="changepage(\'odback\',localStorage.ON_LastPath);"',"","");?>
<h1>Enter six digits and passcode, and start your journey of notes!</h1>
<form action="#" method="post">
<h2>Pass Code: <input type="password" name="passcode"></h2>
<h2>Pass Number: <input type="number" name="passnumber" min="0" max="999999"></h2>
<!--临时加个, 橙鸭心情算法见很久以前发的那个啥游戏手稿, 该键暂时无用
<h2>Today's ORDYLAN's Feeling (Enter Feeling ID): <input type="number" name="feeling" min="1" max="5"></h2><br> -->
<br>
<input type="submit">
</form>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
