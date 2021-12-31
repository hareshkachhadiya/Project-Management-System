<?php
	$a=array(1,3);
	$b=array(1,5);
	$x=6;
	$y=7;
	$k=3;
	function solution($x,$y,$k,$a,$b)
	{
			for($k=0;$k<3;$k++)
			{
				$array= $a[$k];
				$checkkey=array_key_exists($array);
				print_r($checkkey);
				
			}
	}
	
	solution($x,$y,$k,$a,$b);
?>