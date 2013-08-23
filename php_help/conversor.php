<?

var_dump($argv);

$value1 = @$argv[1];
$base_value1 = @$argv[2];
$base_to_convert1 = @$argv[3];

$table_value = array();
$table_value['a'] = 10;
$table_value['b'] = 11;
$table_value['c'] = 12;
$table_value['d'] = 13;
$table_value['e'] = 14;
$table_value['f'] = 15;


if ($value1 != "" && $base_value1 != "" && $base_to_convert1 != "" ) {
	if ($base_to_convert1 == '10') {
		echo "vou converter\n";
		convert_to_10($value1,$base_value1);
	}
}

function convert_to_10 ($value,$base) {
	$value = strtolower($value);
	//write_count($value,$base);
	do_count(value,$base);
}

function do_count($value,$base) {

	$count_array = array('base' => $base, 'values' => array());
	for ($i= 0; $i < strlen($value) ; $i++) { 
		$real_value = convert_letter_to_number($value[$i]);
		$pot = strlen($value) - 1 - $i;
		$count_array['values'][] = array('value' => $real_value, 'pot' => $pot);
	}
	print_r($count_array);
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

?>