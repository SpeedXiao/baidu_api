<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <style type="text/css">
            body, html {width: 100%;height: 100%; margin:0;font-family:"微软雅黑";}
            #l-map{height:300px;width:100%;}
            #results,#results table{width:100%;}
            li{width: 49%;text-align: center}
            .BMap_cpyCtrl{
                display:none;
            }
            .anchorBL{
                height: 20px !important;
            }
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=YPLvTllY0vK9wvhk6FlsiT8N5xwIRkKo"></script>
        <title>驾车导航的结果面板</title>
    </head>
    <body>
        <input type="hidden" id="end" value="<?= $end ?>"/>
        <div id="l-map"></div>
        <div class="from-group">
            <ul class="nav nav-pills">
                <li class="active"><a href="#">最少时间</a></li>
                <li><a href="#">最短距离</a></li>
            </ul>
        </div>
        <!--<div id="results"></div>-->
    </body>
</html>
<script type="text/javascript">
    var map = new BMap.Map("l-map", {enableMapClick: false});
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 14);
    map.enableScrollWheelZoom();//启用滚轮放大缩小
    var opts = {offset: new BMap.Size(10, 10), anchor: BMAP_ANCHOR_BOTTOM_RIGHT};
    map.addControl(new BMap.GeolocationControl(opts));/*添加移动端定位控件*/
    var opts = {type: BMAP_NAVIGATION_CONTROL_ZOOM};
    map.addControl(new BMap.NavigationControl(opts));
    /*将结果展示到页面上*/
    var driving = new BMap.DrivingRoute(map, {
        renderOptions: {
            map: map,
            panel: "results",
            autoViewport: true
        }
    });
    var end_point = document.getElementById('end').value;
    driving.search("上海", end_point);
</script>
