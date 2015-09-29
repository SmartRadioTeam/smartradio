<?php
function Chart_init($array) {
	foreach ($array as $key => $val){
		echo "var ".$key."Data = [";
		foreach ($val as $key2 => $val2){
			$value=$val2["value"];
			$color=$val2['color'];
			$highlight=$val2["highlight"];
			$label=$key2;
			echo'{value:'.$value.',color:"'.$color.'",highlight:"'.$highlight.'",label:"'.$label.'"},';
		}
	echo "];";
	$functions=$functions.'var '.$key.' = document.getElementById("'.$key.'-area").getContext("2d");
				window.Doughnut = new Chart('.$key.').Doughnut('.$key.'Data);';
	}
    echo 'window.onload = function(){'.$functions.'}';
}
