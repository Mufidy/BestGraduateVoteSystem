// JavaScript Document
function _canLogin()
{
	var loginName=$('#loginName').val();
	var pwd=$('#pwd').val();
	var validateNum=$('#valiInput').val();
	if (loginName==''){
		alert("请输入用户名！");
	}
	else if (pwd==''){
		alert("请输入密码！");
	}
	else if (validateNum==''){
		alert("请输入验证码！");
	}else{
		var postStr="flag=05&loginName="+loginName
			+"&password="+pwd+"&postValidateNum="+validateNum;
		var ajax = false;
		//开始初始化XMLHttpRequest对象
	    if(window.XMLHttpRequest) 
		{ 	//Mozilla 浏览器
	        ajax = new XMLHttpRequest();
	    	if (ajax.overrideMimeType) 
			{	//设置MiME类别
	            ajax.overrideMimeType("text/xml");
	   		}
	 	}
	    else if (window.ActiveXObject) 
		{ 	// IE浏览器
	        try 
			{
	        	ajax = new ActiveXObject("Msxml2.XMLHTTP");
	        } 
			catch (e) 
			{
	        	try 
				{
	            	ajax = new ActiveXObject("Microsoft.XMLHTTP");
	            } 
				catch (e) {}
			}
		}
	    if (!ajax) 
		{ 	// 异常，创建对象实例失败
	        window.alert("不能创建XMLHttpRequest对象实例.");
	        return false;
		}                
		//通过Post方式打开连接
		ajax.open("post", "canLogin.php?"+postStr, true);
		//定义传输的文件HTTP头信息
		//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//获取执行状态
		ajax.onreadystatechange = updatePage;
		//发送POST数据
		ajax.send(null);
		
		function updatePage() 
		{ 
	   		//如果执行状态成功，那么就把返回信息写到指定的层里
	   		if (ajax.readyState == 4 && ajax.status == 200)
			{ 
				var ret = ajax.responseText;
				if(ret == 3)
				{
				    alert("密码错误！");
					$('#pwd').val('');
				}
				else if(ret == 1){
					alert("用户名不存在！");
					$('#loginName').val('');
					$('#pwd').val('');
				}
				else if(ret == 2){
					alert("输入验证码错误！");
					$('#valiInput').val('');
					document.getElementById('validatePic').src = 'getValidate.php';
				}
				else {
					window.location.href = ret;

				}
	   		} 
		}
	}
}

function isDN(sss){
	var re;
	re = /^[a-zA-Z|\d]*$/;
	if (re.test(sss)) {
    	return true;
	}
	else {
    	return false;
	}
}
function _canRegister()
{  
    var loginName=$('#nameRegister').val();
	var password=$('#pwd1').val();
	var password2=$('#pwd2').val();

	if (!loginName) {
		alert("登录名不能为空！");
	}
	else{
		if (isDN(loginName)&&((loginName.length>=6)&&(loginName.length<=12))) {
			if(!password){
				alert("密码不能为空！")
			}else{
			if (password != password2){
			alert("两次输入不一致！");
			$('#pwd1').val() = '';
			$('#pwd2').val() = '';
			}
		else {
			var postStr="flag=06&loginName="+loginName+"&password="+password;
			var ajax = false;
			//开始初始化XMLHttpRequest对象
		    if(window.XMLHttpRequest) 
			{ 	//Mozilla 浏览器
		        ajax = new XMLHttpRequest();
		    	if (ajax.overrideMimeType) 
				{	//设置MiME类别
		            ajax.overrideMimeType("text/xml");
		   		}
		 	}
		    else if (window.ActiveXObject) 
			{ 	// IE浏览器
		        try 
				{
		        	ajax = new ActiveXObject("Msxml2.XMLHTTP");
		        } 
				catch (e) 
				{
		        	try
		        	{
		            	ajax = new ActiveXObject("Microsoft.XMLHTTP");
		            } 
					catch (e) {}
				}
			}
		    if (!ajax) 
			{ 	// 异常，创建对象实例失败
		        window.alert("不能创建XMLHttpRequest对象实例.");
		        return false;
			}
                
			//通过Post方式打开连接
			ajax.open("get", "canLogin.php?"+postStr, true);

	//定义传输的文件HTTP头信息
	//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			ajax.onreadystatechange = updatePage;
			//发送POST数据
			ajax.send(null);
	
			//获取执行状态
			function updatePage() 
			{ 
		   		//如果执行状态成功，那么就把返回信息写到指定的层里
		   		if (ajax.readyState == 4 && ajax.status == 200)
				{ 
					var ret = ajax.responseText;
					if (ret == 'false'){
						alert('用户名已存在！！');
						document.getElementById('nameRegister').value='';
						document.getElementById('pwd1').value='';
						document.getElementById('pwd2').value='';
					}
					else{
						alert("注册成功！");
						window.location.href = ret;
					}
		   		} 
			}
			}



		}
	}
		 else{
			window.alert("用户名格式错误！");
		};
}
}

