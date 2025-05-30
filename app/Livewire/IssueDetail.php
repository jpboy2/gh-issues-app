<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class IssueDetail extends Component
{
    public $issue;

protected $listeners = ['viewIssue' => 'loadIssue'];

public function loadIssue($number)
{
    $token = env('GITHUB_PERSONAL_TOKEN');
    $response = Http::withToken($token)->get("https://api.github.com/repos/your-username/repo-name/issues/{$number}");
    $this->issue = $response->json();
}

    public function render()
    {
        return view('livewire.issue-detail');
    }
}
