# 橙鸭笔记系统-开源版
预告  
目前代码上传进度[<25%(不包括里面的笔记图片,图片等静态资源已上传)]  
由于系统内存在大量密码等隐私信息, 我还要补学校作业(后天开学), 代码未来会陆续上传。  
使用nginx+php+mysql开发  
注: 数据库提供游戏服务, 与笔记主业务无关。  
代码里面的开箱动画不开源, 因为它被解包自某国产游戏。  
几乎所有代码都是我写的, 开发上千小时哦。  
最慢3年完成上传(高考结束)  
下图我们的内部仓库   
![git](https://github.com/ordylan/OrdylanNote/assets/56828391/40fe8a0e-aa0f-4ab3-ba39-2643387e5105)

# 开源版备注
## 域名
主域名替换全部``on.ordylan.com``到你的域名;  
图云域名替换全部``onimagecloud.ordylan.com``到你的图云域名;  
## 数据库
``!example.sql``为示例sql数据库, 有内容  
``!blank_sql.sql``为空白sql数据库, 几乎无内容  
## 图云[可选]
见``!imagecloud.tar``, 其中``../HSP_ON/``需要替换为笔记系统所在目录哦~
伪静态很简单(找不到文件了), 自己写.
## 其他
为了增强可读性, 此代码包含笔记, 试卷. 不需要的话可以自己删除(懂一点点代码就可以).其中几个笔记有错误, 因为版本混淆修改未提交.   
如果笔记试卷侵权, 请联系我删除(我住校,回复慢).[真可惜里面什么东西都没被用, 可上传却特别积极]  
代码里面的开箱动画``simage/open_box_file/*``不开源, 只是示例.   
代码里面的符卡``simages/cards/exam/*``不开源, 只是示例.   
其他大部分资源你们可以用, 是我自己做的, 不要商用哦.   
加密算法请自己更换.   

# ----------------README---------------- 

# 橙鸭笔记系统
欢迎来到橙鸭笔记系统,快来找你记的笔记吧!

# 项目文件表 (/)
Create at 10/16/2022 13:20.

# 版本与自动化
1.PHP5.6, 需要php.ini设置忽略简单错误!   
2.Nginx   
3.Mysql   
4.每天执行get请求,清空临时数据 ``/dolog.php?CLEARDATTTA=ononoonhhhhh``   
5.定时,如78分钟,执行,刷新排行榜 ``/ranking.php?rankdo=dodo``   

# 已知问题
images/htmls/内图片返回403

# 文件结构
## 目录[x开头为不公开]

├─@Upload_PAPER >> 上传的试卷  
├─images >> 笔记图片  
├─notes >> 笔记文本  
x─OShua >> O刷  
├─simages >> 系统图片  
├─tags >> 笔记标签  
x─updates >> 发布的动态  

## 文件[x开头为不公开]

x  .user.ini >> 防跨站  
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
x  log.ordylandata >> 日志(旧)  
│  main.js >> 合并后的js  
│  manifest.json >> 断网访问用  
│  middle_exam.html >> 中考倒计时  
│  nonetwork.html >> 断网提示  
│  note_cut.html >> 裁切笔记(非原创,开源)  
│  openbox.php >> 开箱动画(已停用)  
│  PAGEDO.php >> 页面头尾  
│  papers.php >> 试卷合集  
│  passport.php >> 密码通行证  
│  ranking.php >> 趣味排行榜(游戏)  
│  README.md  >> 项目总览介绍  
│  robots.txt  >> 防部分蜘蛛  
│  search.php >> 笔记搜索  
│  sendpaper.php >> 发邮件(非原创,开源,改自PHPMailer)  
x  SqlPass.ordylandata >> 数据库密码  
│  submitpaperanswer.php >> 提交试卷答案  
│  sw.php >> 断网访问  
│  TempLis.php >> 临时表  
│  Tempsentence.php >> 临时每页一句  
x  t.php >> 测试(已取消)  
x  tt.php >> 测试(无用)  
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
