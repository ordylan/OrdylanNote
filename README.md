# 橙鸭笔记系统-开源版
里面几乎所有代码都是我写的, 开发上千小时哦。  
部署教程视频: https://youtu.be/zzhBjYDMvxo   

# 开源版备注
## 域名
主域名: 替换全部``on.ordylan.com``到你的域名;  
图云域名: 替换全部``onimagecloud.ordylan.com``到你的图云域名;  
## 数据库
``!example.sql``为示例sql数据库, 有内容  
``!blank_sql.sql``为空白sql数据库, 几乎无内容  
## 图云[可选]
见``!imagecloud.tar``, 其中需要将``../HSP_ON/``替换为你的笔记系统所在的目录哦~
图云用伪静态: ``rewrite /NoteImg/(.+) /NoteImg.php?imgid=$1;``
## 其他
为了增强可读性, 此代码包含笔记, 试卷. 不需要的话可以自己删除(懂一点点代码就可以).其中几个笔记有错误, 因为版本混淆修改未提交.   
如果笔记试卷等资源侵了你的权, 请联系我删除(由于我住校,不能及时回复).(真可惜里面大部分东西都没被我用, 可我上传笔记试卷却特别积极)  

下附非我制作的资源表,请不要未经原作者同意使用!  
1.代码里面的开箱动画``simage/open_box_file/*``, 只是示例.   
2.代码里面的符卡图片``simages/cards/exam/*``, 只是示例.   
3.代码``PAGEDO.php``里面换页进度条, 只是示例.   
4.代码``sendpaper.php``里面phpmailer, 只是示例.  
5.代码``note_cut.html``里面笔记裁剪, 只是示例.  
6.代码``StudyPlace.php``里面草稿与讲义框的拖动功能, 只是示例.   
7. [以外的部分非我制作的资源......]

我制作的资源你们可以用, 但不要商用哦.   
加密算法请自己更换.   

# ---------README--------- 

# 橙鸭笔记系统
欢迎来到橙鸭笔记系统,快来找你记的笔记吧!

# 项目文件表 (/)
Create at 10/16/2022 13:20.

# 版本与自动化
1.PHP5.6, 需要php.ini设置忽略简单错误(添加``error_reporting = E_ALL & ~E_NOTICE``)!   
2.Nginx   
3.Mysql   
4.每天执行get请求,清空临时数据 ``/dolog.php?CLEARDATTTA=ononoonhhhhh``   
5.定时,如78分钟,执行,刷新排行榜 ``/ranking.php?rankdo=dodo``   

# 已知问题
1.images/htmls/内图片返回403,期待返回200.

# 文件结构
## 目录
```
├─@Upload_PAPER >> 上传的试卷  
├─images >> 笔记图片  
├─notes >> 笔记文本  
├─simages >> 系统图片  
├─tags >> 笔记标签  
```

## 文件
```
│  1.css >> 页面样式css  
│  404.html >> 404提示  
│  addnote.php >> 添加笔记页(以及设置)  
│  allnotes.ordylandata >> 笔记号(总笔记数)  
│  back.png >> 返回图片  
│  boxopen.php >> 开宝箱页  
│  cardroom.php >> 卡牌馆  
│  drawinggame.php >> 网格游戏(半成品)  
│  doAUTH.php >> 新签名算法  
│  dolog.php >> 日志模块  
│  favicon.ico >> 标志  
│  favicon.png >> 标志  
│  getaward.php >> 浏览得奖页  
│  img_text.php >> 图片加字  
│  index.php >> 主系统  
│  internalPROJECT.php >> 内部功能快捷前往  
│  ListenRoom.php >> 音乐厅  
│  main.js >> 合并后的js  
│  manifest.json >> 断网访问用  
│  middle_exam.html >> 中考倒计时  
│  nonetwork.html >> 断网提示  
│  note_cut.html >> 裁切笔记(非自创,改自开源代码)  
│  openbox.php >> 开箱动画(已停用)  
│  PAGEDO.php >> 页面头尾  
│  papers.php >> 试卷合集  
│  passport.php >> 密码通行证  
│  ranking.php >> 趣味排行榜(游戏)  
│  README.md  >> 项目总览介绍  
│  robots.txt  >> 防部分蜘蛛  
│  search.php >> 笔记搜索  
│  sendpaper.php >> 发邮件(非自原,改自开源代码PHPMailer)  
│  submitpaperanswer.php >> 提交试卷答案  
│  sw.php >> 断网访问  
│  TempLis.php >> 临时表  
│  Tempsentence.php >> 临时每页一句  
│  updatejs.js >> js版本检测  
│  upfile.php >> 提交文件api  
│  upload.php >> 提交笔记api  
│  uploadpaper.php >> 上传试卷  
│  welcome.php >> 数据库配置  
│  WrongExerciseDo.php >> 错题练习  
```

# 连接数据库方法
```
$sqlinfo = file('SqlPass.ordylandata');//要准确定位密码文件位置
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
