<?php



/**
 * Front controller
 *
 */

/**
 * 
 * Load all Class
 */
/*spl_autoload_register(function($class){
	$root = dirname(__DIR__);
	$file = $root .'/'. str_replace('\\', '/', $class) .'.php';
	if (is_readable($file)) {
		require $file;
	}
});*/

/**
 * 
 * Load all Classes by composer Autoloader
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
* Set Error and Exception handler
*
*/
error_reporting(E_ALL);
set_error_handler('vendor\framework\exceptions\Errors::errorHandler');
set_exception_handler('vendor\framework\exceptions\Errors::exceptionHandler');


/**
 * Routing
 */

$router = new vendor\framework\routers\Router();


// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
    
/*// Display the routing table
echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';
*/

/*// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}*/

$router->dispatch($_SERVER['QUERY_STRING']);
