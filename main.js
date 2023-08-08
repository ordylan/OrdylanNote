var thisjsversion = 1687850008053;//升级js记得修改updatejs.js的版本号
console.log("js版本:"+thisjsversion);if(!localStorage.ON_MAINJS_VER){localStorage.ON_MAINJS_VER = thisjsversion;localStorage.removeItem('ON_MAINJS_NowUpdate');window.location.reload();}
//loadimage
function lazyLoad() {
  const images = document.querySelectorAll('img[data-src]');
  images.forEach(image => {
    if (isInViewport(image)) {
      image.src = image.dataset.src;
      image.removeAttribute('data-src');
    }
  })
}
function isInViewport(image) {
  const rect = image.getBoundingClientRect();
  return (
    rect.top >= -(window.innerHeight || document.documentElement.clientHeight)*0.5 &&
    //rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)*1.8//&&
    //rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  )
}
window.addEventListener('scroll', lazyLoad);
lazyLoad();
/////////////////js_main/////////////////
//
function re_js(id){
var scripts = document.getElementById(id).getElementsByTagName('script');
for (var i = 0; i < scripts.length; i++) {eval(scripts[i].innerHTML);}}
//新动画
function changepage(aname,pageurl,changeid){
    /*if(!changeid){changeid="main";}
    setTimeout("window.location.href='"+pageurl+"';",600);
    document.getElementById(changeid).className += aname;
    setTimeout("window.location.reload();",3000);*/
    newcpage(aname,pageurl);
}
//新动画2
function newcpage(mode,url){
    if(!mode){mode="odin";}
    document.getElementById('main').classList.add(mode);
    document.getElementById("progressBar").style.display="block";
    document.getElementById('progressBar').style.width=0;
    //window.localStorage.ON_TEMPGETHTMLS = "1";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    //var timeoutt = setTimeout(function() {
    //    if(window.localStorage.ON_TEMPGETHTMLS == "1"){
    //    document.getElementById('main').innerHTML = "<p>Request timed out (Rtill requesting). <a href='"+url+"'>[Retry]</a></p>";}
    //}, 1500);
    /*document.getElementById("mainload").style.display="block";
        xhr.onprogress = function(event) {
                var percentComplete = (event.loaded / event.total) * 100;
                document.getElementById("progressBar").style.width = percentComplete + '%';
        };*/
      if (xhr.readyState === 4 && xhr.status === 200) {
           document.getElementById('progressBar').style.width = '100%';
            if(xhr.responseText.indexOf("<!--SUCCESS_GETaaaa-->") == -1){window.location.href=url;}
            //setTimeout(function() {
            //clearTimeout(timeoutt); window.localStorage.ON_TEMPGETHTMLS = 2;
            document.getElementById('main').innerHTML = xhr.responseText;
            //document.getElementById("mainload").style.display="none";
            document.getElementById('main').classList.remove(mode);
            setTimeout(function(){document.getElementById("progressBar").style.display="none";}, 1200);
            history.pushState({url:url}, "橙鸭笔记系统V2", url);pagesett();
            setTimeout(function(){re_js('main');}, 100);
            //}, 600);
      }
    };
    xhr.open('POST', url, true);
    //xhr.setRequestHeader('ORDYLAN_GETHTML', "true1");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send("GETTTHTML=true1");
}
/*function newcpage(mode, url) {
  if (!mode) {
    mode = "odin";
  }
  document.getElementById('main').classList.add(mode);
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: "GETTTHTML=true1"
  })
  .then(response => {
    if (response.ok) {
      return response.text();
    } else {
      throw new Error('Network response was not ok.');
    }
  })
  .then(html => {
    if (html.indexOf("<!--SUCCESS_GETaaaa-->") == -1) {
      window.location.href = url;
    }
    document.getElementById('main').innerHTML = html;
    document.getElementById('main').classList.remove(mode);
    history.pushState({url: url}, "橙鸭笔记系统V2", url);
    pagesett();
    setTimeout(function() {re_js('main');}, 100);
  })
  .catch(error => {
    console.log('Error:', error);
  });
}*/

//动画
window.addEventListener("click", function(e){
    if (e.target.tagName == 'A'){
        var url = e.target.href;
        if(url.indexOf("#") == -1 && url.indexOf("javascript") == -1 && e.target.getAttribute("target") != "_blank" && e.target.dataset.cp != "no"){
            e.preventDefault();
            //CHANGEPAGE("odin",url);
            newcpage("odin",url);
        }
    }
});
window.addEventListener('popstate', function(e) {
  newcpage("odback",e.state.url);
  console.log(e);
});
//main
function pagesett(){
if(localStorage.ON_ThisPath != window.location.pathname){
if(!localStorage.ON_LastPath) {localStorage.ON_LastPath = window.location.pathname;localStorage.ON_ThisPath = window.location.pathname;}
localStorage.ON_LastPath = localStorage.ON_ThisPath;
if(localStorage.ON_ThisPath != window.location.pathname){localStorage.ON_ThisPath = window.location.pathname;}
}
}
pagesett();

