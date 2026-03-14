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
        $this->call([
            AdminUserSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            RoleMenuSeeder::class,
            UserRoleSeeder::class,
            SubKategoriSeeder::class,
            ArtikelSeeder::class,
            ProdukSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
