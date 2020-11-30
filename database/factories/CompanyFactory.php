<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
class CompanyFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Company::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->sentence,
      'status' =>$this->faker->randomElement([0,1]),
      'wepsite' =>$this->faker->url,
      'email' =>$this->faker->email,
    ];
  }
}
