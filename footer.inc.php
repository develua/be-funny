<? defined("INC_SCAN") or die(header("Location: /error.php"));

include("right_block.inc.php");

echo <<<HTML
</div>

<!--������ ����� Footer-->
<div id="footer">
    <p>Copyright &copy; $year_start (<span>����� ������</span>) $host_name</p>
    <p>��������� �����, ��������, ��������� � ������.</p>
	<div id="wrapperFooter">
		<div id="mapBlock">
        	<a href="map.php" class="hasTip" title="����� �����">����� �����</a>
        </div>
	</div>
</div>
<!--����� ����� Footer-->

<!-- Yandex.Metrika counter --><script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script><script type="text/javascript">try { var yaCounter19152727 = new Ya.Metrika({id:19152727, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true}); } catch(e) { }</script><noscript><div><img src="//mc.yandex.ru/watch/19152727" style="position:absolute; left:-9999px;" alt=""></div></noscript><!-- /Yandex.Metrika counter -->

</body>
</html>
HTML;

mysql_close($db);
exit();

?>