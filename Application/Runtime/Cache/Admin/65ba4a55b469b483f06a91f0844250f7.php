<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>物联网云平台</title>
    <!-- jquery -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.css" media="screen" />
    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css" media="screen" />
    <!--响应式特性 css-->
    <link href="/Public/Admin/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/Home/js/theme/default/laydate.css">
    <!-- layui.css -->
    <link rel="stylesheet" href="/Public/Admin/layui/css/layui.css" />
    <link rel="stylesheet" href="/Public/Admin/css/ace.min.css">
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
    <style type="text/css">
        .logo:link {
            color: #fff;
        }
        .logo:visited {
            color: #fff;
        }
        .logo:hover {
            color: #ddd;
            text-decoration: none;
        }
        .logo:active {
            color: #fff;
        }
        a:hover {
            color: rgb(25, 99, 170) !important;
        }
        div.pagel{
            margin-top: 20px;
            margin-right: 10px;
            float: right;
            color: #666;
        }

        div.pagel span.current , div.pagel a{
            border: 1px solid #dcdcdc;
            display: block;
            float: left;
            font-size: 12px;
            margin-right: 5px;
            padding: 3px 10px;
            text-decoration: none;
            border-radius: 3px;
        }
 
        div.pagel span.current{
            background: lightblue none repeat scroll 0 0 !important;
            border-color: lightblue;
            color: #ffffff !important;
            display: block;
            float: left;
            font-size: 12px;
            cursor: pointer;
        }

        div.pagel a.prev,div.pagel a.next{
            padding: 3px 4px;
        }
        /*.bootstrap-datetimepicker-widget.dropdown-menu {
            width: auto !important;
        }*/
        #date-start,
        #date-end {
            width: 90px !important; 
        }
        .collapse {
            height: auto !important;
        }
        .bootstrap-datetimepicker-widget table td span {
            display: inline-block !important;
        }
        input[type='text'] {
            padding: 14px 5px !important;
        }
        input[type="file"] {
            padding: 0 !important;
        }
       
    </style>
    
</head> 
<body class="bodyBg">
    <div class="row-fluid" id="header">
        <div class="headerLeft fl"><a class="logo" href="<?php echo U('Admin/Index/index');?>">物联网云平台</a></div>
        <div class="headerRight fr">
            <p class="hintTxt"></p> 
            <div>
                <span class="AccountName"><?php echo ($_SESSION['adminuser']['name']); ?></span>
                <span>欢迎您!</span>
            </div>
            <div class="button modifyPassword">
                <a href="<?php echo U('Vendors/password');?>" style="color: #9d9d9d;;">修改密码</a>
            </div>
            <div class="button bowOut">
                <a href="javascript:void(0)" url="<?php echo U('Login/logout');?>" style="color: #9d9d9d;;" id="_exit">退出</a>
            </div>
        </div>
    </div>
<div class="content">

    <div class="navBox sidebar-collapse fl" id="nav">
    <ul class="nav nav-list">
        <!-- 遍历菜单   开始 -->
        <?php if(is_array($nav_data)): foreach($nav_data as $key=>$v): if(empty($v['_data'])): else: ?>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="menu-text">
                            <?php echo ($v['name']); ?>
                        </span>
                    </a>
                    <ul class="submenu">
                        <?php if(is_array($v['_data'])): foreach($v['_data'] as $key=>$n): ?><li>
                                <?php switch($n["id"]): default: ?><a class="item" href="<?php echo U($n['mca']);?>" ><i class="icon-double-angle-right"></i><?php echo ($n['name']); ?></a><?php endswitch;?>
                            </li><?php endforeach; endif; ?>
                    </ul>
                </li><?php endif; endforeach; endif; ?>
        <!-- 遍历菜单   结束 -->
    </ul>
