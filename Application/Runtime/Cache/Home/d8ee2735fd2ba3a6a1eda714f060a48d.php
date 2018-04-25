<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1" >

<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="/Public/Home/css/mobileStyle.css"> -->
<script src="/Public/Home/js/flexible.js"></script>
<link rel="stylesheet" href="/Public/Home/fonts/iconfont.css">
<link rel="stylesheet" href="/Public/Home/css/all-devices.css">
<script src="/Public/Admin/layui/layui.js"></script>
<script src="/Public/Home/js/jweixin-1.2.0.js"></script>	
<title>绑定指引</title>
<style>
	body{
		width: 100vw;
		height: 100vh;
	}

	#devices-list>h3,
	#devices-list>ul>li{
		font-size: 0.473333rem;
	}
	#devicesAdd {
		width: 100%;
		height: 8vh;
		line-height: 8vh;
		position: fixed;
		bottom: 0;
		left: 0;
		color: #039CE9 !important;
		font-size: 0.473333rem;
		background:#F1F1F1;
		font-family: "微软雅黑";
	}
	#devicesAdd i{
		font-size: .9rem;
		margin: 0 .4rem;
	}
	#devicesAdd span{
		display: inline-block;
		font-size: .5rem;
		float: right;
		margin-right: 62vw;
	}
</style>
<script>	
		$(function(){
			//layuiHint弹框提示封装
			function layuiHint(text){
			    layui.use('layer', function(){
			        var layer = layui.layer;
			        layer.msg(text);
			    });  
			}
			$('#devices-list li').bind('click',function(){
				var device_code = $(this).attr('title');
				var _this = this;
				$.ajax({
					url: '<?php echo U("Home/Devices/setNowDevices");?>',
					type: 'post',
					data: { 'device_code':device_code },
					success: function(res){
						if(res == 1){
							$(_this).find('span').addClass('device_now');	

							layuiHint('切换成功！');
							setTimeout(function(){
								location.href = "<?php echo U('Home/Users/mine');?>";
							}, 500);

						}else{
							layuiHint('切换失败！');

						}
					},
					error: function(res){
						layuiHint('切换失败，请稍后再试！');

					}
				})
				// $.post('<?php echo U("Home/Devices/setNowDevices");?>',{ 'device_code':device_code }, function(res){
				// 	// 判断切换设备
				// 	if(res==1){
				// 		$('#devices-list ul li b').removeClass('iconfont icon-chenggong');
				// 		$(_this).children('b').addClass('iconfont icon-chenggong');	
				// 	}
				// });
	
			});	
		});

		$(function(){
			$('#devicesAdd').bind({
				'mouseover' : function () { 

				$(this).css('color','#FF8600');
				},
				'mouseout' : function () {
				$(this).css('color','#ccc');
				}
			});
		});
	</script>

</head>
<body>
	<div id="devices-container">
		<div id="devices-list">
			<h3>所有设备</h3>
			<ul>
				<?php if(is_array($devices)): foreach($devices as $key=>$value): if($currentDevices['did'] == $value['id'] ): ?><!-- 用户当前设备 -->
							<li title="<?php echo ($value['device_code']); ?>"  style="cursor:pointer;"><p><span></span></p>设备编码:<?php echo ($value['device_code']); ?></li>
					    <?php else: ?>
					    	<li title="<?php echo ($value['device_code']); ?>"  style="cursor:pointer;"><p></p>设备编码:<?php echo ($value['device_code']); ?></li><?php endif; endforeach; endif; ?>
			</ul>
		</div>	
	</div>
	<div id="devicesAdd">
		<i class="iconfont icon-jiahao"></i><span>添加设备</span>
	</div>
<script>
	//微信接口
	wx.config({
	    debug: false,
	    appId: '<?php echo ($info["appId"]); ?>',
	    timestamp: '<?php echo ($info["timestamp"]); ?>',
	    nonceStr: '<?php echo ($info["nonceStr"]); ?>',
	    signature: '<?php echo ($info["signature"]); ?>',
	    jsApiList: [
	      // 所有要调用的 API 都要加到这个列表中
	      'configWXDeviceWiFi', 
	      'scanQRCode'
	    ]
	});	
	// 扫码绑定设备
	$("#devicesAdd").click(function(){
		wx.scanQRCode({
		    needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
		    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
		    success: function (res) {
		    	if (res.errMsg === "scanQRCode:ok"){
			    	// 当needResult 为 1 时，扫码返回的结果
				    $.ajax({
				    	url:"<?php echo U('Home/Devices/bind');?>",
				    	type:"post",
				    	data:{device_code:res.resultStr},
				    	dataType:'json',
				    	success:function(data){
				    		if(data==1){
				    			// 绑定成功，跳转到填写用户安装信息
				    			window.location.href = "<?php echo U('Home/Users/personalinformation');?>?"+new Date().getTime();
				    		}else if(data==-1){
				    			alert('设备不存在！');
				    		}else if(data==-2){
				    			alert('设备已被绑定！');
				    		}else{
				    			alert('设备绑定失败！');
				    		}
	
				    	},
				    	error:function(jqXHR, textStatus, errorThrown){
		    				alert("绑定失败" + jqXHR.status + textStatus + errorThrown);
				    		//console.log(jqXHR.status);
				    	}
				    });
				    //alert(res.resultStr);
			    }
			}
		});
	});

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