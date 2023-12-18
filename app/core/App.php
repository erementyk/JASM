<?php
/**
 * Класс приложения.
 * @package erementyk\jasm
 * @author Erement Hompage <e.erementchouk@itevas.ru>
 */
namespace core;

use Evas\Web\WebApp;

class App extends WebApp
{
    public static bool $authorized = false;

    public static function appSession()
    {
    	return static::session();
    }    

    public static function authUser() 
    {   
        return false;
    }
}
