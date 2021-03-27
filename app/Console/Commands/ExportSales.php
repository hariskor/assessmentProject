<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExportSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $clients = Client::whereHas('payments', function($q){
            $q->where('created_at', '>=', Carbon::now()->subDays(30));
        })->get();

        foreach($clients as $client){
            $client->payment = $client->latestPayment(Carbon::now()->subDays(30),Carbon::now());
        }

        $columns = array('name','surname','amount','date');

        $file = fopen('./storage/app/report.'.now().'.csv', 'w');
        fputcsv($file, $columns);


        foreach($clients as $client){
            $row['name']=$client->name;
            $row['surname']=$client->surname;
            $row['amount']=$client->payment->amount;
            $row['date']=$client->payment->created_at;
            
            fputcsv($file, array($row['name'], $row['surname'], $row['amount'], $row['date']));

        }
        fclose($file);

        return 0;

    }
}
