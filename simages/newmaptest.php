<a href="#" class="page-link" data-page="page1">Page 1</a>
<a href="#" class="page-link" data-page="page2">Page 2</a>

<div id="main">
  <!-- 初始页面内容 -->
</div>
 <style>
 #main {
  transition: transform .5s ease;
}

.page-enter {
  transform: translateX(-100%);
}

.page-enter-active {
  transform: translateX(0%);
}

.page-exit {
  transform: translateX(0%);
}

.page-exit-active {
  transform: translateX(100%);
}</style>
<script>
var contentWrapper = document.getElementById('main');
var pageLinks = document.querySelectorAll('.page-link');
pageLinks.forEach(function(link) {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    var page = this.getAttribute('data-page');
    document.getElementById('main').classList.add('page-enter');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var newContent = xhr.responseText;
        //setTimeout(function() {
          contentWrapper.innerHTML = newContent;
          //contentWrapper.classList.remove('page-exit');
          //contentWrapper.classList.add('page-enter');
          setTimeout(function() {
            contentWrapper.classList.remove('page-enter');
          }, 600);
        //}, 500);
      }
    };
    xhr.open('GET', '/noteview/tags/1?page=' + page, true);
    xhr.send();
  });
});


window.addEventListener('popstate', function(event) {
  var state = event.state;
  if (state) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var newContent = xhr.responseText;
        contentWrapper.classList.add('page-exit');
        setTimeout(function() {
          contentWrapper.innerHTML = newContent;
          contentWrapper.classList.remove('page-exit');
          contentWrapper.classList.add('page-enter');
          history.pushState({ url: '/page.php?page=xxx' }, '', '/page.php?page=xxx');
    history.replaceState({ url: window.location.href }, '', window.location.href);

          setTimeout(function() {
            contentWrapper.classList.remove('page-enter');
          }, 500);
        }, 500);
      }
    };
    xhr.open('GET', state.url, true);
    xhr.send();
  }
});


</script>






<div id="map-wrapper">
  <object id="map" type="image/svg+xml" data="map.svg"></object>
  <div id="zoom-control">
    <input type="range" min="0.5" max="2" step="0.05" value="1" id="zoom-range">
  </div>
</div>
 <style>#map-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

#map {
  width: 100%;
  height: auto;
  max-width: 100%;
  touch-action: none;
  transform-origin: left top;
  transition: transform 0.3s;
}

#zoom-control {
  position: absolute;
  right: 20px;
  bottom: 20px;
}

#zoom-range {
  width: 100px;
}
</style>
<script>
var map = document.getElementById("map");
var x0, y0, x1, y1, distance;

function handleTouchStart(evt) {
  if (evt.touches.length == 2) {
    // 记录两个手指的起始坐标和距离
    x0 = evt.touches[0].clientX;
    y0 = evt.touches[0].clientY;
    x1 = evt.touches[1].clientX;
    y1 = evt.touches[1].clientY;
    distance = Math.sqrt((x1 - x0) ** 2 + (y1 - y0) ** 2);
  }
}

function handleTouchMove(evt) {
  if (evt.touches.length == 2) {
    // 计算当前两个手指的距离，并根据距离变化来缩放地图
    var x2 = evt.touches[0].clientX;
    var y2 = evt.touches[0].clientY;
    var x3 = evt.touches[1].clientX;
    var y3 = evt.touches[1].clientY;
    var newDistance = Math.sqrt((x3 - x2) ** 2 + (y3 - y2) ** 2);
    var scale = newDistance / distance; // 计算缩放倍数
    map.style.transform = "scale(" + scale + ")";
  }
}

function handleTouchEnd(evt) {
  // 清除记录的数据
  x0 = y0 = x1 = y1 = distance = null;
}

map.addEventListener("touchstart", handleTouchStart, false);
map.addEventListener("touchmove", handleTouchMove, false);
map.addEventListener("touchend", handleTouchEnd, false);
var map = document.getElementById("map");
var range = document.getElementById("zoom-range");

range.addEventListener("input", function() {
  var scale = parseFloat(this.value);
  map.style.transform = "scale(" + scale + ")";
});
</script>


1. 首先，在SVG地图中使用`<foreignObject>`元素添加坐标信息，例如：

```svg
<g id="place-1">
  <rect x="200" y="300" width="100" height="50" fill="#fff"/>
  <foreignObject x="200" y="300" width="100" height="50">
    <div class="label">Place 1</div>
  </foreignObject>
</g>
```

在这个例子中，我们在`<g>`元素中创建了一个矩形和一个嵌套的`<foreignObject>`元素，用于显示坐标信息。`<foreignObject>`元素中包含一个`<div>`元素，用于显示具体的文本信息。

2. 在JavaScript代码中监听缩放事件，获取当前的缩放倍数，并根据倍数控制坐标信息的显示或隐藏。例如：

```javascript
var map = document.getElementById("map");
var labels = document.getElementsByClassName("label");

function updateLabels() {
  var scale = getScale(map); // 获取缩放倍数
  for (var i = 0; i < labels.length; i++) {
    var label = labels[i];
    if (scale >= 1.5) {
      label.style.display = "block"; // 缩放倍数大于等于1.5时显示标签
    } else {
      label.style.display = "none"; // 否则隐藏标签
    }
  }
}

function getScale(element) {
  var transform = element.style.transform;
  if (!transform) {
    return 1;
  }
  var values = transform.match(/scale\(([^)]+)\)/);
  if (!values) {
    return 1;
  }
  return parseFloat(values[1]);
}

map.addEventListener("touchmove", updateLabels, false);
map.addEventListener("touchend", updateLabels, false);
map.addEventListener("mousemove", updateLabels, false);
map.addEventListener("mouseout", updateLabels, false);
```

在`updateLabels`函数中，我们首先调用`getScale`函数获取当前的缩放倍数，然后根据倍数控制坐标信息的显示或隐藏。`getScale`函数用于从`transform`属性中提取缩放倍数的值，如果没有找到，则默认返回1。

在这个例子中，我们为了方便，将更新标签显示的代码放在了滑动和移出地图的事件处理函数中，你可以根据实际情况进行调整。

3. 最后，在CSS中添加一些基本的样式，例如：

```css
.label {
  display: none;
  position: relative;
  z-index: 1;
  font-size: 14px;
  color: #333;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  pointer-events: none;
}
```

在这个例子中，我们给标签添加了一些基本的样式，例如白色背景、圆角边框、字体大小和对齐方式等，其中`pointer-events: none;`表示禁止事件穿透，以免干扰手势操作。

以上是一种基本的实现方式，具体还可以根据实际情况进行调整和优化。