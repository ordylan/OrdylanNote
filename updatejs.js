//2023/2/1新增js版本检查
var thisjsversion = 1687850008053;
if (localStorage.ON_MAINJS_VER != thisjsversion && localStorage.ON_MAINJS_NowUpdate != "true") {
localStorage.removeItem('ON_MAINJS');localStorage.removeItem('ON_MAINJS_VER');localStorage.ON_MAINJS_NowUpdate = "true";window.location.reload();
} else {
    
}