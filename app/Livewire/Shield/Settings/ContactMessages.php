<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use App\Models\ContactMessage;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ContactMessages extends Component
{

    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $filter = 'all';

    public $selectedMessages = [];
    public $selectAll = false;

    // For modal
    public $showMessageModal = false;
    public $currentMessage = null;
    // For reply modal
    public $showReplyModal = false;
    public $replyContent = '';
    public $replySubject = '';

    // For filters
    public $dateRange = null;
    public $priorityFilter = 'all';
    public $statusFilter = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'filter' => ['except' => 'all'],
        'priorityFilter' => ['except' => 'all'],
        'statusFilter' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refresh' => '$refresh',
        'deleteConfirmed' => 'bulkDelete',
    ];

    public function mount()
    {
        $this->dateRange = now()->subDays(30)->format('Y-m-d') . ' to ' . now()->format('Y-m-d');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedMessages = $this->getFilteredMessages()
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedMessages = [];
        }
    }

    public function updatedSelectedMessages()
    {
        $this->selectAll = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function viewMessage(ContactMessage $message)
    {
        $this->currentMessage = $message;
        $this->showMessageModal = true;

        if (!$message->isRead()) {
            $message->markAsRead();
        }

        // Pre-populate reply fields
        $this->replySubject = "RE: {$message->subject}";
    }

    public function closeMessage()
    {
        $this->showMessageModal = false;
        $this->currentMessage = null;
        $this->resetPage();
        $this->dispatch('message-read');
    }

    public function showReply(ContactMessage $message)
    {
        $this->currentMessage = $message;
        $this->replySubject = "RE: {$message->subject}";
        $this->replyContent = "\n\n\n---------------------\nOriginal message from {$message->name} ({$message->email}):\n{$message->message}";
        $this->showReplyModal = true;
    }

    public function sendReply()
    {
        $this->validate([
            'replySubject' => 'required|min:2',
            'replyContent' => 'required|min:5',
        ]);

        // Here you would typically send the actual email
        // For demonstration, we'll just update the status

        $this->currentMessage->update([
            'status' => 'replied'
        ]);

        // Log the reply in your system or another table if needed

        $this->showReplyModal = false;
        $this->replyContent = '';
        $this->replySubject = '';
        $this->dispatch('reply-sent', 'Your reply has been sent successfully!');
    }

    public function markAsRead($id)
    {
        ContactMessage::findOrFail($id)->markAsRead();
        $this->dispatch('message-status-updated');
    }

    public function markAsUnread($id)
    {
        ContactMessage::findOrFail($id)->markAsUnread();
        $this->dispatch('message-status-updated');
    }

    public function bulkMarkAsRead()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected');
            return;
        }

        ContactMessage::whereIn('id', $this->selectedMessages)
            ->update(['read_at' => now(), 'status' => 'read']);

        $this->selectedMessages = [];
        $this->dispatch('success', count($this->selectedMessages) . ' messages marked as read');
    }

    public function bulkMarkAsUnread()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected');
            return;
        }

        ContactMessage::whereIn('id', $this->selectedMessages)
            ->update(['read_at' => null, 'status' => 'unread']);

        $this->selectedMessages = [];
        $this->dispatch('success', count($this->selectedMessages) . ' messages marked as unread');
    }

    /**
     * Confirm deletion of selected messages
     */
    public function confirmDelete()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected for deletion.');
            return;
        }

        $count = count($this->selectedMessages);

        $this->dispatch('confirm-delete', [
            'title' => 'Are you sure?',
            'text' => "You are about to delete $count " . Str::plural('message', $count) . ". This action cannot be undone.",
            'ids' => $this->selectedMessages
        ]);
    }

    public function bulkDelete()
    {
        $count = count($this->selectedMessages);

        ContactMessage::whereIn('id', $this->selectedMessages)->delete();

        $this->selectedMessages = [];
        $this->dispatch('success', "{$count} messages moved to trash");
    }

    public function changePriority($id, $priority)
    {
        ContactMessage::findOrFail($id)->update(['priority' => $priority]);
        $this->dispatch('success', 'Priority updated successfully');
    }

    public function archive($id)
    {
        ContactMessage::findOrFail($id)->update(['status' => 'archived']);
        $this->dispatch('success', 'Message archived successfully');
    }

    public function bulkArchive()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected');
            return;
        }

        ContactMessage::whereIn('id', $this->selectedMessages)
            ->update(['status' => 'archived']);

        $this->selectedMessages = [];
        $this->dispatch('success', 'Selected messages archived successfully');
    }

    public function exportSelected()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected');
            return;
        }

        // This would typically generate and download a CSV/Excel file
        // For demonstration purposes, we'll just show a success message
        $this->dispatch('success', 'Export functionality would go here');
    }

    public function resetFilters()
    {
        $this->reset(['search', 'dateRange', 'priorityFilter', 'statusFilter', 'filter']);
        $this->resetPage();
    }

    public function getFilteredMessages()
    {
        $query = ContactMessage::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('subject', 'like', '%' . $this->search . '%')
                    ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) == 2) {
                $query->whereBetween('created_at', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ]);
            }
        }

        if ($this->priorityFilter !== 'all') {
            $query->where('priority', $this->priorityFilter);
        }

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'read') {
            $query->whereNotNull('read_at');
        } elseif ($this->filter === 'high_priority') {
            $query->where('priority', 'high');
        } elseif ($this->filter === 'archived') {
            $query->where('status', 'archived');
        } elseif ($this->filter === 'replied') {
            $query->where('status', 'replied');
        }

        return $query->orderBy($this->sortField, $this->sortDirection);
    }

    public function getMessagesProperty()
    {
        return $this->getFilteredMessages()->paginate($this->perPage);
    }

    public function getUnreadCountProperty()
    {
        return ContactMessage::whereNull('read_at')->count();
    }

    public function getHighPriorityCountProperty()
    {
        return ContactMessage::where('priority', 'high')->count();
    }


    /**
     * Delete the selected messages after confirmation
     */
    public function deleteConfirmed()
    {
        if (empty($this->selectedMessages)) {
            $this->dispatch('warning', 'No messages selected.');
            return;
        }

        $count = count($this->selectedMessages);

        // Delete the selected messages
        ContactMessage::whereIn('id', $this->selectedMessages)->delete();

        // Reset selection
        $this->selectedMessages = [];
        $this->selectAll = false;

        // Show success message
        $this->dispatch('success', $count . ' ' . Str::plural('message', $count) . ' deleted successfully.');
    }

    public function render()
    {
        return view('livewire.shield.settings.contact-messages', [
            'messages' => $this->messages,
            'unreadCount' => $this->unreadCount,
            'highPriorityCount' => $this->highPriorityCount,
        ])
            ->layout('shield.layouts.shield', [
                'title' => 'Contact Messages Management'
            ]);
    }
}
