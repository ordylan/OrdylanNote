<?php
if($_GET["mode"] == "card"){
    $animations = "/simages/open_box_file/card/chouka.json";
}
else{
    $animations = "/simages/open_box_file/chouka.json";
}
print <<<SPINE
<title>橙鸭笔记系统V2[开箱]</title>
<div id="app"><a href="javascript:void(0);" onclick="openaa();"  id="kaika" style="z-index: 999;display:none"><img style="width:100%;height:100%;position: absolute;" src="https://ordylan.com/toumbtn.png"></a></div> 
<a href="/boxopen.php"><img src="/back.png" id="b" alt="back" style="height:10%;z-index: 9999;position: absolute;top:0;"></a>

<script src="https://ordylan.com/js/newan/pixi.min.js"></script>
<script src="https://ordylan.com/js/newan/pixi-spine.js"></script>
<script>
const app = new PIXI.Application({
    backgroundColor:0xE6E6E6,
    antialias:true,
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
?>