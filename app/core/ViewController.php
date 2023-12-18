<?php
/**
 * Базовый контроллер отображения.
 * @package erementyk\jasm
 * @author Erement Hompage <e.erementchouk@itevas.ru>
 */
namespace core;

use Evas\Router\Controller;

class ViewController extends Controller
{
    /**
     * Вывод шапки сайта.
     * @param array|null свойства шапки
     */
    public function siteHeader(array $args = null)
    {
        return $this->view('header.php', $args);
    }

    /**
     * Вывод подвала сайта.
     * @param array|null свойства подвала
     */
    public function siteFooter(array $args = null)
    {
        return $this->view('footer.php', $args);
    }

    /**
     * Вывод компонента сайта.
     * @param string имя компонента
     * @param array|null свойства компонента
     */
    public function sitePart(string $name, array $args = null)
    {
        if (!preg_match('/\.(php|html|htm)$/', $name)) {
            $name .= '.php';
        }
        return $this->view("parts/$name", $args);
    }

    /**
     * Вывод страницы сайта.
     * @param string имя страницы
     * @param array|null свойства стараницы
     */
    public function sitePage(string $name, array $args = null)
    {
        if (!preg_match('/\.(php|html|htm)$/', $name)) {
            $name .= '.php';
        }
        return $this->view("pages/$name", $args);
    }
    
    /**
     * Компиляция vue компонента в модульный вид.
     * @param string имя компонента
     */
    public function vueCompiler(string $name){
        $t = file_get_contents($this->resolveViewPath("$name"));
        $templatePos = [mb_strpos($t,'<template>')+10, mb_strpos($t,'</template>')-10];
        $componentPos = mb_strpos($t,'<script>')+9;
        $template = mb_substr($t, $templatePos[0], $templatePos[1]);
        $component = mb_substr($t, $componentPos, -12);
        echo $component . "template: ` $template `}";
    }
}
