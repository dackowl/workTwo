$(".set").on("click",function(){
	//$("#bounced").fadeIn(1000)
	$("#bounced").animate({top:"150px"});
})
$("#btn2").on("click",function(){
	$("#bounced").animate({top:"100%"}).animate({top:"-100%"},10);
})

