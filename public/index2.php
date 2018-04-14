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
		<a href="test.php"><img src="img/btn-home-test.png" alt=""></a>
	</div>

</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script>
	$win = $(window).height();
	$("#HomePage").height($win);


	wx.config({
	    debug: true,
	    appId: '<?php echo $signPackage["appId"];?>',
	    timestamp: <?php echo $signPackage["timestamp"];?>,
	    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	    signature: '<?php echo $signPackage["signature"];?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	    ]
  	});
	  wx.ready(function () {
	    // 在这里调用 API
	  });





</script>
</body>
</html>
