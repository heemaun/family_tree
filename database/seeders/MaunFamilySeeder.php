<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class MaunFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1st generation
        $nakib = Person::create([
            'name'      => 'Nokib Uddin Ahmed',
            'gender'    => 'male',
        ]);


        //2nd generation
        $kutub = Person::create([
            'name'      => 'Kutub Uddin Ahmed',
            'gender'    => 'Male',
            'father_id' => $nakib->id,
        ]);

        $otijan = Person::create([
            'name'      => 'Otijan Begum',
            'gender'    => 'Female',
        ]);
        $otijan->husband()->attach($kutub->id);


        //3rd generation
        $rohoman = Person::create([
            'name'      => 'Abdur Rohman',
            'gender'    => 'Male',
            'father_id' => $kutub->id,
            'mother_id' => $otijan->id,
        ]);

        $mehera = Person::create([
            'name'      => 'Mehera Khatun',
            'gender'    => 'Female',
        ]);
        $mehera->husband()->attach($rohoman);

        $rohomot = Person::create([
            'name'      => 'Abdur Rohmot',
            'gender'    => 'Male',
            'father_id' => $kutub->id,
            'mother_id' => $otijan->id,
        ]);

        $sehera = Person::create([
            'name'      => 'Sehera Khatun',
            'gender'    => 'Female',
        ]);
        $sehera->husband()->attach($rohomot);

        $mohir = Person::create([
            'name'      => 'Mohir Uddin Ahmed',
            'gender'    => 'Male',
            'father_id' => $kutub->id,
            'mother_id' => $otijan->id,
        ]);

        $mofiz = Person::create([
            'name'      => 'Mofiz Uddin Ahmed',
            'gender'    => 'Male',
            'father_id' => $kutub->id,
            'mother_id' => $otijan->id,
        ]);

        $mono = Person::create([
            'name'      => 'Monoara Begum',
            'gender'    => 'Female',
        ]);
        $mono->husband()->attach($mofiz);


        //4th generation
        $barik = Person::create([
            'name'      => 'Abdul Barik',
            'gender'    => 'Male',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $mongoli = Person::create([
            'name'      => 'Mongoli',
            'gender'    => 'Female',
        ]);
        $mongoli->husband()->attach($barik);

        $bulu = Person::create([
            'name'      => 'Mokbul Hossain Bulu',
            'gender'    => 'Male',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $akli = Person::create([
            'name'      => 'Aklima Khatun',
            'gender'    => 'Female',
        ]);
        $akli->husband()->attach($bulu);

        $nur = Person::create([
            'name'      => 'Nur Islam',
            'gender'    => 'Male',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $parvin = Person::create([
            'name'      => 'Rehana Parvin',
            'gender'    => 'Female',
        ]);
        $parvin->husband()->attach($nur);

        $tulu = Person::create([
            'name'      => 'Nuruzzaman Tulu',
            'gender'    => 'Male',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $helen = Person::create([
            'name'      => 'Maksuda Zaman Helen',
            'gender'    => 'Female',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);
        $helen->husband()->attach($tulu);

        $rowshon = Person::create([
            'name'      => 'Rowshon Ara',
            'gender'    => 'Female',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $shamshul = Person::create([
            'name'      => 'Shamshul Islam',
            'gender'    => 'Male',
        ]);
        $rowshon->husband()->attach($shamshul);

        $rokeya = Person::create([
            'name'      => 'Rokeya Khatun',
            'gender'    => 'Female',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $fojlar = Person::create([
            'name'      => 'Fozlar Rohman',
            'gender'    => 'Male',
        ]);
        $rokeya->husband()->attach($fojlar);

        $kulsum = Person::create([
            'name'      => 'Kulsum Begum',
            'gender'    => 'Female',
            'father_id' => $rohoman->id,
            'mother_id' => $mehera->id,
        ]);

        $mortuza = Person::create([
            'name'      => 'Mortuza Al Khan',
            'gender'    => 'Male',
        ]);
        $kulsum->husband()->attach($mortuza);

        $tofazzel = Person::create([
            'name'      => 'Tofazzel Hossain',
            'gender'    => 'Male',
            'father_id' => $rohomot->id,
            'mother_id' => $sehera->id,
        ]);

        $dulari = Person::create([
            'name'      => 'Dulari Begum',
            'gender'    => 'Female',
        ]);
        $dulari->husband()->attach($tofazzel);

        $shohidul = Person::create([
            'name'      => 'Shohidul Islam',
            'gender'    => 'Male',
            'father_id' => $rohomot->id,
            'mother_id' => $sehera->id,
        ]);

        $parvin2 = Person::create([
            'name'      => 'Rehana Parvin',
            'gender'    => 'Female',
        ]);
        $parvin2->husband()->attach($shohidul);

        $azizul = Person::create([
            'name'      => 'Azizul Islam',
            'gender'    => 'Male',
            'father_id' => $rohomot->id,
            'mother_id' => $sehera->id,
        ]);

        $meherun = Person::create([
            'name'      => 'Meherun Parvin',
            'gender'    => 'Female',
            'father_id' => $mohir->id,
        ]);
        $meherun->husband()->attach($azizul);

        $taleb = Person::create([
            'name'      => 'Taleb Hossain',
            'gender'    => 'Male',
            'father_id' => $rohomot->id,
            'mother_id' => $sehera->id,
        ]);

        $rehana = Person::create([
            'name'      => 'Rehana',
            'gender'    => 'Female',
            'father_id' => $rohomot->id,
            'mother_id' => $sehera->id,
        ]);

        $sojol = Person::create([
            'name'      => 'Sojol',
            'gender'    => 'Male',
        ]);
        $rehana->husband()->attach($sojol);

        $mojammel = Person::create([
            'name'      => 'Mojammel Hossain',
            'gender'    => 'Male',
            'father_id' => $mohir->id,
        ]);

        $saheba = Person::create([
            'name'      => 'Saheba Khatun',
            'gender'    => 'Female',
        ]);
        $saheba->husband()->attach($mojammel);

        //----------------------------------------------------

        $hasan = Person::create([
            'name'      => 'Hasan Ali',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $kohinur = Person::create([
            'name'      => 'Kohinur Begum',
            'gender'    => 'Female',
        ]);
        $kohinur->husband()->attach($hasan);

        $hossain = Person::create([
            'name'      => 'Hossain Ali',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $nilu = Person::create([
            'name'      => 'Nilufar Yasmin',
            'gender'    => 'Female',
        ]);
        $nilu->husband()->attach($hossain);

        $habib = Person::create([
            'name'      => 'Habibur Rohman',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $rina = Person::create([
            'name'      => 'Mahfuza Akter Rina',
            'gender'    => 'Female',
        ]);
        $rina->husband()->attach($habib);

        $hamidur = Person::create([
            'name'      => 'Hamidur Rohman',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $tuni = Person::create([
            'name'      => 'Maksuda Aktar Tuni',
            'gender'    => 'Female',
        ]);
        $tuni->husband()->attach($hamidur);

        $hannan = Person::create([
            'name'      => 'Abdul Hannan',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $surovi = Person::create([
            'name'      => 'Mahmuda Aktar Surovi',
            'gender'    => 'Female',
        ]);
        $surovi->husband()->attach($hannan);

        $harun = Person::create([
            'name'      => 'Harun Ur Roshid',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $lipi = Person::create([
            'name'      => 'Masuma Yasmin Lipi',
            'gender'    => 'Female',
        ]);
        $lipi->husband()->attach($harun);

        $hariz = Person::create([
            'name'      => 'Mahbub Alam Hariz',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $suraiya = Person::create([
            'name'      => 'Suraiya Begum',
            'gender'    => 'Female',
        ]);
        $suraiya->husband()->attach($hariz);

        $hanif = Person::create([
            'name'      => 'Monoar Hossain Hanif',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $yasmin = Person::create([
            'name'      => 'Nilufar Yasmin',
            'gender'    => 'Female',
        ]);
        $yasmin->husband()->attach($hanif);

        $hiru = Person::create([
            'name'      => 'Mijanur Rohman Hiru',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $baby = Person::create([
            'name'      => 'Baby',
            'gender'    => 'Female',
        ]);
        $baby->husband()->attach($hiru);

        $mamun = Person::create([
            'name'      => 'Mamun Ur Roshid',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $moon = Person::create([
            'name'      => 'Khatamun',
            'gender'    => 'Female',
        ]);
        $moon->husband()->attach($mamun);

        $mithun = Person::create([
            'name'      => 'Mokarom Hossain Mithun',
            'gender'    => 'Male',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $pingky = Person::create([
            'name'      => 'Pingky',
            'gender'    => 'Female',
        ]);
        $pingky->husband()->attach($mithun);

        $husna = Person::create([
            'name'      => 'Husne Ara',
            'gender'    => 'Female',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $mohshin = Person::create([
            'name'      => 'Mohshin Reza',
            'gender'    => 'Male',
        ]);
        $husna->husband()->attach($mohshin);

        $mamoni = Person::create([
            'name'      => 'Mahfuza Ferdousi Mamoni',
            'gender'    => 'Female',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $dalim = Person::create([
            'name'      => 'Masud Parvez Dalim',
            'gender'    => 'Male',
        ]);
        $mamoni->husband()->attach($dalim);

        $noyonmoni = Person::create([
            'name'      => 'Mahmuda Ferdousi Noyonmoni',
            'gender'    => 'Female',
            'father_id' => $mofiz->id,
            'mother_id' => $mono->id,
        ]);

        $rokon = Person::create([
            'name'      => 'Roknuzzaman',
            'gender'    => 'Male',
        ]);
        $noyonmoni->husband()->attach($rokon);
    }
}
