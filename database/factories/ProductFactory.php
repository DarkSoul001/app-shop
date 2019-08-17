<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
	return [
        //
		'name' => substr($faker->sentence(3), 0, -1),
		'description' => $faker->sentence(10),
		'logn_description' => $faker->text,
		'price' => $faker->randomfloat(2, 5, 150),

		'category_id'=> $faker->numberBetween(1,5)
	];
});
