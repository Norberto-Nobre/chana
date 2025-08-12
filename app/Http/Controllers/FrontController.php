<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Services\FrontService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $frontService;

     public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function index(){

        $data = $this->frontService->getFrontPageData();
        /*dd($data); */
        return view('mycount', $data);
    }

    public function details(Vehicle $vehicle){
        return view('carro-detalhes', compact('vehicle'));
    }

    public function reservaDetalhes(Request $request){
        // dd($request->all());
         return view('reserva-detalhes');
        
    }
}
