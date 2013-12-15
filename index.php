<html>
	<head>
		<meta charset="windows-1255">
		<script src="http://code.jquery.com/jquery-latest.min.js"
		        type="text/javascript"></script>
		<script type="text/javascript">
		$( document ).ready(function() {

			$("p").filter(function() {
			    return  $(this).attr("level") > 0;
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

			jQuery.fn.findChild = function(child) {
				return $("p").filter(function() {
				     return  $(this).attr("parent") == child;
				});
			};

			jQuery.fn.loopChild = function(childObj) {
			
					childObj = $(this);
	
				if (childObj.is(":visible"))
					{	
					childObj.fadeOut().changeToExpand();
					var child= parseInt(childObj.attr("child"));
					$(this).findChild(child).loopChild(this);
					}
			};

			
		});
		</script>

		<style>
		body
		{
		direction:rtl;
		}
		</style>
	</head>
	<body>

	<?php
	
		$child = null;
		$level= 0;

		if (($handle = fopen("ctc.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$parent = $data[1];

			if ($parent==$child)
				$level++;

			if (isset($lvlArr[$parent]))
				$level=$lvlArr[$parent] +1;

			$child = $data[0];
			$lvlArr[$child]=$level;

			echo ("<p style='padding-right:".$level . "em' level='".$level ."'' child='". $child ."' parent='" .$parent ."'>");
			echo (" <img src='expand.png' class='expand'> ");
			echo (" <img src='collapse.png' class='collapse' style='display:none'> ");
	    	echo ($data[2]."</p>");
		     
		    }
		    fclose($handle);
		}
	?>
	</body>
</html>