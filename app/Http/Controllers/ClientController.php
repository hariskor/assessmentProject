<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        //no dates added
        if(!(isset($request->startDate) && isset($request->endDate))){
            $clients = Client::all();
            return view('client.index',['clients'=>$clients]);    
        }

        //with date parameters

        //form validation
        $validated = $request->validate([
            'startDate' => 'date',
            'endDate' => 'date | after:startDate',
            //
        ]);
        
        $startDate = Carbon::minValue();
        $endDate = Carbon::maxValue();
        
        $clients = Client::whereHas('payments', function(Builder $q) use ($request){
            if($request->startDate){
                $startDate = $request->startDate;
                $q->where('created_at','>=',$startDate);
                
            }    
            if($request->endDate){
                $endDate = $request->endDate;
                $q->where('created_at','<=',$endDate);
            }    
        })->get();
        
        foreach($clients as $client){
            $client->payment = $client->latestPayment($startDate,$endDate);
        }

        return view('client.index',['clients'=>$clients]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
