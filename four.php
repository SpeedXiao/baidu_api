<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
        <title>地图demo</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=YPLvTllY0vK9wvhk6FlsiT8N5xwIRkKo"></script>
        <style type="text/css">
            body, html,#allmap {width: 100%;height: 100%; margin:0;font-family:"微软雅黑";}
            #l-map{height:300px;width:100%;}
            #r-result{width:100%; font-size: 14px; line-height: 20px;}
            a{float: right}
            .BMap_cpyCtrl{
                display:none;
            }
            .anchorBL{
                height: 20px !important;
            }
        </style>
    </head>
    <body>
        <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
        <div id="l-map"></div>
        <div id="search" class="form-group"><label type="text" size="20" id="conid" class="form-control"/>浙江省杭州市拱墅区丰潭路380号<a href="five.php?end=浙江省杭州市拱墅区丰潭路380号" class="btn" style="padding: 0">->到这里去</a></label></div>
</body>
</html>
<script type="text/javascript">
    function G(id) {
        return document.getElementById(id);
    }
    var myValue = $('#conid').text();
//    console.log(myValue);
    // 百度地图API功能
    var map = new BMap.Map("l-map", {enableMapClick: false});
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);
    map.enableScrollWheelZoom();//启用滚轮放大缩小
    var opts = {offset: new BMap.Size(10, 10), anchor: BMAP_ANCHOR_BOTTOM_RIGHT};
    map.addControl(new BMap.GeolocationControl(opts));/*添加移动端定位控件*/
    var opts = {type: BMAP_NAVIGATION_CONTROL_ZOOM};
    map.addControl(new BMap.NavigationControl(opts));

    // 创建地址解析器实例     
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上，并调整地图视野    
    myGeo.getPoint(myValue, function (point) {
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        } else {
            alert('请重新加载');
        }
    });
</script>