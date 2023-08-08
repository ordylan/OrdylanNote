<?php
header("content-type: application/x-javascript");
if($_GET["install"] != "true"){
$aa = '';
//if($_COOKIE["ON_PASS"] != md5("ORDYLANNOTE_PASS_ID".$_COOKIE["ON_PASS_NUMBER"]."_TRUE")){$onpass = "false";}
if($_GET["do"] == "allnotetext"){
$notenum = file('allnotes.ordylandata');
$notenum = $notenum[0];
$aa = ',"/noteview/tags/1",
        "/noteview/tags/10",
        "/noteview/tags/11",
        "/noteview/tags/12",
        "/noteview/tags/13",
        "/noteview/tags/14",
        "/noteview/tags/15",
        "/noteview/tags/16",
        "/noteview/tags/17",
/*        "/noteview/tags/1?gettexta=true",
        "/noteview/tags/10?gettexta=true",
        "/noteview/tags/11?gettexta=true",
        "/noteview/tags/12?gettexta=true",
        "/noteview/tags/13?gettexta=true",
        "/noteview/tags/14?gettexta=true",
        "/noteview/tags/15?gettexta=true",
        "/noteview/tags/16?gettexta=true",
        "/noteview/tags/17?gettexta=true",*/
        "cardroom.php"';
for ($i = 0; $i < $notenum + 1; $i++) {
    $aa = $aa.',
    "/noteview/notes/'.$i.'"';
}
}
elseif ($_GET["do"] == "noteimg") {
    if(file_exists("notes/".$_GET["id"].'.ordylandata')){
    $notteee = file("notes/".$_GET["id"].'.ordylandata')[0];
    $notteee = explode('{[(<||>)]}', $notteee);
    $tp = $notteee[3];
    $tp = explode('|', $tp);
    for ($i = 0; $i < count($tp)-1; $i++) {
        $aa = $aa.',
    "'.$tp[$i].'"';
    }
}}
//if($onpass == "false"){$aa="";}
print<<<JS
const CACHE_NAME = 'ON';

self.addEventListener('install',async event => {
    const cache = await caches.open(CACHE_NAME);
    await cache.addAll([
        //必要资源
        "/",
        "/back.png",
        "/nonetwork.html",
        "404.html",
        "/1.css"{$aa}
    ]);
    await self.skipWaiting();
});

self.addEventListener('activate',event => {
    console.log('activate: ',event);
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch',async (event) => {
    // 注意，event.request 页面发出的请求
    // 而 caches.match 根据请求匹配本地缓存中有没有相应的资源
    async function getResponse(){
        try {
            if(navigator.onLine){   // onLine 是 true，表示有网
                let response = await fetch(event.request);
                let cache = await caches.open(CACHE_NAME);
                await cache.put(event.request, response.clone());
                return response;
            }else{
                return await caches.match(event.request);
            }
        } catch (error) {
            // 也有可能在请求途中我们网断了，这时候需要判断一下缓存中有没有数据
            let res = await caches.match(event.request);
            if(!res)    return caches.match('/nonetwork.html');
            return res;
        }
    }
    event.respondWith(
        getResponse()
    );
});
/*
self.addEventListener('fetch',async (event) => {
    // 注意，event.request 页面发出的请求
    // 而 caches.match 根据请求匹配本地缓存中有没有相应的资源

    async function getResponse(){
        try {
            const response = await caches.match(event.request);
            // 如果没有找到相应的内容，就用 fetch 给服务器发请求
            if(!response){
                response = await fetch(event.request);
                // 打开缓存，将请求到的数据克隆一份放入缓存中
                let cache = await caches.open(CACHE_NAME);
                await cache.put(event.request, response.clone());
            }   // 最后别忘了返回 promise包裹的 response
            return response;
        } catch (error) {
            // fetch 没有请求到（可能是断网了），这也表明缓存中没有请求对应的响应数据
            // 这个时候就使用缓存里的其他数据
            return caches.match('/');
        }
    }

    event.respondWith(
        getResponse()
    );
});*/


JS;
}
else{
    echo("self.addEventListener('install',event => {
    console.log('install: ',event);
});

self.addEventListener('activate',event => {
    console.log('activate: ',event);
});

self.addEventListener('fetch',event => {
    console.log('fetch: ',event);
});
");
}