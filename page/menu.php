<?php
	require_once('../fn/session.php');
	if($ulv<1){
		Header("HTTP/1.1 303 See Other"); 
		Header("Location: ../"); 
		exit;
	}
?>
<!doctype html>
<html>
 <head>
	<meta charset="UTF-8">
	<title id="pageTitle">网站导航</title>
	<link id="pageIcon" href="main/img/skywen.ico" rel="shortcut icon" />
	<link href="../main/frame/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../main/css/index.css" /> 
	<script src="../main/js/jquery-2.0.0.min.js"></script>
	<script src="../main/frame/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../main/js/reunite0.0.3.js"></script>
	<style type="text/css">
		.rightBottom{
			padding:0;
			min-height:800px;
		}

	</style>
 </head>
 <body>
	<div class='left'>
		<div class="logo">
			<a href="../">
				<img src="../main/img/skywen.svg" alt="skywen" />
				<p>为创意工作者而设计</p>
			</a>
		</div>
		<ul class='menu' id="menu">
			<a href='../'>首页</a>
			<a case="listBtn" url='user.html'>个人设置</a>
			<a case="listBtn" url='list.html'>分类管理</a>
			<a case="listBtn" url='web.html'>导航管理</a>
			<?php
				require_once('../fn/session.php');
				if($ulv>8){
			?>
				<a case="listBtn" url='admin.html'>用户管理</a>
			<?php
				}
			?>
		</ul>
	</div>
	<!-- 分割线 -->
	<div class="right">
		<div class="rightBox" style="height:100%;">
			<div class="rightTop col-xs-12">
				<div class="search_box">
					<a glue="pullDown" href="#" class="search_select" id="search_select">
						<span class="selectBtn" ></span>
						<ul class="selectBox_downBox"style="display:none"></ul>
					</a>
					<input class="search_text" type="text" glue="search_text" case="searchText">
					<button class="search_btn" case="searchBtn"></button>
				</div>
				<div class="user_box" id="pageMsg"></div>
			</div>
			<iframe class="mainBox"	src="" frameborder="0" id="win" case="win" url=""></iframe>
			<div class="mainMsg col-xs-12">© CopyRight 2015- 2017, 绍兴天问网络信息技术有限公司 , Skywen.All Rights Reserved. 浙ICP备16036744号-1</div>
		</div>
	</div>

	<script type="text/javascript">
		$.get("../api/other/getSelectLists.php",function(e){//加载搜索数据
			var json=JSON.parse(e);
			$("[case='searchText']").attr('placeholder',json.msg[0].search_name+" Search");
			if(json.result="success"){
				pulldown(
					{
						valName:"search_url",
						titleName:"search_name",
						glueName:"pullDown",
						data:json.msg
					},function(e,el,name){
					$(name).html(e.target.innerHTML);
					$("[case='searchText']").attr('placeholder',e.target.innerHTML+" Search");
					$(el).attr("val",$(e.target).attr("val"))
				});
			}
		})
		
		function frameHeight() {
			var iframe=$("#win")[0];
			var height=setInterval(function(){
				$("#win").ready(function(){
					$("#win").height($("#win").contents().find("html").height())
				});
			})
		};
		function pulldown2(glueName,fn){//下拉框组件
			var  el=document.querySelector("[glue='"+glueName+"']");
			var box=el.children[1];
			box.style.display="none";
			el.addEventListener("blur",function(){
				box.style.display="none";
				console.log(1);
			})
			el.addEventListener("click",function(){
				box.style.display=box.style.display=="none"?"":"none";
			})
			if(fn){
				box.addEventListener("click",function(e){
					fn(e);
				})
			}
		}	
		$.get("../api/user/get.php",function(e){
			var json=JSON.parse(e);
			var str="";
			if(json.result=="success"){
				$("#pageTitle").html(json.msg[0].user_title);
				$("#pageIcon").attr('href',json.msg[0].user_picon);
				if(json.login){
					str+='<a  class="user_msg"></a>';
					str+='<a class="user_menu search_select" glue="pullDownUser" href="#">';
					str+='<span class="selectBtn"><img class="user_icon" src="'+json.msg[0].user_icon+'" alt="头像" /><span class="user_name">'+json.msg[0].user_name+'</span><i class="user_down"></i></span>';
					str+='<ul class="selectBox_downBox user_downBox" id="user_selectBox">';
					str+='<li href="menu.php?to=user">个人设置</li><li href="menu.php?to=list">分类管理</li><li href="menu.php?to=web">导航管理</li>';
					<?php
						if($ulv>8){
						echo "str+='<li href=\"menu.php?to=admin\">用户管理</li>';";
						}
					?>
					str+='<li href="../fn/exit.php" case="exitLogin">退出</li></ul></a>';
					$('#pageMsg').html(str);
					pulldown2("pullDownUser",function(e){
						location.href=$(e.target).attr("href");
					});
				}
			}
			else{
				layer.alert("获取信息失败："+json.msg);
			}
		});
		if(urlGet("to")){
			$('#win').attr('src',urlGet("to")+".html");
			$('#menu a[case="listBtn"][url="'+urlGet("to")+'.html"]').addClass("active").siblings().removeClass("active");
		}
		event('listBtn',function(e){
			if($(e.target).attr('url')!=$('#win').attr('src').substr($('#win').attr('src').lastIndexOf('/')+1)){
				$(e.target).siblings().removeClass("active");
				$(e.target).addClass("active");
				$("#win").attr('src',$(e.target).attr('url'));
				frameHeight();
			}
		});
		event("searchText",function(e){
			if(e.keyCode==13){
				var str=$("#search_select").attr("val")+$("[glue='search_text']").val();
				window.open(str);
			};
		},"keyup");
		event("searchBtn",function(){
			var str=$("#search_select").attr("val")+$("[glue='search_text']").val();
			window.open(str);
			
		});
		event("exitLogin",function(e){
			localStorage.skywenToken=""
		})
	</script>
 </body>
</html>
