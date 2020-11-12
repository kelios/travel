<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,

    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'email_verified_at' => $faker->dateTime,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Transport::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Complexity::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\CityWorlt::class, static function (Faker\Generator $faker) {
    return [


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Country::class, static function (Faker\Generator $faker) {
    return [


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\CityWorlt::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'state_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'country_id' => $faker->randomNumber(5),


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Country::class, static function (Faker\Generator $faker) {
    return [
        'code' => $faker->sentence,
        'name' => $faker->firstName,
        'phonecode' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Month::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\OverNightStay::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Travel::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'budget' => $faker->randomNumber(5),
        'number_peoples' => $faker->randomNumber(5),
        'number_days' => $faker->randomNumber(5),
        'minus' => $faker->text(),
        'plus' => $faker->text(),
        'recommendation' => $faker->text(),
        'description' => $faker->text(),
        'publish' => $faker->boolean(),
        'visa' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Category::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'image' => $faker->sentence,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Companion::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,


    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Comment::class, static function (Faker\Generator $faker) {
    return [
        'comment' => $faker->text(),
        'travel_id' => $faker->sentence,
        'users_id' => $faker->sentence,
        'reply_id' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Comment::class, static function (Faker\Generator $faker) {
    return [
        'comment' => $faker->text(),
        'travel_id' => $faker->sentence,
        'users_id' => $faker->sentence,
        'reply_id' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Message::class, static function (Faker\Generator $faker) {
    return [
        'messages' => $faker->text(),
        'travel_id' => $faker->sentence,
        'sender_id' => $faker->sentence,
        'recipient_id' => $faker->sentence,
        'is_read' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Message::class, static function (Faker\Generator $faker) {
    return [
        'thread_id' => $faker->randomNumber(5),
        'user_id' => $faker->randomNumber(5),
        'body' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'deleted_at' => null,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Article::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text(),
        'article_type_id' => $faker->sentence,
        'publish' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ArticleType::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
