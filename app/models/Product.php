<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 protected $table = 'products';
	 public static $errors;

	 protected $fillable = [
	 	'name','description','category_id',
	 	'property','image','price','content',
	 	'feature','promotion','created_at','updated_at'
	 ];

	 private static $rules = [
	 	'name' => 'required|unique:products,name',
	 	'description' => 'required|unique:products,description',
	 	'category_id' => 'required|numeric|exists:categories,id',
	 	'property' => 'alpha',
	 	'image' => 'required',
	 	'feature' => 'boolean',
	 	'promotion' => 'boolean'
	 ];

	 public function category() {
	 	return $this->belongsTo('Category');
	 }

	 public function image() {
	 	return $this->hasMany('Image');
	 }

	 public function scopeFeature($query) {
	 	return $query->where('feature','=','1');
	 }

	 public function scopePromotion($query) {
	 	return $query->where('promotion','=','1');
	 }

	 public function scopeExtra($query) {
	 	return $query->where('feature','=','1')->orWhere('promotion','=','1');
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