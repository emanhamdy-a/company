<?php

namespace Database\Factories;

use App\Models\Empolyee;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpolyeeFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Empolyee::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'first_name' => $this->faker->firstName,
      'last_name' =>  $this->faker->lastName,
      'status' =>  $this->faker->randomElement([0,1]),
      'phone' =>  $this->faker->phoneNumber,
      'email' =>  $this->faker->unique()->safeEmail,
      'company_id' => Company::all()->random()->id,
    ];
  }
}
