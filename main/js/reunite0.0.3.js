
//author  Airword

/*case属性的元素绑定事件*/
function event(caseName,fn,type){
	document.addEventListener(type?type:"click",function(e){
		if(e.target.getAttribute("case")==caseName){
			fn(e);
		}
	});
}

/*glue属性的元素操作*/
function set(glueName,fn){
	var Ds=document.querySelectorAll("[glue='"+glueName+"']");
	Array.prototype.map.call(Ds,function(e,i){
		fn(e,i)
	});
}

/*获取网址里的参数*/
function urlGet(url){
     var reg = new RegExp("(^|&)"+ url +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}

/* h5上传图片显示绑定 input文件关联显示input[type="file"] 和img */

function showImg(file,img){
	var file = document.querySelector('[glue="'+file+'"]').files[0];  
	//创建读取文件的对象  
	var reader = new FileReader();  
	//为文件读取成功设置事件  
	reader.onload=function(e) {  
		document.querySelector('[glue="'+img+'"]').src=e.target.result; 
	};  
	//正式读取文件  
	reader.readAsDataURL(file);
} 

/*调用板块*/
function part(partName,url,fn){
	var xmlhttp;
	var el=document.querySelector("[part='"+partName+"']");
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			el.innerHTML=(xmlhttp.responseText);
		}
	}
	xmlhttp.open('get',url);
	xmlhttp.setRequestHeader("Content-type","application/plain");
	xmlhttp.send();
	if(fn){
		fn(el);
	}
}
/*组件*/
function pulldown(option,fn){//下拉框组件
	var  el=document.querySelector("[glue='"+option.glueName+"']");
	var title=el.children[0];
	var box=el.children[1];
	var str="";
	Array.prototype.map.call(option.data,function(e,i){
		if(i==0){
			title.innerHTML=e[option.titleName];
			el.setAttribute('val',e[option.valName]);
		};
		str+="<li  val='"+e[option.valName]+"'>"+e[option.titleName]+"</li>";
	});
	box.innerHTML=str;
	el.addEventListener("blur",function(){
		box.style.display="none";
	})
	el.addEventListener("click",function(){
		box.style.display=box.style.display=="none"?"":"none";
	})
	if(fn){
		box.addEventListener("click",function(e){
			fn(e,el,title);
		})
	}
}		
