<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class IssuesList extends Component
{
    public $issues = [];
    public $selectedIssue = null;
    public $num = null;

    protected $queryString = ['num'];
    protected $listeners = ['backToListFromBrowser' => 'backToList'];

    public function mount()
    {
        $token = env('GITHUB_PERSONAL_TOKEN');
        $response = Http::withToken($token)->withoutVerifying()->get('https://api.github.com/issues');
        $this->issues = collect($response->json())->filter(fn($i) => $i['state'] === 'open');

        if ($this->num) {
            $this->selectedIssue = collect($this->issues)->firstWhere('number', $this->num);
        }
    }

    public function updatedNum($value)
{
    if ($value === null) {
        $this->selectedIssue = null;
    } else {
        $this->selectedIssue = collect($this->issues)->firstWhere('number', $value);
    }
}

    public function viewIssue($num)
    {
        $this->num = $num;
        $this->selectedIssue = collect($this->issues)->firstWhere('number', $num);
    }

    public function backToList()
    {
        $this->selectedIssue = null;
        $this->num = null; // clear URL param
    }

    public function render()
    {
        return view('livewire.issues-list');
    }
}

