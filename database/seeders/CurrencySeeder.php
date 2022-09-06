<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'http://api.nbp.pl/api/exchangerates/tables/A';

        $response = json_decode(Http::get($url), true);
       
        $currency = $response[0]["rates"];

        foreach ($currency as $item) 
        {
            Currency::create([
                'name'=>$item['currency'],
                'code'=>$item['code']
            ]);
           
        }
    }
}
