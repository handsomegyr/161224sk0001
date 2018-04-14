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
	
	<?php
		$share = isset($_GET['share']) ?  $_GET['share'] : 1;

		if($share == 1)
		{
	?>
	<img src="img/share1.jpg" width="640">

	<?php
	}elseif($share==2){
	?>
	<img src="img/share2.jpg" width="640">
	<?php
	}elseif($share==3){
	?>
	<img src="img/share3.jpg" width="640">
	<?php
	}
	?>


</div>






</body>
</html>
