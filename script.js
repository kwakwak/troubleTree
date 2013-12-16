$( document ).ready(function() {

	$("p").filter(function() {
		return  $(this).attr("child") > 1;
	}).hide();

	$( "p" ).click(function() {
		var child= parseInt($(this).attr("child"));
		$(this).find('img').toggle().findChild(child).fadeChild(child);
	});

	jQuery.fn.fadeChild = function(child) {
		if ($(this).is(":visible")) {
			childObj = $(this).findChild(child);

			childObj.each(function() {
				$(this).loopChild();
			});

		} else {
			$(this).fadeIn();	
		}
	};

	jQuery.fn.changeToExpand = function() {
		$(this).find("img.collapse").hide();
		$(this).find("img.expand").show();
	};

	jQuery.fn.findChild = function(child) { // find direct children
		return $("p").filter(function() {
			return  $(this).attr("parent") == child;
		});
	};

	jQuery.fn.loopChild = function(childObj) { // finds all children

		childObj = $(this);

		if (childObj.is(":visible"))
		{	
			childObj.fadeOut().changeToExpand();
			var child= parseInt(childObj.attr("child"));
			childObj = jQuery.fn.findChild(child);

			childObj.each(function() {
				$(this).loopChild();
			});
		}
	};


});