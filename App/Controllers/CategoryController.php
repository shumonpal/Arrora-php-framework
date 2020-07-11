<?php

namespace App\Controllers;

use vendor\framework\controllers\Controller;
use vendor\framework\views\View;
use App\Models\Category;

/**
* Posts Class
*
* PHP version 7.0.27
*/
class CategoryController extends Controller
{

	protected $category; 
	
	public function __construct(){
		$this->category = new Category();
	}
	public function indexAction()
	{		
		$cats = $this->category->getAll();
		$hello = hello();
		//$cats = ['cat1' => 'Education', 'cat2' => 'Entertainment'];
		return View::render('category', ['cats' => $cats, 'hello' =>  $hello ]);
	}	



	public function testAction()
	{
		//return $this->category->insert();
		/*foreach ($this->category->listsBy(['name', 'discribe']) as $key => $value) {
			echo $value['name'];
		}*/
		return $this->category->where('id', 2);

	}
}