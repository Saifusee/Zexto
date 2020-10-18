<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableDataSeeder::class);
        $this->call(BlogsTableDataSeeder::class);
        $this->call(BlogsCommentsTableDataSeeder::class);
        $this->call(ProductsTableDataSeeder::class);
        $this->call(OrdersTableDataSeeder::class);
        $this->call(OrderProductTableDataSeeder::class);
    }
}
