<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_firstname' => encrypt(strtolower(fake()->firstName())),
            'customer_lastname' => encrypt(strtolower(fake()->lastName())),
            'customer_middlename' => encrypt(strtolower(fake()->lastName())),
            'email' => encrypt(strtolower(fake()->freeEmail())),
            'customer_gender' => 'Male',
            'contact_person' => encrypt(strtolower(fake()->firstName())),
            'contact_number' => encrypt(strtolower('09'.fake()->unique()->randomNumber(8, true))),
            'country' => 'Philippines',
            'province' => encrypt(strtolower(fake()->word())),
            'city' => encrypt(strtolower(fake()->word())),
            'barangay' => encrypt(strtolower(fake()->word())),
            'zipcode' => fake()->numberBetween($min = 1000, $max = 9000),
            'additional_information' => encrypt(strtolower(fake()->streetAddress())),
            'created_by' => '1',
            'modified_by' => '1',
        ];
    }
}
