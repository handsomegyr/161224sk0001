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
    <link rel="stylesheet" href="js/slider/responsiveslides.css">
    <link rel="stylesheet" href="css/ui.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/slider/responsiveslides.js"></script>
</head>
<body>

<div id="TestPage">
	
	<div id="Absolute" class="countDownList">
		<ul>
			<?php
			for($i=0;$i<15;$i++){
			?>
			<li></li>
			<?php } ?>
		</ul>
	</div>

	

	<div  id="Absolute" class="TestContent">
		<!-- show title start -->
		<div id="Absolute" class="show_number">1</div>
		<!-- show title end -->
		<ul class="rslides" id="dowebok">
			<!--01-->
		    <li>
		    	<div id="Absolute" class="show_title">以下哪个人物遭受了1000万点的实锤攻击？</div>
				<div id="Absolute" class="show_line"></div>
		    	<div class="testBox style-list">
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/1/1.jpg"></p>
		    			<p>薛之谦</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/1/2.jpg"></p>
		    			<p>靳东</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/1/3.jpg"></p>
		    			<p>许知远</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/1/4.jpg"></p>
		    			<p>贾跃亭</p>
		    		</dt>		
		    	</div>	
		    </li>

		    <!--02-->
		    <li>
		    	<div id="Absolute" class="show_title">以下哪位不是性侵事件的始作俑者？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="10">
		    			<p><img src="img/2/1.jpg"></p>
		    			<p>姜仁浩</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/2/2.jpg"></p>
		    			<p>三色</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/2/3.jpg"></p>
		    			<p>凯文史派西</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/2/4.jpg"></p>
		    			<p>哈维·温斯坦</p>
		    		</dt>

				</div>	
		    </li>

			<!--03-->	
		    <li>
		    	<div id="Absolute" class="show_title">图中的男子为什么擦眼泪？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt><img src="img/3/3.jpg" width="380"></dt>
					<dt class="qustion question-list" data-s="0"  style="margin-top: 20px;">
		    			<p>被证监局查水表做假账</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="10">
		    			<p>输给了不是人的家伙</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>失去了世界第一的排名</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>摇号买到车牌了</p>
		    		</dt>

				</div>	
		    </li>

		    <!--04-->	
		    <li>
		    	<div id="Absolute" class="show_title">2017年最流行吸什么?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="0">
		    			<p><img src="img/4/1.jpg"></p>
		    			<p>吸钱</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/4/2.jpg"></p>
		    			<p>吸血</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/4/3.jpg"></p>
		    			<p>吸猫</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/4/4.jpg"></p>
		    			<p>吸狗</p>
		    		</dt>
				</div>	
		    </li>

		    <!--05-->
		    <li>
		    	<div id="Absolute" class="show_title">吴亦凡接下去会说什么？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt><img src="img/5/wyf.gif" width="380"></dt>
					<dt class="qustion question-list" data-s="0"  style="margin-top: 20px;">
		    			<p>what fuck!</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>我觉得不行</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>吃葡萄不吐葡萄皮</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="10">
		    			<p>你有freestyle吗？</p>
		    		</dt>

				</div>	
		    </li>

		    <!--06-->
		    <li>
		    	<div id="Absolute" class="show_title">吃鸡来源于以下哪款游戏？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">

					<dt class="qustion" data-s="0">
		    			<p><img src="img/6/1.jpg"></p>
		    			<p>王者荣耀</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/6/2.jpg"></p>
		    			<p>皇室战争</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/6/3.jpg"></p>
		    			<p>绝地求生</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/6/4.jpg"></p>
		    			<p>崩坏3</p>
		    		</dt>

				</div>	
		    </li>

		    <!--07-->
		    <li>
		    	<div id="Absolute" class="show_title">以下哪道菜难倒了中国留学生？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">

					<dt class="qustion" data-s="0">
		    			<p><img src="img/7/1.jpg"></p>
		    			<p>臭豆腐</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/7/2.jpg"></p>
		    			<p>烤乳猪</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/7/3.jpg"></p>
		    			<p>宫保鸡丁</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/7/4.jpg"></p>
		    			<p>番茄炒蛋</p>
		    		</dt>
				</div>	
		    </li>


		    <!--08-->
		    <li>
		    	<div id="Absolute" class="show_title">以下哪样东西不会让人误解油腻?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="10">
		    			<p><img src="img/8/1.jpg"></p>
		    			<p>人民币</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/8/2.jpg"></p>
		    			<p>霸王洗发水</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/8/3.jpg"></p>
		    			<p>保温杯</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/8/4.jpg"></p>
		    			<p>手串</p>
		    		</dt>
				</div>	
		    </li>



		    <!--09-->
		    <li>
		    	<div id="Absolute" class="show_title">代表中国角逐第90届奥斯卡的是哪部影片？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">

					<dt class="qustion" data-s="0">
		    			<p><img src="img/9/1.jpg"></p>
		    			<p>妖猫传</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/9/2.jpg"></p>
		    			<p>战狼2</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/9/3.jpg"></p>
		    			<p>功守道</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/9/4.jpg"></p>
		    			<p>芳华</p>
		    		</dt>
				</div>	
		    </li>


		    <!--10-->
		    <li>
		    	<div id="Absolute" class="show_title">2017年底流行起了一种什么人设？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">

					<dt class="qustion" data-s="0">
		    			<p><img src="img/10/1.jpg"></p>
		    			<p>斜杠青年</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/10/2.jpg"></p>
		    			<p>社会人</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/10/3.jpg"></p>
		    			<p>小确丧</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/10/4.jpg"></p>
		    			<p>佛系</p>
		    		</dt>
				</div>	
		    </li>


		    <!--11-->
		    <li>
		    	<div id="Absolute" class="show_title">江歌案被告陈世峰一审判决结果是？</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt><img src="img/11/1.jpg" width="380"></dt>
					<dt class="qustion question-list" data-s="0"  style="margin-top: 20px;">
		    			<p>无期徒刑</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>死刑</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="10">
		    			<p>有期徒刑20年</p>
		    		</dt>
		    		<dt class="qustion question-list" data-s="0">
		    			<p>有期徒刑30年</p>
		    		</dt>

				</div>	
		    </li>
			
			<!--12-->
		    <li>
		    	<div id="Absolute" class="show_title">好姐妹的感情就像什么?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="10">
		    			<p><img src="img/12/1.jpg"></p>
		    			<p>塑料姐妹花</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/12/2.jpg"></p>
		    			<p>波波姐妹花</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/12/3.jpg"></p>
		    			<p>蕾丝姐妹花</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/12/4.jpg"></p>
		    			<p>校服姐妹花</p>
		    		</dt>
				</div>	
		    </li>


			<!--13-->
		    <li>
		    	<div id="Absolute" class="show_title">年初在美国因持枪藏毒的中国艺人是?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="0">
		    			<p><img src="img/13/1.jpg"></p>
		    			<p>岳云鹏</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/13/2.jpg"></p>
		    			<p>宋小宝</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/13/3.jpg"></p>
		    			<p>周立波</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/13/4.jpg"></p>
		    			<p>王宝强</p>
		    		</dt>
				</div>	
		    </li>


		    <!--14-->
		    <li>
		    	<div id="Absolute" class="show_title">G20峰会期间，普京大帝因为迟到向哪国元首SAY SORRY ?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="0">
		    			<p><img src="img/14/1.jpg"></p>
		    			<p>特朗普</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/14/2.jpg"></p>
		    			<p>安倍晋三</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/14/3.jpg"></p>
		    			<p>习大大</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/14/4.jpg"></p>
		    			<p>默克尔</p>
		    		</dt>
				</div>	
		    </li>

		    <!--15-->
		    <li>
		    	<div id="Absolute" class="show_title">以下那一项不是IPHONE X 的卖点?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="0">
		    			<p><img src="img/15/1.jpg"></p>
		    			<p>人脸识别</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/15/2.jpg"></p>
		    			<p>双摄</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/15/3.jpg"></p>
		    			<p>全面屏</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/15/4.jpg"></p>
		    			<p>空气刘海</p>
		    		</dt>
				</div>	
		    </li>


		     <!--16-->
		    <li>
		    	<div id="Absolute" class="show_title">2017 搞笑诺贝尔上猫被证明是什么体?</div>
				<div id="Absolute" class="show_line"></div>
				<div class="testBox style-list">
					<dt class="qustion" data-s="0">
		    			<p><img src="img/16/1.jpg"></p>
		    			<p>胴体</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/16/2.jpg"></p>
		    			<p>天体</p>
		    		</dt>
		    		<dt class="qustion" data-s="10">
		    			<p><img src="img/16/3.jpg"></p>
		    			<p>液体</p>
		    		</dt>
		    		<dt class="qustion" data-s="0">
		    			<p><img src="img/16/4.jpg"></p>
		    			<p>灵体</p>
		    		</dt>
				</div>	
		    </li>
		   
		</ul>


	</div>
	
	<div id="Absolute" class="next-panel"></div>




	

