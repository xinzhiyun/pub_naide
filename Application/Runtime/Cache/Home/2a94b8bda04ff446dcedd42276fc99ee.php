<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<link rel="stylesheet" href="/Public/Home/amazeui/assets/css/amazeui.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/iconfont/iconfont.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/common.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/index/index.css">
	<script src="/Public/Home/js/vue.min.js"></script>
</head>
<body><!--设备状态数据-->
	<div class="content" id='home'>
		<!-- 顶部 -->
		<div class="indexTop" :style='homeStyle'>
			<!-- 水球 -->
			<div class="waterQiu">
				<div class="waterQius"> 
					<div class="picKuan"></div>
					<div class="waterPure">
						<p>
							<a v-text='tdsPure'>0</a>
							<span class='fwhite'>ppm</span>
						</p>
						<span class='fwhite'>纯水TDS</span>
					</div>
					<div class="waterRaw">
						<p>
							<a v-text='tdsRaw'>0</a>
							<span class='fwhite'>ppm</span>
						</p>
						<span class='fwhite'>原水TDS</span>
					</div>
					<!-- 水波浪 -->
					<div class='wave -one'></div>
					<div class='wave -two'></div>
					<div class='wave -three'></div>
				</div>
			</div>
			<!-- 水波浪 -->
			<div class="waterLiu">
				<div id="statusBox" class="allStatus">
					<div class="status addwater left">
						<p><i :class="statusIconName"></i></p>
						<span v-text='statusText'></span>
					</div>
					<!-- <div class="statusZhishui addwater left">
						<p><i class="iconfont icon-zhishui"></i></p><span>制水</span>
					</div>
					<div class="fullWaters left">
						<p><i class="iconfont icon-shuiman"></i></p>
						<span>水满</span>
					</div>
					<div class="statusShuiman service right">
						<p><i class="iconfont icon-jianxiu"></i></p>
						<span>检修</span>
					</div>
					<div class="statusShuiman lessWaters right">
						<p><i class="iconfont icon-queshui"></i></p>
						<span>缺水</span>
					</div>
					<div class="statusShuiman wash right">
						<p><i class="iconfont icon-chongxi"></i></p>
						<span>冲洗</span>
					</div>
					<div class="statusShuiman showDown right">
						<p><i class="iconfont "></i></p>
						<span>已关机</span>
					</div>
					<div class="statusShuiman arrearage right">
						<p><i class="iconfont "></i></p>
						<span>已欠费</span>
					</div>
					<div class="statusShuiman outLine right">
						<p><i class="iconfont "></i></p>
						<span>已离线</span>
					</div>
					<div class="statusShuiman leaking right">
						<p><i class="iconfont icon-leaking"></i></p>
						<span>漏水</span>
					</div> -->
				</div>
				<!-- 时长 -->
				<div class='fwhite' v-if='leasingmode == 0'>
					<div>剩余天数<span v-text='reday'></span>天</div>
					<div>已用天数<span v-text='usedday'></span>天</div>
				</div>
				<!-- 流量 -->
				<div class='fwhite' v-if='leasingmode == 1'>
					<div>剩余流量<span v-text='reflow'></span>L</div>
					<div>已用流量<span v-text='usedflow'></span>L</div>
				</div>
				<!-- 时长 和 流量 -->
				<div class='fwhite' v-if='leasingmode == 2'>
					<!-- 显示比例小的 -->
					<div v-if='reday/(reday+usedday) <= reflow/(reflow+usedflow)'>剩余天数<span v-text='reday'></span>天</div>
					<div v-if='reday/(reday+usedday) <= reflow/(reflow+usedflow)'>已用天数<span v-text='usedday'></span>天</div>
					<div v-if='reday/(reday+usedday) > reflow/(reflow+usedflow)'>剩余流量<span v-text='reflow'></span>L</div>
					<div v-if='reday/(reday+usedday) > reflow/(reflow+usedflow)'>已用流量<span v-text='usedflow'></span>L</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<div class="indexBottom" :style='homeStyle'>
			<ul>
				<li>
					<a href="javascript:;" @click='filterShow'><p class="iconfont icon-filter"></p><span>滤芯</span></a>
				</li>
				<li>
					<a href="javascript:;" @click='power'><p class="iconfont icon-power"></p><span class="switchText" v-text='powerStatus'></span></a>
				</li>
				<li>
					<a href="javascript:;" @click='wash'><p class="iconfont icon-wash"></p><span class="washText">冲洗</span></a>
				</li>
			</ul>
			<ul>
				<li>
					<a class="buy" href="{:U('Home/Pay/buy')}"><p class="iconfont icon-buy"></p><span>购买</span></a>
				</li>
				<li>
					<a href="{:U('Home/Users/mine')}"><p class="iconfont icon-user"></p><span>我的</span></a>
				</li>
				<li>
					<a class="repair" href="{:U('Home/Repair/index')}"><p class="iconfont icon-repair"></p><span>报修</span></a>
				</li>
			</ul>
		</div>
		<!-- 分享 -->
		<div class="share" :style='homeStyle'>分享</div>
		<!-- 分享面板 -->
		<div class="shareContent" style="display:none;">
			<ul class="shareContents">
				<li>
					<div class="shweixin"><span class="iconfont icon-weixin1" style="color: rgb(11,202,52)"></span><span>微信</span></div>
					<div class="shweibo"><span class="iconfont icon-weibo" style="color: rgb(251,96,90)"></span><span>微博</span></div>
					<div class="shpyquan"><span class="iconfont icon-pengyouquan1" style="color: rgb(11,202,52)"></span><span>朋友圈</span></div>
					
				</li>
				<li>
					<div class="shQQ"><span class="iconfont icon-qq" style="color: rgb(81,145,216)"></span><span>QQ</span></div>
					<div class="shkjian"><span class="iconfont icon-kongjian00" style="color: rgb(251,176,52)"></span><span>空间</span></div>
					<div class="shscang"><span class="iconfont icon-xingxing" style="color: rgb(125,174,207)"></span><span>收藏</span></div>
				</li>
				<li class="cancel">
					<p>取消</p>
				</li>
			</ul>
		</div>
		<!-- 滤芯部分 -->
		<div id='filter' :style='filterstyle'>
			<div class='filterTop cfix'>
				<span class='fleft fblue' @click='filterMove' index='0' dataclass='fleft'>滤芯详情</span>
				<span class='fright' @click='filterMove' index='1' dataclass='fright'>滤芯复位</span>
				<div class='line' :style='lineStyle'><span class='bgblue'></span></div>
			</div>
			<div class='filtermain' :style='filmainStyle'>
				<ul class='mLeft'>
					<li>
						<!-- 时长 -->
						<div class='fliterPercItem' v-for='f in filterList' v-if='filtermode == 0'>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-text='(f.reday/f.allLife)*100+"%"'>80%</span>
							</p>
							<div class='percent'>
								<span class='bgblue' :style='"width:"+(f.reday/f.allLife)*100+"%"'></span>
							</div>
						</div>
						<!-- 流量 -->
						<div class='fliterPercItem' v-for='f in filterList' v-if='filtermode == 1'>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-text='(f.reflow/f.allFlow)*100+"%"'>80%</span>
							</p>
							<div class='percent'>
								<span class='bgblue' :style='"width:"+(f.reflow/f.allFlow)*100+"%"'></span>
							</div>
						</div>
						<!-- 时长 和 流量 -->
						<div class='fliterPercItem' v-for='f in filterList' v-if='filtermode == 2'>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-if='f.reday/f.allLife <= f.reflow/f.allFlow' v-text='(f.reday/f.allLife)*100+"%"'>80%</span>
								<span class='fright' v-if='f.reday/f.allLife > f.reflow/f.allFlow' v-text='(f.reflow/f.allFlow)*100+"%"'>80%</span>
							</p>
							<div class='percent'>
								<span class='bgblue' v-if='f.reday/f.allLife <= f.reflow/f.allFlow' :style='"width:"+(f.reday/f.allLife)*100+"%"'></span>
								<span class='bgblue' v-if='f.reday/f.allLife > f.reflow/f.allFlow' :style='"width:"+(f.reflow/f.allFlow)*100+"%"'></span>
							</div>
						</div>
					</li>
					<!-- 滤芯描述 -->
					<li>
						<div class='fliterDescItem' v-for='d in filterList'>
							<p v-text='d.fName'>RO膜</p>
							<p class='color888' v-text='d.fDesc'>RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇</p>
							<!-- 时长 -->
							<div class='cfix' v-if='filtermode == 0'>
								<span class='fleft'>总寿命：<span v-text='d.allLife'></span>天</span>
								<span class='fright'>剩余：<span v-text='d.reday'></span>天</span>
							</div>
							<!-- 流量 -->
							<div class='cfix' v-if='filtermode == 1'>
								<span class='fleft'>总寿命：<span v-text='d.allFlow'>1000</span>L</span>
								<span class='fright'>剩余：<span v-text='d.reflow'>800</span>L</span>
							</div>
							<!-- 时长 和 流量 -->
							<div class='cfix' v-if='filtermode == 2'>
								<span class='fleft' v-if='d.reday/d.allLife <= d.reflow/d.allFlow'>总寿命：<span v-text='d.allLife'></span>天</span>
								<span class='fright' v-if='d.reday/d.allLife <= d.reflow/d.allFlow'>剩余：<span v-text='d.reday'></span>天</span>
								<span class='fleft' v-if='d.reday/d.allLife > d.reflow/d.allFlow'>总寿命：<span v-text='d.allFlow'></span>L</span>
								<span class='fright' v-if='d.reday/d.allLife > d.reflow/d.allFlow'>剩余：<span v-text='d.reflow'></span>L</span>
							</div>
						</div>
					</li>
				</ul>
				<ul class='mRight'>
					<ul>
						<!-- 时长 -->
						<li class='filteritem' v-for='f in filterList' @click.prevent='resetSelect($event)' :fname='f.fName' v-if='filtermode == 0'>
							<span class='iconfont icon-emptycircle'></span>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-text='(f.reday/f.allLife)*100+"%"'>80%</span>
							</p>
							<div class='percent'><span class='bgblue' :style='"width:"+(f.reday/f.allLife)*100+"%"'></span></div>
						</li>
						<!-- 流量 -->
						<li class='filteritem' v-for='f in filterList' @click.prevent='resetSelect($event)' :fname='f.fName' v-if='filtermode == 1'>
							<span class='iconfont icon-emptycircle'></span>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-text='(f.reflow/f.allFlow)*100+"%"'>80%</span>
							</p>
							<div class='percent'><span class='bgblue' :style='"width:"+(f.reflow/f.allFlow)*100+"%"'></span></div>
						</li>
						<!-- 时长 和 流量 -->
						<li class='filteritem' v-for='f in filterList' @click.prevent='resetSelect($event)' :fname='f.fName' v-if='filtermode == 2'>
							<span class='iconfont icon-emptycircle'></span>
							<p class='cfix'>
								<span class='fleft' v-text='f.fName'>RO膜</span>
								<span class='fright' v-if='f.reday/f.allLife <= f.reflow/f.allFlow' v-text='(f.reday/f.allLife)*100+"%"'>80%</span>
								<span class='fright' v-if='f.reday/f.allLife > f.reflow/f.allFlow' v-text='(f.reflow/f.allFlow)*100+"%"'>80%</span>
							</p>
							<div class='percent' v-if='f.reday/f.allLife <= f.reflow/f.allFlow'><span class='bgblue' :style='"width:"+(f.reday/f.allLife)*100+"%"'></span></div>
							<div class='percent' v-if='f.reday/f.allLife > f.reflow/f.allFlow'><span class='bgblue' :style='"width:"+(f.reflow/f.allFlow)*100+"%"'></span></div>
						</li>
					</ul>
					<div :index='resetFilter' @click='filterReset' class='reset bgblue'>确认复位</div>
				</ul>
			</div>
		</div>
	</div>

	<script src="/Public/Home/js/public.js"></script>
	<script>
		// 显示loading
		var loaddiv = document.getElementsByClassName('loadingdiv');
		fadeFn({elem: loaddiv[0]});
	</script>
	<script src="/Public/Home/js/jquery.min.js"></script>
	<script src="/Public/Home/amazeui/assets/js/amazeui.min.js"></script>
	<script src="/Public/Home/js/index/index.js"></script>
	<script src="/Public/Home/js/websocket.js"></script>
	<script>
		var back2home = document.getElementsByClassName('back2home');
		back2home[0].setAttribute('href','{:U("Home/Index/index")}');

		var href = location.href;
		// 显示滤芯页面
		if(href.indexOf('filter') > -1){
			home.homeStyle = 'opacity:0;';
			home.filterstyle = 'display:block;';
			document.title = '滤芯';
			$('#navbar>h2').text('滤芯');
			$('#navbar').css({position:'fixed'});
			$("#navbar").show();

		}else{
			home.homeStyle = 'opacity:1;';
		}
		window.onload = function(){
			var wsurl = "ws://localhost:8181";
			// wsFun(wsurl, function(str, res){
			// 	// str: 数据类型（接收，关闭， 错误），
			// 	// 在websocket.js中给出，不需要传
			// 	console.log(str, res);
			// 	// 接收数据更新到页面
			// 	if(str == 'message'){
			// 		home.tdsPure = res;
			// 		home.tdsRaw = (res/2);
			// 	}
			// });
			home.leasingmode = 2;		// 租赁模式
			home.filtermode = 1;		// 滤芯模式
			home.reday = 66;			// 剩余天数
			home.usedday = 101;			// 已用天数
			home.reflow = 99;			// 剩余流量
			home.usedflow = 101;		// 已用流量
			// home 是vue实例
			home.filterList = [
				{fNum:'0',fName:'RO膜',fDesc:'RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇',allLife:'100',allFlow:'100',reday:'80',reflow:'60'},
				{fNum:'1',fName:'PP棉',fDesc:'RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇',allLife:'100',allFlow:'100',reday:'50',reflow:'80'},
				{fNum:'2',fName:'滤芯1',fDesc:'RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇',allLife:'100',allFlow:'100',reday:'70',reflow:'20'},
				{fNum:'3',fName:'滤芯2',fDesc:'RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇',allLife:'100',allFlow:'100',reday:'40',reflow:'70'},
				{fNum:'4',fName:'PP棉',fDesc:'RO膜能够有效去除水中钙、镁、细菌、有机物、无机物、金属离子和放射性物质等，经过该装置净化出的水晶莹清澈、甜美甘醇',allLife:'100',allFlow:'100',reday:'66',reflow:'90'}
			];

			home.tdsPure = 100;		// 纯水值
			home.tdsRaw = 99;		// 原水值
			home.statusText = home.statusList[0];	// 水机状态
			home.statusIconName = home.statusIconClass.makeWater;	// 水机状态图标
			
			// 加载结束，隐藏loading
			fadeFn({elem: $('.loadingdiv')[0],handle:'hide'});
		}
	</script>
</body>
</html>