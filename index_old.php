<?
	session_start();
	if (!isset($_SESSION['status']))
	{
		$_SESSION['status'] = "not visited";
	}
	

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TestShop</title>
		<meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
  		<link rel = "stylesheet" type = "text/css" href = "./slick/slick.css">
  		<link rel = "stylesheet" type = "text/css" href = "./slick/slick-theme.css">
  		<link rel = "stylesheet" href = "/style.css?v=1">
	</head>

	<body>
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

		<div id = "mod-div" class = "modal">
			<div class = "modal-content">
				<div class = "modal-header">
					<span class = "close">&times;</span>
					<h2>Оформление заказа "<i id = "price-name"></i>" стоимостью <i id = "price"></i> деняк</h2>
				</div>
				<form class = "sale-form" id = "form-ok" action = "#" name = "form-sale">
					<div class = modal-body>
						<label for = "name-input">Введите ваше имя </label><input type = "text" id = "name-input" name = "name" placeholder = "Андрей" required> <br>
						<label for = "email-input">Введите адрес электронной почты </label><input type = "email" id = "email-input" name = "email" placeholder = "simple@gmail.com" required> <br>
						<label for = "tel-input">Введите ваш номер телефона </label><input type = "tel" id = "tel-input" name = "tel" placeholder = "+7(999)999-99-99" required> <br>
						<input type = "hidden" class = "price-id" name = "id">
					</div>
					<div class = "modal-footer">
						<input type = "submit" class = "sale-ok" value = "Купить">
					</div>
				</form>
			</div>
		</div>

		<div id = "mod-good" class = "modal">
			<div class = "modal-content">
				<div class = "modal-header">
					<span class = "close">&times;</span>
					<h3>Спасибо за покупку</h3>
				</div>
				<div class = "modal-body">
					<p>Наш менеджер свяжется с вами в ближайшее время</p>
				</div>
			</div>
		</div>

		<div id = "mod-bad" class = "modal">
			<div class = "modal-content">
				<div class = "modal-header">
					<span class = "close">&times;</span>
					<h3>Технические неполадки</h3>
				</div>
				<div class = "modal-body">
					<p>Похоже, у нас что-то сломалось или происходят технические работы</p>
					<p>Приносим свои извинения за возможные неудобства</p>
				</div>
			</div>
		</div>

		<?
			$options = array(
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			$db = new PDO('mysql:host=localhost; dbname=ashakirova_tshop; charset=utf8', "ashakirova_tshop", "QB*H0VDy3234234", $options);
		?>

		<div class = "sales">
		<? foreach($db->query('SELECT * FROM sales ORDER BY price DESC') as $row) 
		{ ?>
			<div class = "product">
				<p><?= $row['name'] ?></p>
				<img class = "lazy" data-original = "<?= $row['picture'] ?>" width = "150px">
				<p><?= $row['about'] ?></p>
				<div class = "sale-buttons" data-name = "<?= $row['name'] ?>" data-price = "<?= $row['price'] ?>" data-id = "<?= $row['ID'] ?>"><p class = "text-price">Купить за <?= $row['price'] ?> деняк</p></div>
			</div>
		<? } ?>
		</div>

		<h2 class = "text-center">Ваши отзывы</h2>
		<div class = "reviews" id = "reviews-block">
		<? foreach($db->query('SELECT * FROM reviews') as $row)
		{ ?>
			<div class = "feedback">
				<p><?= htmlentities($row['feedback']) ?></p>
				<p class = "feed-name"><?= htmlentities($row['name']) ?></p>
			</div>
		<? } ?>
		</div>

		<?
			$db = null;
			if ($_SESSION['status'] !== "visited")
			{ ?> 
				<div id = "reviews-hidder">
					<h2 class = "text-center">Оставьте свой отзыв</h2>
					<form name = "form-review" class = "review-form" id = "form-feed">
						<div class = "review-div">
							<label for = "person">Представьтесь, пожалуйста </label><input type = "text" id = "person" name = "name-person" placeholder = "Антон Владимирович Козак"> <br>
							<textarea  id = "text-review" rows = "10" name = "feed" placeholder = " Поле для написания отзыва"></textarea> <br>
							<input type = "submit" class = "review-ok" id = "review-ok" value = "Отправить">
						</div>
					</form>
				</div>
			<? } ?>

		<div id = "mod-review" class = "modal">
			<div class = "modal-content">
				<div class = "modal-header">
					<span class = "close">&times;</span>
					<h3>Спасибо за ваш отзыв</h3>
				</div>
				<div class = "modal-body">
					<p>Ваше мнение очень важно для нас</p>
				</div>
			</div>
		</div>

		<div class = footer>
			<p class = "author">Сайт создан методом дендрофикального конструирования</p>
			<p class = "copyright">©Aleksey Bedrin, <a class = "github" href = "https://github.com/mazabayt">github репозиторий</a></p>
		</div>

		<script src = "https://code.jquery.com/jquery-3.5.1.js" integrity = "sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin = "anonymous"></script>
		<script src = "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script src = "/lazyload/jquery.lazyload.js" type = "text/javascript" charset = "utf-8"></script>
		<script src = "/script.js" type = "text/javascript"></script>
	</body>
</html>