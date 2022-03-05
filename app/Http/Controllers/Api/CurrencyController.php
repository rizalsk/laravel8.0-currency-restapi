<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency as CurrencyModel;
use App\Helpers\Curr as CurrHelper;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\CurrencyCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    
    public function index(){
        $currencies = new CurrencyModel;
        $query = $currencies->query();
        $query->orderBy('date', 'desc'); 
        return new  CurrencyCollection( $query->get() );

    }

    public function show($code){
        $code = strtoupper(Str::slug($code));
        if( $currency = CurrencyModel::where('code', $code)->orderBy('date', 'desc')->first() ){
            return response()->json([
                'status' => 'success',
                'rate' => new CurrencyResource($currency) 
            ],200);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'currency not found'
        ], 500);
    }

    public function fetch($requestDate){
        $data = [];

        try {
            
            $requestDate = Str::slug($requestDate, '-');
            $response = CurrHelper::fetch($requestDate);
            if( isset($response['rates']) ){
                foreach ($response['rates'] as $code => $rate) {
                    $name = CurrHelper::getName($code);
                    $date = $response['date'];

                    $dataCurreny = [
                        'code' => $code,
                        'name' => $name,
                        'rate' => $rate,
                        'date' => $date
                    ];

                    if(!$find = CurrencyModel::whereDate('date','=',"'$date'" )->where('code', $code)->first() ){
                        $data[] = $dataCurreny ;
                        $currency = CurrencyModel::create($dataCurreny); 
                    }
                }
            }
            
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],200);
            return false;
        }

        return response()->json([
            'status' => 'success',
            'message' => count($data).' currencies succesfully inserted',
            'rates' => $data
        ],200);
    }
}
