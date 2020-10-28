		<?
			require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
			$APPLICATION->SetTitle("Testshop");
			
			session_start();
			if (!isset($_SESSION['status']))
			{
				$_SESSION['status'] = "not visited";
			}

			$options = array(
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			$db = new PDO('mysql:host=localhost; dbname=ashakirova_tshop; charset=utf8', "ashakirova_tshop", "QB*H0VDy3234234", $options);
		?>

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

		<div class = "sales">
			<? 
				if (CModule::IncludeModule("iblock"))
				{
					$res = CIBlockElement::GetList(
						Array("PROPERTY_PRICE" => "DESC"),
						Array("IBLOCK_ID" => 1),
						false,
						false,
						Array("ID", "NAME", "PROPERTY_PRICE", "DETAIL_PICTURE", "DETAIL_TEXT")
					);
					while ($row = $res->GetNext())
					{ 
						?>
							<div class = "product">
								<p><?= $row["NAME"] ?></p>
								<img class = "lazy" data-original = "<?= CFile::GetPath($row["DETAIL_PICTURE"]) ?>" width = "150px">
								<p><?= $row["DETAIL_TEXT"] ?></p>
								<div class = "sale-buttons" data-name = "<?= $row["NAME"] ?>" data-price = "<?= $row["PROPERTY_PRICE_VALUE"] ?>" data-id = "<?= $row["ID"] ?>"><p class = "text-price">Купить за <?= $row["PROPERTY_PRICE_VALUE"] ?> деняк</p></div>
							</div>
						<?
					} 
				} 
			?>
		</div>

		<h2 class = "text-center">Ваши отзывы</h2>
		<div class = "reviews" id = "reviews-block">
			<? 
				foreach($db->query('SELECT * FROM reviews') as $row)
				{ 
					?>
						<div class = "feedback">
							<p><?= htmlentities($row['feedback']) ?></p>
							<p class = "feed-name"><?= htmlentities($row['name']) ?></p>
						</div>
					<? 
				} 
			?>
		</div>

		<?
			$db = null;
			if ($_SESSION['status'] !== "visited")
			{ 
				?> 
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
				<? 
			} 
		?>

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

		<? 
			require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
		?>