<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui" />
	<title>滤芯---充值 </title>
	<link rel="stylesheet" href="/Public/Home/css/lvxin-chongzhi.css">
	<link rel="stylesheet" href="/Public/Home/fonts/iconfont.css">
	<!-- <link rel="stylesheet" href="http://at.alicdn.com/t/font_495581_xn0gpcbuksc92j4i.css"> -->
	<link rel="stylesheet" href="/Public/Admin/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfontHome.css">
	<style type="text/css">
	.linkBox{
		position: fixed;
		top:0;
	}
	input{
		appearance:none;
		-moz-appearance:none; /* Firefox */
		-webkit-appearance:none; /* Safari and Chrome */
	}
	.shopCart input{
		border-radius:0;
	}
</style>
</head> 
<body>
	<div id="contain">
		<input type="hidden" value=<?php echo ($device['device_code']); ?>  id="device">
		<div id="ulDiv">
			<ul class="_ul _position">
				<li>套餐</li>
				<li>产品</li>
			</ul>
			<div id="lineDiv" class="_line"></div>
			<!-- <a id="back2Home" href="<?php echo U('Home/index/index');?>"><i class="iconfont icon-zhuye"></i></a> -->
		</div>

		<div class="contentBox">
			<div id="liuliang" class="contentbox">
				<h3><b>选择套餐</b></h3>
				<?php if(is_array($setmeallist)): foreach($setmeallist as $ke=>$vo): ?><input type="button" value="<?php echo ($vo['describe']); ?>" remodel="<?php echo ($vo['remodel']); ?>" dayNum="<?php echo ($vo['flow']); ?>" flowNum="<?php echo ($vo['flow']); ?>" sid="<?php echo ($vo['id']); ?>"><br><?php endforeach; endif; ?>
			</div>
			<!-- 滤芯开始 -->
			<div id="mo" class="contentbox">
				<?php if(is_array($filtersList)): foreach($filtersList as $k=>$v): ?><div class="item" state="0">
						<div id="ro1" class="ro1">
							<div id="ro-left" index="<?php echo ($v); ?>"><img src="/Public<?php echo ($v['picpath']); ?>" alt=""></div>
							<div id="ro-right">
								<div class="top">
									<h3><?php echo ($v['filtername']); ?></h3>
									<p text="<?php echo ($v['introduce']); ?>"><?php echo (msubstr($v['introduce'],0,45,'utf-8')); ?></p>
								</div>
								<div class="bott">
									<b>￥<?php echo ($v['price']/100); ?> </b>
									<i>
										<input type="button" value="━" class="minus"><input fid="<?php echo ($v['id']); ?>" class="num" type="number" value="0"><input type="button" value="╋" class="plus">
									</i>
								</div>
							</div>
						</div>
						<hr>
					</div><?php endforeach; endif; ?>	
			</div>
		</div>
		<!-- 滤芯结束 -->
		<div id="foot">
			<a class="shopCart"><i class="iconfont icon-gouwuche">
				<?php if(!empty($cartNum)): ?><span id="cartNun"><?php echo ($cartNum); ?></span><?php endif; ?>	
			</i></a>
			<input id="cart" type="button" value="加入购物车"><input id="buy" type="button" value="立即购买">
		</div>
	</div>
	<!-- layui.js -->
	<script type="text/javascript" src="/Public/Admin/layui/layui.js"></script>
	<script src="/Public/Home/js/jquery-1.11.1.min.js"></script>
	<script src="/Public/Home/js/flexible.js"></script>
	<!-- 微信支付支持JS部分代码 -->
	<script src="/Public/Home/js/jweixin-1.2.0.js"></script>	
	<script>
		$(function(){
			if(window.name != "") {
				window.location.reload();
				window.name = "";
			}
			var leaseMode;	//判断上次选择的是充值还是滤芯
			var flowNum=0;
			var dayNum=0;
			var deviceId=$("#device").val();
			var data = [];// 创建空数组，将来装套餐和产品
			//  选中的套餐类型
			$('#liuliang>input').click(function(){
				// 被选中的充值套餐改变样式// 找到所有的充值套餐，设置默认样式
				$(this).css({'background': '#039CE9','color':'#FFF'}).siblings().css({'background': 'rgba(0,0,0,0)','color':'#585858'});
				// 给被选中的套餐添加class属性sid值// 清除所有的class属性sid值
				$(this).addClass("sid").siblings().removeClass("sid");
				// 获取充值的流量或套餐
				if($(this).attr("remodel")=="0"){// 按流量充值
					dayNum = 0;
					leaseMode=1;
					flowNum = $(this).attr("flowNum");
				}else if($(this).attr("remodel")=="1"){// 按时间充值
					leaseMode=2;
					flowNum = 0;
					dayNum = $(this).attr("dayNum");
				}
			});
	        //进入购物车
	        $(".shopCart").click(function(ev){
	        	window.location.href="<?php echo U('ShoppingCart/shopBill');?>";
	        	window.name = "bencale";
	        });
			//立即购买操作
			$('#buy').click(function(){
	            var type=0;      
	            var cartNun = $('#cartNun').html()-0;// 获取购物车产品数量，隐转数值
	            
	            var index = 0;// 初始化下标
	            var sid = $('input.sid').attr('sid');// 获取被选中的套餐
	            if(sid !== undefined){
	                // 设置套餐ID为数组
	                data = [
	                {'sid':sid-0,'num':1,'deviceId':deviceId,'flowNum':flowNum,'dayNum':dayNum}
	                ];
	            }
	            
	            // 获取被选中的滤芯产品
	            var fid = $('input.fid');
	            if(fid.length>0){
	            	for(var i=fid.length-1;i>=0;i--){
	                    // 设置产品ID为数组
	                    data.push(
	                    	{'fid':$(fid[i]).attr('fid')-0,'num':$(fid[i]).val()-0}
	                    	);
	                }
	            }

	            // 检测是否选择产品
	            if(data.length>0){
	                // ajax请求添加购物车
	                var date = JSON.stringify(data)
	                // 异步提交
	                $.post('<?php echo U("ShoppingCart/shopAdd");?>',{ 'data':date }, function(res){
	                    // 判断购物车是否添加成功
	                    if(res.status==1){
	                        // 添加购物车成功跳转
	                        // 异步提交请求支付系统
							if(leaseMode=="0"){//零售型
								layuiHint("您的设备不需要充值");
							}else{
								// 立即付款
								$.post('<?php echo U("PaymentSystem/action");?>',{ 'data':1, }, function(res){
									if(res==2){
										// 套餐确认
										window.location.href='<?php echo U("ShoppingProcess/sureSetmeal");?>';
									}else if(res==3){
										// 快递确认
										window.location.href='<?php echo U("ShoppingProcess/sureBill");?>';
									}else {
										
										weixinPay(res);
									}
								});
							}
						}
					})
	            }else{
	                // 购物车有产品
	                if(cartNun>0){
	                    // 直接跳转到购买页面
	                    //window.location.href='<?php echo U("PaymentSystem/action");?>';
	                    // 异步提交
	                    // $.post('<?php echo U("PaymentSystem/action");?>',{ 'data':1 }, function(res){
	                    //     if(res==2){
	                    //         // 套餐确认
	                    //         window.location.href='<?php echo U("ShoppingProcess/sureSetmeal");?>';
	                    //     }else if(res==3){
	                    //         // 快递确认
	                    //         window.location.href='<?php echo U("ShoppingProcess/sureBill");?>';
	                    //     }else{
	                    //         // 立即付款
	                    //         weixinPay(res);
	                    //     }
	                    // });
	                    $.ajax({
	                    	url:'<?php echo U("PaymentSystem/action");?>',
	                    	type:'post',
	                    	dataType:'json',
	                    	data:{ 'data':1 }, 
	                    	success:function(res){
	                    		// console.log(res);
	                    		if(res==2){
		                            // 套餐确认
		                            window.location.href='<?php echo U("ShoppingProcess/sureSetmeal");?>';
		                        }else if(res==3){
		                            // 快递确认
		                            window.location.href='<?php echo U("ShoppingProcess/sureBill");?>';
		                        }else{
		                            // 立即付款
		                            weixinPay(res);
		                        }
		                    }
		                });
	                }else{
	                    // 请先选择产品
	                    layuiHint('请先选择产品!');
	                }
	            }
	        })
			// 点击立即购买清除本地session某些项目
			$("#foot a").click(function(){
				sessionStorage.setItem('lineMove', '');
				sessionStorage.setItem('lineRight', '');
				sessionStorage.setItem('lineLeft', '');
				sessionStorage.setItem('shopFrom', '');
			})
			// 点击返回首页清除本地session某些项目
			// $("#back2Home").click(function(){
			// 	sessionStorage.setItem('lineMove', '');
			// 	sessionStorage.setItem('lineRight', '');
			// 	sessionStorage.setItem('lineLeft', '');
			// })
			var lineMove = sessionStorage.getItem("lineMove");	//判断上次选择的是充值还是滤芯
			// var deviceId = sessionStorage.getItem("deviceId");	//判断上次选择的是充值还是滤芯
			var lineRight = sessionStorage.getItem("lineRight"),
			lineLeft = sessionStorage.getItem("lineLeft"),
				shopFrom = sessionStorage.getItem("shopFrom");		//判断从充值进入商城还是点击商城进入商城
			if(shopFrom == 'charge'){	//从首页‘充值’进来
				// 左边偏移量
				var $left = $("._ul").children("li").eq(0).offset().left+$("._ul").children("li").eq(0).innerWidth()/2 - 25;
				// 下划线动画
				$('._line').css({left:$left+'px'});

				$("._ul").children("li").eq(0).css({color: '#039CE9'});
				$("._ul").children("li").eq(1).css({color: '#6F6F6F'});

			}else if(shopFrom == 'mall'){	//从首页‘商城’进来
				// 左边偏移量
				var $left = ($("._ul").children("li").eq(1).offset().left+$("._ul").children("li").eq(1).innerWidth()/2 - 25 );

				$('._line').css({left:$left+'px'});

				$("._ul").children("li").eq(0).css({color: '#6F6F6F'});
				$("._ul").children("li").eq(1).css({color: '#039CE9'});
				// // 显示当前的内容盒子
				$(".contentBox").children('div').eq(0).hide();

				$(".contentBox").children('div').eq(1).show();
			}else{
				var $left = $("._ul").children("li").eq(0).offset().left+$("._ul").children("li").eq(0).innerWidth()/2 - 25;
				$('._line').css({left:$left+'px'});
			}
			// 加入购物车时的界面
			if(lineMove == lineLeft && lineMove && lineLeft ){	//上次选择的是充值

				$("._ul").children("li").eq(0).css({color: '#039CE9'});
				$("._ul").children("li").eq(1).css({color: '#6F6F6F'});
				// // 显示当前的内容盒子
				$(".contentBox").children('div').eq(0).slideDown().siblings().slideUp();
				// 下划线动画
				$('._line').animate({left:lineLeft+'px'});

			}else if(lineMove == lineRight && lineMove && lineRight){	//上次选择的是滤芯
				$("#lineDiv").css({left: lineRight + 'px'});
				$("._ul").children("li").eq(0).css({color: '#6F6F6F'});
				$("._ul").children("li").eq(1).css({color: '#039CE9'});

				// // 显示当前的内容盒子
				$(".contentBox").children('div').eq(1).slideDown().siblings().slideUp();
				// 下划线动画
				$('._line').animate({left:lineRight+'px'});
			}
			$("#ro-right>.top>p").click(function(){
				layuiHint( $(this).attr('text') );
			})
			//微信接口
			wx.config({
				debug: false,
				appId: '<?php echo ($info["appId"]); ?>',
				timestamp: '<?php echo ($info["timestamp"]); ?>',
				nonceStr: '<?php echo ($info["nonceStr"]); ?>',
				signature: '<?php echo ($info["signature"]); ?>',
				jsApiList: [
			      // 所有要调用的 API 都要加到这个列表中
			      'chooseWXPay'
			      ]
			  });

			/**
			 * TAB切换
			 * 找到充值和滤芯按钮并绑定点击事件
			 */
			 // $('._line').css({left:($('._ul > li').eq(0).offset().left+$('._ul > li').eq(0).innerWidth()/2 - 25)+'px'});
			//点击事件
			$('._ul > li').click( function () {
				// 选中和不选中的状态
				$(this).css({color: "#039CE9"});
				$(this).siblings("li").css({color: "#6F6F6F"});
				// 左边偏移量
				var $left = $(this).offset().left+$(this).innerWidth()/2 - 25;
				// // 显示当前的内容盒子
				$(".contentBox").children('div').eq($(this).index()).slideDown().siblings().slideUp();
				// 下划线动画
				$('._line').animate({left:$left+'px'});
			});
			/**
			 *  减号按钮让产品购买数量自减
			 */
			 //layuiHint弹框提示封装
			function layuiHint(text){
			 	layui.use('layer', function(){
			 		var layer = layui.layer;
			 		layer.msg(text);
			 	});
			}
			$('.minus').next('input').on('blur',function(){
			 	if(/[^\d]+/.test($(this).val().trim())){
			 		layuiHint('请输入数字')
			 		$(this).val('0')
			 	}
			})
			$('.minus').click(function(){// 点击减号按钮获取当前产品的value值,隐式转数值型
				var num = $(this).next('input').val()-0;
				if(num>0){// 判断产品数量大于0
					$(this).next('input').val(--num);// 产品数量自减
					if(num==0){// 如果产品数量等于0
						// 找祖先元素.item下面的子元素hr设置样式
						$(this).parents('.item').find("hr").css({'border':'1px solid #CCC'});
						// 找祖先元素.item设置样式
						$(this).parents('.item').css({'background':'#FFF'});
						// 清除class属性fid值
						$(this).next('input').removeClass("fid");
					}
				}
			});
			//加号按钮让产品购买数量自增
			$('.plus').click(function(){
				// 点击加号按钮获取当前产品的value值,隐式转数值型
				var num = $(this).prev('input').val()-0;
				// 判断产品数量小于库存
				if(true){
					// 产品数量自增
					$(this).prev('input').val(++num);

					// 找祖先元素.item设置样式
					$(this).parents('.item').css({'background':'#F0F0F0'});
					// 找祖先元素.item下面的子元素hr设置样式
					$(this).parents('.item').find("hr").css({'border':'1px solid #7D7FCE'});
					// 给被选中的产品添加class属性fid值
					$(this).prev('input').addClass("fid");
				}
			});

			/**
			 *  失去焦点事件检测产品购买数量设置样式
			 */
			$('.num').blur(function(){
				// 获取产品购买数量
				var num = $(this).val()-0;
				if(num<=0){
					// 特异常处理
					$(this).val(0);
					// 找祖先元素.item下面的子元素hr设置样式
					$(this).parents('.item').find("hr").css({'border':'1px solid #CCC'});
					// 找祖先元素.item设置样式
					$(this).parents('.item').css({'background':'#FFF'});
					// 清除class属性fid值
					$(this).removeClass("fid");
				}else{
					// 找祖先元素.item设置样式
					$(this).parents('.item').css({'background':'#F0F0F0'});
					// 找祖先元素.item下面的子元素hr设置样式
					$(this).parents('.item').find("hr").css({'border':'1px solid #7D7FCE'});
					// 给被选中的产品添加class属性fid值
					$(this).addClass("fid");
				}

			});

			/**
			 * 购买按钮和加入购物车按钮鼠标经过效果
			 */
			$('#foot>input').mouseenter(function(){
				// 将所有的input恢复默认样式
				$(this).parents('#foot').find('input').css({'background':'rgba(0,0,0,0)','color':'#039CE9'});
				// 设置当前的按钮样式
				$(this).css({'background':'#039CE9','color':'#FFF'});

			});

			/**
			 * 加入购物车操作
			 */
			$('#cart').click(function(){

				// 创建空数组，将来装套餐和产品
				var data = [];
				// 初始化下标
				var index = 0;
				// 获取被选中的套餐
				var sid = $('input.sid').attr('sid');
				if(sid !== undefined){
					// 设置套餐ID为数组
					data = [
					{'sid':sid-0,'num':1}
					];
				}

				// 获取被选中的滤芯产品
				var fid = $('input.fid');
				if(fid.length>0){
					for(var i=fid.length-1;i>=0;i--){
						// 设置产品ID为数组
						data.push(
							{'fid':$(fid[i]).attr('fid')-0,'num':$(fid[i]).val()-0}
							);
					}
				}

				// 检测是否选择产品
				if(data.length>0){
					// ajax请求添加购物车
					var date = JSON.stringify(data)
					// 异步提交
					$.post('<?php echo U("ShoppingCart/shopAdd");?>',{ 'data':date }, function(res){
						// 判断购物车是否添加成功
						if(res.status){
							// 刷新页面
							// location.reload();
							location.href = "<?php echo U('Home/Shop/index');?>";
							// for(var i in res.msg){
							// 	$("#cartNun").val($("#cartNun").val() + res.msg.num)
							// }
						}
					});
					// 选中滤芯
					if(parseInt($("#lineDiv").css("left")) > $(window).innerWidth()/2){
						sessionStorage.setItem("lineRight",
							parseInt($("#lineDiv").offset().left+$("#lineDiv").innerWidth()/2 - 25)
							)
						sessionStorage.setItem("lineLeft",'')
						//设置判断当前所在“充值”还是”滤芯“的判断值
						sessionStorage.setItem("lineMove",
							parseInt($("#lineDiv").offset().left+$("#lineDiv").innerWidth()/2 - 25)
							)

					}else if(parseInt($("#lineDiv").css("left")) < $(window).innerWidth()/2){
						// 选中充值
						sessionStorage.setItem("lineLeft",
							parseInt($("#lineDiv").css("left"))
							)
						sessionStorage.setItem("lineRight",'')
						sessionStorage.setItem("lineMove",
							parseInt($("#lineDiv").offset().left+$("#lineDiv").innerWidth()/2 - 25)
							)
					}
				}else{
					// 用户未添加产品
					layuiHint('请先选择产品！');
				}

			});
			// 微信支付方法
			function weixinPay(res){
				WeixinJSBridge.invoke(
					'getBrandWCPayRequest',
					JSON.parse(res),
					function(res){
						if (res.err_msg.substr(-2) == 'ok') {
	                        // if(leaseMode=="1") {//按流量计费
	                        //     ajson["ReFlow"]=flowNum;
	                        // }else if(leaseMode=="2"){//按时间计费
	                        //     ajson["Reday"]=dayNum;
	                        // }else if(leaseMode=="3"){//时长和流量套餐
	                        //     ajson["ReFlow"]=flowNum;
	                        //     ajson["Reday"]=dayNum;
	                        // }
			                // 付款成功，跳转前台主页
			                location.href = "<?php echo U('Home/PaymentSystem/paySuccess');?>";
			            } else if (res.err_msg.substr(-6) == 'cancel') {
			                    // 取消付款
			                    // 跳转到待付款订单页面
			                    location.href = "<?php echo U('Home/PaymentSystem/failureToPay');?>";
			                }else{
			                    // 付款失败
			                    // 跳转到待付款订单页面
			                    location.href = "<?php echo U('Home/PaymentSystem/failureToPay');?>";
			                }
			            }
			            );
			};

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