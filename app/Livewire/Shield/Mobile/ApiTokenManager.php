<?php

namespace App\Livewire\Shield\Mobile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApiTokenManager extends Component
{
    public $createApiTokenForm = [
        'name' => '',
        'permissions' => [],
    ];

    public $updateApiTokenForm = [
        'permissions' => [],
    ];

    public $displayingToken = false;
    public $managingApiTokenPermissions = false;
    public $confirmingApiTokenDeletion = false;

    public $plainTextToken;
    public $tokenBeingManaged;
    public $tokenIdBeingDeleted;

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function createApiToken()
    {
        $this->validate([
            'createApiTokenForm.name' => 'required|string|max:255',
        ]);

        $token = $this->user->createToken(
            $this->createApiTokenForm['name'],
            $this->createApiTokenForm['permissions']
        );

        $this->plainTextToken = $token->plainTextToken;
        $this->displayingToken = true;

        $this->createApiTokenForm = ['name' => '', 'permissions' => []];

        $this->dispatch('created');
    }

    public function manageApiTokenPermissions($tokenId)
    {
        $this->tokenBeingManaged = $this->user->tokens()->findOrFail($tokenId);
        $this->updateApiTokenForm['permissions'] = $this->tokenBeingManaged->abilities ?? [];
        $this->managingApiTokenPermissions = true;
    }

    public function updateApiToken()
    {
        $this->tokenBeingManaged->forceFill([
            'abilities' => $this->updateApiTokenForm['permissions'],
        ])->save();

        $this->managingApiTokenPermissions = false;
    }

    public function confirmApiTokenDeletion($tokenId)
    {
        $this->confirmingApiTokenDeletion = true;
        $this->tokenIdBeingDeleted = $tokenId;
    }

    public function deleteApiToken()
    {
        $this->user->tokens()->where('id', $this->tokenIdBeingDeleted)->delete();
        $this->confirmingApiTokenDeletion = false;
    }

    public function render()
    {
        return view('livewire.shield.mobile.api-token-manager', [
            'tokens' => $this->user->tokens->sortBy('name'),
            'permissions' => \Laravel\Jetstream\Jetstream::$permissions,
            'hasPermissions' => \Laravel\Jetstream\Jetstream::hasPermissions(),
        ])->layout('shield.layouts.shield');
    }
}