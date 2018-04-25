<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui" />
	<title>报修</title>
	<link rel="stylesheet" href="/Public/Home/fonts/iconfont.css">
	<link rel="stylesheet" href="http://at.alicdn.com/t/font_495581_nl5nael9r049rudi.css">
	<link rel="stylesheet" href="/Public/Home/css/repair.css">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfontHome.css">
	<script src="/Public/Home/js/flexible.js"></script>
	<script src="/Public/Home/js/laydate.js"></script>
	<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/Admin/layui/layui.js"></script>
	<style>
		#repair-main>i {
			color: #51bdf3;
		}
		#repair-container>input {
			background: #039CE9;
		}
		.timer-set>div {
			width: 5.18555rem;
			display: flex;
    		justify-content: space-between;
    		align-items: center;
		}
		#chooseDate, #star, #end {
			border: 1px dashed #ccc;
			font-size: .4rem;
			border-radius: 2px;
		}
		#repair-main {
			height: auto;
		}
		.repair-sendpic {
			width: 2.5rem;
		    height: 2.5rem;
		    position: absolute;
		    left: 0;
		    opacity: 0;
		    margin-top: .2rem
		}
		#repair-link>p>input {
			width: 6.6rem;
			padding: 0 2%;
		}
		#picShow {
			width: 100%;
			display: inline;
			position: relative;
		}
		#picShow>span {
			width: 20vmin;
			height: 20vmin;
			display: inline-block;
			position: relative;
			margin: 2vmin 1vmin;
		}
		#picShow>span>img {
			width: 100%;
			height: 100%;
			display: inline-block;
			position: relative;
		}
		.delPic {
			width: 5vmin;
			height: 5vmin;
			display: flex;
			justify-content: center;
			align-items: center;
			position: absolute;
			top: 0;
			right: 0;
			margin-top: -2vmin;
			margin-right: -2vmin;
			border-radius: 5vmin;
			color: #fff;
			background: red;
		}
		textarea {
			font-size: .4rem;
		}
		.layui-laydate, .layui-laydate-main{
			width: 98vw;
			left: 50%;
			/*transform: translateX(-49vw);*/
		}
		.laydate-footer-btns {
			width: 50%;
			display: flex;
			position: relative;
			right: 0;
			top: 0;
			align-items: center;
		}
		.laydate-btns-clear,
		.laydate-btns-now,
		.laydate-btns-confirm {
			width: 33.33%;
			display: inline-block;
			padding: 10% !important;
		}
		.layui-laydate-content table {
			width: 90%;
			position: relative;
			left: 50%;
			margin-left: -45%;
		}
		.layui-laydate-footer {
			display: flex;
			justify-content: flex-end;
			height: auto;
		}
		.laydate-footer-btns span {
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.laydate-time-list>li>ol {
			overflow-x: hidden;
			overflow-y: scroll;
		}
	</style>
</head>
<body>
	<form action="<?php echo U('Home/Repair/index');?>" method="post" enctype="multipart/form-data" id="form">
		<div id="repair-all">
			<div id="repair-container">
				<div id="repair-timer">
					
					<p>设备编码：<?php echo ($code['device_code']); ?></p><br>
					<p>服务时间：</p>
					<div class="timer-set">
						<input type="hidden" value="<?php echo ($code['device_code']); ?>" name="device_code">
						<input name="date" type="button" class="in-first layui-input" id="chooseDate" value="" placeholder="yyyy年MM月dd日"><br>
						<div>
							<input name="begin_time" type="button" id="star" value="" placeholder="HH:mm:ss">
							<b>~</b>
							<input name="over_time" type="button" id="end" value="" placeholder="HH:mm:ss">
						</div>
					</div>
				</div>
				<div id="repair-main">
					<h3>您所遇到的问题描述<b>*</b></h3>
					<textarea name="content" id="QUesdec" cols="30" rows="10"></textarea>
					<p>上传截图</p>
					<i class="iconfont icon-plus"></i>
					<input name="pic" class="repair-sendpic" accept="image/*" type="file" />
					<div id="picShow"></div>
				</div>
				<div id="repair-link">
					<p>联系方式</p>
					<p>
						<label for="name">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label>
						<!-- <input name="name" id="name" class="name" type="text" placeholder="请输入您的姓名"> -->
                        <input name="name" id="name" class="name" type="text" value="<?php echo ($code['name']); ?>" placeholder="请输入您的姓名">

					</p>
					<p>
						<label for="name">电&nbsp;&nbsp;&nbsp;&nbsp;话：</label>
						<!-- <input name="phone" id="name" class="phone" type="text" placeholder="请输入手机号码"> -->
                        <input name="phone" id="name" class="phone" type="text" value="<?php echo ($code['phone']); ?>" placeholder="请输入手机号码">

					</p>
					<p>
						<label for="name">维修地址：</label>
						<!-- <input name="address" id="name" class="address" type="text" placeholder="请输入您的详细地址"> -->
                    	<input name="address" id="name" class="address" type="text" value="<?php echo ($code['address']); ?>" placeholder="请输入您的详细地址">

					</p>
					<p>	
						<?php if($phone['csphone']): ?><label for="name" style="padding-top: 10px;">客服电话：<a href="tel:<?php echo ($phone['csphone']); ?>" class="telephone"><?php echo ($phone['csphone']); ?></a></label>
						<?php else: ?>
						<label for="name" style="padding-top: 10px;">客服电话：<a href="tel:<?php echo ($phone['phone']); ?>" class="telephone"><?php echo ($phone['phone']); ?></a></label><?php endif; ?>
						
						
					</p>
				</div>
				<input type="button" value="提交" id="re-commit">
			</div>

		</div>
	</form>
	<script>

		//layuiHint弹框提示封装
		function layuiHint(text){
		    layui.use('layer', function(){
		        var layer = layui.layer;
		        layer.msg(text);
		    });  
		}
		$(function(){

			$("#star").val('09:00:00');
			var nowDate = new Date().getTime();

			// $("#chooseDate").val(
			// 	new Date().toLocaleString()
			// 	.substr(0,9).replace('/', '年').replace('/', '月') +'日'
			// );
			// console.log(end_time);
			
			$("#chooseDate").click(function(){

			  	//选择服务日期，
				laydate.render({
					elem: '#chooseDate', //指定元素
					show: true,
					format: 'yyyy年MM月dd日',
					btns: ['clear', 'confirm'],
					min: 1
				});
			})

			var startDate, endDate;
			$("#star").click(function(){

				// 选择服务起始时间
				startDate = laydate.render({
					elem: '#star', //指定元素
					show: true,
					type: 'time',
					format: 'HH:mm:ss',
					min: '09:00:00',
					max: '18:00:00',   
					done: function (value, dates) {  
						// console.log(dates);
					    endDate.config.min ={  
				             year: dates.year,   
				             month: dates.month-1, //关键  
				             date: dates.date,   
				             hours: dates.hours,   
				             minutes: dates.minutes,   
				             seconds : dates.seconds  
					    };      
					}
				});
			})

			$("#end").click(function(){
				// 选择服务结束时间
				endDate= laydate.render({
					elem: '#end', //指定元素
					show: true,
					type: 'time',
					format: 'HH:mm:ss',
					btns: ['clear', 'confirm'],
					min: '09:00:00',
					max: '18:00:00'
				});
			});
			// 选择服务结束时间
			endDate= laydate.render({
				elem: '#end', //指定元素
				type: 'time',
				format: 'HH:mm:ss',
				btns: ['clear', 'confirm'], 
				min: '09:00:00',
				max: '18:00:00'
			});
			
			$('form>input').click(function(){
				$('#repair-main>i').css('color','#6848F9');
				$('form>input').mouseout(function(){
					$('#repair-main>i').css('color','#D0D1FC');
				})
			});

			// 上传的图片
			$(".repair-sendpic").on("change",function(e){
				var files =this.files;
				var span = $("<span></span>"),
					span1 = $("<span>X</span>"),
					img = $('<img src="" alt="" />'
						);
				var reader =new FileReader();
				reader.readAsDataURL(files[0]);
				reader.onload =function(e){
					var mb = (e.total/1024)/1024;
					if(mb>= 4){
						layuiHint('文件大小大于4M');
						return;
					}
					img[0].src = this.result;
					img[0].width = "100%";
					img[0].height = "90%";
					
					// console.log(span, span[0]);
					span1.addClass("delPic");
					span1.css({zIndex: '999'});
					span.append(span1);
					span.append(img[0]);
					$('#picShow').append(span);
				}
			});

			// 点击上传的图片右上角的" x "，删除这张图片
			$(".delPic").live("click", ".delPic", function(){
				$(this).parent().remove();
			})

			// 验证姓名，手机号，地址的正则
			var	nameReg = /^([a-zA-Z0-9_\u4e00-\u9fa5]){2,30}$/,
				phoneReg = /^(1[3|4|5|7|8])\d{9}$/,
				addressReg = /^(?=.*?[\u4E00-\u9FA5])[\dA-Za-z\u4E00-\u9FA5]{8,}/;

			// 点击‘提交’
			$("#re-commit").click(function(){

				if($("#chooseDate").val() 
					&& $("#star").val() && $("#end").val() 
					&& $("#QUesdec").val() && $("#picShow").html()
					&& (nameReg.test($(".name").val()))
					&& (phoneReg.test($(".phone").val()))
					&& (addressReg.test($(".address").val())) ){
					
					$("#form").submit();

				}else if(!$("#chooseDate").val() || !$("#star").val() || !$("#end").val()){
					layuiHint("请选择完整的服务时间！");

				}else if(!$("#QUesdec").val()){
					layuiHint("请描述您遇到的问题！");

				}else if(!$("#picShow").html()){
					layuiHint("请上传图片！");

				}else if( !(nameReg.test($(".name").val())) ){
					layuiHint("请输入正确的姓名！");

				}else if( !(phoneReg.test($(".phone").val())) ){
					layuiHint("请输入正确的手机号码！");

				}else if( !(addressReg.test($(".address").val())) ){
					layuiHint("请输入详细地址！");

				}

				// console.log($("#picShow").html())
				// console.log($("#QUesdec"))
			})
		})
	
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