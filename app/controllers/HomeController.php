<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	// Home Page
	public function getIndex() {
		$products = new Product;
		$features = $products->feature()->get();
		$promotions = $products->promotion()->get();

		return View::make('home.index',
			   array('features' => $features, 
			   	     'promotions' => $promotions));
	}

	// Shop Page
	public function getShop() {
		$cat_id = 1;
		$select = 'Home';
		if(isset($_GET["cat_id"])) {
			$cat_id = $_GET["cat_id"];
			$category = Category::category($cat_id)->first();
			do {
				$select = $category->name;
				$category = Category::category($category->category_id)->first();
			}while ($category->category_id != $category->id);
		}

		$navigators = static::getNavigation($cat_id);
		return View::make('home.shop', array('cat_id' => $cat_id, 
											 'select' => $select,
											 'navigators' => $navigators));
	}

	// Extra Product
	public function getExtra() {
		$products = Product::extra()->get();
		return json_encode($products);
	}


	// Element include product, category, parent
	public function getElement() {
		$query = $_GET['category'];
		$parents = Category::category('1')->first();
		$parents = $parents->subcategories()->get();

		$products;
		$subcategories;
		if($query == '1') {
			$subcategories = [];
			$products = Product::all();
		}else {
			$categories = Category::category($query)->first();
			$subcategories = $categories->subcategories()->get();

			$products = $categories->products()->get();
		}
		return json_encode(array($subcategories,$products,$parents),JSON_UNESCAPED_UNICODE);
	}

	public function getSearch() {
		$query = $_GET['query'];
		$categories = Category::where('name','LIKE','%'.$query.'%')->get();
		$products = Product::where('name', 'LIKE', '%'.$query.'%')->get();
		return json_encode(array($categories,$products),JSON_UNESCAPED_UNICODE);

	}

	// Navigation function use in Shop page
	public static function getNavigation($category) {
		$temp = array();
		$navigator = Category::where('id','=',$category)->first();
		$check = true;
		if($navigator->id == 1) $check = false;

		do {
			array_push($temp, $navigator);
			$navigator = Category::category($navigator->category_id)->first();			
		} while ($navigator->category_id != $navigator->id);

		if($check) array_push($temp,Category::category('1')->first());
		$temp = array_reverse($temp);
		return $temp;
	}

}
