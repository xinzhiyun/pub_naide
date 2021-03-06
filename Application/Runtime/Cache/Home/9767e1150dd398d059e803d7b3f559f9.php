<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui" />
	<title>报装/报修</title>
	<link rel="stylesheet" href="/Public/Home/css/Repair/css/repair.css">
	<link rel="stylesheet" href="/Public/Home/amazeui/assets/css/amazeui.min.css">
	<link rel="stylesheet" href="/Public/Home/css/common.css">
	<!-- <link rel="stylesheet" href="/Public/Home/css/laydate.css"> -->
	<link rel="stylesheet" href="/Public/Home/iconfont/iconfont.css">
</head>
<body style="overflow:auto">
<div class="repair-all_bg" id="repair_vue">
	<form action="" metho="post" enctype="multipart/form-data" id="form">
		<div id="repair-all">
		<!-- 服务内容部分开始 -->
			<div id="repair-container">
				<ul>
					<li>
						<p class="fblue">服务内容</p>
					</li>
					<li>	
						<div class="am-u-sm-3 fs-l">预约时间：</div>
						<div class="am-u-sm-5">&nbsp;</div>
						<div class="am-u-sm-3 fs-r" id="appointment">2018-03-30</div>
						<i class="am-u-sm-1 iconfont icon-xiangyou1"></i>
					</li>
					<li>
						<div class="am-u-sm-3 fs-l">预约时段：</div>
						<div class="am-u-sm-4">&nbsp;</div>
						<div class="am-u-sm-4 fs-r" id="repair_time">&nbsp;</div>
						<i class="am-u-sm-1 iconfont icon-xiangyou1"></i>
					</li>
					<li>
						<div class="am-u-sm-3 fs-l">服务类型：</div>
						<div class="am-u-sm-4">&nbsp;</div>
						<div class="am-u-sm-4 fs-r" id="repair_t">&nbsp;</div>
						<i class="am-u-sm-1 iconfont icon-xiangyou1"></i>
					</li>
				</ul>
				<ul>
					<li>
						<span>备注信息：</span>
						<textarea name="a" placeholder="您可以填写要备注的信息，或遇到的问题...(客不填)" id="comments"></textarea>
					</li>
					<li class="file_li">
						<div class="repairPic am-u-sm-4" id="Pic_file">
				            <i class="iconfont icon-ai-up-img"></i>
				            <span>添加问题图片</span>
				            <input type="file" id="file_input" multiple/>  
			            </div>
			             <!-- <div class="pic_2 am-u-sm-4"><img src="../../Public/frontEnd/images/1a.jpg" alt=""></div> -->
					</li>
				</ul>
			</div>
		<!-- 服务内容部分结束 -->

		<!-- 信息确认部分开始 -->
			<div id="repair-infoconfirm">
				<ul>
					<li class="l_z"><p class="fblue">信息确认</p></li>
					<li class="l_z">
						<div class="am-u-sm-3 fs-l">联系人：</div>
						<div class="am-u-sm-5">&nbsp;</div>
						<div class="am-u-sm-3 fs-r" id="contact">{{info_confirm.linkman}}</div>
						<i class="am-u-sm-1"></i>
					</li>
					<li class="l_z">
						<div class="am-u-sm-3 fs-l">联系电话：</div>
						<div class="am-u-sm-4">&nbsp;</div>
						<div class="am-u-sm-4 fs-r" id="contact_number">{{info_confirm.contact_number}}</div>
						<i class="am-u-sm-1"></i>
					</li>
					<li class="l_z">
						<div class="am-u-sm-3 fs-l">设备编码：</div>
						<div class="am-u-sm-2">&nbsp;</div>
						<div class="am-u-sm-6 fs-r" id="repair_device">{{info_confirm.device_code}}</div>
						<i class="am-u-sm-1"></i>
					</li>
					<li>
						<!-- <span class="fs-l">详细地址：</span> -->
						<!-- <textarea name="a" style="width:200px;height:70px;" class="fs-r" placeholder=""></textarea>  -->
						<div class="am-u-sm-3 fs-l">详细地址：</div>
						<div class="am-u-sm-8 fs-r" id="address">{{info_confirm.detailed_add}}</div>
						<i class="am-u-sm-1"></i>
					</li>
				</ul>
			</div>
		<!-- 信息确认部分结束 -->

			<input type="button" value="提交" id="repair-sub" class="bgblue">
		
		</div>
	</form>
	<!-- 预约时段蒙版开始部分 -->
		<div class="mask_bg time_bg">
			<div class="mask_bottom">
				<p class="fblue">预约时段</p>
				<ul id="time_ul">
					<li class="no_selected"></li>
					<li id="check time_selected">上午&nbsp;09:00-11:00</li>
					<li class="no_selected">下午&nbsp;14:00-17:00</li>
				</ul>
				<ul>
					<li></li>
				</ul>
			</div>
		</div>
	<!-- 预约时段蒙版结束部分 -->

	<!-- 维修蒙版开始部分 -->
		<div class="mask_bg repair_bg">
			<div class="mask_bottom">
				<p class="fblue">服务类型</p>
				<ul id='repair_ul'>
					<li class="no_selected">安装</li>
					<li id="repai_selected">维修</li>
					<li class="no_selected">维护</li>
				</ul>
				<ul>
					<li></li>
				</ul>
			</div>
		</div>
	<!-- 维修蒙版结束部分 -->

</div>
	<script src="/Public/Home/js/jquery.min.js"></script>
	<script src="/Public/Home/amazeui/assets/js/amazeui.min.js"></script>
	<script src="/Public/Home/js/public.js"></script>
	<script src="/Public/Home/js/vue.min.js"></script>
	<script src="/Public/Home/js/Repair/repair.js"></script>
	<script>
		window.onload = function(){
				
			var back2home = document.getElementsByClassName('back2home');
			back2home[0].setAttribute('href','{:U("Home/Index/index")}');
		}
	</script>
</body>
</html>