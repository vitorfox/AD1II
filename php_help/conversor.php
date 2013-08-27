<?

$value_no_ready = @$argv[1];
$base_value1 = @$argv[2];
$base_to_convert1 = @$argv[3];

$table_value = array();
$table_value['a'] = 10;
$table_value['b'] = 11;
$table_value['c'] = 12;
$table_value['d'] = 13;
$table_value['e'] = 14;
$table_value['f'] = 15;


$value1 = reset((explode('.',$value_no_ready));
$value_fraction = end((explode('.',$value_no_ready));


if ($value1 != "" && $base_value1 != "" && $base_to_convert1 != "" ) {

	if($base_value1 == $base_to_convert1)
		exit(eline("Tah de brinca?"));

	$value_base_10 = $value1;
	if($base_value1 != '10') {
		$value_base_10 = convert_to_10($value1,$base_value1);
		eline('');
	}

	if ($base_to_convert1 != '10') {
		convert_to_any($value_base_10,$base_to_convert1);
	}
}

function convert_to_any ($value_base_10, $base){

	eline("Convertendo para base $base");
	$result = -1;
	(string) $result_text = "";
	$result = $value_base_10;
	while($result != 0) {
		$rb = $result;
		$result = (int) ($result / $base);	
		$mod = $rb % $base;
		$result_text = (string) convert_number_to_letter($mod) . (string) $result_text;
		eline("$rb / $base = $result -> $mod");
	}

	/*if ((int)$result_text)
		eline((int)$result_text.echobase($base));
	else*/
		eline($result_text.echobase($base));
}

function echobase($base) {
	return '_'.$base;
}

function convert_to_10 ($value,$base) {

	eline("Convertendo para base 10");

	$value = strtolower($value);
	write_count($value,$base);
	return do_count_pot($value,$base);
}

function do_count_pot($value,$base) {
	$arr_pot = get_array_count_pot($value,$base);
	$arr_values = $arr_pot['values'];

	$x = sizeof($arr_values) - 1;
	$count_text = "";
	$tot_count = 0;
	foreach ($arr_values as $array_value) {

		if($array_value['value'] == 0)
			continue;

		$part_count = $array_value['value'] * eleva($arr_pot['base'],$array_value['pot']);

		if ($count_text == "") {
			$count_text = $part_count;
		} else {
			$count_text = $count_text . " + ". $part_count;
		}
		$x--;
		$tot_count += $part_count;
	}
	eline("$count_text");
	eline("$tot_count".(echobase('10')));
	return $tot_count;
}

function eleva($x, $y){
	$tot = 1;
	for ($i=0; $i<$y; $i++) {
		$tot = $tot * $x; 
	}
	return $tot;
}

function get_array_count_pot($value,$base) {

	$count_array = array('base' => $base, 'values' => array());
	for ($i= 0; $i < strlen($value) ; $i++) { 
		$real_value = convert_letter_to_number($value[$i]);
		$pot = strlen($value) - 1 - $i;
		$count_array['values'][] = array('value' => $real_value, 'pot' => $pot);
	}
	return $count_array;
}

function write_count($value,$base) {
	$show_count = "";
	for ($i= 0; $i < strlen($value) ; $i++) { 
		$real_value = convert_letter_to_number($value[$i]);
		$pot = strlen($value) - 1 - $i;
		if ($show_count == "") {
			$show_count = $real_value . "*".$base."^".$pot;
		} else {
			$show_count = $show_count . " + ". $real_value . "*".$base."^".$pot;
		}
	}
	echo $show_count."\n";	
}

function convert_letter_to_number($value) {
	GLOBAL $table_value;

	if (isset($table_value[$value])) {
		return $table_value[$value];
	}
	return $value;
}

function convert_number_to_letter($value) {
	GLOBAL $table_value;

	foreach($table_value as $key => $val) {
		if($val == $value)
			return strtoupper($key);
	}
	return $value;
}

function eline($text) {
	echo $text."\n";
}

?>
