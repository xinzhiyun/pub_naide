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
        <div class="tableBox">
            <div class="titleBar">订单管理/<span>订单列表</span></div>
            <form class="form-search" action="/index.php/Admin/Orders/index" method="post">
                <span class="select-box">订单编号:
                    <input type="text" class="input-medium order_id" name="order_id" placeholder="请输入订单编号" style="width: 100px;"/ >
                </span>
                <span class="select-box">下单用户:
                    <input type="text" class="input-medium nickname" name="nickname" placeholder="请输入姓名" style="width: 100px;"/ >
                </span>

                <span class="select-box">购买商品数量:
                    <input type="text" class="input-medium total_num" name="total_num" placeholder="请输入商品数量" style="width: 100px;"/ >
                </span>
                <span class="select-box">购买总额:
                    <input type="text" class="input-medium mintotal_price" name="mintotal_price" placeholder="" style="width: 60px;" / > ~ 
                    <input type="text" class="input-medium maxtotal_price" name="maxtotal_price" placeholder="" style="width: 60px;" / >
                </span>
                <span class="select-box">收货人:
                    <input type="text" class="input-medium name" name="name" placeholder="请输入收货人姓名" style="width: 100px;"/ >
                </span>
                <span class="select-box">收货人电话:
                    <input type="text" class="input-medium phone" name="phone" placeholder="请输入电话" style="width: 100px;"/ >
                </span>
                <span class="select-box">收货人地址:
                    <input type="text" class="input-medium address" name="addres" placeholder="请输入收货人地址" style="width: 100px;"/ >
                </span>                
                <span class="select-box" style="display: inline-block;position:relative">下单时段:
                    <input type="text" id="date-start" class="input-medium form-control" name="mincreated_at" placeholder="请选择时间" style="width: 76px;left: 0"/ > ~ <input type="text" id="date-end" class="input-medium form-control" name="maxcreated_at" placeholder="请选择时间" style="width:76px;right: 0"/ >
                </span>
                <div class="submitBtn">
                    <button type="submit" name="output" value="1" class="btn fr mbtn" style="float: left;color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe62f;</i> 导出</button>
                    <button type="reset" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#x1002;</i> 重置</button>
                    <button type="submit" name="search" value="1" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe615;</i> 查找</button>
                </div>               
            </form>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>订单编号</th>
                    <th>下单用户</th>
                    <th>经销商名字</th>
                    <th>购买商品数量</th>
                    <th>购买总额</th>
                    <th>收货人</th>
                    <th>收货人电话</th>
                    <th>收货地址</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <!-- <th>是否付款</th>
                    <th>是否发货</th>
                    <th>是否收货</th>
                    <th>是否充值</th> -->
                </tr>
                </thead>
                <tbody>
                    <?php if(!empty($list)): if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                            <td><a href="/index.php/Admin/Orders/order_detail.html#<?php echo ($vo["order_id"]); ?>"><?php echo ($vo["order_id"]); ?></a></td>
                            <td><?php echo ($vo["nickname"]); ?></td>
                            <td><?php echo ($vo["vname"]); ?></td>
                            <td><?php echo ($vo["total_num"]); ?></td>
                            <td><?php echo ($vo['total_price']/100); ?></td>
                            <td><?php echo ($vo["name"]); ?></td> 
                            <td><?php echo ($vo["phone"]); ?></td>
                            <td><?php echo ($vo["addres"]); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["created_at"])); ?></td>
                            <td>
                                <?php if($vo['is_pay'] == 0 ): ?>待付款
                                <?php elseif($vo['is_pay'] == 2 ): ?>订单已取消
                                <?php elseif($vo['is_receipt'] == 0 ): ?>
                                    <a href="javascript:void(0)">
                                        <span style="color:red" class="_send">待发货</span>
                                    </a>
                                <?php elseif($vo['is_ship'] == 0 ): ?>待收货
                                <?php elseif($vo['is_ship'] == 1 ): ?>已收货
                                <?php else: ?> 订单完成<?php endif; ?>
                                <input type="hidden" name="order_id" value="<?php echo ($vo["order_id"]); ?>">
                                <input type="hidden" name="is_receipt" value="1">
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">查无数据</td>
                        </tr><?php endif; ?>
                </tbody>
            </table>
            <div class="pagination">
                <ul>
                    <?php echo ($button); ?>
                </ul>
            </div>

            <!-- 弹框信息 -->
            <div class="modal fade" id="_send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style='width:46%;box-sizing:border-box;padding:0px !important;'>
                <div class="" style='box-sizing:border-box;padding:5px;margin-left:-10px;' >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                请输入订单信息：
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form id="_orders" class="form-inline" url="/index.php/Admin/Orders/edit/order_id/<?php echo ($vo["order_id"]); ?>/is_receipt/1"
                            method="post">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <tr>
                                        <th width="20%" class="">
                                            快递名称：
                                        </th>
                                        <td>
                                            <input class="input-medium" type="text" name="express" id="input_name" style="width:100%;vertical-align:top;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            快递单号：
                                        </th>
                                        <td>
                                            <input class="input-medium" type="text" name="mca" id="input_num" style="width:100%;vertical-align:top;">
                                        </td>
                                    </tr>
                                </table>

                               

                                <div class="text-right">
                                    <input class="btn btn-info" type="button" value="取消" style='width:14%;'>&nbsp;&nbsp;&nbsp;
                                    <input class="btn btn-success" type="button" value="确定" style='width:14%;'>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('.pagination ul a').unwrap('div').wrap('<li></li>');
                $('.pagination ul span').wrap('<li class="active"></li>');
                
                // 弹框信息
                var name_bool = false;
                var num_bool = false;
                $('table tr th').css('vertical-align','middle');
                $('._send').click(function(){
                    $('#_send').modal('show');
                    var _order_id = $(this).parent().parent().parent().children().eq(0).text().trim()
                    $('#_orders').attr('action','/index.php/Admin/Orders/edit/order_id/'+_order_id+'/is_receipt/1')
                });

                $('#input_name').change(function(){
                    if(/[\u4e00-\u9fa5]{2}/.test($(this).val())){
                        $(this).next().text('');
                        name_bool = true;
                    }else{
                        $(this).next().html('请输入正确的快递名称&nbsp;(&nbsp;2位以上中文字符&nbsp;)&nbsp;！');
                    }
                });
                $('#input_num').change(function(){
                    if(/^\w{9,15}/.test($(this).val())){
                        $(this).next().text('');
                        num_bool = true;
                    }else{
                        $(this).next().html('请输入正确的快递单号&nbsp;(&nbsp;9-15位数字或字母&nbsp;)&nbsp;！');
                    }
                });

                $('input[type=button]').eq(0).click(function(){
                    $('#_send').modal('hide');
                });

                $('input[type=button]').eq(1).click(function(){

                    if(name_bool&&num_bool){
                        $('#_orders').submit();
                    }else{
                        return false;
                     }
                });
                /**************** 搜索关键字保留 -- 开始 ******************/
                    var srearchInfo = {};
                    var order_id, nickname, total_num, mintotal_price, maxtotal_price, 
                    name, phone, address, date_start, date_end;
                    /**
                     * order_id：订单ID, nickname：昵称, total_num：数量, 
                     * mintotal_price：价格最低, maxtotal_price：价格最高, 
                     * name：收货人姓名, phone：收货人电话, address：收货人地址,
                     * date_start：开始时间, date_end：结束时间
                     */
                    // 点击搜索
                    $("button[name='search']").click(function(){
                        setSearchWord();
                    })
                    function setSearchWord(){
                        sessionStorage.setItem('search', '');   // 初始化

                        order_id = $('.order_id').val();
                        nickname = $('.nickname').val();
                        name = $('.name').val();
                        phone = $('.phone').val();
                        address = $('.address').val();
                        total_num = $('.total_num').val();
                        mintotal_price = $('.mintotal_price').val();
                        maxtotal_price = $('.maxtotal_price').val();
                        date_start = $('#date-start').val();
                        date_end = $('#date-end').val();

                        srearchInfo['order_id'] = order_id;
                        srearchInfo['nickname'] = nickname;
                        srearchInfo['name'] = name;
                        srearchInfo['phone'] = phone;
                        srearchInfo['address'] = address;
                        srearchInfo['total_num'] = total_num;
                        srearchInfo['mintotal_price'] = mintotal_price;
                        srearchInfo['maxtotal_price'] = maxtotal_price;
                        srearchInfo['mintime'] = date_start;
                        srearchInfo['maxtime'] = date_end;

                        sessionStorage.setItem('search', JSON.stringify(srearchInfo));
                    }
                    // 搜索关键字保留
                    if(sessionStorage.getItem('search')){
                        var srearchInfo = JSON.parse(sessionStorage.getItem('search'));
                        if($('.form-search').length){
                            // console.log(srearchInfo)
                            
                            $('.order_id').val(srearchInfo['order_id']);
                            $('.nickname').val(srearchInfo['nickname']);
                            $('.name').val(srearchInfo['name']);
                            $('.phone').val(srearchInfo['phone']);
                            $('.address').val(srearchInfo['address']);
                            $('.total_num').val(srearchInfo['total_num']);
                            $('.mintotal_price').val(srearchInfo['mintotal_price']);
                            $('.maxtotal_price').val(srearchInfo['maxtotal_price']);
                            $('#date-start').val(srearchInfo['mintime']);
                            $('#date-end').val(srearchInfo['maxtime']);

                            setTimeout(function(){
                                sessionStorage.setItem('search', '');   // 初始化
                            },500)
                        }
                    }
                    // 重置搜索结果
                    $('button[type="reset"]').click(function(){
                        location.href = '<?php echo U("Admin/Orders/index");?>';

                    })
                    
                /**************** 搜索关键字保留 -- 结束 ******************/

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