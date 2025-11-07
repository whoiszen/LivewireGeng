<?php

namespace App\Livewire\Renters;

use App\Models\Room;
use Livewire\Component;

class RenterList extends Component
{
    public $rooms;
    public $searchQuery = '';
    public $filterType = 'all'; // 'all', 'shared', 'private'
    private $roomImages = ['pic1.jpeg', 'pic2.jpeg', 'pic3.jpeg', 'pic4.jpeg'];

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms()
    {
        $query = Room::with('renter')
            ->when($this->searchQuery, function ($q) {
                $q->where('room_number', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('price', 'like', '%' . $this->searchQuery . '%');
            })
            ->when($this->filterType !== 'all', function ($q) {
                $q->where('capacity', $this->filterType === 'shared' ? '>' : '=', 1);
            });

        $this->rooms = $query->get();
    }

    public function updatedSearchQuery()
    {
        $this->loadRooms();
    }

    public function updatedFilterType()
    {
        $this->loadRooms();
    }

    public function getRoomImage($index)
    {
        return $this->roomImages[$index % count($this->roomImages)];
    }
    public function render()
    {
        return view('livewire.renters.renter-list');
    }
}
