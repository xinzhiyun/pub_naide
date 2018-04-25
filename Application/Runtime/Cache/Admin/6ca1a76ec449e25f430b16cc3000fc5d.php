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
        <div class="row-fluid fl" id="main" style="width: 100%">
            <div class="tableBox">
                <div class="titleBar">设备管理/<span>设备列表</span></div>
                <form class="form-search" action="/index.php/Admin/Devices/devicesList" method="post">
                    <span class="select-box">设备编号:
                        <input type="text" class="input-medium device_code" name="device_code" placeholder="请输入设备编号" style="width: 100px;"/ >
                    </span>
                        <span class="select-box">经销商名称:
                        <input type="text" class="input-medium name" name="name" placeholder="请输入经销商名称" style="width: 100px;"/ >
                    </span>
                    <span class="select-box">是否绑定:
                        <select class="select is_bind" size="1" name="is_bind" style="width: 100px;">
                            <option value="" selected>- 是否绑定 -</option>
                            <option value="1">是</option>
                            <option value="2">否</option>
                        </select>
                    </span>
                    <span class="select-box">绑定的用户:
                        <input type="text" class="input-medium dname" name="dname" placeholder="请输入用户名" style="width: 100px;"/ >
                    </span>
                    <span class="select-box">电话:
                        <input type="text" class="input-medium phone" name="phone" placeholder="请输入电话号码" style="width: 100px;"/ >
                    </span>
                    <span class="select-box">设备类型(滤芯):
                        <input type="text" class="input-medium typename" name="typename" placeholder="请输入设备类型" style="width: 100px;"/ >
                    </span>
                     <span class="select-box" style="display: inline-block;position:relative">时间:
                        <input type="text" id="date-start" class="input-medium form-control" name="minupdatetime" placeholder="请选择时间" style="width: 76px;left: 0"/ > ~ <input type="text" id="date-end" class="input-medium form-control" name="maxupdatetime" placeholder="请选择时间" style="width:76px;right: 0"/ >
                    </span>
                    <span class="select-box">设备状态:
                        <select class="select status" size="1" name="status" style="width: 100px;">
                            <option value="" selected>- 设备状态 -</option>
                        <option value="0">已激活</option>
                        <option value="1">未激活</option>
                        </select>
                    </span>
                    <div class="submitBtn">
                        <button type="submit" name="output" value="1" class="btn fr mbtn" style="float: left;color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe62f;</i> 导出</button>
                        <button type="reset" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#x1002;</i> 重置</button>
                        <button type="submit" name="search" value="1" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe615;</i> 查找</button>
                    </div>
                </form>
                <table class="table table-bordered table-hover text-center" >
                    <thead>
                        <tr style='font-weight: bold;'>
                            <td>编号</td>
                            <td>设备编号</td>
                            <td>经销商名称</td>
                            <td>是否已被绑定</td>
                            <td>ICCID</td>
                            <td>绑定的用户</td>
                            <td>电话</td>
                            <td>地址</td>
                            <td>计费模式</td>
                            <td>剩余天数</td>
                            <td>剩余流量</td>
                            <td>工作状态</td>
                            <td>网络状态</td>
                            <td>滤芯模式</td>
                            <td>设备类型(滤芯)</td>
                            <td>设备首次绑定时间</td>
                            <td>最近更新时间</td>
                            <td>设备状态</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($deviceInfo['data'])): ?><tr><td colspan="8">暂无设备信息</td></tr>
                        <?php else: ?>
                        <!-- <?php echo dump($deviceInfo['data']);?> -->
                    <?php if(is_array($deviceInfo['data'])): foreach($deviceInfo['data'] as $key=>$data): ?><tr>
                                    <td><?php echo ($key+1); ?></td>
                                    <td>
                                        <a class="btn-link detail" href="/index.php/Admin/Devices/devices_detail.html#<?php echo ($data["device_code"]); ?>"><?php echo ($data["device_code"]); ?>
                                        </a>
                                    </td>
                                    <td><?php echo ($data["name"]); ?></td>
                                    <?php if($data['uid']): ?><td>是</td>
                                        <?php else: ?>
                                        <td>否</td><?php endif; ?>
                                    <td><?php echo ($data["iccid"]); ?></td>
                                    <td><a class="btn-link detail" href="<?php echo U('admin/users/user_info',array('open_id'=>$data['open_id']));?>"><?php echo ($data["dname"]); ?>
                                    </a></td>
                                    <td><?php echo ($data["phone"]); ?></td>
                                    <td><?php echo ($data["address"]); ?></td>
                                    <td>
                                        <?php switch($data["leasingmode"]): case "0": ?>零售型<?php break;?>
                                            <?php case "1": ?>按流量计费<?php break;?>
                                            <?php case "2": ?>按时间计费<?php break;?>
                                            <?php case "3": ?>时长和流量套餐<?php break;?>
                                            <?php default: endswitch;?>
                                    </td>
                                    <td><?php echo ($data["reday"]); ?></td>
                                    <td><?php echo ($data["reflow"]); ?></td>
                                    <td>
                                        <?php switch($data["devicestause"]): case "0": ?>制水<?php break;?>
                                            <?php case "1": ?>冲洗<?php break;?>
                                            <?php case "2": ?>水满<?php break;?>
                                            <?php case "3": ?>缺水<?php break;?>
                                            <?php case "4": ?>漏水<?php break;?>
                                            <?php case "5": ?>检修<?php break;?>
                                            <?php case "6": ?>欠费停机<?php break;?>
                                            <?php case "7": ?>关机<?php break;?>
                                            <?php case "8": ?>开机<?php break;?>
                                            <?php default: endswitch;?>
                                    </td>
                                    <td><?php echo ($data["netstause"]); ?></td>
                                    <td>
                                        <?php switch($data["filtermode"]): case "0": ?>按时长<?php break;?>
                                            <?php case "1": ?>按流量<?php break;?>
                                            <?php case "2": ?>时长和流量<?php break;?>
                                            <?php default: endswitch;?>
                                    </td>

                                    <td><?php echo ($data["typename"]); ?></td>
                                    <td><?php echo (date('Y-m-d H:i:s', $data["addtime"])); ?></td>
                                    <?php if($data['updatetime'] == null ): ?><td></td>
                                        <?php else: ?>
                                        <td><?php echo (date('Y-m-d H:i:s', $data["updatetime"])); ?></td><?php endif; ?>
                                   <?php if($data['alivestause'] == 1 ): ?><td>已激活</td>
                                        <?php else: ?>
                                        <td>未激活</td><?php endif; ?>

                                </tr><?php endforeach; endif; endif; ?>
                    </tbody>
                </table>
                <!-- 上下页，请加样式 -->
                <div class="pagination pagination-lg pull-center">
                    <ul>
                        <?php echo ($deviceInfo['show']); ?>
                    </ul>
                </div>
            </div>
            <script>
                /**************** 搜索关键字保留 -- 开始 ******************/
                    var srearchInfo = {};
                    var device_code, name, is_bind, dname,phone,
                    typename, date_start, date_end, status;
                    /**
                     * device_code: 设备编号, name：经销商名称, 
                     * is_bind：是否绑定, dname：绑定的用户, 
                     * typename：设备类型, status：设备状态, 
                     * mintime：开始时间, maxtime：结束时间
                     */
                    // 点击搜索
                    $("button[name='search']").click(function(){
                        setSearchWord();
                    })
                    function setSearchWord(){
                        sessionStorage.setItem('search', '');   // 初始化

                        device_code = $('.device_code').val();
                        name = $('.name').val();
                        if($('.is_bind>option:selected').val()){
                            is_bind = Number($('.is_bind>option:selected').val());
                        }
                        if($('.status>option:selected').val()){
                            status = Number($('.status>option:selected').val())+1;
                        }
                        
                        dname = $('.dname').val();
                        phone =$('.phone').val();
                        typename = $('.typename').val();
                        date_start = $('#date-start').val();
                        date_end = $('#date-end').val();

                        srearchInfo['device_code'] = device_code;
                        srearchInfo['name'] = name;
                        srearchInfo['is_bind'] = is_bind;
                        srearchInfo['dname'] = dname;
                        srearchInfo['phone'] = phone;
                        srearchInfo['typename'] = typename;
                        srearchInfo['mintime'] = date_start;
                        srearchInfo['maxtime'] = date_end;
                        srearchInfo['status'] = status;
                        sessionStorage.setItem('search', JSON.stringify(srearchInfo));
                    }
                    // 搜索关键字保留
                    if(sessionStorage.getItem('search')){
                        var srearchInfo = JSON.parse(sessionStorage.getItem('search'));
                        if($('.form-search').length){
                            // console.log(srearchInfo)
                            $('.device_code').val(srearchInfo['device_code']);
                            if(srearchInfo['is_bind']){
                                $('.is_bind>option').eq(srearchInfo['is_bind'])[0].selected = true;
                            }
                            if(srearchInfo['status']){
                                $('.status>option').eq(srearchInfo['status'])[0].selected = true;
                            }
                            
                            $('.name').val(srearchInfo['name']);

                            $('.phone').val(srearchInfo['phone']);
                            $('.dname').val(srearchInfo['dname']);
                            $('.typename').val(srearchInfo['typename']);
                            $('#date-start').val(srearchInfo['mintime']);
                            $('#date-end').val(srearchInfo['maxtime']);

                            setTimeout(function(){
                                sessionStorage.setItem('search', '');   // 初始化
                            },500)
                        }
                    }
                    // 重置搜索结果
                    $('button[type="reset"]').click(function(){
                        location.href = '<?php echo U("Admin/Devices/devicesList");?>';

                    })
                    
                /**************** 搜索关键字保留 -- 结束 ******************/

                $('.remove').click(function(){
                    var a=$(this).attr('device_id');
                    tip('确定解除绑定？','提示',function(){
                        window.location.href = "<?php echo U('remove');?>"+"?device_code="+a;
                    })
                    return false;
                })
            </script>
        </div>
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
    	var ua = navigator.userAgent;
    	var isOpera = ua.indexOf("Opera") > -1;
    	if(ua.indexOf('compatible') > -1 && ua.indexOf('MSIE') > -1 && !isOpera){

    		alert('您的浏览体验不佳，请更换新的浏览器，如谷歌浏览器或火狐浏览器！')
    	}
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
		            locale: moment.locale('zh-cn'),
		        }); 
		        
		        //结束时间
				var enddate = $("#date-end").datetimepicker({
		            format: 'YYYY-MM-DD',  
		            locale: moment.locale('zh-cn')
		        }); 
		         //动态设置最小值  
			    startdate.on('dp.change', function (e) {  
			        enddate.data('DateTimePicker').minDate(e.date);
			    	// $('#date-start').val(time);

			    });  
			    //动态设置最大值  
			    enddate.on('dp.change', function (e) { 
			        startdate.data('DateTimePicker').maxDate(e.date);
			    	// $('#date-end').val(time);  
			        
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