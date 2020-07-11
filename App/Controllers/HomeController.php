<?php

namespace App\Controllers;

use vendor\framework\controllers\Controller;
use vendor\framework\views\View;
/**
* Home Class
*
* PHP version 7.0.27
*/
class HomeController extends Controller
{

	/**
	* Before Filter
	*
	* @return viod
	*/
	protected function before()
	{
		//return false;
	}
	/**
     * Show the index page
     *
     * @return void
     */
	public function indexAction()
	{
		return View::render('home.php');
	}


	public function addNewAction()
	{
		echo phpversion();
		//echo 'addNew method from Home class';

	}
}