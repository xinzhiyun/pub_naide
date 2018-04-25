<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>净水物联网</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui" />
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfont.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/iconfontHome.css">
	<style type="text/css">
		.linkBox{
			display: none !important;
		}
		.dazi {
			display: flex;
			justify-content: space-between;
			align-items: baseline;
		}
		.dazi>b,
		.dazi>span {
			display: inline-block;
			position: relative;
			top: 0;
			margin: 0 auto;
		}
		#puretdsVal {
			position: relative;
		}
		.icon-leaking {
			color: red;
		}
		.flow_day {
			width: 100vw;
			display: block;
		}
		.flow_day>div {
			width: 33.33%;
			display: inline-block;
		}
		.flow_day>div:nth-of-type(2) {
			position: absolute;
		    height: 2rem;
		    top: .8rem;
		    left: 36%;
		    z-index: 11;
		}
		.flow_day>div:nth-of-type(3) {
			right: 0;
		}
		.flow_day>div>p {
			text-align: center;
		}
	</style>
</head>
<body>
	<input type="hidden" value="<?php echo ($_SESSION['weixin'][1]['appId']); ?>" id="appId">
	<input type="hidden" value="<?php echo ($_SESSION['weixin'][1]['nonceStr']); ?>" id="nonceStr">
	<input type="hidden" value="<?php echo ($_SESSION['weixin'][1]['signature']); ?>" id="signature">
	<input type="hidden" value="<?php echo ($_SESSION['weixin'][1]['timestamp']); ?>" id="timestamp">
	<input type="hidden" class="status" value=<?php echo ($status); ?> name=""><!--滤芯详情页面设置-->
	<input type="hidden" class="res" value=<?php echo ($res); ?> name=""><!--res数据-->
	<input type="hidden" class="deviceInfo" value=<?php echo ($deviceInfo); ?> name=""><!--设备状态数据-->
	<div class="content">
		<div class="top">
			<div class="topcontent">
				<div class="xuanhuan bg3"></div>
				<div class="bolang bg4"></div>
				<div class="bolang1 bg4"></div>
				<div class="containTxt">
					<div class="dazi" >
						<b id="rawtdsVal">
							0<span>ppm</span>
						</b>
					</div>
					<div class="queshui">纯水TDS</div>
					<div class="dazi1">
						<b id="puretdsVal">
							0<span>ppm</span>
						</b>
					</div>
					<div class="queshui1">原水TDS</div>
				</div>
			</div>
			<div class="allStatus clearfix" id="statusBox">
				<div class="statusZhishui addwater left"><!--制水-->
					<p><i class="iconfont icon-zhishui"></i></p>
					<span>制水</span>
				</div>
				<div class="fullWaters left"><!--水满-->
					<p><i class="iconfont icon-shuiman"></i></p>
					<span>水满</span>
				</div>
				<div class="statusShuiman service right"><!--检修-->
					<p><i class="iconfont icon-jianxiu"></i></p>
					<span>检修</span>
				</div>
				<div class="statusShuiman lessWaters right"><!--缺水-->
					<p><i class="iconfont icon-queshui"></i></p>
					<span>缺水</span>
				</div>
				<div class="statusShuiman wash right"><!--冲洗-->
					<p><i class="iconfont icon-chongxi"></i></p>
					<span>冲洗</span>
				</div>
				<div class="statusShuiman showDown right"><!--关机-->
					<p><i class="iconfont "></i></p>
					<span>已关机</span>
				</div>
				<div class="statusShuiman arrearage right"><!--欠费-->
					<p><i class="iconfont "></i></p>
					<span>已欠费</span>
				</div>
				<div class="statusShuiman outLine right"><!--离线-->
					<p><i class="iconfont "></i></p>
					<span>已离线</span>
				</div>
				<div class="statusShuiman leaking right"><!--离线-->
					<p><i class="iconfont icon-leaking"></i></p>
					<span>漏水</span>
				</div>
			</div>
			<div class="shuibolang">
				<div class='flow_day'>
					<div class="textLeft">
						<!--<p id="surplusVal"></p>-->
					</div>
					<div class='textcenter'></div>
					<div class="textRight">
				</div>
					<!--<p id="alreadyUsedVal"></p>-->
				</div>
				<div class="shuibolang1"></div>
				<div class="shuibolang2"></div>
			</div>
		</div>
		<div class="bottom">
			<ul class="clearfix">
				<li><a href="<?php echo U('Home/Index/filter');?>"><p class="iconfont icon-lvxin1"></p><span>滤芯</span></a></li>
				<li><a href="javascript:;" class="clickBtn"><p class="iconfont icon-kaiguan"></p><span class="switchText">开机</span></a></li>
				<li><a href="javascript:;" class="washBtn"><p class="iconfont icon-chongxi1"></p><span class="washText">冲洗</span></a></li>
			</ul>
			<ul class="clearfix">
				<li><a class="charge" href="<?php echo U('Home/Shop/index');?>" class=""><p class="iconfont icon-chongzhi1"></p><span>充值</span></a></li>
				<li><a href="<?php echo U('Home/Users/mine');?>"><p class="iconfont icon-wode1"></p><span>我的</span></a></li>
				<li><a class="mall" href="<?php echo U('Home/Shop/index');?>"><p class="iconfont icon-chongzhi"></p><span>商城</span></a></li>
			</ul>
		</div>
	</div>
	<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/flexible.js"></script>
	<script type="text/javascript" src="/Public/Admin/layui/layui.js"></script>
	<link rel="stylesheet" href="/Public/Admin/layui/css/layui.css" />
	<!-- 微信JSSDK -->
	<script src="/Public/Home/js/jweixin-1.2.0.js"></script>	
	<script src="/Public/Home/js/wx_share.js"></script>	
	<script>

	var pumpSpend = 260/60000;	//泵流速
	// 获取窗口高度
	var docCH = document.documentElement.clientHeight;
	// console.log(docCH)
	
	var topH = document.getElementsByClassName("top")[0].offsetHeight;
	// console.log(topH)

	var botH = docCH - topH;
	// console.log(botH)

	// $(".bottom").css("height", botH);
	// 记录是从充值进入商城还是点击商城进入商城
	$(".mall").click(function(){
		sessionStorage.setItem("shopFrom",'mall');
	})
	$(".charge").click(function(){
		sessionStorage.setItem("shopFrom",'charge');
	})

	sessionStorage.setItem("lineRight",'');
	sessionStorage.setItem("lineLeft",'');
	//页面加载时执行
	$(function(){
		// 获取微信JSSDK所需的数据
		var appId = $("#appId").val(),
			nonceStr = $("#nonceStr").val(),
			signature = $("#signature").val(),
			timestamp = $("#timestamp").val();

		// 调用微信分享
		//wxShare(appId,nonceStr,signature,timestamp);
		// console.log(appId,nonceStr,signature,timestamp)
		
		//变量定义
		var data = JSON.parse($(".status").val());
		var res = JSON.parse($('.res').val());
		var deviceInfo = JSON.parse($(".deviceInfo").val());
		var deviceId = data.deviceid;//设备id
		sessionStorage.setItem("deviceId",deviceId);//设备编号设置本地存储
		// var deviceId=162753445596778;//设备id
		// var deviceId=112233445566778;//设备id
		var devicestause = data.devicestause;//设备状态
		console.log(data);
		//netstause:  0: 断开， 1：连接中
		if(data.netstause == 1){	// 连接
			machineStatus();	//执行水机状态方法

		}else if(data.netstause == 0){		
			outLine();
			// return
		}

		function machineStatus(){
			if(devicestause == "0"){//制水
				addwater();
			}else if(devicestause == "1"){//冲洗
				wash();
			}else if(devicestause == "2"){//水满
				fullWaters();
			}else if(devicestause == "3"){//缺水
				lessWaters();
			}else if(devicestause == "5"){//检修
				service();
            }else if(devicestause == "6"){//欠费
                arrearage();
			}else if(devicestause == "7"){ //关机
				showDown();
			}else if(devicestause == "8"){//开机

			}
		}

		var usednumberFlow = parseInt(data.sumpump*pumpSpend);//已用流量
		var usednumberDay = parseInt(data.sumday);//已用天数
		var renumberFlow = parseInt(data.reflow);//剩余流量
		var renumberDay = parseInt(data.reday);//剩余天数
		// console.log(usednumberFlow);
		$("#puretdsVal").html((data.rawtds?data.rawtds:'0') + '<span>ppm</span>');
		$("#rawtdsVal").html((data.puretds?data.puretds:'0') + '<span>ppm</span>');
		// $(".textLeft").html("<p id='surplusVal'><span>剩余天数</span><b>"+(data.reday?data.reday:'0')+"天</b></p>");
		// $(".textRight").html("<p id='alreadyUsedVal'><span>已用天数</span><b>"+(usednumberFlow?usednumberFlow:'0')+"天</b></p>");
		//1.设备状态页面数据显示
		if(data.leasingmode == "0"){//零售

			$(".textLeft").html("<p id='surplusVal'><span>已用</span><b>"+(usednumberFlow?usednumberFlow:'0')+"L</b></p>");
			$(".textRight").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usednumberDay?usednumberDay:'0')+"天</b></p>");
		}else if(data.leasingmode == "1"){//显示流量值

			$(".textLeft").html("<p id='surplusVal'><span>剩余流量</span><b>"+renumberFlow+"L</b></p>");

			$(".textRight").html("<p><span>已用</span><b>"+(usednumberDay?usednumberDay:'0')+"天</p>");
			$(".textcenter").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usednumberFlow?usednumberFlow:'0')+"L</b></p>");

		}else if(data.leasingmode == "2"){//套餐值
			$(".textLeft").html("<p id='surplusVal'><span>剩余</span><b>"+(renumberDay?renumberDay:'0')+"天</b></b></p>");
			$(".textRight").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usednumberFlow?usednumberFlow:'0')+"L</b></p>");
			$(".textcenter").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usednumberDay?usednumberDay:'0')+"天</b></p>");

		}else if(data.leasingmode == "3"){//套餐&流量
			$(".textLeft").html("<p id='surplusVal'><span>剩余</span><b>"+(renumberDay?renumberDay:'0')+"天</b></p>");
			$(".textcenter").html("<p><span>已用</span><b>"+(usednumberFlow?usednumberFlow:'0')+"L</b></p>");
			$(".textRight").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usednumberDay?usednumberDay:'0')+"天</b></p>");
		}

		//websoket
		var websoket = new WebSocket("ws://120.27.12.1:6001");
		var PackNum = 0;//包数据
		var CmdList = [];//命令队列
		var identify = 0;
		var numAdd = 0;
		websoket.onopen = function(){
			//包数据
			ajson = {
				"DeviceID":deviceId,
				"PackType":"login",
				"Vison":0,
			};
			websoket.send(JSON.stringify(ajson));
			setTimeout(function(){
				ajson.PackType = "Select";
				websoket.send(JSON.stringify(ajson));
				setInterval(function(){
					websoket.send(JSON.stringify(ajson));
				},60000);
			},100);
		}
		// websocket 连接关闭后刷新页面
		websoket.onclose = function(){
			location.reload();
		}
		//实时接收数据
		websoket.onmessage = function(data){
			
			numAdd = 0;
			var dataList = JSON.parse(data.data);//读取websoket数据，转换为json对象
			var leasingmode = dataList.LeasingMode;//租赁模式
			//console.log(dataList.LeasingMode);
			machineStatus();//执行水机状态方法
			console.log(dataList);
			// 触发重绘，解决ppm重叠问题
			$("#rawtdsVal").toggleClass('repain');
			$("#puretdsVal").toggleClass('repain');
			// 获取设备租赁模式
			if(dataList.LeasingMode){
				sessionStorage.setItem("leaseMode",dataList.LeasingMode);
			}
			if(dataList.PackType == "Select"){	//返回查询数据类型数据
				console.log(dataList);
                
				var usedFlow = parseInt(dataList.SumPump*pumpSpend);
				var usedDay = parseInt(dataList.SumDay);

				//1.设备状态页面数据显示
				$("#rawtdsVal").text((dataList.PureTDS?dataList.PureTDS:'0') + '<span>ppm</span>');//设置当前设备原水值
				$("#puretdsVal").text((dataList.RawTDS?dataList.RawTDS:'0') + '<span>ppm</span>');//设置当前设备纯水值
				if(leasingmode == "0"){//零售
					$(".textLeft").html("<p id='surplusVal'><span>已用</span><b>"+(usedFlow?usedFlow:'0')+"L</b></p>");
					$(".textRight").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usedDay?usedDay:'0')+"天</b></p>");

				}else if(leasingmode == "1"){//显示流量值
					$(".textLeft").html("<p id='surplusVal'><span>剩余</span><b>"+dataList.ReFlow+"L</b></p>");
					$(".textcenter").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usedDay?usedDay:'0')+"天</b></p>");

					$(".textRight").html("<p><span>已用</span><b>"+(usedFlow?usedFlow:'0')+"L</b></p>");

				}else if(leasingmode == "2"){//套餐值
					$(".textLeft").html("<p id='surplusVal'><span>剩余</span><b>"+dataList.Reday+"天</b></p>");
					$(".textcenter").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usedDay?usedDay:'0')+"天</b></p>");
					$(".textRight").html("<p><span>已用</span><b>"+(usedFlow?usedFlow:'0')+"L</b></p>");

				}else if(leasingmode == "3"){//套餐&流量
					$(".textLeft").html("<p id='surplusVal'><span>剩余</span><b>"+dataList.Reday+"天</b></p><p><span>剩余</span><b>"+dataList.ReFlow+"L</b></p>");
					$(".textRight").html("<p id='alreadyUsedVal'><span>已用</span><b>"+(usedDay?usedDay:'0')+"天</b></p>");
				}

			}else if(dataList.PackType == "SetData"){	//设置数据类型数据
				identify=0;
				for(var i=0; i<CmdList.length; i++){
					if(CmdList[i].cmd.PackNum == dataList.PackNum){
						if(CmdList[i].cmd.type == "关机中"){
							showDown();

						}else if(CmdList[i].cmd.type == "开机中"){
							machineStatus();

						}else if(CmdList[i].cmd.type == "冲洗中"){
							wash();

						}

						CmdList.splice(i,1);
						break;
					}
				}
			}
			//显示当前设备状态
			function machineStatus(){
				if(dataList.DeviceStause == "0"){//制水
					addwater();
				}else if(dataList.DeviceStause == "1"){//冲洗
					wash();
				}else if(dataList.DeviceStause == "2"){//水满
					fullWaters();
				}else if(dataList.DeviceStause == "3"){//缺水
					lessWaters();
				}else if(dataList.DeviceStause == "4"){//漏水
					leaking();
				}else if(dataList.DeviceStause == "5"){//检修
					service();
                }else if(dataList.DeviceStause == "6"){//欠费
                    arrearage();
				}else if(dataList.DeviceStause == "7"){ //关机
					showDown();
				}else if(dataList.DeviceStause == "8"){//开机

				}
			}
		}
        //90秒后判断设备是否离线
        setInterval(function(){
            numAdd++;
            if(numAdd == 90){
                outLine();
            }
        }, 1000);

		//冲洗按钮操作
		$('.washBtn').click(function(){
			var thisT=$(".washText");
			if($(".switchText").html() != "关机"){
				layui.use('layer', function(){
					var layer = layui.layer;
					layer.msg('设备不在线，不能冲洗');
				});
				return false;
			}else{
				var ajson;//数据对象
				var type="";
				//判断操作类型
				//弹框提示
				layui.use('layer', function(){
					var layer = layui.layer;
					layer.confirm("确定要冲洗"+deviceId+"水机吗？", {icon: 3, title:'温馨提示'}, function(index){
						layer.close(index);
						ajson={
							"DeviceID":deviceId,
							"PackType":"SetData",
							"Vison":0,
							"PackNum":PackNum,
							"curTime":0,
						};
						//根据当前设备状态设置按钮文本
						ajson['DeviceStause'] = 1;
						ajson['type'] = '冲洗中';
						//发送数据
						websoket.send(JSON.stringify(ajson));
						CmdList.push({
							cmd:ajson,
							type:"冲洗中"
						});
						identify = 1;
						setTimeout(function(){
							if(identify == 1){
								layui.use('layer', function(){
									var layer = layui.layer;
									// layer.msg('操作超时！');
									thisT.html('冲洗')
								});
								identify = 0;
							}
						},10000)
					});
				});
			}

		});
		//开机/关机按钮操作
		$('.clickBtn').click(function(){
			var mtext = $(this).find(".switchText").text();
			var _this=$(this).children("span").html();
			var ajson;//数据对象
			//判断操作类型
			var tipsText = "确定要"+ _this + deviceId +"吗？";
			//弹框提示
			layui.use('layer', function(){
				var layer = layui.layer;
				layer.confirm(tipsText, {icon: 3, title:'温馨提示'}, function(index){
					
					layer.close(index);
					ajson={
						"DeviceID":deviceId,
						"PackType":"SetData",
						"Vison":0,
						"PackNum":PackNum,
						"curTime":0,
					};
					//根据当前设备状态设置按钮文本
					var type = 0;
					if(_this == "开机"){
						ajson['DeviceStause'] = 8;
						ajson['type'] = '开机中';
						$(".switchText").html("开机中");

						$("html").css("background", "#A8E2FF");
						$("body").css({height:'100vh',filter:'grayscale(0)'});

					}else if(_this == "关机"){
						ajson['DeviceStause'] = 7;
						ajson['type'] = '关机中';
						$(".switchText").html("关机中");

						$("html").css("background", "rgba(194,194,194,.5)");
						$("body").css({height:'100vh',filter:'grayscale(100%)'});

					}
					//发送数据
					websoket.send(JSON.stringify(ajson));
					CmdList.push({
						cmd:ajson,
						type:type
					});

					identify = 1;
					setTimeout(function(){
						if(identify == 1){
							layui.use('layer', function(){
								var layer = layui.layer;
								// layer.msg('操作超时！');
								if($(".switchText").html == '开机中'){
									$(".switchText").html('开机')

									$("html").css("background", "#A8E2FF");
									$("body").css({height:'100vh',filter:'grayscale(0)'});

								}else if($('.switchText').html() == '关机中'){
									$('.switchText').html('关机');

									$("html").css("background", "rgba(194,194,194,.5)");
									$("body").css({height:'100vh',filter:'grayscale(100%)'});
								}

							});
							identify = 0;
						}
					},10000)
				});
			});
		});
        //页面关闭后关闭websoket;
        window.onunload = function(){
            websoket.close();
        };
	})
	//页面加载时执行结束
