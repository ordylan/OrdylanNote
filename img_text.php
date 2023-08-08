<?php 
$bottom = $_POST["bottom"];
$texxxt = $_POST["toptext"];
$colorr = $_POST["color"];
$tsize1 = $_POST["tsize"];

if($texxxt){
 //$imgSrc = 'images/1667651768603_1_660920.png';
 if(!$_FILES["File"]["tmp_name"][0])exit("图片未上传");
 // header('content-type:image/jpeg;charset="utf-8"');
 print<<<O
 <script>
function downloadall(){
document.getElementById("ddddd").innerHTML="";
let n = document.getElementsByTagName("img");
var x = 0;
for(i of n){
var dlLink = document.createElement('a');
x++;
dlLink.download = 'ordylannote_image_'+ x + "_"+ Number(new Date())+".jpg"; // 文件名
dlLink.href = i.src;
dlLink.dataset.downloadurl = ['image/jpeg', dlLink.download, dlLink.href].join(':');
document.getElementById("ddddd").appendChild(dlLink);
dlLink.innerHTML="[下载图片"+x+"]";
//dlLink.click();
//document.body.removeChild(dlLink);
}
 }
function downloadall2(){
let n = document.getElementsByTagName("a");
for(i of n){
i.click();
}
 }
</script>
<div id="ddddd"></div>
 <bottom onclick="downloadall();downloadall2();"><b>[下载全部image]</b></bottom>
O;
for($i=0;$i<count($_FILES["File"]["name"]);$i++){
 $imgSrc = $_FILES["File"]["tmp_name"][$i];
 $src=$imgSrc;
 $info = getimagesize($src);
 $type=image_type_to_extension($info[2],false);
 $fun = "imagecreatefrom{$type}";
 $img=$fun($src);
 //旋转ios
    $exif = exif_read_data($imgSrc);
    if($exif && isset($exif['Orientation']) && $exif['Orientation'] != 1) {
        switch ($exif['Orientation']) {
            case 3: $deg = 180; break;
            case 6: $deg = 270; break;
            case 8: $deg = 90; break;
            default: $deg = 0;
        }
        if($deg > 0) {$img = imagerotate($img, $deg, 0);}
    }

    $img_width = imagesx($img);
    $img_height = imagesy($img);
    $tsize = $tsize1/1.2;
    $color = imagecolorallocate($img,255,165,0);
    
    if($bottom == "1"){
    $text = '>ORDYLAN<'; 
    $posiBox_text = imagettfbbox($tsize,0,'../HSP_ON_imagecloud/msyhl.ttc',$text);
    $textBox_width = $posiBox_text[2] - $posiBox_text[0]; 
    imagettftext($img,$tsize,0,$img_width-1-$textBox_width-($img_width/30),$img_height-1-($img_width/30),$color,'../HSP_ON_imagecloud/msyhl.ttc',$text); 
    }
if($colorr == "red") $color = imagecolorallocate($img,255,0,0);
elseif ($colorr == "blue") $color = imagecolorallocate($img,0,128,255);
elseif ($colorr == "orange") $color = imagecolorallocate($img,255,165,0);
else $color = imagecolorallocate($img,255,165,0);
$tsize = $tsize1;

    //$posiBox_text = imagettfbbox($tsize,0,'../HSP_ON_imagecloud/msyhl.ttc',$texxxt);
    imagettftext($img,$tsize,0,10,15+($posiBox_text[1] - $posiBox_text[7]),$color,'../HSP_ON_imagecloud/msyhl.ttc',$texxxt); 

//imagettftext($img,$tsize,0,($img_width/1000),($img_height/20),$color,'../HSP_ON_imagecloud/msyhl.ttc',$texxxt);


//imagejpeg($img); //解析图片
    
ob_start();
imagejpeg($img);
$image_data = ob_get_contents();
ob_end_clean();
echo '<img src="data:image/jpeg;base64,'.base64_encode($image_data).'" style="width:100%;">';
imagedestroy($img);
}}
else{
print<<<ODODHTMLLLL
<a href="/noteview/tags/1">[回首页]</a><br>--图片加字--
<form action="#" enctype="multipart/form-data" method="post" target="iframe">
<h2>Add Text: <input type="text" name="toptext" value="祝老师新年快乐, 万事如意哦!"><br>
Text Colour: [Red<input type="radio" name="color" id="color" value="red" checked="true"/>][Orange<input type="radio" name="color" id="color" value="orange"/>][Blue<input type="radio" name="color" id="color" value="blue"/>]<br>
Bottom Text: [Need<input type="radio" name="bottom" id="bottom" value="1" checked="true"/>][Not Need<input type="radio" name="bottom" id="bottom" value="2"/>]<br>
Text Size: <input type="number" name="tsize" value="33"><br>
Image: <input type="file" name="File[]" multiple="multiple"><br></h2>
<input type="submit">
</form>

<iframe id="iframe" name="iframe" style="width:80%;height:60%;"></iframe>
ODODHTMLLLL;
}
?>