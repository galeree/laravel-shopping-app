<?php

class ProductsController extends BaseController {

	private static $prefix = '/image/product/';

	public function getIndex()
	{
		$products = Product::all();
		return View::make('dashboard/product.index');
	}


	public function getCreate()
	{
		return View::make('dashboard/product.create');
	}


	public function postCreate()
	{
		if( ! Product::isValid(Input::all()) ) {
			return Redirect::back()->withInput();
		}

		$product = new Product();
		$product->name = Input::get('name');
		$product->description = Input::get('description');
		$product->category_id = Input::get('category_id');
		$product->property = Input::get('property');
		$product->price = Input::get('price');
		$product->content = Input::get('content');

		$feature = Input::get('feature');
		if(isset($feature)) {
			$product->feature = true;	
		}
		
		$promotion = Input::get('promotion');
		if(isset($promotion)) {
			$product->promotion = true;
		}
		
		$timestamps = new DateTime;
		$product->created_at = $timestamps;
		$product->updated_at = $timestamps;

		$picture = Input::file('image');
		if(isset($picture)) {
			$destination = public_path().static::$prefix;
			$filename = $picture->getClientOriginalName();
			$product->image = static::$prefix.$filename;
			$uploadSuccess = $picture->move($destination,$filename);
		}

		$product->save();
		
		$propertyupdate = Input::get('propertyupdate');
		$propertyupdate = json_decode($propertyupdate,true);
		$property = Input::get('property');
		if(isset($property)) {
			foreach ($propertyupdate as $item) {
				$id = $item['id'];
				$name = $item['name'];
				$image = new Image();
				$image->name = $name;
				$image->product_id = $product->id;
				$image->image_id = $id;
				$image->save();
			}
		}

		return Redirect::route('product.index');
	}


	public function getShow()
	{
		$query = $_GET['query'];
		$filter = $_GET['filter'];
		$products;
		if($filter == 1) {
			$products = DB::table('products')->where('products.name','LIKE', '%'.$query.'%')
						->join('categories','categories.id','=','products.category_id')
						->get(['products.*','categories.name as category_name']);
		}else if($filter == 2) {
			$element = Category::where('name','=', $query)->first();
			if(count($element) == 0) return json_encode([], JSON_UNESCAPED_UNICODE);
			
			$id = $element->id;
			$products = DB::table('products')->where('products.category_id','=',$id)
						->join('categories','categories.id','=','products.category_id')
						->get(['products.*','categories.name as category_name']);
		}else {
			$products = DB::table('products')
						->join('categories','categories.id','=','products.category_id')
						->get(['products.*','categories.name as category_name']);

		}
		return json_encode($products, JSON_UNESCAPED_UNICODE);
	}


	public function getEdit($id)
	{
		$product = Product::where('id','=',$id)->first();
		$name = Category::where('id','=',$product->category_id)->first();
		$name = $name->name;
		return View::make('dashboard/product.edit',
			   array('product' => $product, 'name' => $name));
	}


	public function postEdit($id)
	{
		$product = Product::where('id','=',$id)->first();
		$product->name = Input::get('name');
		$product->description = Input::get('description');
		$product->category_id = Input::get('category_id');
		$product->property = Input::get('property');
		$product->price = Input::get('price');
		$product->content = Input::get('content');

		$feature = Input::get('feature');
		if(isset($feature)) {
			$product->feature = true;	
		}
		
		$promotion = Input::get('promotion');
		if(isset($promotion)) {
			$product->promotion = true;
		}
		
		$timestamps = new DateTime;
		$product->updated_at = $timestamps;

		$picture = Input::file('image');
		if(isset($picture)) {
			$destination = public_path().static::$prefix;
			$filename = $picture->getClientOriginalName();
			$product->image = static::$prefix.$filename;
			$uploadSuccess = $picture->move($destination,$filename);
		}

		$product->save();

		$property = Input::get('property');

		if(isset($property)) {
			$propertyupdate = Input::get('propertyupdate');
			$propertyupdate = json_decode($propertyupdate,true);

			$propertyold = Input::get('propertyold');
			$propertyold = json_decode($propertyold,true);
			$deleteitem = array();

			foreach ($propertyold as $data1) {
				$duplicate = false;
				foreach ($propertyupdate as $data2) {
					if($data1['id'] === $data2['id']) $duplicate = true;
				}
				if($duplicate === false) array_push($deleteitem, $data1);
			}

			$insertitem = array();
			foreach ($propertyupdate as $data1) {
				$duplicate = false;
				foreach ($propertyold as $data2) {
					if($data1['id'] === $data2['id']) $duplicate = true;
				}
				if($duplicate === false) array_push($insertitem, $data1);
			}

			foreach ($insertitem as $item) {
				$id = $item['id'];
				$name = $item['name'];
				$image = new Image();
				$image->name = $name;
				$image->product_id = $product->id;
				$image->image_id = $id;
				$image->save();
			}

			foreach ($deleteitem as $item) {
				DB::table('images')->where('image_id', '=', $item['id'])
				->where('product_id','=',$product->id)->delete();
			}		
		}else {
			$items = Image::where('product_id','=',$product_id)->get();
			foreach ($items as $item) {
				$item->delete();
			}
		}

		return Redirect::route('product.index');
	}


	public function getDelete($id)
	{
		$product = Product::where('id','=',$id)->first();
		$images = Image::where('product_id','=',$id)->get();
		$product->delete();
		foreach ($images as $image) {
			$image->delete();
		}
		return Redirect::route('product.index');
	}


}
