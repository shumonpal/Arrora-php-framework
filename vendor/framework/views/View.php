<?php

namespace vendor\framework\views;

use Jenssegers\Blade\Blade;

/**
* View Class
*
* PHP version 7.0.27
*/

class View
{
	
	/**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */

	public static function render($file, $params = [])
	{
		
		static $blade = null;

        if ($blade === null) {
            $view = '../App/Views';
            $cache = '../App/Cache/';
            $blade = new Blade($view, $cache);
            /*$loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);*/
        }

        //echo $twig->render($file, $params);
        echo $blade->make($file, $params);
		
	}
}