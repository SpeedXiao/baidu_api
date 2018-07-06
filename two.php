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
            a{color: #999;}
            a:hover{color: #999}
            .BMap_cpyCtrl{
                display:none;
            }
            .anchorBL{
                height: 20px
            }
        </style>
    </head>
    <body>
        <div id="search" class="form-group"><input type="text" size="20" id="conid" class="form-control" placeholder="请输入地址"/></div>
        <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
        <div id="l-map"></div>
        <table id="r-result" class="table table-condensed"></table>
    </body>
</html>
<script type="text/javascript">
    function G(id) {
        return document.getElementById(id);
    }
    // 百度地图API功能
    var map = new BMap.Map("l-map", {enableMapClick: false});
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);
    map.enableScrollWheelZoom();//启用滚轮放大缩小
    var opts = {offset: new BMap.Size(10, 10), anchor: BMAP_ANCHOR_BOTTOM_RIGHT}
    map.addControl(new BMap.GeolocationControl(opts));/*添加移动端定位控件*/
    var opts = {type: BMAP_NAVIGATION_CONTROL_ZOOM};
    map.addControl(new BMap.NavigationControl(opts));

    /*搜索提示*/
    var ac = new BMap.Autocomplete(//建立一个自动完成的对象
            {"input": "conid"
                , "location": map
            });
    ac.addEventListener("onhighlight", function (e) {  //鼠标放在下拉列表上的事件
        var str = "";
        var _value = e.fromitem.value;
        var value = "";
        if (e.fromitem.index > -1) {
            value = _value.province + _value.city + _value.district + _value.street + _value.business;
        }
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province + _value.city + _value.district + _value.street + _value.business;
        }
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        G("searchResultPanel").innerHTML = str;
    });
    var myValue;
    ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
        var _value = e.item.value;
        myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
        G("searchResultPanel").innerHTML = "onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
        setPlace();
    });

    function setPlace() {
        map.clearOverlays();    //清除地图上所有覆盖物
        function myFun() {
            var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
            map.centerAndZoom(pp, 18);
            map.addOverlay(new BMap.Marker(pp));    //添加标注
        }
        var local = new BMap.LocalSearch(map, {//智能搜索
            onSearchComplete: myFun
        });
        console.log(myValue);
        local.search(myValue);
    }

    /*搜索后的其余选项*/
//    var options = {
//        onSearchComplete: function (results) {
//            // 判断状态是否正确
//            if (local.getStatus() == BMAP_STATUS_SUCCESS) {
//                var s = [];
//                for (var i = 0; i < results.getCurrentNumPois(); i++) {
//                    s.push('<tr><td>' + results.getPoi(i).title + '<br/><a>' + results.getPoi(i).address + '</a></td></tr>');
////					s.push([results.getPoi(i).title,results.getPoi(i).address]);
//                }
////                console.log(s);
//                document.getElementById("r-result").innerHTML = s.join("<br/>");
//            }
//        }
//    };
//    var local = new BMap.LocalSearch(map, options);
//    local.search("公园");
</script>