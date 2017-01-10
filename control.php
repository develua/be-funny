<? session_start(); define("INC_SCAN","1");

include("header.inc.php");

$text = string_slash($_POST[text]);
$menu = string_slash($_POST[menu]);

if(!isset($_SESSION[counter]))
{
	$_SESSION[counter] = 0;
}

if(isset($_POST[submit]) && !empty($text))
{
	if($menu == 1)
	{
		$result = mysql_query("INSERT INTO content (text, the_like) VALUES ('$text','0')");
		$_SESSION[counter]++;
	}
	
	else if($menu == 2)
	{
		$result = mysql_query("INSERT INTO fact (text) VALUES ('$text')");
	}
	
	if($result == true)
	{
		$res_control = "Данные успешно сохранены в базу данных";
		$res_css = 'class="resOkCss"';
	}
	
	else
	{
		$res_control = "Данные не сохранены в базу данных";
		$res_css = 'class="errorCss"';
	}
}

echo <<<HTML
<div id="mainControl">
	<div id="counter">$_SESSION[counter]</div>
	<div id="formControl">
		<div id="resControl" $res_css>$res_control</div>
		<form action="control.php" method="post">
			<textarea name="text"></textarea>
			<select name="menu">
				<option value="1">Контент</option>
				<option value="2">Интересное</option>
			</select>
			<input name="reset" type="reset" value="Удалить">
			<input name="submit" type="submit" value="Сохранить">
		</form>
	</div>
	<div id="generatorImg"><a href="generator.php?password=$myPassword" target="_blank">Ссылка</a></div>
</div>
HTML;

include("footer.inc.php");

?>