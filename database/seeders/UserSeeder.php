<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [];
    $faker = Factory::create();
    for ($i = 0; $i < 30; $i++) {
      $users[] = [
        'id'          => Str::uuid(),
        'name'        => $faker->name,
        'email'       => $faker->unique()->safeEmail,
        'phone'       => $faker->numerify('##########'),
        'gender'      => $faker->randomElement(['male', 'female']),
        'social_id'   => $faker->unique()->numerify,
        'social_type' => 'google',
        'is_active'   => '1',
        'created_by'  => Str::uuid(),
        'updated_by'  => Str::uuid(),
        'created_at'  => now(),
        'updated_at'  => now(),
      ];
    }
    User::insert($users);
  }
}
