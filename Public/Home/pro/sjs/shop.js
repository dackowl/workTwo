var curr=0; //第几张图片 
$(function(){
	 $("ol li").on("mousemove",function(){
	 curr=$(this).index();
	 showimg(curr);
	});
window.setInterval(function(){
	 showimg(curr);
	 curr++;
	 if(curr>=5) curr=0;
	 },1500);
})
function showimg(idx){
	 $("#ul li").hide();
	 $("#ul li:eq("+ idx+ ")").show(); //.fadeIn(1000)
	 $("ol li").removeClass('ys');
	 $("ol li:eq("+ idx+ ")").addClass('ys');
}

$(function(){
	//热卖弹框
	$(".tk").on("mousemove",function(){
		$(this).children().eq(0).css({"margin-top":"5px"});
	})
	$(".tk").on("mouseout",function(){
		$(this).children().eq(0).css({"margin-top":"63px"});
	})
	//正在进行
})





	


