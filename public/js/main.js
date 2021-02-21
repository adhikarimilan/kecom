$(document).ready(function(){
	$(".img_wrapper img").each(function(){
       $(this).css("display","none");
       var img = $(this).attr("src");
       //console.log(img);
       $(this).parent().css({"background":"url("+img.replace('\\','/')+")","background-size":"cover","background-position":"center"});
  });

	//product gallery

	$(".prod-gallery-wrapper .gallery-thumb").click(function(e){
		e.preventDefault();
		var imgUrl = $("a img", this).attr('src');
		$(".gallery-main-img img").attr("src", imgUrl);
		$(".prod-gallery-wrapper .gallery-thumb").removeClass("active");
		$(this).addClass("active");
	})

	//product price update

	$("#prod-weight,#prod-flavour").on('change', function(){
		var mainPrice = $(".prod-price").attr("data-mainPrice");
		var prodWeight = $("#prod-weight").val();
		//var prodFlavour = $("#prod-flavour").val();
		var factor =1;// $("#prod-flavour option[value='"+prodFlavour+"']").attr("data-factor");
		var newPrice = Math.floor(mainPrice*prodWeight*factor); 
		$(".prod-price #money").html(newPrice);
	})
});