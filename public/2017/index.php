<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxce4c6068d982ad73","230eb5f22df9228557776ac27465439b");
$signPackage = $jssdk->GetSignPackage();

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="viewport" content="width=750,target-densitydpi=device-dpi, user-scalable=0" />
    <meta charset="UTF-8">
    <title>2017搜瘦槽点测试-出出</title>
    <link rel="stylesheet" href="css/ui.css">
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>


<div id="HomePage">
	
	<div id="logo"><img src="img/logo.png" alt=""></div>

	<div id="Absolute" class="start-home">
		<img src="img/index.png">

	</div>
	

	<div id="Absolute" class="btn-start-2">
		<a href="test.php?act=test"><img src="img/btn-home-test.png" alt=""></a>
	</div>

</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	$win = $(window).height();
	$("#HomePage").height($win);


	wx.config({
	    debug: false,
	    appId: '<?php echo $signPackage["appId"];?>',
	    timestamp: <?php echo $signPackage["timestamp"];?>,
	    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	    signature: '<?php echo $signPackage["signature"];?>',
	   jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone']
  	});
	//通过ready接口处理成功验证
        wx.ready(function(){
            // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
            var shareInfo = {
                title: '2017搜瘦槽点测试',  // 分享标题
                desc: '做完这个测试，我只希望2018能少点这样的破事！',   // 分享描述
                link: 'http://yoox.rice5.com.cn/2017/index.php',       // 分享链接
                imgUrl: 'http://yoox.rice5.com.cn/2017/img/icon.jpg',  // 分享图标
                type: 'link',           // 分享类型,music、video或link，不填默认为link
                dataUrl: '',            // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {  // 用户确认分享后执行的回调函数
                },
                cancel: function () {   // 用户取消分享后执行的回调函数
                }
            };
            // 分享到朋友圈
            wx.onMenuShareTimeline(shareInfo);
            // 分享给朋友
            wx.onMenuShareAppMessage(shareInfo);
            // 分享到QQ
            wx.onMenuShareQQ(shareInfo);
            // 分享到腾讯微博
            wx.onMenuShareWeibo(shareInfo);
            // 分享到QQ空间
            wx.onMenuShareQZone(shareInfo);
        });
        //通过error接口处理失败验证
        wx.error(function(res){
            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
            console.info(res);
        });




</script>
</body>
</html>
