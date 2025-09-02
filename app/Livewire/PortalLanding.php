<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PortalLanding extends Component
{
    public bool $showClientLogin = false;
    public bool $showMerchantLogin = false;

    public string $email = '';
    public string $password = '';

    public string $loginContext = 'client'; // client|merchant

    public function openClientLogin(): void
    {
        $this->loginContext = 'client';
        $this->showClientLogin = true;
    }
    public function openMerchantLogin(): void
    {
        $this->loginContext = 'merchant';
        $this->showMerchantLogin = true;
    }
    public function closeModals(): void
    {
        $this->reset(['showClientLogin', 'showMerchantLogin', 'email', 'password']);
    }

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', __('auth.failed'));
            return;
        }

        session()->regenerate();

        if ($this->loginContext === 'merchant') {
            $this->redirectRoute('merchant.portal', navigate: true);
            return;
        }

        $this->redirectRoute('client.portal', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.portal-landing');
    }
}
