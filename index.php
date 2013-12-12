<html>
	<head>
		<script src="http://code.jquery.com/jquery-latest.min.js"
		        type="text/javascript"></script>
		<script type="text/javascript">
		$( document ).ready(function() {
			$("p").filter(function() {
			    return  $(this).attr("level") > 0;
			}).hide();

			$( "p" ).click(function() {
				child= $(this).attr("child");
				level= $(this).attr("level") + 1;
				$("p").filter(function() {
				    return  $(this).attr("level") == level || $(this).attr("parent") == child;
				}).fadeToggle();
			});
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
	$handle = @fopen("ctc.txt", "r");
	$child = null;
	$level= 0;

	if ($handle) {
	    while (($buffer = fgets($handle, 4096)) !== false) {
			preg_match('#\](.*)#', $buffer, $text);
			preg_match("/"."(\\[)(\\d+)(,)(\\d+)(\\])"."/is", $buffer, $id);

			$parent = $id[4];

			if ($parent==$child)
				$level++;

			if (isset($lvlArr[$parent]))
				$level=$lvlArr[$parent] +1;

			$child = $id[2];
			$lvlArr[$child]=$level;

			echo ("<p style='padding-right:".$level . "em' level='".$level ."'' child='". $child ."' parent='" .$parent ."'>");

	    	echo ($text[1]."</p>");

	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	}
	?>
	</body>
</html>