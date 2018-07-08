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
            #zjmobliestart{font-size:40px;}
            .cyj-download-btn{
                width:8.86666667rem;
                height: 1.25333333rem;
                line-height: 1.25333333rem;
                background: #e72d2d;
                color: #fff;
                border-radius: 0.6266666667rem;
                display: block;
                text-align: center;
                font-size: 0.4266666667rem;
            }

            .cyj-download-btn:hover {
                font-weight: bold;
                text-decoration: none;
                background: #eaeaea;
            }
            .show-dialog {
                display: none;
                position: fixed;
                left: 50%;
                top: 50%;
                margin-left: -3rem;
                margin-top: -1rem;
                width: 6rem;
                height: 2rem;
                line-height: 2rem;
                text-align: center;
                color: #6f6f6f;
                font-size: 16px;
                background: #f4f4f4;
                border-radius: 0.15rem;
                box-shadow: 0 0 7px 4px rgb(255, 255, 255);;
                border: 1px solid #e3e3e3;
                z-index: 100;
            }
        </style>
    </head>
    <body>
        <p id="zjmobliestart">唤醒浙江移动手机营业厅！</p>
        <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
        <div id="l-map"></div>
        <!--<div id="search" class="form-group"><label type="text" size="20" id="conid" class="form-control"/>浙江省杭州市拱墅区丰潭路380号<a href="five.php?end=浙江省杭州市拱墅区丰潭路380号" class="btn" style="padding: 0" onclick="applink()">->到这里去</a></label></div>-->
        <div id="search" class="form-group"><label type="text" size="20" id="conid" class="form-control"/>浙江省杭州市拱墅区丰潭路380号<a href="#" class="btn" style="padding: 0">->到这里去</a></label></div>
    <a href="javascript:void(0);" class="cyj-download-btn">立即下载App</a>
    <div class="show-dialog">正在为您跳转，请稍等...</div>
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
    map.enableScrollWheelZoom(); //启用滚轮放大缩小
    var opts = {offset: new BMap.Size(10, 40), anchor: BMAP_ANCHOR_BOTTOM_LEFT};
    map.addControl(new BMap.GeolocationControl(opts)); /*添加移动端定位控件*/
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
    });</script>
<script type="text/javascript">
//    function applink() {
//        window.location = 'zjmobile://platformapi/startapp';
//        var clickedAt = +new Date;
//        setTimeout(function () {
//            !window.document.webkitHidden && setTimeout(function () {
//                if (+new Date - clickedAt < 2000) {
//                    window.location = 'https://itunes.apple.com/us/app/zhe-jiang-yi-dong-shou-ji/id898243566#weixin.qq.com';
//                }
//            }, 500);
//        }, 500)
//
//    }
    var browser = {
        versions: function () {
            var u = navigator.userAgent,
                    app = navigator.appVersion;
            return {
                trident: u.indexOf('Trident') > -1, /*IE内核*/
                presto: u.indexOf('Presto') > -1, /*opera内核*/
                webKit: u.indexOf('AppleWebKit') > -1, /*苹果、谷歌内核*/
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, /*火狐内核*/
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), /*是否为移动终端*/
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), /*ios终端*/
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, /*android终端或者uc浏览器*/
                iPhone: u.indexOf('iPhone') > -1, /*是否为iPhone或者QQHD浏览器*/
                iPad: u.indexOf('iPad') > -1, /*是否iPad*/
                webApp: u.indexOf('Safari') == -1, /*是否web应该程序，没有头部与底部*/
                souyue: u.indexOf('souyue') > -1,
                superapp: u.indexOf('superapp') > -1,
                weixin: u.toLowerCase().indexOf('micromessenger') > -1,
                Safari: u.indexOf('Safari') > -1
            };
        }(),
        language: (navigator.browserLanguage || navigator.language).toLowerCase()
    };

    document.querySelector(".cyj-download-btn").onclick = function () {
        document.querySelector(".show-dialog").style.display = "block";
        setTimeout(function () {
            document.querySelector(".show-dialog").style.display = "none";
        }, 1000);
        if (browser.versions.ios) {
            window.location.href = "https://itunes.apple.com/cn/app/id452186370?ls=1&mt=8";
            setTimeout(function () {
                window.location.href = "该App的连接地址";
                window.location.href = "该App的连接地址";
            }, 2000)
        } else if (browser.versions.android) {
//            window.location.href = "打开该androidApp的连接://openApp";
            window.location.href = "bdapp://map/direction?region=beijing&origin=39.98871,116.43234&destination=name:西直门&mode=driving";
            setTimeout(function () {
                window.location.href = "http://map.baidu.com/zt/client/index/";
            }, 2000)
        }
    };
</script>
