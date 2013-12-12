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

		for ($x=0; $x<=$level; $x++) 
			echo ("-");
 	
		
		$child = $id[2];
		$lvlArr[$child]=$level;

		echo (" ". $child ."," .$parent .":".$text[1]."</br>");
		
		

    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

var_dump($lvlArr);
?>

