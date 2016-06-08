function checkMaxInput(obj,maxLen,remLen) {
	if (obj.value.length > maxLen){	//如果输入的字数超过了限制
		obj.value = obj.value.substring(0, maxLen);	//就去掉多余的字
		remLen.innerText = '您输入的内容超出了字数限制'
	}
	else{
		remLen.innerText = '还能输入' + (maxLen - obj.value.length) + '字';//计算并显示剩余字数
	}
}//new function

function   chkmaxsms(vobj1,vmax)   {   
	var   str=vobj1.value;   
    var   strlen=str.length;   
    if(strlen>vmax)   {   
        alert('字数超过限制');   
        eval(vobj1.value=str.substr(0,vmax));   
    }   
} 

String.prototype.Trim = function(){
	return this.replace(/(^\s*)|(\s*$)/g,"");
}

function check_name(){
	var realname=document.getElementById('realname').value;
	realname = realname.Trim();
	
	if(realname == ""){
		alert("请输入姓名");
		return false;
	}else{
		var reg = /^[\u4e00-\u9fa5]{2,10}$/g;
		if(reg.test(realname)){
			return true;
		}else{
			alert("请输入正确的姓名");
			return false;
		}
	}
}

function check_politicallandscape(){
	var obj = document.getElementById('politicallandscape');
	var txt = obj.options[obj.selectedIndex].value;

	if(txt == "moren"){
		alert("请选择政治面貌");
		return false;
	}else{
		txt == obj.options[obj.selectedIndex].value;
		return true;
	}
}

function check_number(){
	var number;
	number = document.getElementById('number').value;
	number = number.Trim();

	if(number.length == 0){
		alert("请输入学号");
		return false;
	}
	else if(number.length != 8 ||/[\W]/g.test(number.value)){
		alert("请输入正确的学号");
		return false;
	}
	else {
		return true;
	}		
}

function check_nation(){
	var nation = document.getElementById('nation').value;
	nation = nation.Trim();

	if(nation == ""){
		alert("请输入民族");
		return false;
	}else{
		var reg = /^[\u4e00-\u9fa5]{1,20}$/g;
		if(reg.test(nation)){
			return true;
		}else{
			alert("请输入正确的民族");
			return false;
		}
	}
}

function check_tele(){
	var tele;
	tele = document.getElementById('tele').value;
	tele = tele.Trim();

	if(tele.length == 0){
		alert("请输入手机");
	}
	else if(tele.length != 11 || /^\d*$/.test(tele.value)){
		alert("请输入正确的手机");
		return false;
	}
	else {
		return true;
	}
}

function check_college(){
	var obj = document.getElementById('college');
	var txt = obj.options[obj.selectedIndex].value;

	if(txt == "moren"){
		alert("请选择院系");
		return false;
	}else{
		txt == obj.options[obj.selectedIndex].value;
		return true;
	}
}

