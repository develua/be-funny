<? defined("INC_SCAN") or die(header("Location: /error.php"));

include("right_block.inc.php");

echo <<<HTML
</div>

<!--Начало блока Footer-->
<div id="footer">
    <p>Copyright &copy; $year_start (<span>Игорь Продан</span>) $host_name</p>
    <p>Коллекция цитат, статусов, афоризмов и фактов.</p>
	<div id="wrapperFooter">
		<div id="mapBlock">
        	<a href="map.php" class="hasTip" title="Карта сайта">Карта сайта</a>
        </div>
	</div>
</div>
<!--Конец блока Footer-->

<!-- Yandex.Metrika counter --><script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script><script type="text/javascript">try { var yaCounter19152727 = new Ya.Metrika({id:19152727, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true}); } catch(e) { }</script><noscript><div><img src="//mc.yandex.ru/watch/19152727" style="position:absolute; left:-9999px;" alt=""></div></noscript><!-- /Yandex.Metrika counter -->

</body>
</html>
HTML;

mysql_close($db);
exit();

?>