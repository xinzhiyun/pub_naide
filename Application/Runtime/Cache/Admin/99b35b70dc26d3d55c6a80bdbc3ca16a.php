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
            <div class="titleBar">套餐管理/<span>套餐列表</span></div>
            <form class="form-search" action="/index.php/Admin/Setmeal/index" method="post">
                <span class="select-box">产品类型:
                    <input type="text" class="input-medium prodtype" name="typename" placeholder="请输入产品类型" style="width: 70px;"/ >
                </span>
                <span class="select-box">套餐模式:
                    <select class="select" size="1" name="remodel" style="width: 100px;">
                    <option value="" selected>- 套餐模式 -</option>
                    <option value="0">流量</option>
                    <option value="1">时长</option>
                    </select>
                </span>
                <span class="select-box">套餐金额:
                    <input type="text" class="input-medium minmoney" name="minmoney" placeholder="" style="width: 60px;" / > ~ 
                    <input type="text" class="input-medium maxmoney" name="maxmoney" placeholder="" style="width: 60px;" / >
                </span>
                <span class="select-box">套餐量（天）:
                    <input type="text" class="input-medium flow" name="flow" placeholder="请输入查询条件" style="width: 70px;" / >
                </span>
                <span class="select-box">套餐名称:
                    <input type="text" class="input-medium describe" name="describe" placeholder="请输入查询条件" style="width: 70px;" / >
                </span>
                <span class="select-box" style="display: inline-block;position:relative">时间:
                    <input type="text" id="date-start" class="input-medium form-control" name="mintime" placeholder="请选择时间" style="width: 76px;left: 0"/ > ~ <input type="text" id="date-end" class="input-medium form-control" name="maxtime" placeholder="请选择时间" style="width:76px;right: 0"/ >
                </span>
                
                <!-- <span class="select-box">查询条件:
                    <input type="text" class="input-medium" name="value" placeholder="请输入查询条件" / >
                </span>
                <span class="select-box">产品类型:
                    <select class="select" size="1" name="key" style="width: 100px;">
                    <option value="1" selected>产品类型</option>
                    <option value="2">套餐模式</option>
                    </select>
                </span>
                <span class="select-box">查询条件:
                    <input type="text" class="input-medium" name="value" placeholder="请输入查询条件" / >
                </span> -->
                <div class="submitBtn">
                    <button type="submit" name="output" value="1" class="btn fr mbtn" style="float: left;color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe62f;</i> 导出</button>
                    <button type="reset" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#x1002;</i> 重置</button>
                    <button type="submit" name="search" value="1" class="btn fr mbtn" style="color: #8f0911;background-color: #eee;"><i class="layui-icon">&#xe615;</i> 查找</button>
                </div>               
            </form>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>套餐编号</th>
                    <th>产品类型</th>
                    <th>套餐模式</th>
                    <th>套餐金额</th>
                    <th>套餐量（天）</th>
                    <th>套餐名称</th>
                    <th>创建时间</th>
                    <th>是否首充</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(!empty($list)): if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["typename"]); ?></td>
                        <td>
                            <?php switch($vo["remodel"]): case "0": ?>流量<?php break;?>
                                <?php case "1": ?>时长<?php break;?>
                                <?php default: endswitch;?>
                        </td>
                        <td><?php echo ($vo['money']/100); ?></td>
                        <td><?php echo ($vo["flow"]); ?></td>
                        <td><?php echo ($vo["describe"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                        <td>
                            <?php switch($vo["status"]): case "0": ?>否<?php break;?>
                                <?php case "1": ?>是<?php break;?>
                                <?php default: endswitch;?>
                        </td>
                        <td><a class="deletBnt" ruleId="<?php echo ($vo['id']); ?>" href="javascript:;">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="12">查无数据</td>
                    </tr><?php endif; ?>
                </tbody>
            </table>
            <div class="pagination">
                <ul>
                    <?php echo ($button); ?>
                </ul>
            </div>
            <script>
                $('.pagination ul a').unwrap('div').wrap('<li></li>');
                $('.pagination ul span').wrap('<li class="active"></li>');

                /**************** 搜索关键字保留 -- 开始 ******************/
                    var srearchInfo = {};
                    var type, remodel, minmoney, maxmoney, 
                        flow, describe, mintime, maxtime;
                    /**
                     * type: 产品类型, remodel：套餐模式, 
                     * minmoney：最小金额, maxmoney：最大金额, 
                     * flow：套餐量, describe：套餐名称, 
                     * mintime：开始时间, maxtime：结束时间
                     */
                    // 点击搜索
                    $("button[name='search']").click(function(){
                        setSearchWord();
                    })
                    function setSearchWord(){
                        sessionStorage.setItem('search', '');
                        
                        type = $('.prodtype').val();
                        if($('select>option:selected').val()){
                            remodel = Number($('select>option:selected').val())+1;
                        }
                        minmoney = $('.minmoney').val();
                        maxmoney = $('.maxmoney').val();
                        flow = $('.flow').val();
                        describe = $('.describe').val();
                        mintime = $('#date-start').val();
                        maxtime = $('#date-end').val();

                        srearchInfo['type'] = type;
                        srearchInfo['remodel'] = remodel;
                        srearchInfo['minmoney'] = minmoney;
                        srearchInfo['maxmoney'] = maxmoney;
                        srearchInfo['flow'] = flow;
                        srearchInfo['describe'] = describe;
                        srearchInfo['mintime'] = mintime;
                        srearchInfo['maxtime'] = maxtime;
                        sessionStorage.setItem('search', JSON.stringify(srearchInfo));
                    }
                    // 搜索关键字保留
                    if(sessionStorage.getItem('search')){
                        var srearchInfo = JSON.parse(sessionStorage.getItem('search'));
                        if($('.form-search').length){
                            // console.log(srearchInfo)
                            $('.prodtype').val(srearchInfo['type']);
                            if(srearchInfo['remodel']){
                                $('select>option').eq(srearchInfo['remodel'])[0].selected = true;
                            }
                            $('.minmoney').val(srearchInfo['minmoney']);
                            $('.maxmoney').val(srearchInfo['maxmoney']);
                            $('.flow').val(srearchInfo['flow']);
                            $('.describe').val(srearchInfo['describe']);
                            $('#date-start').val(srearchInfo['mintime']);
                            $('#date-end').val(srearchInfo['maxtime']);

                            setTimeout(function(){
                                sessionStorage.setItem('search', '');   // 初始化
                            },500)
                        }
                    }
                    // 重置搜索结果
                    $('button[type="reset"]').click(function(){
                        location.href = '<?php echo U("Admin/Setmeal/index");?>';

                    })
                    
                /**************** 搜索关键字保留 -- 结束 ******************/
                
                $(".deletBnt").click(function(){
                    var _this=$(this);
                    var id = $(this).attr('ruleId');
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.confirm('确定删除?', {icon: 3, title:'提示'}, function(index){
                            window.location.href='<?php echo U("Admin/Setmeal/del","","");?>?id='+id;
                            layer.close(index);
                        });
                    });
                });   

                $(".outputExcel").click(function(){
                    var remodel = '<?php echo $_POST["remodel"]; ?>',
                        typename = '<?php echo $_POST["typename"]; ?>',
                        minmoney = '<?php echo $_POST["minmoney"]; ?>',
                        maxmoney = '<?php echo $_POST["maxmoney"]; ?>',
                        flow = '<?php echo $_POST["flow"]; ?>',
                        describe = '<?php echo $_POST["describe"]; ?>',
                        mintime = '<?php echo $_POST["mintime"]; ?>',
                        maxtime = '<?php echo $_POST["maxtime"]; ?>';
                    $.ajax({
                       type: "POST",
                       url: "index",
                       async: false,
                       data: {
                            'remodel':remodel,
                            'typename':typename,
                            'minmoney':minmoney,
                            'maxmoney':maxmoney,
                            'flow':flow,
                            'describe':describe,
                            'mintime':mintime,
                            'maxtime':maxtime,
                            'outputExcel':1
                       },
                       success:function(res){
                            console.log(res);
                       }        
                    });
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