/*function _skipCanRegister()
{
	window.location.href="canRegister.html";
}*/

function _adminLogin(){
	var adminName=$('#adminId').val();
	var adminPwd=$('#adminPassword').val();

	if (adminName==''){
		alert("请输入用户名！");
	}
	else if (adminPwd==''){
		alert("请输入密码！");
	}
	else{
		var postStr="flag=04&adminName="+adminName
			+"&adminPwd="+adminPwd;
		var ajax = false;
		//开始初始化XMLHttpRequest对象
	    if(window.XMLHttpRequest) 
		{ 	//Mozilla 浏览器
	        ajax = new XMLHttpRequest();
	    	if (ajax.overrideMimeType) 
			{	//设置MiME类别
	            ajax.overrideMimeType("text/xml");
	   		}
	 	}
	    else if (window.ActiveXObject) 
		{ 	// IE浏览器
	        try 
			{
	        	ajax = new ActiveXObject("Msxml2.XMLHTTP");
	        } 
			catch (e) 
			{
	        	try 
				{
	            	ajax = new ActiveXObject("Microsoft.XMLHTTP");
	            } 
				catch (e) {}
			}
		}
	    if (!ajax) 
		{ 	// 异常，创建对象实例失败
	        window.alert("不能创建XMLHttpRequest对象实例.");
	        return false;
		}                
		//通过Post方式打开连接
		ajax.open("post", "canLogin.php?"+postStr, true);
		//定义传输的文件HTTP头信息
		//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//获取执行状态
		ajax.onreadystatechange = updatePage;
		//发送POST数据
		ajax.send(null);
		
		function updatePage() 
		{ 
	   		//如果执行状态成功，那么就把返回信息写到指定的层里
	   		if (ajax.readyState == 4 && ajax.status == 200)
			{ 
				var ret = ajax.responseText;
				if(ret == 3)
				{
				    alert("密码错误！");
					$('#adminId').val('');
				}
				else if(ret == 1){
					alert("用户名不存在！");
					$('#adminId').val('');
					$('#adminPassword').val('');
				}
				else {
					window.location.href = ret;

				}
	   		} 
		}
	}
}

function admin(){
	var webInput = prompt("请输入管理员口令： ");

	var adminkey = webInput;

	if (!adminkey) {
		alert("口令不能为空！");
	}
	
	else {
		var postStr="flag=07&adminkey="+adminkey;
		var ajax = false;
		//开始初始化XMLHttpRequest对象
	    if(window.XMLHttpRequest) 
		{ 	//Mozilla 浏览器
	        ajax = new XMLHttpRequest();
	    	if (ajax.overrideMimeType) 
			{	//设置MiME类别
	            ajax.overrideMimeType("text/xml");
	   		}
	 	}
	    else if (window.ActiveXObject) 
		{ 	// IE浏览器
	        try 
			{
	        	ajax = new ActiveXObject("Msxml2.XMLHTTP");
	        } 
			catch (e) 
			{
	        	try
	        	{
	            	ajax = new ActiveXObject("Microsoft.XMLHTTP");
	            } 
				catch (e) {}
			}
		}
	    if (!ajax) 
		{ 	// 异常，创建对象实例失败
	        window.alert("不能创建XMLHttpRequest对象实例.");
	        return false;
		}
            
		//通过Post方式打开连接
		ajax.open("post", "canLogin.php?"+postStr, true);

//定义传输的文件HTTP头信息
//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		ajax.onreadystatechange = updatePage;
		//发送POST数据
		ajax.send(null);

		//获取执行状态
		function updatePage() 
		{ 
	   		//如果执行状态成功，那么就把返回信息写到指定的层里
	   		if (ajax.readyState == 4 && ajax.status == 200)
			{ 
				var ret = ajax.responseText;
				if (ret == '3'){
					alert('口令不正确！！');
				}
				else {
					window.location.href = ret;
				}
	   		} 
		}
	}
	
}