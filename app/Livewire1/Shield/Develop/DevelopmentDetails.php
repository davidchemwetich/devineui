<?php

namespace App\Livewire\Shield\Develop;

use Livewire\Component;
use App\Models\Development;
use App\Models\Donation;
use Livewire\WithPagination;

class DevelopmentDetails extends Component
{
    use WithPagination;

    public Development $development;
    public $developmentId;
    public $showDonationModal = false;
    public $donationAmount;
    public $donationUserId = null;

    protected $rules = [
        'donationAmount' => 'required|numeric|min:1',
        'donationUserId' => 'nullable|exists:users,id',
    ];

    public function mount($id)
    {
        $this->developmentId = $id;
        $this->development = Development::with('projectLead', 'donations.user')->findOrFail($id);
    }

    public function openDonationModal()
    {
        $this->showDonationModal = true;
    }

    public function closeDonationModal()
    {
        $this->showDonationModal = false;
        $this->donationAmount = null;
        $this->donationUserId = null;
        $this->resetValidation();
    }

    public function addDonation()
    {
        $this->validate();

        $donation = new Donation();
        $donation->development_id = $this->development->id;
        $donation->user_id = $this->donationUserId;
        $donation->amount = $this->donationAmount;
        $donation->donated_at = now();
        $donation->save();

        // Update the development record
        $this->development->amount_raised += $this->donationAmount;
        $this->development->donors_count = $this->development->donations()->distinct('user_id')->count();
        $this->development->last_donation_at = now();
        $this->development->save();

        $this->closeDonationModal();

        // Refresh the development data
        $this->development = Development::with('projectLead', 'donations.user')->findOrFail($this->developmentId);

        session()->flash('message', 'Donation added successfully.');
    }

    public function render()
    {
        $donations = Donation::where('development_id', $this->development->id)
            ->with('user')
            ->orderBy('donated_at', 'desc')
            ->paginate(10);

        $volunteers = $this->development->volunteers()->paginate(10, ['*'], 'volunteer_page');

        $progressPercentage = 0;
        if ($this->development->target_amount > 0) {
            $progressPercentage = min(100, round(($this->development->amount_raised / $this->development->target_amount) * 100));
        }

        return view('livewire.shield.develop.development-details', [
            'donations' => $donations,
            'volunteers' => $volunteers,
            'progressPercentage' => $progressPercentage,
        ])->layout('shield.layouts.shield-layout');
    }
}