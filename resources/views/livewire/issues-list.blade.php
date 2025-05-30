<div class="space-y-4">

    @if ($selectedIssue)
        {{-- ISSUE DETAILS --}}
        <button wire:click="backToList" class="text-sm text-blue-400 hover:underline mb-4">
            ← Back to issues list
        </button>

        <div class="bg-gray-800 p-4 rounded-xl">
            <h2 class="text-2xl font-bold text-white mb-2">
                <a href="{{ $selectedIssue['html_url'] }}" target="_blank">#{{ $selectedIssue['number'] }} — {{ $selectedIssue['title'] }}</a>
            </h2>

            <div class="text-sm text-gray-400 mb-4">
                Created {{ \Carbon\Carbon::parse($selectedIssue['created_at'])->diffForHumans() }}
            </div>

            <div id="issue-body"
                class="break-words [&_code]:overflow-x-scroll text-[clamp(0.8rem,2vw,1.5rem)] leading-relaxed text-white dark:text-white font-sans [&_pre]:bg-gray-900 [&_pre]:p-4 [&_pre]:rounded-lg [&_pre]:overflow-auto [&_pre]:text-sm [&_pre]:max-h-96 [&_code]:text-pink-400 [&_code]:font-mono">
                @php
                    $html = \Illuminate\Support\Str::markdown($selectedIssue['body'] ?? '');

                    $doc = new \DOMDocument();
                    libxml_use_internal_errors(true);
                    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
                    libxml_clear_errors();

                    $imgs = $doc->getElementsByTagName('img');

                    $imageLinks = [];
                    for ($i = $imgs->length - 1; $i >= 0; $i--) {
                        $img = $imgs->item($i);
                        $src = $img->getAttribute('src');
                        $imageLinks[] = $src;

                        $a = $doc->createElement('a');
                        $a->setAttribute('href', $src);
                        $a->setAttribute('target', '_blank');
                        $a->setAttribute('rel', 'noopener noreferrer');

                        $newImg = $doc->createElement('img');
                        $newImg->setAttribute('src', $src);
                        $newImg->setAttribute('alt', 'Attached image ' . ($i + 1));

                        $newImg->setAttribute('style', 'object-fit: cover; border-radius: 4px; margin:1rem 0;');
                        $newImg->setAttribute(
                            'onerror',
                            "this.onerror=null;this.src='https://placehold.co/200x100?text=Image+" . ($i + 1) . "';",
                        );

                        $a->appendChild($newImg);

                        $img->parentNode->replaceChild($a, $img);
                    }

                    $body = $doc->getElementsByTagName('body')->item(0);
                    $innerHTML = '';
                    foreach ($body->childNodes as $child) {
                        $innerHTML .= $doc->saveHTML($child);
                    }
                @endphp



                <style>
                    #issue-body p {
                        font-size: 1rem;
                    }

                    #issue-body pre {
                        @apply bg-gray-900 rounded-lg p-4 overflow-auto text-sm max-h-96;
                        width: 100%;
                        border-radius: 4px;
                        padding: 1rem 1rem;
                        background-color: #000;
                        /* Dark gray background */
                        color: white;
                        margin: 1rem 0;
                    }

                    #issue-body code {
                        color: white;

                        font-size: 0.8rem;
                        /* 14px */
                        /* Pink text */
                    }
                </style>
                {{-- Render Markdown content --}}
                {!! $innerHTML !!}
                @if (!empty($imageLinks))
                    <div class="mt-4 text-sm text-gray-300">
                        <p class="mb-2 font-semibold">Attached Image/s:</p>
                        @foreach ($imageLinks as $index => $link)
                            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                class="block text-blue-400 hover:underline mb-1">
                                Image {{ $index + 1 }}: {{ $link }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>





            <div class="mt-4 flex gap-2 flex-wrap items-center justify-between">

                <div class="flex items-center gap-2">
                    <img src="{{ $selectedIssue['user']['avatar_url'] }}" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-white">{{ $selectedIssue['user']['login'] }}</span>
                </div>
                <div class="flex justify-start gap-1">

                    <img src="/images/github-mark-white.png" class="w-4 h-4" alt="GitHub Logo">

                    <a href="{{ $selectedIssue['repository']['html_url'] }}" target="_blank"
                        class="text-sm text-gray-400 hover:underline">
                        {{ $selectedIssue['repository']['name'] }}
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">🧩 My Open Issues</h2>
            <span class="text-sm bg-gray-700 text-white px-2 py-1 rounded">{{ count($issues) }} issues</span>
        </div>

        @forelse($issues as $issue)
            <div wire:click="viewIssue({{ $issue['number'] }})"
                class="bg-gray-800 hover:bg-gray-700 transition rounded-xl p-4 cursor-pointer">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-white text-lg">#{{ $issue['number'] }} {{ $issue['title'] }}</h3>

                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <span class="flex items-center gap-1">
                            <x-heroicon-o-clock class="w-4 h-4 text-gray-400" />

                            {{ \Carbon\Carbon::parse($issue['created_at'])->diffForHumans() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <x-heroicon-o-chat-bubble-left class="w-4 h-4 text-gray-400" />
                            {{ $issue['comments'] ?? 0 }}
                        </span>
                    </div>
                </div>
                @if (!empty($issue['labels']))
                <div class="mt-2 flex gap-2 flex-wrap">
                    @foreach ($issue['labels'] as $label)
                        <span class="text-xs font-semibold px-2 py-1 rounded-full"
                            style="background-color:#{{ $label['color'] }};color:white;">
                            {{ strtoupper($label['name']) }}
                        </span>
                    @endforeach
                </div>
                @endif


                <div class="mt-2 text-sm text-gray-400">
                    {{ \Illuminate\Support\Str::limit($issue['body'], 200, '...') }}
                </div>


                <div class="mt-2 flex gap-2 flex-wrap items-center justify-between">

                    <div class="flex items-center gap-2">
                        <img src="{{ $issue['user']['avatar_url'] }}" class="w-6 h-6 rounded-full">
                        <span class="text-sm text-white">{{ $issue['user']['login'] }}</span>
                    </div>
                    <div class="flex justify-start gap-1">

                        <img src="/images/github-mark-white.png" class="w-4 h-4" alt="GitHub Logo">

                        <a href="{{ $issue['repository']['html_url'] }}" target="_blank"
                            class="text-sm text-gray-400 hover:underline">
                            {{ $issue['repository']['name'] }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No open issues 🎉</p>
        @endforelse
    @endif


</div>
