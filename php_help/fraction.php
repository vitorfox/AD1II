<?

function write_count_frac($value,$base){
	$show_count = "";
	for ($i= 1; $i <= strlen($value) ; $i++) { 
		$real_value = convert_letter_to_number($value[$i-1]);
		$pot = "-".$i;
		$show_count = $show_count . " + ". $real_value . "*".$base."^".$pot;
	}
	echo $show_count."\n";	
}

function get_array_count_pot_frac($value,$base) {

	$count_array = array('base' => $base, 'values' => array());
	for ($i= 1; $i <= strlen($value) ; $i++) { 
		$real_value = convert_letter_to_number($value[$i-1]);
		$count_array['values'][] = array('value' => $real_value, 'pot' => $i);
	}
	return $count_array;
}

function do_count_pot_frac($value,$base) {
	$arr_pot = get_array_count_pot_frac($value,$base);
	$arr_values = $arr_pot['values'];

	$count_text = "";
	$tot_count = 0;
	foreach ($arr_values as $array_value) {

		if($array_value['value'] == 0)
			continue;

		$part_count =  $array_value['value'] / eleva($arr_pot['base'],$array_value['pot']);
		$count_text = $count_text . " + ". $part_count;
		$tot_count += $part_count;
	}
	eline("$count_text");
	return $tot_count;
}

function convert_to_any_frac ($value_base_10, $base){

	eline("Convertendo para base $base");
	(string) $result_text = "";
	$result = $value_base_10;
	$mod = -1;
	while($mod != 0) {
		$result = $result - $div;
		$rb = $result;
		$result = $result * $base;	
		$div = (int) $result / 1.0;
		$mod = fmod($result,1.0);
		$result_text = (string) $result_text . (string) convert_number_to_letter($div) ;
		eline("$rb * $base = $result -> $div");
	}

	/*if ((int)$result_text)
		eline((int)$result_text.echobase($base));
	else*/
	return $result_text;
}

?>