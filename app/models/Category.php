<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 protected $table = 'categories';
	 public static $errors;

	 protected $fillable = [
	 	'name','description','category_id',
	 	'image','created_at','updated_at'
	 ];

	 private static $rules = [
	 	'name' => 'required',
	 	'description' => 'required|unique:categories,description',
	 	'category_id' => 'required|numeric|exists:categories,id',
	 	'image' => 'required'
	 ];

	 public function subcategories() {
	 	return $this->hasMany('Category')->where('id','!=','1');
	 }

	 public function parent() {
	 	return $this->belongsTo('Category');
	 }

	 public function products() {
	 	return $this->hasMany('Product');
	 }

	 public function scopeCategory($query,$id) {
	 	return $query->whereId($id);
	 }

	 public static function isValid($data) {
	 	$validator = Validator::make($data, static::$rules);

	 	if($validator->passes()) {
	 		return true;
	 	}

	 	static::$errors = $validator->messages();
	 	return false;
	 }

}