<?php

namespace Database\Factories;
use Illuminate\Http\File;
use App\Models\Photo;
use App\Models\Empolyee;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
class PhotoFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Photo::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

    $image = $this->faker->image();
    $imageFile = new File($image);

    return [
      'filename' => Storage::disk('public')->putFile('images', $imageFile),
      'photoable_id' => '1',
      'photoable_type' => ' ',
    ];
  }
}
