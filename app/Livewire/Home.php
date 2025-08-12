<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Repositories\VehicleRepository; // importa o repositório

class Home extends Component
{
    protected $vehicleRepository;

    // Injeção do repositório no Livewire
    public function mount(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function render()
    {
        $vehicles = $this->vehicleRepository->getAllVehicles();

        return view('livewire.home', [
            'vehicles' => $vehicles, // passa os dados reais
        ]);
    }
}