</div>
    <div class="row-fluid fl" id="main">
        <div class="tableBox" id="_app">   
            <div class="titleBar">订单管理/<span>订单列表/订单详情</span>&nbsp;&nbsp;&nbsp;<a href="javascript:history.go(-1)" class="btn btn-info">&lt;&lt;返回</a></div>
            <div id="_show" class="clearfix">
                <div id="_num" class="clearfix">
                    <span class="pull-left"></span>
                    <span class="pull-right">订单号：</span>
                </div>
          
              
                <table class="table table-condensed _float_left" >
                    <tr>
                        <td>
                            滤芯
                        </td>
                        <td>
                            滤芯名称
                        </td>
                        <td>
                            滤芯单价
                        </td>
                        <td>
                            滤芯购买数量
                        </td>
                        <td>
                            滤芯购买总金额
                        </td>
                        
                    </tr>
                    <tbody id="_tbody">
                        
                    </tbody>
                </table>

                <table class="table table-condensed _float_right">
                    <tr>
                        <td>
                            套餐描述
                        </td>
                        <td>
                            套餐金额
                        </td>
                        <td>
                            套餐购买数量
                        </td>
                        <td>
                            套餐
                        </td>
                        <td>
                            套餐购买总金额
                        </td>
                    </tr>
                    <tbody id="_tbody2">
                        
                    </tbody>
                </table>
                
            </div>
           
            <div id="_fn" style="background-color: #eee;padding:10px 10px">
                    <span style="font-size: 16px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
                
            
            </div>
            <script>


               $.ajax({
                url:'/index.php/Admin/Orders/detail/order_id/' + location.hash.slice(1),
                success:function(data){
                    console.log(data)
                    if(data.filter[0].created_at){
                        data.filter[0].created_at = new Date(parseInt(data.filter[0].created_at)*1000).toLocaleString()
                    }
                    $('#_num').children('span').eq(0).html(data.filter[0].created_at)
                    $('#_num').children('span').get(1).innerHTML +=  data.order[0].order_id

                    if(data.filter.length){
                        for(var i in data.filter){
                            if(data.filter[i].filtername){
                                var html = '<tr>'
                                html += '<td><img width=50 src="/Public'+data.filter[i].picpath+'"></td>'+
                                        '<td>'+data.filter[i].filtername+'&nbsp;(&nbsp;'+data.filter[i].alias+'&nbsp;)&nbsp;</td>'+
                                        '<td>'+(data.filter[i].price?data.filter[i].price/100:'--')+'元</td>'+
                                        '<td>'+(data.filter[i].goods_num?data.filter[i].goods_num:'--')+'个</td>'+
                                        '<td>'+(data.filter[i].goods_price?data.filter[i].goods_price/100:'--')+'元</td>'
                                html += '</tr>'
                                $('#_tbody').append(html)
                            }
                        }
                    }else{
                        $('#_tbody').append('暂无购买套餐')
                    }
                    

                    if(data.setmeal.length){
                        for(var j in data.setmeal){
                            if(data.setmeal[j].goods_price){
                                var html2 = '<tr>'
                                var str = Number(data.setmeal[j].remodel)?'(天)':'(L)'
                                html2 += '<td>'+(data.setmeal[j].describe?data.setmeal[j].describe:'--')+'</td>'+
                                         '<td>'+(data.setmeal[j].money?data.setmeal[j].money/100:'--')+'元</td>'+
                                         '<td>'+(data.setmeal[j].goods_num?data.setmeal[j].goods_num:'--')+'个</td>'+
                                         '<td>'+(data.setmeal[j].flow?data.setmeal[j].flow:'--')+str+'</td>'+
                                         '<td>'+(data.setmeal[j].goods_price?data.setmeal[j].goods_price/100:'--')+'元</td>'
                                html2 += '</tr>'
                                $('#_tbody2').append(html2)
                            }
                        }
                    }else{
                        $('#_tbody2').append('暂无购买产品')
                    }
                    var $span = $('#_fn span')
                    $span.eq(0).append('订单总价：'+data.order[0].total_price/100 + '元')
                    $span.eq(1).append('订单数量：'+data.order[0].total_num + '单')
                    $span.eq(2).append(data.order[0].express?('快递：'+data.order[0].express):'快递：暂无快递')
                }
               })
            </script>
        </div>
        <!-- footer part -->
            <div class="row-fluid" id="footer">
        <div class="span8 offset2">
            <p>©2017 - 2018 点球电子 </p>
        </div>
    </div>
    <!-- bootstrap.js -->
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
    <!-- layui.js -->
    <script type="text/javascript" src="/Public/Admin/layui/layui.js"></script>
    <!-- 城市三级联动.js -->
    <script type="text/javascript" src="/Public/Admin/js/area.js"></script>
    <!-- 左边导航栏引用 -->
    <script src="/Public/Admin/js/ace.min.js"></script>
    <script src="/Public/Admin/js/adminPublic.js"></script>
	<script src="/Public/Admin/js/index/moment-with-locales.min.js"></script>
	<!-- <script src="/Public/Admin/js/index/bootstrap-datetimepicker.js"></script> -->
	<script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 
    <script type="text/javascript">  
        //提示
        function tip(tip,title,fn){
            layui.use('layer', function(){
                var layer = layui.layer;
                layer.confirm(tip, {icon: 3, title:title}, function(index){
                    fn&&fn()                
                });
            });
        }   
        $('#_exit').click(function(){
            tip('确定退出？','提示',function(){
                window.location.href = "<?php echo U('Login/logout');?>"
            })
            return false
        })
    </script>
	<script type="text/javascript">
		//设置nav高度
	    var windowh=$(window).height();
	    var navH=$("#nav").height(windowh-70);
	    $(function(){
	    	// 按回车键 搜索
	 		$('.form-search input').on('keyup', function(e){
	 			if(e.keyCode == '13'){
	 				$('.form-search').submit();
	 				// 搜索关键字保留
	 				setSearchWord();
	 			}
	 		})
	 		$('#date-start').css({width:'90px;'});
	 		$('#date-end').css({width:'90px;'});
		    /**************** 按时间搜索 -- 开始 ******************/
		    	var newdate = new Date(),
		    	year = newdate.getFullYear(),
		    	month = (newdate.getMonth()+'').length == 1 
		                  ? '0' + (newdate.getMonth()+1)
		                  : newdate.getMonth()-0+1,
		        date = (newdate.getDate()+'').length == 1 
		                  ? '0' + newdate.getDate()
		                  : newdate.getDate();
		    	var now = year +'-'+ month +'-'+ date;
		    	// console.log(year, month, date);
		    	// $("#date-start").val(now);
		    	 // 开始时间
		        var startdate = $("#date-start").datetimepicker({  
		            format: 'YYYY-MM-DD',  
		            locale: moment.locale('zh-cn')
		        }); 
		        
		        //结束时间
				var enddate = $("#date-end").datetimepicker({
		            format: 'YYYY-MM-DD',  
		            locale: moment.locale('zh-cn')
		        }); 
		         //动态设置最小值  
			    startdate.on('dp.change', function (e) {  
			        enddate.data('DateTimePicker').minDate(e.date);  
			        var time = $(this).val()+' 00:00:00';
			    	$('#date-start').val(time);

			    });  
			    //动态设置最大值  
			    enddate.on('dp.change', function (e) {  
			        startdate.data('DateTimePicker').maxDate(e.date); 
			        var time = $(this).val()+' 23:59:59'; 
			    	$('#date-end').val(time);  
			        
			    });
		        // $("#date-start").datetimepicker('show');
		        // $("#date-end").datetimepicker('show');

		    /**************** 按时间搜索 -- 结束 ******************/


		    /********** 设置导航栏当前位置 高亮 选中 -- 开始 ***********/

			    var href = location.href, nowPos;   // nowPos：当前文件地址
			    if(href.indexOf('html') > -1){
			        nowPos = href.substring(href.lastIndexOf('/Admin/')+7, href.indexOf('html')+4);
			    }else{
					nowPos = href.substring(href.lastIndexOf('/Admin/')+7);
			    }
			  	// console.log('nowPos: ',nowPos);
			    // 导航下的所有连接
			    var alink = $(".item");
			    // console.log('alink: ',alink)
			    // 高亮 选择当前地址的导航
			    for(var i=0; i<alink.length; i++){
			    	alink[i].onclick = function(){
			    		sessionStorage.setItem('nav_now', this.getAttribute("href"));
			    		
			    	}
			    }
			    if(sessionStorage.getItem('nav_now')){
			    	var thisModule, thisMenu, thisSelect;		// 当前模块， 当前菜单
			    	var nowurl = sessionStorage.getItem('nav_now'),
			    		now = nowurl.substring(nowurl.lastIndexOf('/Admin/')+7, nowurl.indexOf('html')+4);
			    	console.log(now, nowurl);
			    	for(var i=0; i<alink.length; i++){
			    		if(now == 'Index/index.html'){
					    	return
					    	// 以下代码不在首页生效
					    }
			    		if(alink[i].getAttribute('href').indexOf(now) > -1){
			    			thisSelect = alink[i];
			    			thisMenu = alink[i].parentNode.parentNode;
			    			thisModule = alink[i].parentNode.parentNode.parentNode;

			    			thisSelect.style.color = '#1963aa';
			    			thisMenu.style.display = 'block';
			    			thisModule.setAttribute('class', 'open');

			    			// console.log('thisSelect: ', thisSelect);
			    			// console.log('thisMenu: ', thisMenu);
			    			// console.log('thisModule: ', thisModule);
			    		}
			    	}
			    }

		    /********** 设置导航栏当前位置 高亮 选中 -- 结束 ***********/

		});

	</script>
</body>
</html>
    </div> 
</div>