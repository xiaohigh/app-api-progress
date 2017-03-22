//控制返回数据的格式
var format = 'json';
var timestamp = Date.parse(new Date()) / 1000;

$('.f').click(function(){
	//调整样式
	$('.f').removeClass('btn-danger');
	$(this).addClass('btn-danger');
	format = $(this).html();
});


//点击一个按钮
$('button').eq(0).click(function(){
	var url = '/server.php?c=article&a=list&format='+format;
	var url = addTimestamp(url);
	var url = addSign(url);
	showUrl(url);
	//显示url地址
	$.get(url,{}, function(data){
		//显示返回的结果
		showResult(data);
	});
});

//第二个按钮
$('button').eq(1).click(function(){
	var url = '/server.php?c=article&a=list&page=2&num=20&cate=5&format='+format;
	var url = addTimestamp(url);
	var url = addSign(url);

	showUrl(url);
	//显示url地址
	$.get(url,{}, function(data){
		//显示返回的结果
		showResult(data);
	});
});

//第三个按钮
$('button').eq(2).click(function(){
	var url = '/server.php?c=article&a=detail&id=20&format='+format;
	var url = addTimestamp(url);
	var url = addSign(url);

	showUrl(url);
	//显示url地址
	$.get(url,{}, function(data){
		//显示返回的结果
		showResult(data);
	});
});

//第四个按钮  登陆
$('button').eq(3).click(function(){
	var url = '/server.php?c=login&a=login&id=20&username=admin&password=admin';
	var url = addTimestamp(url);
	var url = addSign(url);

	showUrl(url);
	//显示url地址
	$.get(url,{}, function(data){
		//显示返回的结果
		showResult(data);
		var data = $.parseJSON(data);
		//将登陆token写入到本地
		localStorage.setItem('login_token', data.data.token);
		localStorage.setItem('uid', data.data.id);
	});
});

//第五个按钮  获取用户信息
$('button').eq(4).click(function(){
	//如果没有登陆 请先登陆
	if(!isLogin()) {
		alert('您还没有登陆,请登陆!!');
		return;
	}
	//拼接url
	var url = '/server.php?c=user&a=info&uid='+getUserId()+'&format='+format;
	var url = addTimestamp(url);
	var url = addLoginSign(url);

	showUrl(url);
	//显示url地址
	$.get(url,{}, function(data){
		//显示返回的结果
		showResult(data);
	});
});


//显示当前的url
function showUrl(data) {
	$('#url').html('URL: GET- '+data);
}

//显示当前返回的结果
function showResult(data) {
	$('#result').text(data);
}

//添加时间戳
function addTimestamp(url){
	return url+'&t='+getTimestamp();
}

//获取时间戳
function getTimestamp(){
	return Date.parse(new Date()) / 1000;
	// return timestamp;
}

//添加登陆签名


//添加签名
function addSign(url){
	return url+'&sign='+getSign(url);
}

//添加登陆签名
function addLoginSign(url){
	return url+'&sign='+getLoginSign(url);
}

//获取签名
function getSign(url) {
	//拆分字符串
	var tmp = url.split('?');
	//获取参数部分
	var url = tmp[1];
	//解析参数部分成对象
	var res = parseQueryString(url);
	//排序对象
	var obj = sortObject(res);
	//创建url
	var res = makeUrl(obj);
	//返回签名
	return encrypt(res+localStorage.getItem('common_token'));		
}

//获取登陆签名
function getLoginSign(url) {
	//拆分字符串
	var tmp = url.split('?');
	//获取参数部分
	var url = tmp[1];
	//解析参数部分成对象
	var res = parseQueryString(url);
	//排序对象
	var obj = sortObject(res);
	//创建url
	var res = makeUrl(obj);
	//返回签名
	return encrypt(res+localStorage.getItem('login_token'));		
}

//解析url获得get参数
function parseQueryString(url) {
    var items = url.split("&");  
    var result = {};  
    var arr;  
    for (var i = 0; i < items.length; i++) {  
        arr = items[i].split("=");  
        result[arr[0]] = arr[1];  
    }  
    return result;  
}  

//排序对象
function sortObject(myObj){
	var keys = [],
	  k, i, len;

	for (k in myObj) {
	  if (myObj.hasOwnProperty(k)) {
	    keys.push(k);
	  }
	}

	keys.sort();

	len = keys.length;
	var res = {};
	for (i = 0; i < len; i++) {
	  k = keys[i];
	  res[k] = myObj[k];
	}
	return res;
}

//拼接url
function makeUrl(obj) {
	var url = ''
	for(var i in obj) {
		url += i+'='+obj[i]+'&';
	}
	return url.substr(0, url.length-1);
}

//加密字符串
function encrypt(str) {
	return md5(str);
}

//页面初始化
function init() {
	//检测本地是否有默认的token
	var token = localStorage.getItem('common_token');
	if(!token) {
		localStorage.setItem('common_token','lampbrother');
	}
}
init();

function isLogin() {
	return localStorage.getItem('uid');
}

function getUserId()
{
	return localStorage.getItem('uid');
}