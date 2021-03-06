<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
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
<div class="content" style="background-color: #ECF0F5">
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
            <div class="titleBar">用户管理/<span>用户详情</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.go(-1)" class="btn btn-info">&lt;&lt;返回</a></div>
            
            <h1 class="text-center __user">当前用户：</h1>
            <input type="hidden" value='<?php echo ($user); ?>' class="_inp">
            <input type="hidden" value='<?php echo ($flow); ?>' class="_inp">
            <input type="hidden" value='<?php echo ($userinfo); ?>' class="_inp">
            <input type="hidden" value='<?php echo ($balance); ?>' class="balance">
            <div class="_tb _user" style="border-top: 4px #5ED0F4 solid;
    border-bottom:  1px #CCCCCC solid">
                <h3>用户基础信息</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td>姓名</td>
                            <td>手机</td>
                            <td>安装地址</td>
                            <td>已绑定的设备</td>
                            <td>剩余量（天）</td>
                            <td>最后登录时间</td>
                            <td>登录IP</td>
                            <td>关注日期</td>
                            <td>用户状态</td>
                            <td>解绑</td>
                        </tr>
                    </thead>
                    <tbody class="_user_"></tbody>
                </table>
            </div>
            
            <div class="_tb _user" style="border-top: 4px #5ED0F4 solid;
    border-bottom:  1px #CCCCCC solid">
                <h3>充值记录</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td>用户ID</td>
                            <td>充值方式</td>
                            <td>订单号码</td>
                            <td>充值金额/元</td>
                            <td>充值量（天）</td>
                            <td>充值时间</td>
                        </tr>
                    </thead>
                    <tbody class="_flow"></tbody>
                </table>
                
            </div>
        </div>
        <script>
            var _inp = $('._inp')
            var user = _inp.eq(0).val()
            var flow = _inp.eq(1).val()
            var consume = _inp.eq(2).val();
            var balance = JSON.parse($(".balance").val());

            console.dir(balance);
            var userStatus = {
                '0':'禁用',
                '1':'启用'
            }
            var mode = {
                '0':'系统赠送',
                '1':'微信',
                '2':'支付宝'
            }
            user.replace(/({.+})/,function(match,p1,offset,str){
                var data = JSON.parse(match)
                $('.__user').append(data.nickname)
            })
            flow.replace(/(\[.+\])/,function(match,p1,offset,str){
                var data = JSON.parse(match)
                console.log('data: ',data);
                data.forEach(function(el,i,arr){
                    var time = el.addtime?new Date(Number(el.addtime)*1000).toLocaleString():'--'
                    var ordernumber = el.order_id?el.order_id:'--'
                    var currentbalance = el.reday?el.reday:'--'
                    var flow = el.flow?el.flow:'--'
                    var money = el.money?el.money:'--'
                    var html = '<tr>'+
                                    '<td>'+el.id+'</td>'+
                                    '<td>'+mode[el.mode]+'</td>'+
                                    '<td>'+ordernumber+'</td>'+
                                    '<td>'+money/100+'</td>'+
                                    '<td>'+flow+'</td>'+
                                    '<td>'+time.trim()+'</td>'+
                                '</tr>'
                    $('._flow').append(html)
                }) 
            })

            consume.replace(/(\[.+\])/,function(match,p1,offset,str){
                var data = JSON.parse(match)
                // console.dir(data);

                data.forEach(function(el,i,arr){
                    // console.dir(arr);
                    var login_time = data[i].login_time?new Date(Number(data[i].login_time)*1000).toLocaleString():'--'
                    var addtime = data[i].addtime?new Date(Number(data[i].addtime)*1000).toLocaleString():'--'
                    var installaddress= data[i].address?data[i].address:'--';
                    var html = '<tr>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].phone+'</td>'+
                        '<td>'+installaddress+'</td>'+
                        '<td class="device_code">'+data[i].device_code+'</td>'+
                        '<td class="balance"></td>'+
                        '<td>'+addtime+'</td>'+
                        '<td>'+data[i].login_ip+'</td>'+
                        '<td>'+login_time+'</td>'+
                        '<td>'+userStatus[data[i].user_status]+'</td>'+
                        '<td><a class="unb" did="'+data[i].device_code+'" href="javascript:;">解绑</a></td>'+
                    '</tr>'
                    if(data[i].device_code != null){
                        $('._user_').append(html)
                    } else {
                        $('._user_').append('<tr><td>暂无绑定设备</td></tr>')
                    }
                })
                                
            })

            $('._user_').on("click",".unb",function(){
                var dcode = $(this).attr("did");
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.confirm('点击"确定"解绑！',function(){
                        $.ajax({
                            url:"<?php echo U('Admin/Users/unbind');?>",
                            data:{"device_code":dcode},
                            dataType:"json",
                            type: 'post',
                            success:function(res){
                                console.log(res);
                                location.reload();
                                 layui.use('layer', function(){
                                    var layer = layui.layer;
                                    layer.msg('解绑成功！');
                                });
                            },
                            error:function(res){
                                console.log(res);
                            }
                        });
                    });
                });
            })
            // 遍历剩余流量
            for(var i=0; i<balance.length; i++){
                // console.log($(".device_code").eq(i).text())
                // console.log(balance[i].deviceid)
                if($(".device_code").eq(i).text() == balance[i].deviceid){

                    if(!balance[i].reday){
                        $(".device_code").eq(i).siblings(".balance").text(0)
                    }else{
                        $(".device_code").eq(i).siblings(".balance").text(balance[i].reday)
                    }
                }
                
            }
        </script>
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
			    	$('#date-start').val(time);

			    });  
			    //动态设置最大值  
			    enddate.on('dp.change', function (e) {  
			        startdate.data('DateTimePicker').maxDate(e.date);
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