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
            html{height:100%}    
            body{height:100%;margin:0px;padding:0px}    
            #container{height:80%;width: 95%}    
        </style> 
    </head>
    <body>
        <h4><p>地址：</p><input id="address"/></h4>
        <!--<div id="container"></div>-->
    </body>
    <script type="text/javascript">
//    var map = new BMap.Map("container");
    var lng = 116.404;
    var lat = 39.915;
//    var point = new BMap.Point(lng, lat);
//    map.centerAndZoom(point, 12);
//    var marker = new BMap.Marker(point);        // 创建标注    
//    map.addOverlay(marker);
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function (r) {
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
//            var mk = new BMap.Marker(r.point);
//            map.addOverlay(mk);
//            map.panTo(r.point);
            lng = r.point.lng;
            lat = r.point.lat;
            console.log('您的位置：' + r.point.lng + ',' + r.point.lat);
            var myGeo = new BMap.Geocoder();
// 根据坐标得到地址描述    
            myGeo.getLocation(new BMap.Point(lng, lat), function (result) {
                if (result) {
                    $('#address').val(result.address);
                    console.log(result.address);
                }
            });
            // 创建地理编码实例      
        } else {
            alert('failed' + this.getStatus());
        }
    });

</script>
</html>
