<? defined("INC_SCAN") or die(header("Location: /error.php"));

echo <<<HTML
</div>
<!--Конец блока MainBlock-->

<!--Начало блока RightBlock-->
<div id="rightBlock">
	
	<div id="youKnow"></div>
	
	<div class="rightContent" id="shareBlock">
		<p>Поделиться ссылкой:</p>
		<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
		<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div>
	</div>
	
	<div class="rightContent" id="bannerRight">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Баннерная реклама 160x600 -->
			<ins class="adsbygoogle"
			style="display:inline-block;width:160px;height:600px"
			data-ad-client="ca-pub-6993321457349830"
			data-ad-slot="4107175223"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	
	<div class="rightContent" id="bannerRight">
HTML;

if (!defined('_SAPE_USER')){
	define('_SAPE_USER', 'eec0766637508f48cea294d91692f6f4');
}
require_once(realpath($_SERVER['DOCUMENT_ROOT'].'/other/'._SAPE_USER.'/sape.php'));
$sape = new SAPE_client();
echo $sape->return_links($n);

echo <<<HTML
	</div>
	
</div>
HTML;

?>