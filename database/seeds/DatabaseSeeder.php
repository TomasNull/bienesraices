<?php

use App\Role;
use App\User;
use App\Agent;
use App\Category;
use App\Client;
use App\RealEstate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('realestates');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('realestates');
        Storage::makeDirectory('users');

        factory(Role::class, 1)->create(['name' => 'admin']);
        factory(Role::class, 1)->create(['name' => 'agent']);
        factory(Role::class, 1)->create(['name' => 'client']);

        factory(User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => Role::ADMIN
        ])
        ->each(function(User $u) {
            factory(Client::class, 1)->create(['user_id' => $u->id]);
        });

        factory(User::class, 20)->create([
            'role_id' => Role::CLIENT
        ])
            ->each(function(User $u) {
                factory(Client::class, 1)->create(['user_id' => $u->id]);
            });

        factory(User::class, 5)->create([
            'role_id' => Role::AGENT
        ])
            ->each(function(User $u) {
                factory(Client::class, 1)->create(['user_id' => $u->id]);
                factory(Agent::class, 1)->create(['user_id' => $u->id]);
            });

        factory(Category::class, 3)->create();

        factory(RealEstate::class, 30)->create();
    }
}
