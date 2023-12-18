<?php
/**
 * JASM endpoint.
 * @package erementyk\jasm
 * @author Erement Hompage <e.erementchouk@itevas.ru>
 */
use core\App;
use Evas\Base\Loader;

// вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['HTTP_USER_AGENT']) {
	$discord_user_agent = '(compatible; Discordbot/2.0; +https://discordapp.com)';

	$pos = strpos($_SERVER['HTTP_USER_AGENT'], $discord_user_agent);
	if($pos !== false){
		include 'discord.php';
		die();			
	}
}else{
	if ($_SERVER['REQUEST_URI'] === '/robots.txt') {
		echo "User-agent: *\nDisallow: /\n";
		die();
	}
}
// подключаем автозагрузку
include __DIR__ . '/../vendor/evas-php/evas-base/src/Loader.php';
(new Loader)->useEvas()->dir('/app/')->run();
// подгружаем зависимости
App::di()->loadDefinitions('config/di.php');
// подключаем константы
App::include('config/constants.php');
// подключаем роутинг
$router = App::include('config/router.php');
$router->requestRouting(App::request());
