<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{

     public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.home');
    }


}
