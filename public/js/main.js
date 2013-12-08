$(document).ready(function(){
	$("#hs").hide();
	document.onkeydown = function(e){
		if(e.which==13){
			generate();
		}
	};
	$("#button").click(function(){
		generate();
	});
	$("#short").click(function(){
		$("#short").select();
	});
	
	function generate(){
		if(!is_url()){
			alert("请输入正确的网址");
		}else{
			$.post("index.php/Index/make",{url:$("#input").val()},function(r){
				$("#hs").show();
				$("#short").val(r);
			});
		}
	}
	
	function is_url(){
		str = $("#input").val(); 
		str = str.match(/[A-Za-z0-9\.-]{1,}\.[A-Za-z]{2,}/); 
		if (str == null){ 
			return false; 
		}else{ 
			return true; 
		} 
	}
});