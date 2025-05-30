<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
class Issues extends Component
{
    public $user = [];
    public $open_issues = [];

    public function mount()
    {
        $token = env('GITHUB_PERSONAL_TOKEN');
        $response = Http::withToken($token)->withoutVerifying()->get('https://api.github.com/issues');
        $this->open_issues = collect($response->json())->filter(fn($i) => $i['state'] === 'open');
        $this->user['name'] = $this->open_issues[0]['assignee']['login']; // Replace with your actual name
        $this->user['avatar'] = $this->open_issues[0]['assignee']['avatar_url'];
        //echo $this->user;
    }


    public function render()
    {
        return view('livewire.issues');
    }
}
