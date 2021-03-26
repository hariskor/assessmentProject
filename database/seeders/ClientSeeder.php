<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=>'Taylor','surname'=>'Otwell'),
            array('name'=>'Mohamed','surname'=>'Said'),
            array('name'=>'Jeffrey','surname'=>'Way'),
            array('name'=>'Phill','surname'=>'Sparks')
        );
        Client::insert($data);
        //
    }
}
