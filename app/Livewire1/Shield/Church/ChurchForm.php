<?php

namespace App\Livewire\Shield\Church;

use Livewire\Component;
use App\Models\Church;
use App\Models\Cluster;
use App\Models\Region;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChurchForm extends Component
{
    use WithFileUploads;

    public $churchId = null;
    public $name;
    public $region_id;
    public $cluster_id;
    public $thumbnail;
    public $existing_thumbnail;
    public $google_map_iframe;
    public $address;
    public $phone;
    public $email; 
    public $church_leader_user_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'region_id' => 'required|exists:regions,id',
        'cluster_id' => 'required|exists:clusters,id',
        'thumbnail' => 'nullable|image|max:1024',
        'google_map_iframe' => 'required|string',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'church_leader_user_id' => 'required|exists:users,id',
    ];

    public function mount($churchId = null)
    {
        if ($churchId && $churchId !== 'new') {
            $this->churchId = $churchId;
            $this->loadChurchData();
        }
    }

    public function loadChurchData()
    {
        $church = Church::find($this->churchId);
        
        if (!$church) {
            // Handle the case where church is not found
            $this->dispatch('notify', ['message' => 'Church not found!', 'type' => 'error']);
            return;
        }
        
        $this->name = $church->name;
        $this->region_id = $church->region_id;
        $this->cluster_id = $church->cluster_id;
        $this->existing_thumbnail = $church->thumbnail;
        $this->google_map_iframe = $church->google_map_iframe;
        $this->address = $church->address;
        $this->phone = $church->phone;
        $this->email = $church->email;
        $this->church_leader_user_id = $church->church_leader_user_id;
    }

    public function saveChurch()
    {
        $this->validate();

        $thumbnailPath = $this->existing_thumbnail;
        
        if ($this->thumbnail) {
            if ($this->existing_thumbnail) {
                Storage::disk('public')->delete($this->existing_thumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('thumbnails', 'public');
        }

        Church::updateOrCreate(
            ['id' => $this->churchId !== 'new' ? $this->churchId : null],
            [
                'name' => $this->name,
                'region_id' => $this->region_id,
                'cluster_id' => $this->cluster_id,
                'thumbnail' => $thumbnailPath,
                'google_map_iframe' => $this->google_map_iframe,
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
                'church_leader_user_id' => $this->church_leader_user_id,
            ]
        );

        $this->dispatch('notify', ['message' => 'Church saved successfully!']);
        $this->resetForm();
        $this->dispatch('churchSave d'); 
    }

    public function resetForm()
    {
        $this->name = '';
        $this->region_id = null;
        $this->cluster_id = null;
        $this->thumbnail = null;
        $this->existing_thumbnail = null;
        $this->google_map_iframe = '';
        $this->address = '';
        $this->phone = '';
        $this->email = '';
        $this->church_leader_user_id = null;
    }

    public function render()
    {
        $regions = Region::all();
        $clusters = Cluster::all();
        $users = User::all();

        return view('livewire.shield.church.church-form', compact('regions', 'clusters', 'users'));
    }
}