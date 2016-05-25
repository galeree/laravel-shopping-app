<?php

class CategoriesController extends BaseController {

	private static $prefix = '/image/category/';

	public function getIndex()
	{
		$categories = Category::all();
		return View::make('dashboard/category.index',
			   array('categories' => $categories));
	}

	public function getNode() {
		$parent = $_GET['parent'];
		$categories = Category::where('category_id','=',$parent)->where('id','!=','1')->get();
		return json_encode($categories, JSON_UNESCAPED_UNICODE);
	}

	public function getCheckname() {
		$type = $_GET["type"];
		$name = Input::get("name");

		$categories = Category::where('name','=',$name)->get();
		
		if($type == 'create') {
			if(count($categories) == 0) return 'true';
			else return 'false';		
		} else {
			if(count($categories) <= 1) return 'true';
			else return 'false';
		}

	}

	public function getCheckdescription() {
		$type = $_GET["type"];
		$description = Input::get('description');

		$categories = Category::where('description','=',$description)->get();
		
		if($type == 'create') {
			if(count($categories) == 0) return 'true';
			else return 'false';			
		} else {
			if(count($categories) <= 1) return 'true';
			else return false;
		}

	}

	public function getNavigation() {
		$category = $_GET['category'];
		$temp = array();
		$navigator = Category::where('id','=',$category)->first();
		$check = true;
		if($navigator->id == 1) $check = false;

		do {
			array_push($temp, $navigator);
			$navigator = Category::where('id','=',$navigator->category_id)->first();			
		} while ($navigator->category_id != $navigator->id);

		if($check) array_push($temp,Category::where('id','=','1')->first());
		$temp = array_reverse($temp);
		return $temp;
	}


	public function getCreate()
	{
		return View::make('dashboard/category.create');
	}



	public function postCreate()
	{
		$category = new Category();
		$category->name = Input::get('name');
		$category->description = Input::get('description');
		$category->category_id = Input::get('category_id');
		
		$timestamps = new DateTime;
		$category->created_at = $timestamps;
		$category->updated_at = $timestamps;

		$picture = Input::file('image');
		if(isset($picture)) {
			$destination = public_path().static::$prefix;
			$filename = $picture->getClientOriginalName();
			$category->image = static::$prefix.$filename;
			$uploadSuccess = $picture->move($destination,$filename);
		}

		$category->save();
		return Redirect::route('category.index');
	}



	public function getShow()
	{
		$query = $_GET['query'];
		$filter = $_GET['filter'];
		$categories;
		if($filter == 1) {
			$categories = DB::table('categories')->where('categories.name','LIKE', '%'.$query.'%')
							->join('categories as parent','categories.category_id','=','parent.id')
							->get(['categories.*','parent.name as category_name']);
		}else if($filter == 2) {
			$element = Category::where('name','=', $query)->first();
			if(count($element) == 0) return json_encode([], JSON_UNESCAPED_UNICODE);
			
			$id = $element->id;
			$categories = DB::table('categories')->where('categories.category_id','=',$id)
							->join('categories as parent','categories.category_id','=','parent.id')
							->get(['categories.*','parent.name as category_name']);
		}else {
			$categories = DB::table('categories')->join('categories as parent','categories.category_id','=','parent.id')
							->get(['categories.*','parent.name as category_name']);
		}

		return json_encode($categories, JSON_UNESCAPED_UNICODE);
	}


	public function getEdit($id)
	{
		$category = Category::where('id','=',$id)->first();
		$name = Category::where('id','=',$category->category_id)->first();
		$name = $name->name;
		return View::make('dashboard/category.edit', array('category' => $category, 'name' => $name));
	}

	public function postEdit($id)
	{
		$category = Category::where('id','=',$id)->first();
		$category->name = Input::get('name');
		$category->description = Input::get('description');
		$category->category_id = Input::get('category_id');
		
		$timestamps = new DateTime;
		$category->updated_at = $timestamps;

		$picture = Input::file('image');
		if(isset($picture)) {
			$destination = public_path().static::$prefix;
			$filename = $picture->getClientOriginalName();
			$category->image = static::$prefix.$filename;
			$uploadSuccess = $picture->move($destination,$filename);
		}
		$category->save();
		return Redirect::route('category.index');
	}


	public function getDelete($id)
	{
		$category = Category::where('id','=',$id)->first();
		$category->delete();
		return Redirect::route('category.index');
	}


}
