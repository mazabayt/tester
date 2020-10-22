<?
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>TestShop</title>
		<meta charset = "UTF-8">
  		<link rel = "stylesheet" type = "text/css" href = "./slick/slick.css">
  		<link rel = "stylesheet" type = "text/css" href = "./slick/slick-theme.css">
  		<link rel = "stylesheet" href = "/style.css?v=1">
	</head>

	<body>
		<section class = "fade slider">
    		<div>
				<p class = "banner">Баннер №1</p>
				<img src = "https://i.pinimg.com/236x/b4/9c/12/b49c129f6f2600100836dd4f953aa78c.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №2</p>
				<img src = "http://www.sibinfo.su/files/Fck/image/babulya____sq373.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №3</p>
				<img src = "https://i.mycdn.me/i?r=AEF0PjOBfKSCKs0AX-NHBglGlECFsYToHAOXasBMnhLGqFjaGUC5bdaS2LfRWc32-UaPO0i1bS25atCdys1_w0Ps&amp;i=1&amp;fn=external_8">
			</div>
    		<div>
				<p class = "banner">Баннер №4</p>
				<img src = "https://bnw-thmb.r.worldssl.net/ykATI6Ow7O4rAvjV14nfFuEGVWE=/fit-in/256x256/https://pp.vk.me/c636219/v636219967/bfac/dT9wQJji_qs.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №5</p>
				<img src = "https://pp.userapi.com/3oIWqLXVu1Cz2_UHLii1FUJXn-v5ZBFtm9SVKw/Xqvtj-ETP_0.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №6</p>
				<img src = "http://patstalom.com/uploads/images/c/5/3/4/30/f67bd48370.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №7</p>
				<img src = "http://raskleika-spb.ru/wp-content/uploads/2017/01/naruzhnaya-reklama-300x198.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №8</p>
				<img src = "https://serpstat.com/img/blog/kak-sozdat-effektivnij-reklamnij-banner-sekreti-i-trendi/157225954136135849_59949419045.jpg">
			</div>
    		<div>
				<p class = "banner">Баннер №9</p>
				<img src = "https://img.artlebedev.ru/kovodstvo/idioteka/i/200/55914169-AC99-42E1-8DE8-C28F493DD6BA.jpg">
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

		<?
			$mysqli = new mysqli("localhost", "ashakirova_tshop", "QB*H0VDy3234234", "ashakirova_tshop");

			if (mysqli_connect_errno()) 
			{ 
    			printf("Connect failed: %s\n", mysqli_connect_error()); 
    			exit(); 
			}

			$mysqli->set_charset('utf8');

			$sql = 'SELECT * FROM `sales`';
			$result = $mysqli->query($sql);
		?>

		<div class = "sales">
		<? while ($row = $result->fetch_object()) 
		{ ?>
			<div class = "product">
				<p><?= $row->name ?></p>
				<img class = "lazy" data-original = "<?= $row->picture ?>" width = "150">
				<p><?= $row->about ?></p>
				<a><div class = "sale-buttons" data-name = "<?= $row->name ?>" data-price = "<?= $row->price ?>" data-id = "<?= $row->ID ?>"><p class = "text-price">Купить за <?= $row->price ?> деняк</p></div></a>
			</div>
		<? } ?>
		</div>

		<h2 class = "text-center">Ваши отзывы</h2>

		<?
			$result->free();
			$sql = 'SELECT * FROM `reviews`';
			$result = $mysqli->query($sql);
		?>

		<div class = "reviews">
		<? while ($row = $result->fetch_object())
		{ ?>
			<div class = "feedback">
				<p><?= $row->feedback ?></p>
				<p class = "feed-name"><?= $row->name ?></p>
			</div>
		<? } ?>
		</div>

		<?
			$result->free();
			$mysqli->close();
		?> 

		<h2 class = "text-center">Оставьте свой отзыв</h2>
		<form name = "form-review" class = "review-form" id = "form-feed">
			<label for = "person">Представьтесь, пожалуйста </label><input type = "text" id = "person" name = "name-person" placeholder = "Антон Владимирович Козак"> <br>
			<textarea  rows = "10" name = "feed" placeholder = "Поле для написания отзыва"></textarea> <br>
			<input type = "submit" class = "review-ok" value = "Отправить">
		</form>

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
			<p class = "author">Сайт сделан методом дендрофикального конструирования</p>
			<p class = "copyright">©Aleksey Bedrin</p>
		</div>

  		<script src = "https://code.jquery.com/jquery-2.2.0.min.js" type = "text/javascript"></script>
		<script src = "./slick/slick.js" type = "text/javascript" charset = "utf-8"></script>
		<script src = "./lazyload/jquery.lazyload.js" type = "text/javascript" charset = "utf-8"></script>
		<script src = "/script.js" type = "text/javascript"></script>
		
		<script type = "text/javascript">
			$('.fade').slick(
			{
  				dots: true,
  				infinite: true,
  				speed: 500,
  				fade: true,
				cssEase: 'linear',
				autoplay: true,
  				autoplaySpeed: 4000,
			});
		</script>
	</body>
</html>