<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="text/html;utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1" >
	<link rel="stylesheet" href="/Public/Home/css/water-record.css">
	<title>净水记录</title>
</head>
<body>
	<input type="hidden" class="datalist" value=<?php echo (json_encode($data)); ?> name="">
	<div id="dateSelect">
		<input name="date" type="button" class="in-first layui-input" id="chooseMonth" value="">
	</div>
	</div>
	<div class="echartDiv">
		<h3 class="eChartTitle">纯水 <span class="rawMean"></span></h3><br />
		<div class="chart" id="lineChart1" _echarts_instance_="1513755345537" >
			<div>
				<div data-zr-dom-id="bg" ></div>
				<canvas data-zr-dom-id="0" class="zr-element" style="position: absolute; left: 0px; top: 0px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas>
			</div>
		</div>
	</div>
	<div class="echartDiv">
		<h3 class="eChartTitle">原水 <span class="pureMean"></span></h3><br />
		<div class="chart" id="lineChart2" _echarts_instance_="1513755345537" >
			<div>
				<div data-zr-dom-id="bg" ></div>
				<canvas data-zr-dom-id="0" class="zr-element" style="position: absolute; left: 0px; top: 0px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas>
			</div>
		</div>
	</div>
	<div id="console"></div>
	<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/Home/js/laydate.js"></script>
	<script src="/Public/Home/js/echarts.min.js"></script>
	<script src="/Public/Home/js/flexible.js"></script>
	<script src="/Public/Admin/layui/layui.js"></script>
	<script src="/Public/Home/js/comment.js"></script>
	<script>
	var yAxisData = [[400],[2000]];	//设置y轴最大值
	$(function(){
		var year = new Date().getFullYear();//年份
		var month = ((new Date().getMonth()+1)+'').length == 1
					? '0' + (new Date().getMonth()+1)
					: (new Date().getMonth()+1);//获取月份
	 	var mustDateb = new Date(year, month, 0).getDate();//获取月份天数
		var dataList=JSON.parse($(".datalist").val());//数据集
		console.log(dataList);
		if(!dataList.length) {
			layuiHint("本月无数据")
		}
		console.log(1)
		$("#dateSelect").text(year+'-'+month);//显示当前年月
		// 页面加载就给月份赋值
		getAvg(dataList,mustDateb);
		// 选中月份获取净水记录
		$("#dateSelect").click(function(){
			laydate.render({ 
			  	elem: '#dateSelect',
				show: true,
				type: 'month',
				max: new Date().getTime(),
				done: function(value, date, endDate){
					var yearsMonth=value.replace('-', '');// 获取年月数值如：201802
					$.ajax({
						url:"getTds",
						dataType:"json",
						type:"post",
						data:{
							"month":yearsMonth
						},
						success:function(res){
							if(!res.length) {
								layuiHint("本月无数据")
							}
							console.log(res.length)
							year=yearsMonth.slice(0,4);
							month=yearsMonth.slice(5,6);
							mustDatea = new Date(year, month, 0).getDate();
							getAvg(res,mustDatea);
						}
					});
				}
			});
		})
	})
	function getAvg(datalist,mustDates){
		var rawArray=[];//原水数据集
		var pureArray=[];//净水数据集
		var rawSum=0,pureSum=0;
		for(var i=0;i<datalist.length;i++){//遍历原水值与净水值的数据
			rawArray[i]=parseInt(datalist[i].raw);
			pureArray[i]=parseInt(datalist[i].pure);
			rawSum+=rawArray[i];
			pureSum+=pureArray[i];
		}
		// 求平均值
		if(datalist.length !== 0) {
			// 求平均值
			$(".rawMean").html("(平均值："+(rawSum/rawArray.length).toFixed(2)+"ppm)");
			$(".pureMean").html("(平均值："+(pureSum/pureArray.length).toFixed(2)+"ppm)");
		}else{
			$(".rawMean").html("(平均值："+0+"ppm)");
			$(".pureMean").html("(平均值："+0+"ppm)");
		}
		var lineChart1 = echarts.init(byId('lineChart1'));
		lineChart1.setOption(getOption('line', yAxisData[0], rawArray, '#74c2ad',mustDates));

		var lineChart2 = echarts.init(byId('lineChart2'));
		lineChart2.setOption(getOption('line', yAxisData[1], pureArray, '#f75151',mustDates));
	}
	var getOption = function(_chartType, _yAxisData, _seriesData, lineColor,mustDate) {
		var chartOption = {
			grid: {
				x: 30,
				x2: 10,
				y: 30,
				y2: 25
			},
			calculable: false,
			xAxis: [{
				type: 'category',
				splitNumber: 29,
				axisTick: {
					interval: 0
				},	
				data: ['1','','','','','','','','','', '15','','','','','','','','','',mustDate]
			}],
			yAxis: {
				type: 'value',
				splitNumber: 4,	
				min: 0,
				max: _yAxisData,
				splitLine: {
                    show: false
                },
				splitArea: {
					show: false
				},
				axisTick: {
					inside: true
				},
				axisLabel: {
					margin: 2,
					fontSize: 10
				}
			},
			series: [{
				type: _chartType,
				data: _seriesData,
				symbol: 'none',
				lineStyle:{
		            normal:{
		                width: 2,  //连线粗细
		                color: lineColor  //连线颜色
		            }
		        }
			}]
		};
		return chartOption;
	};
	var byId = function(id) {
		return document.getElementById(id);
	};
	
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