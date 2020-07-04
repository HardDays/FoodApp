<?php 
	require_once "language_class.php";
	error_reporting(E_ALL);
	ini_set("display_errors",1);
	
	function getLanguage(){
		preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]), $matches); // Получаем массив $matches с соответствиями
		$langs = array_combine($matches[1], $matches[2]); // Создаём массив с ключами $matches[1] и значениями $matches[2]
		foreach ($langs as $n => $v)
			$langs[$n] = $v ? $v : 1; // Если нет q, то ставим значение 1
		arsort($langs); // Сортируем по убыванию q
		$default_lang = key($langs); // Берём 1-й ключ первого (текущего) элемента (он же максимальный по q)
		if(strpos($default_lang, "ru") !==false)return "ru";
		elseif(strpos($default_lang, "cz") !==false)return "cz";
	}
	
	$language = getLanguage();
	//$language = "cz";
	$lang = new Language($language);

	include ("index.html");
?>