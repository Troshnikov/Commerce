<?PHP

date_default_timezone_set('Europe/Moscow');

error_reporting(E_ALL); 
 
// Засекаем время
$time_start = microtime(true);

session_start();

require_once('controllers/IndexController.php');

$index = new IndexController();

// Если все хорошо
if(($res = $index->fetch()) !== false)
{
	// Выводим результат
	header("Content-type: text/html; charset=UTF-8");
	print $res;
}
else 
{ 
	// Иначе страница об ошибке
	header("http/1.0 404 not found");

	print $index->page404();

	//echo "Дима, печалька, все сломалось, ничего не работает!";
}

// Отладочная информация
if(1)
{
	print "<!--\r\n";
	$time_end = microtime(true);
	$exec_time = $time_end-$time_start;
  
  	if(function_exists('memory_get_peak_usage'))
		print "Использовано памяти: ".memory_get_peak_usage()." bytes\r\n";  
	print "Страница сгенерировалась за: ".$exec_time." seconds\r\n";

	print "-->";
}