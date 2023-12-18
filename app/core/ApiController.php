<?php
/**
 * @package erementyk\jasm
 * @author Erement Hompage <e.erementchouk@itevas.ru>
 */
namespace core;

use Evas\Router\Controller;
use core\App;

class ApiController extends Controller
{
    const CODE_ERRORS = [
        ["Права есть.", 200],
        ["Нет доступа.", 400],
        ["Нет прав.", 401],
    ];
    protected function respond(mixed $response, int $http_code = 200)
    {   
        if (is_object($response)) {
            $response = get_object_vars($response);
        }
        
        $webResponse = App::response();
        $webResponse->sendJson($http_code, $response);
    }
}
