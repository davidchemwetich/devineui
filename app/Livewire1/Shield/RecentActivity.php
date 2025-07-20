<?php

namespace App\Livewire\Shield;

use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class RecentActivity extends Component
{
    public function render()
    {
        // Get recent users (last 7 days)
        $recentUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recently active users (last login if you have that field)
        $activeUsers = User::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.shield.recent-activity', compact('recentUsers', 'activeUsers'));
    }
}