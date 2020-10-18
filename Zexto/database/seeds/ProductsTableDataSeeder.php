<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'product_name' => 'Man\'s Yellow Bag',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, bags, yellow, hiking, travelling',
                'product_description' => 'Yellow Bag for Boys with leather covering inside and also waterproof',
                'product_amount' => 700,
                'product_previous_amount' => 900,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Sneakers',
                'product_for' => 'All',
                'product_tags' => 'man, boys, girls,  sneakers, shoes, yellow, sports, casual',
                'product_description' => 'Yellow Sneakers for Boys and Girls easy to wash and comfortable available UK size 6',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Hoodies for Men',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, hoodies, brownhoodies, brown, casual, winterlook',
                'product_description' => 'Man Brown hoodies available size xxl',
                'product_amount' => 356,
                'product_previous_amount' => 400,
                'vendor_id' => 5,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Denim Shirts',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, DenimShirts, Shirts, casual, winterlook',
                'product_description' => 'Man SHirts with Denim essence to makes your winter amazing, available size xxl',
                'product_amount' => 378,
                'product_previous_amount' => 421,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, yellow, top, yellowdresses, summerdresses, summerlook',
                'product_description' => 'Yellow Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 196,
                'product_previous_amount' => 250,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Winter Coats',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, coats, browncoats, brown, blazer, winterlook',
                'product_description' => 'Brown Coats,  available size xxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Cream Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, creamtop, cream, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 498,
                'vendor_id' => 4,
            ]
        );
        Product::create(
            [
                'product_name' => 'Green Shade Wide Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, coats, green, loosetops',
                'product_description' => 'Green Shade wide loose Top for ladies to flaunt their casula looks in this summer',
                'product_amount' => 250,
                'product_previous_amount' => 375,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Black Scarf',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, scarf, blackscarf, blackmuffler, winterlook, winters',
                'product_description' => 'Ethnic Black scarfs for all to make your appearance appealing',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Cap',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, caps, yellowcaps,summerlook, summers',
                'product_description' => 'Yellow Cap to enhance your this summer with your casual looks',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Grey Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, greytop, grey, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Thin Full Sleeve Sweater Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, sweater, orange, white, cream, wintertops, winterdresses, casuallooks',
                'product_description' => 'Thin Full Sleeve Sweater Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 350,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'White Ladies Purse',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, accessories, purse, bag, wallet, womanpurse, white, brownleather, partypurse, partyaccessories',
                'product_description' => 'Leather White purse with brown borders to make your party look amazing',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'Man\'s Yellow Bag',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, bags, yellow, hiking, travelling',
                'product_description' => 'Yellow Bag for Boys with leather covering inside and also waterproof',
                'product_amount' => 700,
                'product_previous_amount' => 900,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Sneakers',
                'product_for' => 'All',
                'product_tags' => 'man, boys, girls,  sneakers, shoes, yellow, sports, casual',
                'product_description' => 'Yellow Sneakers for Boys and Girls easy to wash and comfortable available UK size 6',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Hoodies for Men',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, hoodies, brownhoodies, brown, casual, winterlook',
                'product_description' => 'Man Brown hoodies available size xxl',
                'product_amount' => 356,
                'product_previous_amount' => 400,
                'vendor_id' => 5,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Denim Shirts',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, DenimShirts, Shirts, casual, winterlook',
                'product_description' => 'Man SHirts with Denim essence to makes your winter amazing, available size xxl',
                'product_amount' => 378,
                'product_previous_amount' => 421,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, yellow, top, yellowdresses, summerdresses, summerlook',
                'product_description' => 'Yellow Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 196,
                'product_previous_amount' => 250,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Winter Coats',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, coats, browncoats, brown, blazer, winterlook',
                'product_description' => 'Brown Coats,  available size xxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Cream Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, creamtop, cream, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 498,
                'vendor_id' => 4,
            ]
        );
        Product::create(
            [
                'product_name' => 'Green Shade Wide Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, coats, green, loosetops',
                'product_description' => 'Green Shade wide loose Top for ladies to flaunt their casula looks in this summer',
                'product_amount' => 250,
                'product_previous_amount' => 375,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Black Scarf',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, scarf, blackscarf, blackmuffler, winterlook, winters',
                'product_description' => 'Ethnic Black scarfs for all to make your appearance appealing',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Cap',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, caps, yellowcaps,summerlook, summers',
                'product_description' => 'Yellow Cap to enhance your this summer with your casual looks',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Grey Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, greytop, grey, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Thin Full Sleeve Sweater Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, sweater, orange, white, cream, wintertops, winterdresses, casuallooks',
                'product_description' => 'Thin Full Sleeve Sweater Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 350,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'White Ladies Purse',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, accessories, purse, bag, wallet, womanpurse, white, brownleather, partypurse, partyaccessories',
                'product_description' => 'Leather White purse with brown borders to make your party look amazing',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'Man\'s Yellow Bag',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, bags, yellow, hiking, travelling',
                'product_description' => 'Yellow Bag for Boys with leather covering inside and also waterproof',
                'product_amount' => 700,
                'product_previous_amount' => 900,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Sneakers',
                'product_for' => 'All',
                'product_tags' => 'man, boys, girls,  sneakers, shoes, yellow, sports, casual',
                'product_description' => 'Yellow Sneakers for Boys and Girls easy to wash and comfortable available UK size 6',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Hoodies for Men',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, hoodies, brownhoodies, brown, casual, winterlook',
                'product_description' => 'Man Brown hoodies available size xxl',
                'product_amount' => 356,
                'product_previous_amount' => 400,
                'vendor_id' => 5,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Denim Shirts',
                'product_for' => 'Man',
                'product_tags' => 'man, boys, DenimShirts, Shirts, casual, winterlook',
                'product_description' => 'Man SHirts with Denim essence to makes your winter amazing, available size xxl',
                'product_amount' => 378,
                'product_previous_amount' => 421,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, yellow, top, yellowdresses, summerdresses, summerlook',
                'product_description' => 'Yellow Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 196,
                'product_previous_amount' => 250,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Brown Winter Coats',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, coats, browncoats, brown, blazer, winterlook',
                'product_description' => 'Brown Coats,  available size xxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Cream Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, creamtop, cream, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 498,
                'vendor_id' => 4,
            ]
        );
        Product::create(
            [
                'product_name' => 'Green Shade Wide Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, coats, green, loosetops',
                'product_description' => 'Green Shade wide loose Top for ladies to flaunt their casula looks in this summer',
                'product_amount' => 250,
                'product_previous_amount' => 375,
                'vendor_id' => 7,
            ]
        );
        Product::create(
            [
                'product_name' => 'Black Scarf',
                'product_for' => 'All',
                'product_tags' => 'man, woman, boys, girls, ladies, boys, scarf, blackscarf, blackmuffler, winterlook, winters',
                'product_description' => 'Ethnic Black scarfs for all to make your appearance appealing',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 6,
            ]
        );
        Product::create(
            [
                'product_name' => 'Yellow Cap',
                'product_for' => 'Woman',
                'product_tags' => 'woman, girls, ladies, caps, yellowcaps,summerlook, summers',
                'product_description' => 'Yellow Cap to enhance your this summer with your casual looks',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 2,
            ]
        );
        Product::create(
            [
                'product_name' => 'Grey Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, greytop, grey, summertops, summerdresses',
                'product_description' => 'Cream Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 200,
                'product_previous_amount' => 300,
                'vendor_id' => 1,
            ]
        );
        Product::create(
            [
                'product_name' => 'Thin Full Sleeve Sweater Top',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, sweater, orange, white, cream, wintertops, winterdresses, casuallooks',
                'product_description' => 'Thin Full Sleeve Sweater Top for ladies to flaunt their looks in this summer, available in size xl, xxl, xxxl',
                'product_amount' => 300,
                'product_previous_amount' => 350,
                'vendor_id' => 3,
            ]
        );
        Product::create(
            [
                'product_name' => 'White Ladies Purse',
                'product_for' => 'Woman',
                'product_tags' => 'woman, ladies, girls, accessories, purse, bag, wallet, womanpurse, white, brownleather, partypurse, partyaccessories',
                'product_description' => 'Leather White purse with brown borders to make your party look amazing',
                'product_amount' => 400,
                'product_previous_amount' => 500,
                'vendor_id' => 3,
            ]
        );
    }
}
