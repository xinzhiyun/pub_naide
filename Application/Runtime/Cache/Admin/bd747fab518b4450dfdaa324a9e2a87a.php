<?php if (!defined('THINK_PATH')) exit();?><!-- header part -->
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
<!-- content part -->
<div class="content">
    <!-- nav part-->
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
    <!-- from part-->
    <div class="row-fluid fl" id="main">
    <style type="text/css">
        .textarea{width: 215px; min-height: 110px; border: 1px solid #ccc;}
        .textarea p{
            padding: 0 10px;
            margin: 5px;
        } 
        .control-group{position: relative;}
        .control-group .elected{position: absolute; top: 0;left: 0;}
        .control-group .textarea{margin-left: 190px;}
        .btn-groups .btns{
            margin: 50px 0 50px 90px;
            padding: 8px 35px;
            border-radius: 7px;
        } 
    </style>
        <div class="tableBox">
            <div class="titleBar">工单管理/<span>工单添加</span></div>
            <div class="formBox">
                <form class="" action="/index.php/Admin/Work/add" method="post" id="_formTable">
                    
                    <input type="hidden" name="repair_id" value="<?php echo ($repairId); ?>">
                    <!--<div class="control-group">-->
                        <!--<span>工单号<sub style="color:red;margin-left: 5px;">*</sub></span>-->
                        <!--&lt;!&ndash; 需加数字验证 &ndash;&gt;-->
                        <!--<input type="text" class="control" name="number" placeholder="请输入工单号..." style="width:210px;">-->
                    <!--</div>-->
                    <div class="control-group">

                        <span>设备编码<sub style="color:red;margin-left: 5px;">*</sub></span>
                        <!-- 需加数字验证 -->
                        <?php if(empty($_GET)): ?><input type="text" class="control" name="dcode" placeholder="请输入设备编码" style="width:210px;">
                        <?php else: ?>
                            <input type="text" readonly="" name="dcode" value="<?php echo ($repairData['device_code']); ?>"><?php endif; ?>
                    </div>
                        <div class="control-group install">
                            <span>安装人员<sub style="color:red;margin-left: 5px;">*</sub></span>
                            <select name="personnel_id" class="personnel_id">
                                <option value="">--请选择--</option>
                                <?php if(is_array($personnelData)): $i = 0; $__LIST__ = $personnelData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="control-group install">
                            <span>安装人员手机号码<sub style="color:red;margin-left: 5px;">*</sub></span>
                            <input type="text" id="phone" class="control" disabled="" name="phone" value="请选择处理人员" style="width:210px;">
                        </div>
                    <div class="control-group">
                        <span>维护类型</span>
                        <?php if(empty($_GET)): ?><span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control0' name="type" value="0" checked><label for="control0">安装</label>
                            </span>
                            <span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control1' name="type" value="1" disabled><label for="control1">维修</label>
                            </span>
                            <span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control2' name="type" value="2"><label for="control2">维护</label>
                            </span>
                        <?php else: ?>
                            <span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control3' name="type" disabled disabled value="0"><label for="control3">安装</label>
                            </span>
                            <span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control4' name="type" value="1" checked><label for="control4">维修</label>
                            </span>
                            <span style='width:auto !important;text-align: center;'>
                                <input type="radio" class="control" id='control5' name="type" disabled disabled value="2"><label for="control5">维护</label>
                            </span><?php endif; ?>

                    </div>
                    <div class="control-group">
                        <span>工作内容<sub style="color:red;margin-left: 5px;">*</sub></span>
                        <textarea name="content" cols="30" rows="5" class="_textarea"></textarea>
                    </div>
                    <?php if(empty($_GET)): ?><div class="control-group">
                            <span>地址<sub style="color:red;margin-left: 5px;">*</sub></span>
                            <div class="info">
                                <select id="s_province" name="s_province"></select>&nbsp;&nbsp;
                                <select id="s_city" name="s_city" ></select>&nbsp;&nbsp;
                                <select id="s_county" name="s_county"></select>
                            </div>
                            <input type="hidden" name="address" class="addressValue">
                            <!-- 此处需要三级联动 -->
                        </div>
                        <div class="control-group">
                            <span>详细地址<sub style="color:red;margin-left: 5px;">*</sub></span>
                            <input type="text" class="control" name="add_ress" placeholder="请输入详细地址..." style="width:210px;">
                        </div>
                    
                        <div class="control-group">
                            <span>处理时间</span>
                            <!-- 需要时间插件 -->
                            <input type="text" id="addMaintenanceDate" name="time"/>
                        </div><?php endif; ?>
                    <div class="btn-groups">
                        <button class="btns reset btn-primary" type="reset">重置</button>
                        <button class="subbtn btns btn-primary submit" type="button">提交</button>
                    </div>
                    

                </form>
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
<script src="/Public/Home/js/public.js"></script>
<script>
//表单验证
function zero(num){
    return Number(num)<10?'0'+num:num
}
//验证特殊字符
function specail(val){
    return /[`~!@#$^&*()=|{}':;',\[\].<>/?~！@#￥……&*（）——|{}【】\s‘；：”“'。，、？]/.test(val.trim())?1:0
}
//验证中文
function chinese(val){
    return /[\u4E00-\u9FA5\uF900-\uFA2D]/.test(val.trim())?1:0
}
//layuiHint弹框提示封装
function layuiHint(text){
    layui.use('layer', function(){
        var layer = layui.layer;
        layer.msg(text);
    });  
}
var time = $('input[name=time]')
var date = new Date()
var year = date.getFullYear()
var month = date.getMonth()+1
var day = date.getDate()
var str = year+'-'+zero(month)+'-'+zero(day)
time.val(str)
time.click(function(){
    $(this).blur()
})

$('.submit').click(function(event) {
    var hasid = location.href.indexOf('id');
    var numberReg = /[0-9]/;
    var addressReg = /^(?=.*?[\u4E00-\u9FA5])[\dA-Za-z\u4E00-\u9FA5]{8,}/;
    var control = $('.control').val();  // 设备编号
    var _textarea = $('._textarea').val();
    // var phoneNumber = $('input[name=phone]').val().trim()
    var personnel_id = $('.personnel_id>option:selected').val()
    var address = $("input[name='add_ress']").val();
    console.log(addressReg.test(address))
    // if(!numberReg.test(control) && hasid == -1){
    //     layuiHint('请输入正确的设备编码！');
    //     return false
    // }
    // if(!personnel_id){
    //     layuiHint('请选择安装人员！');
    //     return false
    // }

    // if(!chinese(_textarea)){
    //     layuiHint('请填写工作内容！')
    //     return false
    // }

    // if($('#s_province').val()==""||$('#s_city').val()==""||$('#s_county').val()==""){
    //     layuiHint('请把地址填写完整！');
    //     return false

    // }else{
    //     $(".addressValue").val($('#s_province').val() + " " + $('#s_city').val() + " " + $('#s_county').val());
    // } 
    // if(!addressReg.test(address)  && hasid == -1){
    //     layuiHint('请输入详细地址！');
    //     return false
    // }
    $('#_formTable').submit();
});
$(function(){
    //处理日期
    layui.use('laydate', function(){
        var element =laydate = layui.laydate
    })
    //城市三级联动
    _init_area();
    var Gid  = document.getElementById ;
    var showArea = function(){
        Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + Gid('s_city').value + " - 县/区" + Gid('s_county').value + "</h3>"
    }

})

// 选择安装人员，自动请求手机号
$(".personnel_id").change('option',function(e){
    var id = $(this).val();
    console.log(id);
    $.ajax({
        url:"<?php echo U('personnel');?>",
        type:'post',
        data:{'id':id},
        success:function(res){
            $("input[name='phone']").val(res);
        }
    });
})

</script>