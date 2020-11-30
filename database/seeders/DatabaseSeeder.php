<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Empolyee;
use App\Models\Company;
use App\Models\Photo;
use Illuminate\Support\Str;
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
    User::create([
      'name' => 'Eman Hamdy',
      'email' => 'admin@company.com',
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'is_super' => 1,
      'remember_token' => Str::random(10),
    ]);

    for($i=0;$i<30;$i++){
     $company = Company::factory()->create();
     Photo::factory()->create(['photoable_id' => $company->id
     ,'photoable_type' => 'App\Models\Company']);
    }

    for($i=0;$i<60;$i++){
     $empolyees = Empolyee::factory()->create();
     Photo::factory()->create(['photoable_id' => $empolyees->id
     ,'photoable_type' => 'App\Models\Empolyee']);
    }
  }
}
