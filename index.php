<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Testshop");

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
	$APPLICATION->IncludeComponent("bitrix:news.list", "my_products", Array(
		"IBLOCK_TYPE" 						=> "product",			// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" 						=> "1",					// Код информационного блока
		"NEWS_COUNT" 						=> "1",					// Количество новостей на странице
		"COMPONENT_TEMPLATE" 				=> "flat",
		"SORT_BY1" 							=> "PROPERTY_PRICE",	// Поле для первой сортировки новостей
		"SORT_ORDER1" 						=> "DESC",				// Направление для первой сортировки новостей
		"SORT_BY2" 							=> "SORT",				// Поле для второй сортировки новостей
		"SORT_ORDER2" 						=> "ASC",				// Направление для второй сортировки новостей
		"FILTER_NAME" 						=> "",					// Фильтр
		"FIELD_CODE" 						=> array(				// Поля
			0 	=> "PRICE",
			1 	=> "",
		),
		"PROPERTY_CODE" 					=> array(				// Свойства
			0 	=> "PRICE",
			1 	=> "",
		),
		"CHECK_DATES" 						=> "Y",					// Показывать только активные на данный момент элементы
		"DETAIL_URL" 						=> "",					// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"AJAX_MODE" 						=> "N",					// Включить режим AJAX
		"AJAX_OPTION_JUMP" 					=> "N",					// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" 				=> "Y",					// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" 				=> "N",					// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" 			=> "",					// Дополнительный идентификатор
		"CACHE_TYPE" 						=> "A",					// Тип кеширования
		"CACHE_TIME" 						=> "36000000",			// Время кеширования (сек.)
		"CACHE_FILTER" 						=> "N",					// Кешировать при установленном фильтре
		"CACHE_GROUPS" 						=> "Y",					// Учитывать права доступа
		"PREVIEW_TRUNCATE_LEN" 				=> "",					// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" 				=> "d.m.Y",				// Формат показа даты
		"SET_TITLE" 						=> "N",					// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" 				=> "Y",					// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" 				=> "Y",					// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" 				=> "Y",					// Устанавливать описание страницы
		"SET_LAST_MODIFIED" 				=> "N",					// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" 		=> "Y",					// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" 				=> "N",					// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" 			=> "N",					// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" 					=> "",					// ID раздела
		"PARENT_SECTION_CODE" 				=> "",					// Код раздела
		"INCLUDE_SUBSECTIONS" 				=> "Y",					// Показывать элементы подразделов раздела
		"STRICT_SECTION_CHECK" 				=> "N",					// Строгая проверка раздела для показа списка
		"DISPLAY_DATE" 						=> "N",					// Выводить дату элемента
		"DISPLAY_NAME" 						=> "Y",					// Выводить название элемента
		"DISPLAY_PICTURE" 					=> "Y",					// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" 				=> "Y",					// Выводить текст анонса
		"PAGER_TEMPLATE" 					=> "round",				// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" 				=> "N",					// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" 				=> "Y",					// Выводить под списком
		"PAGER_TITLE" 						=> "Товары",			// Название категорий
		"PAGER_SHOW_ALWAYS" 				=> "N",					// Выводить всегда
		"PAGER_DESC_NUMBERING" 				=> "N",					// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" 	=> "36000",				// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" 					=> "Y",					// Показывать ссылку "Все"
		"PAGER_BASE_LINK_ENABLE" 			=> "N",					// Включить обработку ссылок
		"SET_STATUS_404" 					=> "N",					// Устанавливать статус 404
		"SHOW_404" 							=> "N",					// Показ специальной страницы
		"MESSAGE_404" 						=> "",					// Сообщение для показа (по умолчанию из компонента)
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