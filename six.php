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
            #l-map{height:300px;width:100%;}
            #results,#results table{width:100%;}
        </style> 
    </head>
    <body>
        <div id="l-map"></div>
        <div id="results"></div>
    </body>
</html>
<script type="text/javascript">
    var map = new BMap.Map("l-map");
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 12);
    var transit = new BMap.TransitRoute("北京市");
    transit.setSearchCompleteCallback(function (results) {
        if (transit.getStatus() == BMAP_STATUS_SUCCESS) {
            var firstPlan = results.getPlan(0);
            // 绘制步行线路    
            for (var i = 0; i < firstPlan.getNumRoutes(); i++) {
                var walk = firstPlan.getRoute(i);
                if (walk.getDistance(false) > 0) {
                    // 步行线路有可能为0  
                    map.addOverlay(new BMap.Polyline(walk.getPoints(), {lineColor: "green"}));
                }
            }
            // 绘制公交线路   
            for (i = 0; i < firstPlan.getNumLines(); i++) {
                var line = firstPlan.getLine(i);
                map.addOverlay(new BMap.Polyline(line.getPoints()));
            }
            // 输出方案信息  
            var s = [];
            for (i = 0; i < results.getNumPlans(); i++) {
                s.push((i + 1) + ". " + results.getPlan(i).getDescription());
            }
            document.getElementById("results").innerHTML = s.join("<br>");
        }
    })
    transit.search("中关村", "国贸桥");
</script>