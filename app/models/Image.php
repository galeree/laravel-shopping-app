<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Image extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 protected $table = 'images';
	 protected $fillable = [
	 	'name','path','thumbnail_path','product_id',
	 	'created_at','updated_at'
	 ];

	 public function category() {
	 	return $this->belongsTo('Product');
	 }

}