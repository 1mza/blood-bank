<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Governorate;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dropdowns extends Component
{
    public $selectedGovernorate;
    public $selectedCity;

    #[Computed()]
    public function governorates()
    {
        return Governorate::all();
    }

    #[Computed()]
    public function cities()
    {
        return City::where('governorate_id', $this->selectedGovernorate)->get();
    }

    public function render()
    {
        return view('livewire.dropdowns');
    }
    public function mount()
    {
        if (auth('web-clients')->check()) {
            $this->selectedGovernorate = auth('web-clients')->user()->mainGovernorate->id;
            $this->selectedCity = auth('web-clients')->user()->city->id;
        }
    }

}
