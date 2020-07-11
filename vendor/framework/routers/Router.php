<?php

namespace vendor\framework\routers;
/**
 * Router
 *
 * PHP version 7.0.27
 */
class Router
{

    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public function dispatch($url)
    {
    	$url = $this->removeQurStrVar($url);

    	if ($this->match($url)) {
    		$controller = $this->params['controller'];
    		$controller = $this->studlyCaps($controller).'Controller';
            $controller = $this->getNamespace() . $controller;

    		if (class_exists($controller)) {
    			$class_object = new $controller($this->params);

    			$action = $this->params['action'];
    			$action = $this->camalCase($action);
    			if (is_callable([$class_object, $action])) {
    				$action = $class_object->$action();
    			} else {
                    throw new \Exception("Method $action (in Controller $controller) is not found.");
                    
    			}
    			
    		} else { 
                throw new \Exception("Controller $controller not found");
                               			
    		}
    		

    	} else {
    		throw new \Exception('No route matched.', 404);
    	}
    	
    }

    /**
     * Convert string with hypen to StudlyCaps
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public function studlyCaps($string)
    {
    	return str_replace(' ', '', ucwords(str_replace('-', '', $string) ));
    }

    /**
     * Convert string with hypen to Camel Case
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public function camalCase($string)
    {
    	return lcfirst($this->studlyCaps($string));
    }

    /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    public function removeQurStrVar($url)
    {
    	if ($url != '') {
    		$parts = explode('&', $url, 2);
    		if (strpos($parts[0], '=') === false) {
    			$url = $parts[0];
    		}else{
    			$url = '';
    		}
    	}

    	return $url;
    	
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present.
     *
     * @return string The request URL
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }


}
