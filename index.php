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
		
		<?
			$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"my_products", 
	array(
		"IBLOCK_TYPE" => "product",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "1",
		"COMPONENT_TEMPLATE" => "my_products",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "PRICE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"SEARCH_PAGE" => "/search/",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	),
	false
);
		?>

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