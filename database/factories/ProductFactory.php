<?php

use App\ORM_Model\Fld_Product\Product;
use Faker\Generator as Faker;


$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'quantity' => $faker->numberBetween(15, 100),
        'price' => number_format($faker->numberBetween(1500, 10000), 2, '.', '')
    ];
});