</script>
<script>
	
	//制水
	function addwater(){
		$(".switchText").html("关机");
		$(".addwater").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//冲洗
	function wash(){
		$(".switchText").html("关机");
		$(".wash").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//缺水
	function lessWaters(){
		$(".switchText").html("关机");
		$(".lessWaters").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//水满
	function fullWaters(){
		$(".switchText").html("关机");
		$(".fullWaters").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//检修
	function service(){
		$(".switchText").html("关机");
		$(".service").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//欠费
	function arrearage(){
        $(".switchText").html("关机");
        $(".arrearage").show().siblings().hide();
        $(".content").css({height: '100vh'});
        $("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
	//关机
	function showDown(){
		$(".switchText").html("开机");
		$(".showDown").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("html").css("background", "rgba(194,194,194,.5)");
		$("body").css({height:'100vh',filter:'grayscale(100%)'});
	}
	//离线
	function outLine(){
		$(".switchText").html("开机");
		$(".outLine").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("html").css("background", "rgba(194,194,194,.5)");
		$("body").css({height:'100vh',filter:'grayscale(100%)'});
	}
	//漏水
	function leaking(){
		$(".switchText").html("开机");
		$(".leaking").show().siblings().hide();
		$(".content").css({height: '100vh'});
		$("body").css({height:'100vh',filter:'grayscale(0%)'});
	}
</script>

</body>

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