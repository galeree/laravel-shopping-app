<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		$this->call('PromotionTableSeeder');
	}

}

class FeatureTableSeeder extends Seeder {
	public function run()
	{
		$order = 8;
		$title = 'กำมะหยี่';
		$image = '/image/feature/feature18.jpg';
		$alias = 'alias8';
		$content = 'this is content8';
		Feature::create(array('order' => $order, 'title' => $title,
							  'image' => $image, 'alias' => $alias,
							  'content' => $content));

	}

}

class PromotionTableSeeder extends Seeder {
	public function run() {
		$order = 4;
		$title = 'กาวเหลือง 316 15 kg';
		$image = '/image/feature/feature15.jpg';
		$alias = 'alias';
		$content = 'this is content';
		Promotion::create(array('order' => $order, 'title' => $title,
								'image' => $image, 'alias' => $alias,
								'content' => $content));
	}
}
