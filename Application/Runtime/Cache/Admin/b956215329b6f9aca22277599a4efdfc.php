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
            font-size: 12px
            cursor:pointer;
        }

        div.pagel a.prev,div.pagel a.next{
            padding: 3px 4px;
        }
        /*.bootstrap-datetimepicker-widget.dropdown-menu {
            width: auto !important;
        }*/
        #date-start,
        #date-end {
            width: 150px !important;
        }
        .collapse {
            height: auto !important;
        }
        .bootstrap-datetimepicker-widget table td span {
            display: inline-block !important;
        }
        input {
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
            <div class="titleBar">菜单管理/<span>菜单编辑</span></div>
            <table class="table table-bordered table-hover">
                <form action="<?php echo U('Admin/Menu/order');?>" method="post">
                <thead>
                    <tr>
                        <th width="5%">
                            排序
                        </th>
                        <th>
                            菜单名
                        </th>
                        <th>
                            连接
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                            <td>
                                <input class="input-medium text-center" style="width:40px;height:25px;" type="text"
                                name="<?php echo ($v['id']); ?>" value="<?php echo ($v['order_number']); ?>">
                            </td>
                            <td>
                                <?php echo ($v['_name']); ?>
                            </td>
                            <td>
                                <?php echo ($v['mca']); ?>
                            </td>
                            <td>
                                <a href="javascript:;" navId="<?php echo ($v['id']); ?>" navName="<?php echo ($v['name']); ?>" onclick="add_child(this)">
                                    添加子菜单
                                </a>
                                |
                                <a href="javascript:;" navId="<?php echo ($v['id']); ?>" navName="<?php echo ($v['name']); ?>" navMca="<?php echo ($v['mca']); ?>"
                                navIco="<?php echo ($v['ico']); ?>" onclick="edit(this)">
                                    修改
                                </a>
                                |
                                <a class="deletBnt" ruleId="<?php echo ($v['id']); ?>" href="javascript:;">
                                    删除
                                </a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <th>
                            <input class="btn btn-success" type="submit" value="排序">
                        </th>
                        <td>
                            <input class="btn btn-primary" type="button" value="添加菜单" onclick="add()">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
                </form>
            </table>
            <script>
                $('.pagination ul a').unwrap('div').wrap('<li></li>');
                $('.pagination ul span').wrap('<li class="active"></li>')
            </script>
        </div>
        <!-- 弹框信息 -->
        <div class="modal fade" id="bjy-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            添加菜单
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="bjy-form" class="form-inline" action="<?php echo U('Admin/Menu/add');?>"
                        method="post">
                            <input type="hidden" name="pid" value="0">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                    <th width="12%">
                                        菜单名：
                                    </th>
                                    <td>
                                        <input class="input-medium" type="text" name="name">
                                    </td>
                                    <td  style="border-left: none"></td>
                                </tr>
                                <tr>
                                    <th>
                                        连接：
                                    </th>
                                    <td>
                                        <input class="input-medium" type="text" name="mca">
                                        
                                    </td>
                                    <td style="border-left: none">
                                        <span>
                                            输入模块/控制器/方法即可 例如 Admin/Menu/index
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <div class="text-right">
                                <input class="btn btn-success" type="submit" value="添加">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="bjy-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            修改菜单
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="bjy-form" class="form-inline" action="<?php echo U('Admin/Menu/edit');?>"
                        method="post">
                            <input type="hidden" name="id">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                    <th width="12%">
                                        菜单名：
                                    </th>
                                    <td>
                                        <input class="input-medium" type="text" name="name">
                                    </td>
                                    <td style="border-left: none"></td>
                                </tr>
                                <tr>
                                    <th>
                                        连接：
                                    </th>
                                    <td>
                                        <input class="input-medium" type="text" name="mca">
                                        
                                    </td>
                                    <td style="border-left: none">
                                        <span>
                                            输入模块/控制器/方法即可 例如 Admin/Menu/index
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <div class="text-right">
                                <input class="btn btn-success" type="submit" value="修改">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
		            format: 'YYYY-MM-DD hh:mm:ss',  
		            locale: moment.locale('zh-cn')
		        }); 
		        
		        //结束时间
				var enddate = $("#date-end").datetimepicker({
		            format: 'YYYY-MM-DD hh:mm:ss',  
		            locale: moment.locale('zh-cn')
		        }); 
		         //动态设置最小值  
			    startdate.on('dp.change', function (e) {  
			        enddate.data('DateTimePicker').minDate(e.date);  

			    });  
			    //动态设置最大值  
			    enddate.on('dp.change', function (e) {  
			        startdate.data('DateTimePicker').maxDate(e.date);   
			        
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
<script>
// 添加菜单
function add() {
    $("input[name='name'],input[name='mca']").val('');
    $("input[name='pid']").val(0);
    $('#bjy-add').modal('show');
}

// 添加子菜单
function add_child(obj) {
    var navId = $(obj).attr('navId');
    $("input[name='pid']").val(navId);
    $("input[name='name']").val('');
    $("input[name='mca']").val('');
    $('#bjy-add').modal('show');
}

// 修改菜单
function edit(obj) {
    var navId = $(obj).attr('navId');
    var navName = $(obj).attr('navName');
    var navMca = $(obj).attr('navMca');
    var navIco = $(obj).attr('navIco');
    $("input[name='id']").val(navId);
    $("input[name='name']").val(navName);
    $("input[name='mca']").val(navMca);
    $("input[name='ico']").val(navIco);
    $('#bjy-edit').modal('show');
}
//删除
$(".deletBnt").click(function(){
    var _this=$(this);
    var id = $(this).attr('ruleId');
    layui.use('layer', function(){
        var layer = layui.layer;
        layer.confirm('确定删除?', {icon: 3, title:'温馨提示'}, function(index){
            window.location.href='delete?id='+id;
            layer.close(index);
            
        });
    });
});
</script>