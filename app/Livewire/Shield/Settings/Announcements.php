<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Announcements extends Component
{
    use WithPagination;

    public $showModal = false;
    public $confirmingDeletion = false;
    public $isEditing = false;
    public $currentId = null;

    #[Rule('required|min:3|max:255')]
    public $title = '';

    #[Rule('required|min:3')]
    public $message = '';

    #[Rule('nullable|date')]
    public $announcement_date = '';

    public $is_published = false;
    public $search = '';

    protected $queryString = ['search'];

    public function mount()
    {
        $this->announcement_date = now()->format('Y-m-d');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset(['title', 'message', 'is_published', 'currentId', 'isEditing']);
        $this->announcement_date = now()->format('Y-m-d');
        $this->showModal = true;
    }

    public function edit(Announcement $announcement)
    {
        $this->isEditing = true;
        $this->currentId = $announcement->id;
        $this->title = $announcement->title;
        $this->message = $announcement->message;
        $this->announcement_date = $announcement->announcement_date?->format('Y-m-d') ?? now()->format('Y-m-d');
        $this->is_published = $announcement->is_published;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $announcement = Announcement::findOrFail($this->currentId);
            $announcement->update([
                'title' => $this->title,
                'message' => $this->message,
                'announcement_date' => $this->announcement_date,
                'is_published' => $this->is_published,
            ]);

            $this->dispatch('announce', [
                'type' => 'success',
                'message' => 'Announcement updated successfully!'
            ]);
        } else {
            Announcement::create([
                'title' => $this->title,
                'message' => $this->message,
                'announcement_date' => $this->announcement_date,
                'is_published' => $this->is_published,
            ]);

            $this->dispatch('announce', [
                'type' => 'success',
                'message' => 'Announcement created successfully!'
            ]);
        }

        $this->reset(['title', 'message', 'is_published', 'currentId', 'isEditing', 'showModal']);
    }

    public function confirmDelete(Announcement $announcement)
    {
        $this->currentId = $announcement->id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        $announcement = Announcement::findOrFail($this->currentId);
        $announcement->delete();
        
        $this->confirmingDeletion = false;
        $this->currentId = null;
        
        $this->dispatch('announce', [
            'type' => 'success',
            'message' => 'Announcement deleted successfully!'
        ]);
    }

    public function togglePublish(Announcement $announcement)
    {
        $announcement->update([
            'is_published' => !$announcement->is_published
        ]);

        $status = $announcement->is_published ? 'published' : 'unpublished';
        
        $this->dispatch('announce', [
            'type' => 'success',
            'message' => "Announcement {$status} successfully!"
        ]);
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->currentId = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmingDeletion = false;
        $this->reset(['title', 'message', 'is_published', 'currentId', 'isEditing']);
    }

    public function render()
    {
        $announcements = Announcement::query()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('message', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.shield.settings.announcements', [
            'announcements' => $announcements
        ])->layout('shield.layouts.shield');
    }
}