<div class="space-y-6">
    <!-- Recent Users -->
    <div>
        <h4 class="text-sm font-medium text-gray-900 mb-3">Recent Registrations</h4>
        <div class="space-y-3">
            @forelse($recentUsers as $user)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <img class="h-8 w-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                        @if($user->roles->isNotEmpty())
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                @if($user->hasRole('admin')) bg-green-100 text-green-800
                                @elseif($user->hasRole('support')) bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($user->roles->first()->name) }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p class="text-sm text-gray-500">No recent registrations</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recently Active Users -->
    <div>
        <h4 class="text-sm font-medium text-gray-900 mb-3">Recently Active</h4>
        <div class="space-y-3">
            @forelse($activeUsers as $user)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img class="h-8 w-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                            <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-green-400 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $user->updated_at->diffForHumans() }}</p>
                        @if($user->roles->isNotEmpty())
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                @if($user->hasRole('admin')) bg-green-100 text-green-800
                                @elseif($user->hasRole('support')) bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($user->roles->first()->name) }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p class="text-sm text-gray-500">No recent activity</p>
                </div>
            @endforelse
        </div>
    </div>
</div>