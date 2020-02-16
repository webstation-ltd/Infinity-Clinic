<?
function transliteration($string) {
		$table = array(
		'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d',
		'е'=>'e', 'ж'=>'j', 'з'=>'z', 'и'=>'i', 'й'=>'y',
		'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o',
		'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u',
		'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch', 'ш'=>'sh',
		'щ'=>'sht', 'ъ'=>'a', 'ь'=>'', 'ю'=>'yu', 'я'=>'ya',
		);
	$string = mb_strtolower($string, 'UTF-8');
	$string = strtr($string, $table);
	$new_string = preg_replace("/[^a-zA-Z0-9\-\/\s]/", "", $string);
	return str_replace(' ', '-', $new_string);	
}





?>