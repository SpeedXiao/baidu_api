<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <title>地图demo</title>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=YPLvTllY0vK9wvhk6FlsiT8N5xwIRkKo"></script>
        <style type="text/css">  
            html{height:100%}    
            body{height:100%;margin:0px;padding:0px}    
            #container{height:100%}    
        </style> 
    </head>
    <body>
        <h4><p>地址：</p>北京</h4>
        <div id="container"></div>
        <script>
            var map = new BMap.Map("container");/*地图配置与操作*/
            var point = new BMap.Point(116.404, 39.915);/*设置中心点坐标*/
            map.centerAndZoom(point, 12); /*地图初始化，同时设置地图展示级别*/
            var marker = new BMap.Marker(point);        // 创建标注    
            map.addOverlay(marker);
            map.addControl(new BMap.NavigationControl());/*添加控件*/
            map.addControl(new BMap.ScaleControl());/*添加比例尺控件*/
            map.addControl(new BMap.GeolocationControl());/*添加移动端定位控件*/
            map.enableScrollWheelZoom(true); /*开启鼠标滚轮缩放*/
//            window.setTimeout(function () {
//                map.panTo(new BMap.Point(116.409, 39.918));
//            }, 2000);
            map.addEventListener("click", function (evt) {
//                point=e.point.lng + ", " + e.point.lat;
//                var marker = new BMap.Marker(point);
//                map.addOverlay(marker);
//                alert("您点击了地图。");
                var point = evt.target.point;
                var info = '点击Marker坐标: ' + point.lng.toFixed(0) + ', ' + point.lat.toFixed(0);
                alert(info);
            }
            );
        </script>
    </body>
</html>
