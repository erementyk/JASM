<?php
/**
 * Роутинг.

 * @package erementyk\jasm
 * @author Erement Hompage <e.erementchouk@itevas.ru>
 */
use core\App;
use core\ViewController;
use Evas\Router\Router;

$contentTypes = [
    'js' => 'text/javascript',
    'css' => 'text/css',
    'jpg' => 'image/jpeg', 
    'jpeg' => 'image/jpeg', 
    'png' => 'image/png', 
    'svg' => 'image/svg+xml', 
];

$router = (new Router)
->controllerClass(ViewController::class)
->default('login.php')
    ->get('/images/(:any)', function ($path) {
        $types = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
        ];
        $ext = substr($path, strrpos($path, '.') + 1);
        $filename = './public/images/' . $path;
        $type = $types[$ext] ?? null;
        if (!$type || !file_exists($filename)) {
            $this->view('404.php',[]);
            return false;
        }
        header('Content-Type: '. $type);
        $this->view($filename,[]);
    })
    ->get('/(:any).vue', function ($p) {
        header('Content-Type: text/javascript');
        $this->vueCompiler("vue/$p.vue");
    })    
    ->get('/login','login.php')
    ->get('/logout','logout.php');

return $router;
