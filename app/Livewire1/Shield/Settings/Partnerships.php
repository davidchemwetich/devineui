<?php

namespace App\Livewire\Shield\Settings;

use App\Models\Partnership;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Partnerships extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Form properties
    public $partnership_id;
    public $name;
    public $url;
    public $logo;
    public $image;
    public $description;
    public $is_active = true;
    public $partnership_type;

    // Temporary file uploads
    public $temp_logo;
    public $temp_image;

    // UI state
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Define partnership types
    public $partnershipTypes = [
        'strategic' => 'Strategic Partner',
        'technology' => 'Technology Partner',
        'implementation' => 'Implementation Partner',
        'reseller' => 'Reseller',
        'distributor' => 'Distributor',
        'referral' => 'Referral Partner',
        'sponsor' => 'Sponsor',
        'academic' => 'Academic Collaboration',
        'research' => 'Research Collaboration',
        'other' => 'Other',
    ];

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'temp_logo' => 'nullable|image|max:1024',
            'temp_image' => 'nullable|image|max:1024',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'partnership_type' => 'nullable|string|max:255',
        ];
    }

    public function mount()
    {
        // Initialize with default values if needed
    }

    public function render()
    {
        $partnerships = Partnership::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('partnership_type', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.shield.settings.partnerships', [
            'partnerships' => $partnerships,
        ]);
    }

    // Rest of the methods remain the same
    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $this->partnership_id = $id;
        $partnership = Partnership::findOrFail($id);
        $this->name = $partnership->name;
        $this->url = $partnership->url;
        $this->logo = $partnership->logo;
        $this->image = $partnership->image;
        $this->description = $partnership->description;
        $this->is_active = $partnership->is_active;
        $this->partnership_type = $partnership->partnership_type;
        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->partnership_id = $id;
        $this->showDeleteModal = true;
    }

    public function resetForm()
    {
        $this->reset([
            'partnership_id', 'name', 'url', 'logo', 'image',
            'description', 'is_active', 'partnership_type',
            'temp_logo', 'temp_image'
        ]);
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'partnership_type' => $this->partnership_type,
        ];

        // Handle logo upload
        if ($this->temp_logo) {
            $logoPath = $this->temp_logo->store('partnerships/logos', 'public');
            $data['logo'] = $logoPath;
        }

        // Handle image upload
        if ($this->temp_image) {
            $imagePath = $this->temp_image->store('partnerships/images', 'public');
            $data['image'] = $imagePath;
        }

        Partnership::create($data);

        $this->showCreateModal = false;
        $this->resetForm();
        $this->dispatch('partnership-created');
    }

    public function update()
    {
        $this->validate();

        $partnership = Partnership::findOrFail($this->partnership_id);

        $data = [
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'partnership_type' => $this->partnership_type,
        ];

        // Handle logo upload
        if ($this->temp_logo) {
            // Delete old logo if exists
            if ($partnership->logo && Storage::disk('public')->exists($partnership->logo)) {
                Storage::disk('public')->delete($partnership->logo);
            }
            $logoPath = $this->temp_logo->store('partnerships/logos', 'public');
            $data['logo'] = $logoPath;
        }

        // Handle image upload
        if ($this->temp_image) {
            // Delete old image if exists
            if ($partnership->image && Storage::disk('public')->exists($partnership->image)) {
                Storage::disk('public')->delete($partnership->image);
            }
            $imagePath = $this->temp_image->store('partnerships/images', 'public');
            $data['image'] = $imagePath;
        }

        $partnership->update($data);

        $this->showEditModal = false;
        $this->resetForm();
        $this->dispatch('partnership-updated');
    }

    public function delete()
    {
        $partnership = Partnership::findOrFail($this->partnership_id);

        // Delete associated files
        if ($partnership->logo && Storage::disk('public')->exists($partnership->logo)) {
            Storage::disk('public')->delete($partnership->logo);
        }

        if ($partnership->image && Storage::disk('public')->exists($partnership->image)) {
            Storage::disk('public')->delete($partnership->image);
        }

        $partnership->delete();
        $this->showDeleteModal = false;
        $this->resetForm();
        $this->dispatch('partnership-deleted');
    }

    public function toggleActive($id)
    {
        $partnership = Partnership::findOrFail($id);
        $partnership->update([
            'is_active' => !$partnership->is_active
        ]);
    }
}