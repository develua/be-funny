$(document).ready(function(){

$("#disableSelection *").disableSelection();

$(".mainContent:even").css("background","#F6F6F6");
$(".mainContent:odd").css("background","#FFFFFF");

$(".hasTip").tooltipsy();

$("#hideBox").click(
	function()
	{
		var block = $(this);
		
		if(block.attr("id") == "hideBox")
		{
			block.parent().css("height","40px");
			block.next().css({"display":"block","height":"40px","overflow":"hidden"});
			block.attr("id", "hideBoxOff");
			$(".tooltipsy").text("Показать");
		}
		else
		{
			block.parent().css("height","auto");
			block.next().css({"height":"auto"}).disableSelection();
			block.attr("id", "hideBox");
			$(".tooltipsy").text("Скрыть");
		}
	}
);

$(".likeBox").click(
	function()
	{
		var block = $(this);
		var blockId = block.attr("id");
		var dataString = "id=" + blockId;
		
		if(block.attr("class") == "likeBox hasTip")
		{
			block.fadeOut(300);
			block.fadeIn(300).attr("class", "likeBoxOff hasTip");
			$(".tooltipsy").text(+ 1);
			
			$.ajax({
				type: "POST",
				url: "ajax_like.php",
				data: dataString,
				cache: false
			});
		}
	}
);

$.ajax({
  contentType: "text/plain; charset=UTF-8",
  url: "you_know.php",
  success: function(data)
  {
    $("#youKnow").html(data);
  }
});

$("#footer span").click(
	function()
	{
		window.open('http://vk.com/prodan_igor', '_blank');
	}
);

});

jQuery.fn.extend({ 
    disableSelection : function() { 
            this.each(function() { 
                    this.onselectstart = function() { return false; }; 
                    this.unselectable = "on"; 
                    jQuery(this).css('-moz-user-select', 'none'); 
            }); 
    },
    enableSelection : function() { 
            this.each(function() { 
                    this.onselectstart = function() {}; 
                    this.unselectable = "off"; 
                    jQuery(this).css('-moz-user-select', 'auto'); 
            }); 
    } 
});

var imagesList = ['/img/clear_hover.png','/img/clear_off.png','/img/clear_off_hover.png','/img/like_off.png','/img/map_hover.png'];

var aImages = [];
for (var i = 0, len = imagesList.length; i < len; i++) {
	aImages[i] = new Image();
	aImages[i].src = imagesList[i];
}