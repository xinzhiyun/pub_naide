<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" >    
<!-- <link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="/Public/Home/css/mobileStyle.css"> -->
<link rel="stylesheet" href="/Public/Home/fonts/iconfont.css">
<link rel="stylesheet" href="/Public/Home/css/mine-first.css">
<link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfontHome.css">
<title>个人信息</title>
<style> 
	#mine-first-top>.mine-pic>p {
		color: #039CE9;
		font-weight: 600;
	}
	#mine-first-all {
	    padding-top: 5vh;
	}
	.bgTop {
   		background: url('/Public/Home/images/mine-first-02.jpg') no-repeat;
	}
	#mine-first-container {
		margin: 0rem 0.4rem 0.0rem 0.4rem;
	}
	#deviceManage>a,
	#clearLog>a,
	#proposal>a,
	#deviceRepair>a {
		width: 98%;
	    height: 1.3rem;
	    display: block;
	    position: absolute;
	}
	.userName,
	.device_code,
	.mineAddr,
	.userPhone {
		display: block;
		margin: 4px 0;
		color: #35365A;
		font-size: .35rem;
	}
	.userName,
	.mineAddr {
		width: 100%;
		position: relative;
		overflow: hidden;
	}
	/*地址*/
	.mineAddr>em {
		width: 30%;
		display: inline-block;
		position: relative;
		float: left;
	}
	.mineAddr>span {
		width: 65%;
		position: relative;
		display: inline-block;
	}
	.device_code,
	.userPhone {
		width: 100%;
	}
	#deviceManage>a, 
	#clearLog>a, 
	#proposal>a, 
	#deviceRepair>a {
		position: relative;
	}
	.mine-name>section {
		width: 74%;
	    position: relative;
	    left: 50%;
	    margin-left: -37%;
	}
	.edit {
		width: 100%;
		position: absolute;
		bottom: 8px;
		text-align: center;
	}
	.infoBtn{
		border-radius:5px; 
		padding:2px 12px; 
		border:1px solid #2eacec;
	}
	#m-f-list>ul>li>a>i {
		color: #E69A3F;
	}
</style>
</head> 
<body>
<div style="display: none">
	<img src="/Public/Home/images/mine-first-01.png" alt="">
</div>
<div id="mine-first-all" class="mine-first-all bgTop" >
	<input type="hidden" id="refreshed" value="no">
	<div id="mine-first-container">
		<div id="mine-first-top">
			<div class="mine-pic">
				<b>
					<img src="<?php echo ($userInfo['head']); ?>" alt="">
				</b>
				<p><?php echo ($userInfo['nickname']); ?></p>
			</div>
			<div class="mine-name">
			 	<section>
			 		<p>
				 		<span class="userName">
				 			<em>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</em>
				 			<?php echo ($userInfo['name']); ?>
				 		</span>
				 		<span class="device_code">
				 			<em>设备型号：</em>
				 			<?php echo ($userInfo['device_code']); ?>
				 		</span>
			 		</p>
			 		<p>
				 		<span class="mineAddr">
				 			<em>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</em>
				 			<span><?php echo ($userInfo['address']); ?></span>
				 		</span>
				 		<span class="userPhone">
				 			<em>手机号码：</em>
				 			<?php echo ($userInfo['phone']); ?>
				 		</span>
			 		</p>
					<p class="edit"><a class="infoBtn" href="personalinformation">编辑</a></p>					<b> </b>
			 	</section>
			</div> 
			<div class="shouFang">
				<p class="xia"><i class="iconfont icon-xial xia"></i></p>
				<p class="shang"><i class="iconfont icon-jiantouyoushuang-"></i></p>
			</div>
		</div>
		<div id="mine-first-bottom">
			<div id="m-f-list">
				<h3>我的订单</h3>
				<ul>
					<li>
						<a href="<?php echo U('Home/Orders/orderAll');?>?index=0" >
							<i class="iconfont icon-quanbudingdan iconfont2"></i><br>
							<p>全部订单</p>
						</a>
					</li>
					<li>
						<a href="<?php echo U('Home/Orders/orderAll');?>?index=1">
							<i class="iconfont icon-icon_daifukuan"></i><br>
							<p>待付款</p>
						</a>
					</li>                 
					<li>
						<a href="<?php echo U('Home/Orders/orderAll');?>?index=2">
							<i class="iconfont icon-daifahuo3"></i><br>
							<p>待发货</p>
						</a>
					</li>
					<li>
						<a href="<?php echo U('Home/Orders/orderAll');?>?index=3">
							<i class="iconfont icon-daifahuo2"></i><br>
							<p>待收货</p>
						</a>
					</li>
				</ul>
			</div>
			<div id="m-f-b-list">
				<ul>
					<li id="deviceManage">
						<a href="<?php echo U('Home/Devices/manage');?>">
							<i class="iconfont  icon-shebeiguanli1 num-one"></i>
							<b>设备管理</b>
							<i class="iconfont icon-dayuhao right "></i>
							<span>当前设备：<?php echo ($userInfo['device_code']); ?></span>
						</a>
					</li>
					<li id="clearLog">
						<a href="<?php echo U('Home/WaterPurifier/record');?>">
							<i class="iconfont icon-jilu num-two"></i>
							<b>净水记录</b>
							<i class="iconfont icon-dayuhao right "></i>
						</a>
					</li>
					<li id="clearLog">
						<a href="<?php echo U('Home/Users/reward');?>">
							<i class="iconfont icon-jilu num-two"></i>
							<b>服务记录</b>
							<i class="iconfont icon-dayuhao right "></i>
						</a>
					</li>
					<li id="deviceRepair">
						<a href="<?php echo U('Home/Repair/index');?>">
							<i class="iconfont icon-wuyebaoxiu num-third"></i>
							<b>报修</b>
							<i class="iconfont icon-dayuhao right "></i>
						</a>
					</li>
					<li id="proposal">
						<a href="<?php echo U('Home/Feeds/proposal');?>">
							<i class="iconfont  icon-dengpao1 num-fourth"></i>
							<b>建议</b>
							<i class="iconfont icon-dayuhao right "></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
	<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/Home/js/flexible.js"></script>
	<script src="/Public/Home/js/mine-first.js"></script>
	<script>
		if(window.name != 'hasload'){
			location.reload();
			window.name = 'hasload';
		}else{
			window.name = '';
		}

	</script>
</body>
</html>
 <link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfontHome.css">
<style type="text/css">
	/*首页键*/
	.linkBox{
		width: 100%;
		height: 7.5vh;
		line-height: 7.5vh;
		background:rgba(12, 93, 134, 1);
		font-size: 5vw !important;
		font-family: "微软雅黑";
		z-index:1000000;
	}
	.linkBox a{
		color: #fff;	
		text-decoration: none;	
	}
	.linkBox a:hover{
		text-decoration: none !important;
	}
	.linkBox a:first-child{
		float: left;
	}
	.linkBox a:last-child{
		float:right;
		padding: 0 20px;
	}
	.linkBox .icon-zuo{
		margin-left: .2rem;
	}
</style>
<script type="text/javascript">

    // 公版项目“首页”、“返回”按钮
    !function(){
    var aHtml='<div class="linkBox">'+
            '<a class="returnBtn" href="javascript:history.go(-1);"><i class="iconfont icon-zuo"></i>返回</a>'+
            '<a class="indexBtn" href="<?php echo U('/Home/index');?>">首页</a>'+
            '</div>';
    $("body").prepend(aHtml);
    }()
</script>