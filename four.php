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
                height: 25px !important;
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
                left: 36%;
                top: 50%;
                margin-left: -4rem;
                margin-top: -4rem;
                width: 20rem;
                height: 4rem;
                line-height: 4rem;
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
        <p id="zjmobliestart">唤醒地图APP！</p>
        <div id="l-map"></div>
        <div id="search" class="form-group"><label type="text" size="20" id="conid" class="form-control"/>浙江省杭州市拱墅区丰潭路380号<a href="#" class="btn" style="padding: 0">->立即前往</a></label></div>
    <!--<a href="javascript:void(0);" class="cyj-download-btn">立即前往</a>-->
    <div class="show-dialog">正在为您跳转，请稍等...</div>
    <!--<a href="intent://bdapp://map/direction?origin=我的位置&destination=西直门&mode=driving#Intent;scheme=kaola;package=com.kaola;end">打开APP</a>-->
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

    document.querySelector(".btn").onclick = function () {
        document.querySelector(".show-dialog").style.display = "block";
        setTimeout(function () {
            document.querySelector(".show-dialog").style.display = "none";
        }, 1000);
        if (browser.versions.ios) {
//            var openUrl = "baidumap://map/direction?origin=我的位置&destination=西直门&mode=driving&src=webapp.navi.yourCompanyName.yourAppName";
//            var ifr = document.createElement('iframe');
//            ifr.src = openUrl;
//            ifr.style.display = 'none';
//            openApp("baidumap://map/direction?origin=我的位置&destination=西直门&mode=driving&src=webapp.navi.yourCompanyName.yourAppName");
//            window.location.href = "baidumap://map/direction?origin=我的位置&destination=西直门&mode=driving&src=webapp.navi.yourCompanyName.yourAppName";
            window.location.href = "baidumap://map/direction?origin=我的位置&destination=西直门&mode=driving&src=webapp.navi.yourCompanyName.yourAppName";
            setTimeout(function () {
                window.location.href = "itms-apps://itunes.apple.com/cn/app/id452186370?mt=8";
            }, 3000)
        } else if (browser.versions.android) {

            openApp("bdapp://map/direction?origin=我的位置&destination=西直门&mode=driving");
//            window.location.href = "bdapp://map/navi?query=故宫";
            setTimeout(function () {
                document.body.removeChild(ifr);
                window.location.href = "http://map.baidu.com/zt/client/index/";
            }, 3000)
        }
    };
    function openApp(openUrl, falseUrl, callback) {
        //检查app是否打开
        function checkOpen(cb) {
            var _clickTime = +(new Date());
            function check(elsTime) {
                if (elsTime > 3000 || document.hidden || document.webkitHidden) {
                    cb(1);
                } else {
                    cb(0);
                }
            }
            //启动间隔20ms运行的定时器，并检测累计消耗时间是否超过3000ms，超过则结束
            var _count = 0, intHandle;
            intHandle = setInterval(function () {
                _count++;
                var elsTime = +(new Date()) - _clickTime;
                if (_count >= 100 || elsTime > 3000) {
                    clearInterval(intHandle);
                    check(elsTime);
                }
            }, 20);
        }

        //在iframe 中打开APP
        var ifr = document.createElement('iframe');
        ifr.src = openUrl;
        ifr.style.display = 'none';
        if (callback) {
            checkOpen(function (opened) {
                callback && callback(opened);
            });
        }

        document.body.appendChild(ifr);
        setTimeout(function () {
            document.body.removeChild(ifr);
        }, 3000);
    }
</script>
