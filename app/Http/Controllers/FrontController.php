<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Services\FrontService;
use Illuminate\Support\Facades\Auth;
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
        return view('dashboard', $data);
    }

    public function about(){
        return view('about');
    }

    public function cars(){
        return view('carros');
    }

    public function contact(){
        return view('contacto');
    }

    public function details(Vehicle $vehicle){
        return view('carro-detalhes', compact('vehicle'));
    }

    public function reservaDetalhes(Request $request){
        // dd($request->all());
         return view('reserva-detalhes');

    }
}
