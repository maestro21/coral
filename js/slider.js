var indexslider={};
indexslider.activeGroup=0;
indexslider.fadeInIterval=1000;
indexslider.fadeOutIterval=1000;
indexslider.timerIterval=6000;
indexslider.countSlide=0;
indexslider.slideNumber=0;
indexslider.timer=false;
indexslider.timerStart=false;
indexslider.init=function(){
	indexslider.initMenu();
	indexslider.initSlide();
	indexslider.events();
	//if($(".slider-index .slide[group='"+indexslider.activeGroup+"']").length>1){

		
		indexslider.timerStart=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
	//}
	
	
	indexslider.start_stop_Timer();
};
indexslider.initMenu=function(){
	var countGroup=$(".slider-index .selector td").length;
	var widthMenuItem=100/countGroup ;
	$(".slider-index .selector td").width(widthMenuItem + "%");
};
indexslider.events=function(){
	$(".slider-index .selector a.slidename").click(function(){
		//alert("1");
		indexslider.activeGroup=$(this).parent().parent().index();
		$(".slider-index .selector td.active").removeClass("active");
		$(this).parent().parent().addClass("active");
		
		indexslider.initSlide();
		
		return false;
	});
};
indexslider.initSlide=function(){
	$(".slider-index .slide").css("display", "none");
	$(".slider-index .slide[group='"+indexslider.activeGroup+"']").first().fadeIn(indexslider.fadeInIterval);
	$(".slider-index .selector .slide-selector a").removeClass("active");
	$(".slider-index .selector td:eq("+indexslider.activeGroup+")").addClass("active").find(".slide-selector a").first().addClass("active");
	
	indexslider.countSlide=$(".slider-index .slide[group='"+indexslider.activeGroup+"']").length;
	$(".slider-index .arrow-left").css("display", "none");
	if(indexslider.countSlide<=0){
		$(".slider-index .arrow-right").css("display", "none");
	}
	indexslider.initControl();
};

indexslider.showSlide=function(group, slide){
	indexslider.activeGroup=group;
	indexslider.slideNumber=slide;
	$(".slider-index .selector .slide-selector a").removeClass("active");
	$(".slider-index .selector td:eq("+group+") .slide-selector a:eq("+slide+")").addClass("active");
	$(".slider-index .slide[group='"+group+"']").fadeOut(indexslider.fadeOutIterval);
	$(".slider-index .slide[group='"+group+"']:eq("+slide+")").fadeIn(indexslider.fadeInIterval);
	indexslider.initShowArrow();
};

indexslider.initControl=function(){
	$(".slider-index .selector .slide-selector a").off("click");
	indexslider.slideNumber=0;
	indexslider.initShowArrow();
	indexslider.initControlArrow();
	$(".slider-index .selector .slide-selector a").on("click", function(){
		indexslider.slideNumber=$(this).index();
		indexslider.showSlide(indexslider.activeGroup, indexslider.slideNumber);
		indexslider.initControlArrow();
		return false;
	});
};
indexslider.initShowArrow=function(){
	if($(".slider-index .slide[group='"+indexslider.activeGroup+"']:eq("+(indexslider.slideNumber-1)+")").length==0){
		$(".slider-index .arrow-left").css("display", "none");
	}else if(!$(".slider-index .arrow-left").is(":visible")){
		$(".slider-index .arrow-left").css("display", "block");
	}
	if($(".slider-index .slide[group='"+indexslider.activeGroup+"']:eq("+(indexslider.slideNumber+1)+")").length==0){
		$(".slider-index .arrow-right").css("display", "none");
	}else if(!$(".slider-index .arrow-left").is(":visible")){
		$(".slider-index .arrow-right").css("display", "block");
	}
};
indexslider.initControlArrow=function(){
	$(".slider-index .arrow-left").unbind("click");
	$(".slider-index .arrow-right").unbind("click");
	$(".slider-index .arrow-left").click(function(){
		indexslider.showSlide(indexslider.activeGroup, indexslider.slideNumber-1);
	});
	$(".slider-index .arrow-right").click(function(){
		indexslider.showSlide(indexslider.activeGroup, indexslider.slideNumber+1);
	});
};
indexslider.sliderTimer=function(){
	s = $(".slider-index .slide[group='"+indexslider.activeGroup+"']").length - 1;
	g = $(".slider-index .selector a.slidename").length;
	//alert(s);
	if($(".slider-index .slide[group='"+indexslider.activeGroup+"']:eq("+(indexslider.slideNumber+1)+")").length==0){
	//a	indexslider.slideNumber=0;
	
	
	if (s == indexslider.slideNumber) { 
		indexslider.activeGroup++; 
		indexslider.slideNumber=0;
		if (indexslider.activeGroup == g) {indexslider.activeGroup = 0;}
		$(".slider-index .selector a.slidename").eq(indexslider.activeGroup).click();
		//indexslider.showSlide(indexslider.activeGroup, indexslider.slideNumber);
		//if($(".slider-index .slide[group='"+indexslider.activeGroup+"']").length>1){
			indexslider.timer=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
		//} 
		
	}
	
	}else{
		indexslider.slideNumber++;
		
		indexslider.showSlide(indexslider.activeGroup, indexslider.slideNumber);
		if($(".slider-index .slide[group='"+indexslider.activeGroup+"']").length>1){
			indexslider.timer=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
		} else {
			//indexslider.timer=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
		//if (indexslider.activeGroup == s) {indexslider.activeGroup = 0; indexslider.slideNumber=0;}
		//indexslider.timer=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
		}
	}
	
			

};
indexslider.start_stop_Timer=function(){
	$(".slider-index").mouseover(function(){
		clearTimeout(indexslider.timer);
		clearTimeout(indexslider.timerStart);
	});
	$(".slider-index").mouseleave(function(){
		//if($(".slider-index .slide[group='"+indexslider.activeGroup+"']").length>1){

			indexslider.timerStart=setTimeout(indexslider.sliderTimer, indexslider.timerIterval);
			
		
		//}
	});
};

$(document).ready(function(){
	indexslider.init();
});