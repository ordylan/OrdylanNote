# 橙鸭笔记系统-开源版
预告  
由于系统内存在大量密码等隐私信息, 我还要补学校作业(后天开学), 代码未来会陆续上传。  
使用nginx+php+mysql开发  
注: 数据库提供游戏服务, 与笔记主业务无关。  
代码里面的开箱动画不开源, 因为它被解包自某国产游戏。  
几乎所有代码都是我写的, 开发上千小时哦。  
最慢3年完成上传(高考结束)  
我们的内部仓库   
![git](https://github.com/ordylan/OrdylanNote/assets/56828391/40fe8a0e-aa0f-4ab3-ba39-2643387e5105)

# 以下为系统的readme内容
欢迎来到橙鸭笔记系统,快来找你记的笔记吧!

# 项目文件表 (/)
Create at 10/16/2022 13:20.

# PHP版本
5.6, 需要php.ini设置忽略简单错误!

# 已知问题
images/htmls/内图片返回403

## 目录

├─@Upload_PAPER >> 上传的试卷  
├─images >> 笔记图片  
├─notes >> 笔记文本  
├─OShua >> O刷  
├─simages >> 系统图片  
├─tags >> 笔记标签  
└─updates >> 发布的动态  

## 文件

│  .user.ini >> 防跨站  
│  1.css >> 页面样式css  
│  404.html >> 404提示  
│  addnote.php >> 添加笔记页(以及设置)  
│  allnotes.ordylandata >> 笔记号(总笔记数)  
│  back.png >> 返回图片  
│  boxopen.php >> 开宝箱页  
│  cardroom.php >> 卡牌馆  
│  drawinggame.php >> 网格游戏  
│  doAUTH.php >> 新签名算法  
│  dolog.php >> 日志模块  
│  favicon.ico >> 标志  
│  favicon.png >> 标志  
│  getaward.php >> 浏览得奖页  
│  img_text.php >> 图片加字  
│  index.php >> 主系统  
│  internalPROJECT.php >> 内部功能快捷前往  
│  ListenRoom.php >> 音乐厅  
│  log.ordylandata >> 日志(旧)  
│  main.js >> 合并后的js  
│  manifest.json >> 断网访问用  
│  middle_exam.html >> 中考倒计时  
│  nonetwork.html >> 断网提示  
│  note_cut.html >> 裁切笔记  
│  openbox.php >> 开箱动画(已停用)  
│  PAGEDO.php >> 页面头尾  
│  papers.php >> 试卷合集  
│  passport.php >> 密码通行证  
│  ranking.php >> 趣味排行榜(游戏)  
│  README.md  >> 项目总览介绍  
│  robots.txt  >> 防部分蜘蛛  
│  search.php >> 笔记搜索  
│  sendpaper.php >> 发邮件  
│  SqlPass.ordylandata >> 数据库密码  
│  submitpaperanswer.php >> 提交试卷答案  
│  sw.php >> 断网访问  
│  TempLis.php >> 临时表  
│  Tempsentence.php >> 临时每页一句  
│  t.php >> 测试(已取消)  
│  tt.php >> 测试(无用)  
│  updatejs.js >> js版本检测  
│  upfile.php >> 提交文件api  
│  upload.php >> 提交笔记api  
│  uploadpaper.php >> 上传试卷  
│  welcome.php >> 数据库配置  
│  WrongExerciseDo.php >> 错题练习  

# 连接数据库方法
```
$sqlinfo = file('SqlPass.ordylandata');
$sqlinfo = str_replace(PHP_EOL,'', $sqlinfo);
$sqlinfo = str_replace("\n",'', $sqlinfo);
$sql = new mysqli($sqlinfo[0],$sqlinfo[1],$sqlinfo[2],$sqlinfo[3]);
```

# 页面头尾
```
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddHRAD("橙鸭笔记系统V2","页面标题header","back的url","","");?>
<?php require_once 'PAGEDO.php';$pagedo = new HEAD_FUNCTION();$pagedo->AddFOOT();?>
```

# 项目必要伪静态
```
#________________笔记系统________________
#笔记系统main
rewrite /noteview/(.+)/(.+)/(\w+) /index.php?mode=$1&id=$2&token=$3;
rewrite /noteview/(.+)/(.+) /index.php?mode=$1&id=$2;
#笔记系统浏览
rewrite /getaward/(.+)/(.+) /getaward.php?mode=$1&id=$2;
#笔记系统开箱动画
rewrite /simages/open_box_file/chouka.atlas /simages/open_box_file/chouka.atlas.php;
rewrite /simages/open_box_file/card/chouka.atlas /simages/open_box_file/card/chouka.atlas.php;
#笔记系统搜索
rewrite /s/(.+) /search.php?note=$1;
rewrite /s/ /search.php;
#rewrite /noteview/sw.php /sw.php;
#笔记系统试卷
rewrite /p/(\d+) /papers.php?id=$1;
rewrite /p/ /papers.php;
#公共文件库
location /@Upload_PAPER/papers/PublicFileStore   {  
   charset utf-8;    
   autoindex on;
}
#刷错题
rewrite /WED/(\d+) /WrongExerciseDo.php?id=$1;
rewrite /WED/ /WrongExerciseDo.php;
rewrite /simages/map.svg /simages/map.svg.php;

#笔记系统防偷窥
location ^~ /notes/ {deny all; return 403;}
location ^~ /SqlPass.ordylandata {deny all; return 403;}
location ^~ /@Upload_PAPER {location ~ .*\.(ordylandata)?$ { deny all; return 403;}}
location ^~ /images {location ~* .*\.(jpg|png|jpeg)?$ { deny all; return 403;}}
```
