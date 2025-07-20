<?php

namespace App\Livewire\Frontend\Ministry;

use App\Models\Ministry;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MinistryShowcase extends Component
{
    use WithPagination;
    
    public $ministryId = null;
    public $searchTerm = '';
    public $showDetailPage = false;
    
    public function mount($id = null)
    {
        if ($id) {
            $this->ministryId = $id;
            $this->showDetailPage = true;
        }
    }
    
    public function viewMinistry($id)
    {
        $this->ministryId = $id;
        $this->showDetailPage = true;
        
        // Update URL without page refresh for better SEO and sharing
        $this->dispatch('urlChange', ['url' => route('ministries.show', $id)]);
    }
    
    public function backToList()
    {
        $this->showDetailPage = false;
        $this->ministryId = null;
        
        // Update URL without page refresh
        $this->dispatch('urlChange', ['url' => route('ministries.index')]);
    }
    
    public function render()
    {
        if ($this->showDetailPage && $this->ministryId) {
            $ministry = Ministry::with('leader')->findOrFail($this->ministryId);
            return view('livewire.frontend.ministry.ministry-detail', [
                'ministry' => $ministry,
            ])->layout('front.layouts.front-layout');
        }
        
        $ministries = Ministry::when($this->searchTerm, function($query) {
            return $query->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
        })->paginate(9);
        
        return view('livewire.frontend.ministry.ministry-showcase', [
            'ministries' => $ministries,
        ])->layout('front.layouts.front-layout');
    }
}