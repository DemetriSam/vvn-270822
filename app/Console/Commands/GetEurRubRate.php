<?php

namespace App\Console\Commands;

use App\Models\Rate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetEurRubRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_euro_rub_rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get actual Euro Rub Rate';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $rate = $client
            ->request('GET', 'https://api.coingate.com/v2/rates/merchant/EUR/RUB')
            ->getBody()->getContents();

        $rate *= 1.025;
        $rate = round($rate, 2);

        $record = Rate::firstWhere('currency', 'eur');
        if ($record) {
            $record->rate = $rate;
            $record->save();
        } else {
            $record = Rate::create([
                'currency' => 'eur',
                'rate' => $rate,
            ]);
        }
    }
}
