<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class Media extends Component
{
    public function render()
    {
        return view('livewire.backend.media.media2');
    }

    public function detail($id)
    {
        return view('livewire.backend.media.details');
    }
    
    public function create()
    {
        return view('livewire.backend.media.create');
    }

    public function edit($id)
    {
        return view('livewire.backend.media.edit');
    }

    public function update()
    {

    }

    public function destroy($id)
    {

    }

}
