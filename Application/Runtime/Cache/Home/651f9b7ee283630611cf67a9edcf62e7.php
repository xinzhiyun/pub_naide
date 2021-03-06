<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui" />
  <title>服务记录</title>
  <link rel="stylesheet" href="/Public/Home/fonts/iconfont.css">
  <link rel="stylesheet" href="/Public/Home/css/reward.css">
</head>
<body>
  <div class="_reward">
    <div class="rewardTop">
       <div class="myReward">
         <p>服务记录</p>
         <div class="iconReward">
            <span>累计：</span>
            <p>安装&nbsp;{{ num[0] }}</p>
            <p>报修&nbsp;{{ num[1] }}</p>
            <p>维护&nbsp;{{ num[2] }}</p>
         </div>
       </div>
    </div>
    <ul class="rewardFoot">
      <li>
        <h4 @click='showModule($event)'>报修</h4>
        <ul>
          <li v-for='(item, index) in data' class="litem" :index='item.index' v-if='item.type == 1' >
            <p @click='showText($event)'>
              <span>报修</span>
              <span @click='javascript:void(0);'>{{ item.time }}</span>
            </p>
            <div class="show">
              <span><span>处理人：</span>{{ item.name }}</span>
              <div><span>电话：</span><a :href="'tel:'+ item.phone">{{ item.phone }}</a></div>
              <div><span>报修进度：</span>{{ item.result }}</div>
              <div><span>报修地址：</span>{{ item.address }}</div>
            </div>
          </li>
        </ul>
      </li>
      <li>
        <h4 @click='showModule($event)'>安装</h4>
        <ul>
          <li v-for='(item, index) in data' class="litem" :index='item.index' v-if='item.type == 0'>
            <p @click='showText($event)'>
              <span>安装</span>
              <span @click='javascript:void(0);'>{{ item.time }}</span>
            </p>
            <div class="show">
              <span><span>处理人：</span>{{ item.name }}</span>
              <div><span>电话：</span><a :href="'tel:'+ item.phone">{{ item.phone }}</a></div>
              <div><span>安装进度：</span>{{ item.result }}</div>
              <div><span>安装地址：</span>{{ item.address }}</div>
            </div>
          </li>
        </ul>
      </li>
      <li>
        <h4 @click='showModule($event)'>维护</h4>
        <ul>
          <li v-for='(item, index) in data' class="litem" :index='item.index' v-if='item.type == 2'>
            <p @click='showText($event)'>
              <span>维护</span>
              <span @click='javascript:void(0);'>{{ item.time }}</span>
            </p>
            <div class="show" >
              <span><span>处理人：</span>{{ item.name }}</span>
              <div><span>电话：</span><a :href="'tel:'+ item.phone">{{ item.phone }}</a></div>
              <div><span>维护进度：</span>{{ item.result }}</div>
              <div><span>维护地址：</span>{{ item.address }}</div>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
  <script src="/Public/Home/js/jquery-1.10.1.js"></script>
  <script src="/Public/Home/js/public.js"></script>
  <script src="/Public/Home/js/vue.min.js"></script>
  <script>
    $(function(){
      var app = new Vue({
        el: '._reward',
        data() {
          return {
            data: [],
            num: [0, 0, 0],
            isSameEle: null,
            liOffsetH: 0,
            moduleIsShow: true
          }
        },
        computed: {},
        mounted() {
          var that = this;
          // 请求数据
          $.ajax({
            url: '<?php echo U("Users/reward");?>',
            type: 'post',
            success: function(res){
              console.log('请求成功！', res);
              // 将后台传来的时间戳转化为正常时间
              for(var i=0; i<res.length; i++){
                res[i]['index'] = i;
                res[i].time = that.getLocaltime(res[i].time);
                if(res[i].type == 0){// 统计报装数量
                  that.num[0]++;

                }else if(res[i].type == 1){// 统计维修数量
                  that.num[1]++;

                }else if(res[i].type == 2){// 统计维护数量
                  that.num[2]++;

                }
                if(!res[i].phone){
                  res[i].phone = '暂无电话';
                }
                // 处理进度
                if(res[i].result == 0){
                  res[i].result = '未处理';

                }else if(res[i].result == 1){
                  res[i].result = '正在处理';

                }else if(res[i].result == 2){
                  res[i].result = '已处理';

                }
                // 将数据更新到 data 
                that.data.push(res[i]);
              }
              // console.log(that.data);
              // console.log(that.num);
            },
            error: function(res){
              console.log('请求失败！', res);
            } 
          })

        },
        methods: {
          getLocaltime: function (_time) {
            /*
                _time 时间戳（ms）,后台传来的单位是s，需要乘1000
                个位数时加 '0', 统一位数
             */ 
            _time = Number(_time)*1000;
            // console.log('_time: ',_time);
            var localetime = new Date(_time);
            var year = localetime.getFullYear(),
                month = (localetime.getMonth()+'').length == 1 
                  ? '0' + localetime.getMonth() 
                  : localetime.getMonth(),
                date = (localetime.getDate()+'').length == 1
                  ? '0' + localetime.getDate()
                  : localetime.getDate(),
                hour = (localetime.getHours()+'').length == 1
                  ? '0' + localetime.getHours()
                  : localetime.getHours(),
                minute = (localetime.getMinutes()+'').length == 1
                  ? '0' + localetime.getMinutes()
                  : localetime.getMinutes(),
                second = (localetime.getSeconds()+'').length == 1
                  ? '0' + localetime.getSeconds()
                  : localetime.getSeconds();

            var normal = year + '/' + month + '/'  + date + '\t'  + hour + ':'  + minute;
            if(!_time) normal = '时间不见了';
            // console.log('year + month + day + hour + minute: ', normal);
            return normal;
          },
          showText: function(e){
            /**
             * 点击安装或报修项目显示详情
             */
            // e: 当前元素(p标签)
            var li = e.currentTarget.parentNode.parentNode.children;
            var nowLi = e.currentTarget.parentNode;
            // console.log('li: ',li);
            // 初始化
            for(var i=0; i<li.length; i++){
              li[i].style.background = '#fff';
              li[i].children[1].setAttribute('style','height:0;');

            }
            // 展开当前元素
            nowLi.style.background = '#f6f6f6';
            nowLi.children[1].setAttribute('style','height:40vh;border-color:#ddd');
            // 当前元素点击多次
            if(this.isSameEle == nowLi.getAttribute('index')){
              nowLi.children[1].setAttribute('style',"height:0;");
              this.isSameEle = '';
              return
            }
            this.isSameEle = nowLi.getAttribute('index');
            // console.log('index: ',nowLi.getAttribute('index'));
            // console.log('same: ',this.isSameEle);
          },
          showModule: function(e){
            /**
             * 显示或隐藏模块
             * @param {object} [e] [当前元素]
             */
            var ul = e.currentTarget.parentNode.children[1];
            // console.log(ul);

            // 如果当前模块显示则隐藏， 反之则显示
            if(this.moduleIsShow){
              ul.style.display = 'none';
              this.moduleIsShow = false;

            }else if(!this.moduleIsShow){
              ul.style.display = 'block';
              this.moduleIsShow = true;

            }
          }
       }
      });

    })
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