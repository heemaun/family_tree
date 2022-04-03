<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person1 = Person::create([
            'name'      => 'A',
            'gender'    => 'Male',
            'father_id'    => null,
            'mother_id'    => null,
        ]);
        $person2 = Person::create([
            'name'      => 'B',
            'gender'    => 'Female',
            'father_id'    => null,
            'mother_id'    => null,
        ]);
        $person1->wife()->attach($person2->id);
        $person3 = Person::create([
            'name'      => 'C',
            'gender'    => 'Male',
            'father_id'    => $person1->id,
            'mother_id'    => $person2->id,
        ]);
    }
}
