<?php

use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $banks = [
            'Access Bank Plc',
            'Afri Bank Plc ',
            'CitiBank ',
            'Diamond Bank',
            'EcoBank Nigeria',
            'FCMB ',
            'Fidelity Bank',
            'First Bank Nigeria',
            'GTB ',
            'Heritage Bank ',
            'Keystone Bank',
            'Skye Bank',
            'Stanbic IBTC Bank',
            'Standard Chartered',
            'Sterling Bank',
            'UBA ',
            'Union Bank',
            'Unity Bank',
            'Zenith Bank ',
            'United Bank for Africa',
            'Wema Bank Plc'
        ];
        $bankCounts = count($banks);
        for ($num = 0; $num < $bankCounts; $num++) {
            \App\Bank::create([
                'name' => $banks[$num],
            ]);
        }
    }
}