</div>



<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script>
	//定义主画面高度
	$win = $(window).height();
	$("#TestPage").height($win);

	$.cookie('score', 0); 
	//倒计时
	$countDownList = $('.countDownList li');
	var count = 14;
	var countdown = setInterval(CountDown, 1000);

	function CountDown() {
        //倒计时
        $countDownList.eq(count).hide();
	    if (count == 0) {
	        $countDownList.show();
	        count=15;
	    }
	    count--;
	}

	//得分
	var score = 0;

	$(".testBox").find('.qustion').on('click',function(){
		$(".testBox").find('.qustion').css({'background':'none',"color":'#000'});
		$(this).css({'background':'#000',"color":'#fced97'});	
		nowScore = parseInt($(this).attr('data-s'));
		score =  score+nowScore;
	});

	//下一个题目
	$('#dowebok').responsiveSlides({
	 	auto:true,
	 	timeout:16000,
	 	after:function(){
	 		count=0;
	 	},
	 	before:function(index){
	 		
	 		$('.question-list').css({'background':'#ffcc66','color':'#000'})

	 		var number = index+1;
	 		$('.show_number').empty().text(number);
	 		if(number==11)
	 		{
	 			$('.show_number').hide();
	 			$.cookie('score',score);
	 			window.location='res.php?act=res';
	 		}
	 	},
	 	nav: true,
	 	pauseControls:false,
	 	navContainer:'.next-panel',
	 	random:true
	});

</script>

<script>

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
