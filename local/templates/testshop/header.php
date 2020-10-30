<?
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	{
		die();
	}

	//ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	session_start();
	if (!isset($_SESSION['status']))
	{
		$_SESSION['status'] = "not visited";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= $APPLICATION->ShowTitle(); ?></title>
		<?
			$APPLICATION->ShowHead();

			use Bitrix\Main\Page\Asset;

			Asset::getInstance()->addString('<meta name = "viewport" content = "width = device-width, initial-scale = 1">');
			Asset::getInstance()->addString('<meta charset = "UTF-8">');

			Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/slick.css');
		 	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/slick-theme.css');
		 	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');

			Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.5.1.js');
			Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.lazyload.js');
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/script.js');
		?>
	</head>

	<body>
		<div id = "panel"><? $APPLICATION->ShowPanel(); ?></div>

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