//sw
if(localStorage.ON_SW == "true"){
window.onload = function(){
    if('serviceWorker' in navigator){
        navigator.serviceWorker.register('/sw.php')
            .then(resitration => {
                console.log("register" , resitration);
            }).catch(err => console.error(err));
    }
}}
else{
    navigator.serviceWorker.getRegistrations().then(function(registrations) {
 for(let registration of registrations) {
  registration.unregister();
} })
}

/*if ("Notification" in window) {
    if (Notification.permission === "default") {
        Notification.requestPermission();
    }else if(Notification.permission === "granted"){
        if (!navigator.onLine) {
            new Notification("通知: ", {
                body: "当前网络不可用"
            });
        }
        window.addEventListener('online', () => {
            new Notification("通知: ", {
                body: "网络已连接"
            });
        }, false);
    }
}*/

//VmBJYEJDUzFgSkZTYElSV1JFSmBFUlZWWFFgSmBGVlYwSktXVVpLVUZaYEVTVmBOYEVXVmBKRlZgSk5XWUVgTmBFU2BLQkZWYEpaYEVTYElgQldWMEpYVmBIRldZRmBKWlJWWlVWYEhCS1VgSlpYUWBJYFZSWUVgTmBFU2BKYEJXUldCT1UxUlZWYEtCRlUxYEJDV0ZaYEVTRWBORFUyQkpPVWBGUllFYE5HVlZgSkZZRTVgRVJWRmBFU1U1VldVVmBFU1RGWlJWWlVUVVZgRVRgSTFXWUVgSlNTMUVgVlRgSWBCU1lFYFJDUmBKVmBFV0VKTFZERmBFUWBKWldZRWBKYEVVYEpSV1lFYE5gWVlFVlNWYEkxYEVWVk5gRVNgS0JDV0ZaV1dgSWBGWFZWWlhWMFpKWUZWVFlFYEk1V0ZaV1lFNVVWYElaVllGWlpSVlpVVWBIQktURmBCVlZgSmBCV01ERllVV0JKT1ZSV1lFYFJDUzFKYEVTYEtCS1JgSTVYUWBJWlZZRWBOYFlWMVlgVllFYE5HV1VVMVdgSlpIUWBJYE5aUlVgTkVWYEtCSldgS0JGVVdCS1ZgSlJXUlVgTmBFV1ZWYEVTMEpMVTJCS1ZgSlpaUldCU1ExTmBFU1RWWFUyQktWYEpOU1ZWVmBFVmBKWmBFU1ZKRFdVVldWMVlgVVNgSmBOV1lFYEZHWUVWUllFYEpPV0ZKYEVTYElgTkdWYElgQkNTYEpSYEVTYEtCT1UxWmBFUzBKUFdVVldVMVpgRVNWYE5XVmBJYEJDU2BJOVdZRTVUV1VWYEVUYEtCWldVVldVMVpgRVMwSkRXVVZXVkZKVVZgSTFXUmBKWlhXVVZXVjFgSkZZRkpEVWBLQktXYElaV1lFYEpgRVVgSmBOU1ZgSmBOV1ZgS0JJUWBJYFJSTVZaYEVSVk5XU2BLQkZVYEpaT1lFVlRNRWBOSFZgS0JMUWBJYFJYWUVgUkNSYEpVYFdRYElgUlpSV0JPVmBKYEJWVmBLQkZWV0JKVGBKYEZXWUVgTmBZU0ZgQlZWYEtCWlZgSVpgRVFgSlpYWUVgUkNSYEpWWFFgSWBWUllFYEpgWVZgSllgVVNgSWBWWFZWWkxWYEhGVllGYEJSWUVgTmBFU2BKYEZaUldCSllGWlZZRWBOYEVTYElgQlpSVmBOUFZGWmBZWUVWVFlFYEpgWVVGSWBVU2BKYEpXWUVgSmBZVTFgSkdZRWBOYFlVYEpaYFlXVlpgRVNFSkxWVlpgWVIxVmBFUzBKYFlWYElWV1lFVlZWMEpXVlRGU1IxYEJHWUVgTkdXVVpLUkZaRldgS0JGVTJCSldgSTVXVjBKWFZgSlVgVllFVlRWV0JPWUVWWFZgS0JDVmBKWmBFU1dCQ1dgSkpXV2BKYEJWWUVgTlNZRVZUWUVgUkNSYEpWYEVTYEpgTkhXVVZXV0ZJYFVTYElgVlhWVlpYVmBJWlpZRlZUWUVgSldXRlpXV2BKQlhWVlpYVmBLQktTV0JWVTJCSk1WYEJXUldCT1JGVWBXUWBJYE5PVjBKR1ZURmBFUWBJTlRNVWBOYEVSVk5VWUVgTllWYElgQkNTMVJgRVNgSTVgWVVgSmBCQ1UxRWBWVFdCV1ZXQktZRUpUV1VWYEVUYEtCWlZERlpZRlZUWUVgSmBZVjFgSkZZRWBOYEVSVkZgRVNVNVVXVVZgRVNUVldNVmBOYEVSVk5gRVNUVlhWYEtCSlVgSUpPVVQwOQ