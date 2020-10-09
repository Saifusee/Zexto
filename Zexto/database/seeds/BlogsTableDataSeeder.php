<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'blog_title' => 'The Personality Trait That Makes People Happier.',
            'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                             labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                             laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                             amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                             aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                             et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                             nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                             consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                             aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                             ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                               they're basically good and smart, and if you give them tools, they'll do wonderful
                               things with them.”",
            'blog_quote_author' => 'Steven Jobs',
            'blog_status' => 'Disapproved',
            'blog_main_image' => '0_blog-1.jpg',
            'blog_sub_image_1' => '0_blog-1.jpg',
            'blog_sub_image_2' => '0_blog-1.jpg',
            'blog_sub_image_3' => '0_blog-1.jpg',
            'category_tag' => 'Travel',
            'product_tags' => '',
            'user_id' => 6,
        ]);

        Blog::create([
            'blog_title' => 'This was one of our first days in Hawaii last week.',
            'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                             labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                             laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                             amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                             aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                             et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                             nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                             consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                             aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                             ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                               they're basically good and smart, and if you give them tools, they'll do wonderful
                               things with them.”",
            'blog_quote_author' => 'Steven Jobs',
            'blog_status' => 'Approved',
            'blog_main_image' => '0_blog-2.jpg',
            'blog_sub_image_1' => '0_blog-2.jpg',
            'blog_sub_image_2' => '0_blog-2.jpg',
            'blog_sub_image_3' => '0_blog-2.jpg',
            'category_tag' => 'Fashion',
            'product_tags' => '',
            'user_id' => 2,
        ]);

        Blog::create([
            'blog_title' => 'Last week I had my first work trip of the year to Sonoma Valley.',
            'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                             labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                             laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                             amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                             aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                             et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                             nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                             consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                             aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                             ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                               they're basically good and smart, and if you give them tools, they'll do wonderful
                               things with them.”",
            'blog_quote_author' => 'Steven Jobs',
            'blog_status' => 'Approved',
            'blog_main_image' => '0_blog-3.jpg',
            'blog_sub_image_1' => '0_blog-3.jpg',
            'blog_sub_image_2' => '0_blog-3.jpg',
            'blog_sub_image_3' => '0_blog-3.jpg',
            'category_tag' => 'Fashion',
            'product_tags' => '',
            'user_id' => 2,
        ]);

        Blog::create([
            'blog_title' => 'Happy New Year! I know I am a little late on this post.',
            'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                             labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                             laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                             amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                             aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                             et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                             nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                             consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                             aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                             ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                               they're basically good and smart, and if you give them tools, they'll do wonderful
                               things with them.”",
            'blog_quote_author' => 'Steven Jobs',
            'blog_status' => 'Disapproved',
            'blog_main_image' => '0_blog-4.jpg',
            'blog_sub_image_1' => '0_blog-4.jpg',
            'blog_sub_image_2' => '0_blog-4.jpg',
            'blog_sub_image_3' => '0_blog-4.jpg',
            'category_tag' => 'Model',
            'product_tags' => '',
            'user_id' => 6,
            ]);

            Blog::create([
                'blog_title' => 'Absolue collection. The Lancome team has been one…',
                'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
                'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
                'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                                    they're basically good and smart, and if you give them tools, they'll do wonderful
                                    things with them.”",
                'blog_quote_author' => 'Steven Jobs',
                'blog_status' => 'Approved',
                'blog_main_image' => '0_blog-5.jpg',
                'blog_sub_image_1' => '0_blog-5.jpg',
                'blog_sub_image_2' => '0_blog-5.jpg',
                'blog_sub_image_3' => '0_blog-5.jpg',
                'category_tag' => 'Travel',
                'product_tags' => '',
                'user_id' => 2,
            ]);
        
        Blog::create([
            'blog_title' => 'Writing has always been kind of therapeutic for me.',
            'blog_data_1' => "psum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                             labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                             laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit
                             amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                             magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                             aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_data_2' => "Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                             et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                             nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                             consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                             aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                             ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.",
            'blog_quote' => "“ Technology is nothing. What's important is that you have a faith in people, that
                               they're basically good and smart, and if you give them tools, they'll do wonderful
                               things with them.”",
            'blog_quote_author' => 'Steven Jobs',
            'blog_status' => 'Disapproved',
            'blog_main_image' => '0_blog-6.jpg',
            'blog_sub_image_1' => '0_blog-6.jpg',
            'blog_sub_image_2' => '0_blog-6.jpg',
            'blog_sub_image_3' => '0_blog-6.jpg',
            'category_tag' => 'Travel',
            'product_tags' => '',
            'user_id' => 6,
        ]);
    }
}
