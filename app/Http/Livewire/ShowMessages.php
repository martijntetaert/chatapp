<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowMessages extends Component
{
    public function getListeners()
    {
        return [
            "ably:test" => 'test',

        ];
    }

    public function test(){
        dd('test');
    }

    public function render()
    {
        return view('livewire.show-messages');
    }
}
