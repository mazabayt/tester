<?
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	{
		die();
	}

	//ini_set('error_reporting', E_ALL);
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	
	session_start();
	if (!isset($_SESSION['status']))
	{
		$_SESSION['status'] = "not visited";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><? $APPLICATION->ShowTitle() ?></title>
		<meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
  		<link rel = "stylesheet" type = "text/css" href = "/slick/slick.css">
  		<link rel = "stylesheet" type = "text/css" href = "/slick/slick-theme.css">
		<link rel = "stylesheet" href = "/style.css?v=1">

		<? $APPLICATION->ShowHead(); ?>
	</head>

	<body>
		<? $APPLICATION->ShowPanel(); ?>

		<ul id = "cool-menu">
			<li><a href = "/">Главная</a></li>
			<li><a href = "/">Магазин</a></li>
			<li><a href = "/">Контакты</a></li>
		</ul>

		<div id = "page-wrapper">
			<div class = "header-menu">
				<a id = "cool-menu-toggle" href = "#">Меню</a>
			</div>
		</div>

		<section class = "one-time">
    		<div class = "one-time-item">
				<img src = "/images/4.jpg">
			</div>
    		<div class = "one-time-item">
				<img src = "/images/5.jpg">
			</div>
    		<div class = "one-time-item">
				<img src = "/images/6.jpeg">
			</div>
    		<div class = "one-time-item">
				<img src = "/images/5.jpg">
			</div>
    		<div class = "one-time-item">
				<img src = "/images/4.jpg">
			</div>
  		</section>