function check_email(){      
	var email; 
	email = document.getElementById('email').value;      
	email = email.Trim();   
	   
	if (email == "") { 
		alert("请输入Email"); 
		return false;      
	} else { 
		var reg = /^[\w-]+[\.]*[\w-]+[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/;
		if (reg.test(email)) {
			return true;
		} else { 
			alert("请输入有效的Email地址");
			return false;
		}             
    }      
}

function check_highschool(){
	var highschool = document.getElementById('highschool').value;
	highschool = highschool.Trim();

	if(highschool == ""){
		alert("请输入毕业高中");
		return false;
	}else{
		return true;
	}
}

function check_type(){
	var obj = document.getElementById('type');
	var txt = obj.options[obj.selectedIndex].value;

	if(txt == "moren"){
		alert("请选择影响力类型");
		return false;
	}else{
		txt == obj.options[obj.selectedIndex].value;
		return true;
	}
}

function check_save(){
	return check_name()&&check_politicallandscape()&&check_number()&&check_nation()
	&&check_tele()&&check_college()&&check_email()&&check_highschool()&&check_type()
	;
}
function checkMaxInput1(obj,maxLen,remLen) {
	if (obj.value.length > maxLen){	//如果输入的字数超过了限制
		obj.value = obj.value.substring(0, maxLen);	//就去掉多余的字
		remLen.innerText = '您输入的内容超出了字数限制'
	}
	else{
		remLen.innerText = '(限50字以内，后期用于投票页面的简短介绍)!还能输入' + (maxLen - obj.value.length) + '字';//计算并显示剩余字数
	}
}//new function

function checkMaxInput2(obj,maxLen,remLen) {
	if (obj.value.length > maxLen){	//如果输入的字数超过了限制
		obj.value = obj.value.substring(0, maxLen);	//就去掉多余的字
		remLen.innerText = '您输入的内容超出了字数限制'
	}
	else{
		remLen.innerText = '(限800字以内，可为所获荣誉、论文发表情况等，请列点说明)!还能输入' + (maxLen - obj.value.length) + '字';//计算并显示剩余字数
	}
}//new function

function checkMaxInput3(obj,maxLen,remLen) {
	if (obj.value.length > maxLen){	//如果输入的字数超过了限制
		obj.value = obj.value.substring(0, maxLen);	//就去掉多余的字
		remLen.innerText = '您输入的内容超出了字数限制'
	}
	else{
		remLen.innerText = '(限1000字以内，可为个人情况详细介绍等)!还能输入' + (maxLen - obj.value.length) + '字';//计算并显示剩余字数
	}
}//new function

function setImagePreview() {
var docObj=document.getElementById("doc");

var imgObjPreview=document.getElementById("preview");
    if(docObj.files && docObj.files[0]){
        //火狐下，直接设img属性
        imgObjPreview.style.display = 'block';
        imgObjPreview.style.width = '105px';
        imgObjPreview.style.height = '150px'; 
        //imgObjPreview.src = docObj.files[0].getAsDataURL();                   
        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式  
        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
    }else{
        //IE下，使用滤镜
        docObj.select();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("localImag");
        //必须设置初始大小
        localImagId.style.width = "105px";
        localImagId.style.height = "150px";
        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try{
            localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
        }catch(e){
            alert("您上传的图片格式不正确，请重新选择!");
            return false;
        }
        imgObjPreview.style.display = 'none';
        document.selection.empty();
    }
    return true;
    // window.alert(document.selection.)
}

function setImagePreview1() {
var docObj=document.getElementById("doc1");

var imgObjPreview1=document.getElementById("preview1");
    if(docObj.files && docObj.files[0]){
        //火狐下，直接设img属性
        imgObjPreview1.style.display = 'block';
        imgObjPreview1.style.width = '105px';
        imgObjPreview1.style.height = '150px'; 
        //imgObjPreview.src = docObj.files[0].getAsDataURL();                   
        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式  
        imgObjPreview1.src = window.URL.createObjectURL(docObj.files[0]);
    }else{
        //IE下，使用滤镜
        docObj.select();
        var imgSrc = document.selection.createRange().text;
        var localImagId = document.getElementById("localImag");
        //必须设置初始大小
        localImagId.style.width = "105px";
        localImagId.style.height = "150px";
        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try{
            localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
        }catch(e){
            alert("您上传的图片格式不正确，请重新选择!");
            return false;
        }
        imgObjPreview1.style.display = 'none';
        document.selection.empty();
    }
    return true;
    // window.alert(document.selection.)
}

function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url:'doajaxfileupload.php',
				secureuri:false,
				fileElementId:'doc',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;
}
function ajaxFileUpload1()
	{
		$.ajaxFileUpload
		(
			{
				url:'doajaxfileupload1.php',
				secureuri:false,
				fileElementId:'doc1',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;
}

//---------------------------------------------------------------------------------
function _loadDet(){
	var xmlhttp;
	if (window.XMLHttpRequest)
  	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	  {
	  	textR1=xmlhttp.responseText;//这里的responseText是Json
	    _addDetail(textR1);//这个是正常使用的代码
	  }
	}
	var postStr = "flag=02";
	xmlhttp.open("get","namelistDet.php?"+postStr,true);
	xmlhttp.send(postStr);
}
function $G(Read_Id) { return document.getElementById(Read_Id) }
function _addDetail(textD){
	detailObj = JSON.parse(textD);
	
	//注册的时候不用填表
	if(detailObj['realname']!=''){

		$G("realname").value=detailObj['realname'];//姓名
		$G("number").value=detailObj['number'];//学号
		$G("nation").value=detailObj['nation'];//名族
		$G("tele").value=detailObj['tele'];//手机
		$G("email").value=detailObj['email'];//电子邮件
		$G("highschool").value=detailObj['highschool'];//毕业高中
		$G(detailObj['sex']).checked="true";//性别
		$G(detailObj['yesorno']).checked="true";//是否同意公开
		$G(detailObj['recommend']).checked="true";//推荐类型
		if (detailObj['recommend'] == '院系推荐'){
			$G('checkJYM').value=detailObj['checkCode'];
		}
		else{
			document.all.checkJYM.disabled=true;document.all.checkJYM.value='无需校验码';
		}
		$G("college").value=detailObj['college'];//院系
		$G("politicallandscape").value=detailObj['politicallandscape'];//政治面貌
		$G("type").value=detailObj['type'];//影响力类型
		
		var tempdes =detailObj['describe'];
		tempdes = tempdes.replace(/`/g,"\n");
		tempdes = tempdes.replace(/MicrosoftAA/g,"\"");
		tempdes = tempdes.replace(/MicrosoftBB/g,"\'");
		$G("describe").value = tempdes;//个人影响力描述

		var tempdes1 =detailObj['material'];
		tempdes1 = tempdes1.replace(/`/g,"\n");
		tempdes1 = tempdes1.replace(/MicrosoftAA/g,"\"");
		tempdes1 = tempdes1.replace(/MicrosoftBB/g,"\'");
		$G("material").value = tempdes1;//影响力证明材料

		var tempdes2 =detailObj['introduce'];
		tempdes2 = tempdes2.replace(/`/g,"\n");
		tempdes2 = tempdes2.replace(/MicrosoftAA/g,"\"");
		tempdes2 = tempdes2.replace(/MicrosoftBB/g,"\'");
		$G("introduce").value = tempdes2;//个人详细介绍
		$G("preview").src = detailObj['identiPic'];
		$G("preview1").src= detailObj['lifePic'];
 	}
}
function _submit(){
	if (check_save()){
		var name = $('#realname').val();
		//redio style
		var sex = document.getElementsByName('sex');
		var sexResult;
		for (var i = 0;i < sex.length;i++){
			if(sex[i].checked)
				sexResult = sex[i].value;
		}
		//select style
		var political = document.getElementById('politicallandscape');
		var politicalRes = political.options[political.selectedIndex].value;

		var studentNumber = $('#number').val();
		var nation = $('#nation').val();
		var telephone = $('#tele').val();

		//select style
		var college = document.getElementById('college');
		var collegeRes = college.options[college.selectedIndex].value;

		var email = $('#email').val();
		var highSchool = $('#highschool').val();
		//radio style
		var publicOr = document.getElementsByName('judge');
		var publicRes;
		for (var i = 0;i < publicOr.length;i++){
			if(publicOr[i].checked)
				publicRes = publicOr[i].value;
		}
		//select style
		var type = document.getElementById('type');
		var styleRes = type.options[type.selectedIndex].value;

		var describe = $('#describe').val();
		describe = describe.replace(/\n/g,"`");
		describe = describe.replace(/\"/g,"MicrosoftAA");
		describe = describe.replace(/\'/g,"MicrosoftBB");

		var proof = $('#material').val();
		proof = proof.replace(/\n/g,"`");
		proof = proof.replace(/\"/g,"MicrosoftAA");
		proof = proof.replace(/\'/g,"MicrosoftBB");

		var recommend = document.getElementsByName('recommend');
		var recommendRes;
		for (var i = 0;i < recommend.length;i++){
			if(recommend[i].checked)
				recommendRes = recommend[i].value;
		}

		var checkCode = $('#checkJYM').val();
		if (checkCode == null)
			checkCode = '';
		var introduce = $('#introduce').val();
		introduce = introduce.replace(/\n/g,"`");
		introduce = introduce.replace(/\"/g,"MicrosoftAA");
		introduce = introduce.replace(/\'/g,"MicrosoftBB");
		var json_info = {
			'name':name,'sex':sexResult,'studentNumber':studentNumber,
			'political':politicalRes,'nation':nation,'telephone':telephone,
			'college':collegeRes,'email':email,'seniorHighSchool':highSchool,
			'publicOr':publicRes,'style':styleRes,'describe':describe,'proof':proof,
			'introduce':introduce,'recommend':recommendRes,'checkCode':checkCode
		}
		var postStr = JSON.stringify(json_info);
		var newPostStr = "postStr=" + postStr;
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
		ajax.open("post", "strPost.php", true);

		//定义传输的文件HTTP头信息
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");

		ajax.onreadystatechange = updatePage;
		//发送POST数据
		ajax.send(newPostStr);

		//获取执行状态
		function updatePage() 
		{ 
	   		//如果执行状态成功，那么就把返回信息写到指定的层里
	   		if (ajax.readyState == 4 && ajax.status == 200)
			{
				var ret = ajax.responseText;
				alert(ret);
	   		} 
		}
	}
}
//----------------------------------------------------------------------------------------------