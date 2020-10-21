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
		<section class = "autoplay slider">
    		<div>
				Баннер №1 <br>
				<img src = "https://i.pinimg.com/236x/b4/9c/12/b49c129f6f2600100836dd4f953aa78c.jpg" width = "200">
			</div>
    		<div>
				Баннер №2 <br>
				<img src = "http://www.sibinfo.su/files/Fck/image/babulya____sq373.jpg" width = "200">
			</div>
    		<div>
				Баннер №3 <br>
				<img src = "https://i.mycdn.me/i?r=AEF0PjOBfKSCKs0AX-NHBglGlECFsYToHAOXasBMnhLGqFjaGUC5bdaS2LfRWc32-UaPO0i1bS25atCdys1_w0Ps&amp;i=1&amp;fn=external_8" width = "200">
			</div>
    		<div>
				Баннер №4 <br>
				<img src = "https://bnw-thmb.r.worldssl.net/ykATI6Ow7O4rAvjV14nfFuEGVWE=/fit-in/256x256/https://pp.vk.me/c636219/v636219967/bfac/dT9wQJji_qs.jpg" width = "200">
			</div>
    		<div>
				Баннер №5 <br>
				<img src = "https://pp.userapi.com/3oIWqLXVu1Cz2_UHLii1FUJXn-v5ZBFtm9SVKw/Xqvtj-ETP_0.jpg" width = "200">
			</div>
    		<div>
				Баннер №6 <br>
				<img src = "http://patstalom.com/uploads/images/c/5/3/4/30/f67bd48370.jpg" width = "200">
			</div>
    		<div>
				Баннер №7 <br>
				<img src = "http://raskleika-spb.ru/wp-content/uploads/2017/01/naruzhnaya-reklama-300x198.jpg" width = "200">
			</div>
    		<div>
				Баннер №8 <br>
				<img src = "https://serpstat.com/img/blog/kak-sozdat-effektivnij-reklamnij-banner-sekreti-i-trendi/157225954136135849_59949419045.jpg" width = "200">
			</div>
    		<div>
				Баннер №9 <br>
				<img src = "https://img.artlebedev.ru/kovodstvo/idioteka/i/200/55914169-AC99-42E1-8DE8-C28F493DD6BA.jpg" width = "200">
			</div>
  		</section>		

		<div id = "modDiv" class = "modal">
			<div class = "modal-content">
				<div class = "modal-header">
					<span class = "close">&times;</span>
					<h2>Шапка</h2>
				</div>
				<div class = modal-body>
					<p>Текст</p>
					<!-- сюда впихнуть форму -->
					<p>Ещё текст</p>
				</div>
				<div class = "modal-footer">
					<h3>Футер</h3>
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
				<img src = "<?= $row->picture ?>" width = "150">
				<p><?= $row->about ?></p>
				<a><div class = "saleButtons" data-id = "<?= $row->ID ?>"><p class = "textPrice">Купить за <?= $row->price ?> деняк</p></div></a>
			</div>
		<? } ?>
		</div>

		<?
			$result->free();
			$mysqli->close();
		?> 

		<h2 align = "center">Ваши отзывы</h2>



  		<script src = "https://code.jquery.com/jquery-2.2.0.min.js" type = "text/javascript"></script>
		<script src = "./slick/slick.js" type = "text/javascript" charset = "utf-8"></script>
		<script src = "/script.js" type = "text/javascript"></script>
  		<script type = "text/javascript">
			$(document).on('ready', function() 
			{
				$('.autoplay').slick(
				{
  					slidesToShow: 3,
  					slidesToScroll: 1,
  					autoplay: true,
  					autoplaySpeed: 2000,
				});
    		});
		</script>
	</body>
</html>