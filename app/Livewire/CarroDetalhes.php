<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class CarroDetalhes extends Component
{

     public $vehicle;

    public function mount($id)
    {
        $this->vehicle = Vehicle::with(['model', 'model.category'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.carro-detalhes', [
            'vehicle' => $this->vehicle
        ])->layout('layouts.app'); // ou o layout que você usa;
    }

}
