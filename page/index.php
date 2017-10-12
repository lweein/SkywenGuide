<?php 

	require_once('../fn/index.php');
	require_once('../fn/session.php');
	$seo=getSeo();
?>

<!doctype html>

<html lang="en">

 <head>
	<meta charset="UTF-8">

	<title id="pageTitle">网站导航</title>
	<meta name="keywords" content="<?php echo $seo->keywords ?>">
	<meta name="description" content="<?php echo $seo->description ?>">

	<link id="pageIcon" href="../main/img/skywen.ico" rel="shortcut icon" />
	
   <link rel="stylesheet" href="../main/frame/caomei/style.css" />
	<link href="../main/frame/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="../main/css/index.css" rel="stylesheet">
	<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" charset="utf-8"></script>
	<script src="../main/js/jquery-2.0.0.min.js"></script>

	<script src="../main/frame/bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../main/js/reunite0.0.3.js"></script>

  <style type="text/css">


i{margin-right:5px;}
.selectedlistBox{
	display:none;
}
.selectedlistBox.active{
	display:block;
}

  </style>

 </head>
 <body>
	 <div class="left" id="left">
		<div class="logo">
			<a href="https://www.skywen.cn">
				<img src="../main/img/skywen.svg" alt="" />
				<p>为创意工作者而设计</p>
			</a>
		</div>
		<ul class='menu' id="menu"><!-- 此件加载列表数据 --></ul>
	 </div>
	 <!-- 右部页面 -->
	 <div class="right">
		<!-- 搜索部分 -->
		<div class="rightBox">
			<div class="rightTop col-xs-12">
				<div class="search_box">
					<a glue="pullDown" href="#" class="search_select" id="search_select">
						<span class="selectBtn" ></span>
						<ul class="selectBox_downBox"style="display:none"></ul>
					</a>
					<input class="search_text" type="text" glue="search_text" case="searchText">
					<button class="search_btn" case="searchBtn"></button>
				</div>
				<div class="user_box" id="pageMsg">
					<a class="user_btn new" href="register.html">注册</a>
					<a class="user_btn login" href="login.html">登录</a>		
				</div><!-- 个人用户信息 -->

			</div>

			<!-- 主体显示部分 -->

			<div class="mainBox col-xs-12" id="mainBox"></div>
			<div class="mainMsg col-xs-12">© CopyRight 2015- 2017, 绍兴天问网络信息技术有限公司 , Skywen.All Rights Reserved. 浙ICP备16036744号-1</div>
		</div>

	</div>

		<script type="text/javascript">
			/*auto login*/

			var suid="<?php echo $_SESSION['uid'] ?>";
			if(localStorage.skywenUid&&localStorage.skywenToken&&suid=="1"){
				var key=navigator.appName+navigator.appVersion+screen.width+screen.height;
				$.post('../api/user/keepLogin.php',{uid:localStorage.skywenUid,token:localStorage.skywenToken,key:key},function(e){
					<?php
						if($ulv==1){//判断不不是管理员登录
							echo "location.reload();";
						}
					?>
				})
			}
			
			var init={listLid:null};
			function show(){//初始化加载数据
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
				});
				$.get('../api/list/getAll.php',function(lists){//getlists
					var json=JSON.parse(lists);
					if(json.result!="success"){
						alert(json.msg);
						return;
					}
					var str="";
					json.msg.map(function(e,i){
						if(i==0){
							init.listLid=e.list_id;
						}
						str+="<a "+(i==0?"class='active'":"")+" lid='"+e.list_id+"' case='listBtn' ><i class='"+e.list_icon+"'></i>"+e.list_name+"</a><ul glue='listBox' class='selectedlistBox'></ul>";
					});
					$("#menu").html(str);
				});	
				/*获取第一个分组数据*/
				var setFirstGroup=setInterval(function(){
					if(init.listLid!=null){
						getGroupByLid(init.listLid);
						clearInterval(setFirstGroup);
					}
				},0)
			}

			show();

			function getGroupByLid(lid){ //根据lid获取分组
				var str="";
				$.post('../api/group/getByLid.php',{lid:lid},function(e){
					/*渲染主页左部列表*/
					var json=JSON.parse(e);
					if(json.result!="success"){
						alert(json.msg);
						return;
					}
					/*渲染主页右部列表*/
					$.post("../api/web/getByLid.php",{lid:lid},function(w){
						var str2="";
						var groups=json.msg;
						var json2=JSON.parse(w);
						if(json2.result=="success"){
							var str2="";
							json.msg.map(function(group,i){//group循环
								str+="<a "+(i==0?"class='active'":"")+"href='#"+group.group_id+"' case='groupBtn' gid='"+group.group_id+"'><i class='tag'></i><i class='"+group.group_icon+"'></i>"+group.group_name+"</a>";

								str2+="<div class='box col-xs-12'><div class='list_title col-xs-12' id='"+groups[i].group_id+"'><span><i class='"+groups[i].group_icon+"'></i>"+groups[i].group_name+"</span></div>";
								
								json2.msg.map(function(web,j){//web循环
									if(web.web_gid==group.group_id){
										str2+='<div class="col-lg-3 col-md-6"><a class="web_box" href="';
										str2+=web.web_url+'" target="_blank"><img alt="image" class="web_icon" src="';
										str2+=web.web_icon+'"><div class="web_msg"><h4 class="web_name">';
										str2+=web.web_name+'</h4><p class="web_title">';
										str2+=web.web_msg+'</p></div><div class="clearfix"></div></a></div>';
									}
								});
								str2+="</div>";
							});
						$("#menu a[lid='"+lid+"']").next("ul[glue='listBox']").addClass("active").html(str).siblings("ul[glue='listBox']").removeClass("active");
						$('#mainBox').html(str2);
						}
					});
				});
			}

			
		</script>	

	<script type="text/javascript">
		$.get("../api/user/get.php",function(e){
			var str="";
			var json=JSON.parse(e);
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
		function pulldown2(glueName,fn){//下拉框组件
			var  el=document.querySelector("[glue='"+glueName+"']");
			var box=el.children[1];
			box.style.display="none";
			el.addEventListener("blur",function(){
				box.style.display="none";
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

		event('listBtn',function(e){
			var lid=$(e.target).attr("lid");
			$(e.target).addClass("active").siblings().removeClass("active");
			
			getGroupByLid(lid);
		});

		event('groupBtn',function(e){
			if($(e.target).is(".active")){
			}
			else{
				$(e.target).siblings().removeClass("active");
				$(e.target).addClass("active");
			}
		});
		event("exitLogin",function(e){
			localStorage.skywenToken="";
			QC.Login.signOut();
		})
	</script>
 </body>
</html>

