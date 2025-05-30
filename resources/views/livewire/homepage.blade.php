<div>
    <!-- Navbar -->
    <header class="bg-black border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="/images/github-mark-white.png" class="w-9 h-9" alt="GitHub Logo" />
                <h1 class="text-xl font-bold text-white">GitHub Issues</h1>
            </div>

            <nav class="flex items-center gap-6 text-sm">
                <a href="/"
                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full hover:bg-blue-500 flex items-center gap-1">Home</a>
                <a href="/issues"
                    class="text-gray-300 hover:text-white flex items-center gap-1 bg-[#161B22] hover:bg-gray-700 px-4 py-1.5 rounded-full shadow justify-center">
                    My Issues
                </a>
                <div class="flex items-center gap-2">
                    <span class="text-white">{{ $user['name'] }}</span>
                    <img src={{ $user['avatar'] }} class="w-8 h-8 rounded-full border border-gray-600" alt="Avatar" />
                </div>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="max-w-6xl mx-auto px-6 py-10">

        <div class="bg-[#0D1117] text-white flex flex-col items-center px-4">
            {{-- GitHub Logo --}}
            <div class="mb-6">
                <img src="/images/github-mark-white.png" class="w-16 h-16" alt="GitHub Logo">
            </div>

            {{-- Heading --}}
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold mb-2">Welcome to GitHub Issues App</h1>
                <p class="text-gray-400">A beautiful and efficient way to manage your GitHub issues in one place.</p>
            </div>

            {{-- User Card --}}
            <div class="bg-[#161B22] rounded-xl p-6 w-full max-w-sm text-center shadow-lg">
                <div class="flex flex-col items-center mb-4">
                    <img src="{{ $user['avatar'] }}" class="w-16 h-16 rounded-full mb-2" alt="User Avatar">
                    <h2 class="text-xl font-semibold">{{ $user['name'] }}</h2>
                    <span class="text-gray-400">{{ '@' . $user['name'] }}</span>
                </div>

                <div class="grid grid-cols-1 gap-4 mt-4 ">
                    <div class="bg-[#0D1117] p-4 rounded-lg ">
                        <p class="text-gray-400 text-sm mb-1">Open Issues</p>
                        <p class="text-2xl font-bold">{{ count($open_issues) }}</p>
                    </div>
                    <div class="bg-[#0D1117] p-4 rounded-lg ">
                        <p class="text-gray-400 text-sm mb-1">Latest Issue</p>
                        @if (count($open_issues) > 0)
                            <p class="text-sm font-bold"><a href="/issues?num={{ $open_issues[0]['number'] }}">#{{ $open_issues[0]['number'] }} {{ $open_issues[0]['title'] }}</a>
                            </p>

                            <div class="flex justify-between mt-1">
                                <div class="flex justify-center items-center gap-1">

                                    <img src="/images/github-mark-white.png" class="w-4 h-4" alt="GitHub Logo">

                                    <a href="{{ $open_issues[0]['repository']['html_url'] }}" target="_blank" class="text-sm text-gray-400 hover:underline">
                                        {{ $open_issues[0]['repository']['name'] }}
                                    </a>
                                </div>
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($open_issues[0]['created_at'])->format('F j, Y') }}
                                </p>
                            </div>
                        @else
                            <p class="text-sm">N/A</p>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow" ><a href="/issues">View Assigned Issues</a></button>
                <a href="https://github.com" target="_blank"
                    class="bg-[#161B22] hover:bg-gray-700 px-5 py-2 rounded-lg shadow flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 .5a12 12 0 00-3.79 23.4c.6.11.82-.26.82-.58v-2.03c-3.34.73-4.04-1.61-4.04-1.61-.54-1.36-1.32-1.73-1.32-1.73-1.08-.73.08-.71.08-.71 1.2.08 1.83 1.23 1.83 1.23 1.06 1.82 2.79 1.29 3.47.99.11-.77.42-1.3.76-1.6-2.67-.3-5.47-1.34-5.47-5.95 0-1.32.47-2.4 1.23-3.24-.12-.3-.54-1.52.12-3.18 0 0 1-.32 3.3 1.23a11.5 11.5 0 016 0c2.3-1.55 3.3-1.23 3.3-1.23.66 1.66.24 2.88.12 3.18.76.84 1.23 1.92 1.23 3.24 0 4.62-2.81 5.64-5.49 5.94.43.38.81 1.12.81 2.26v3.35c0 .32.22.69.83.58A12 12 0 0012 .5z" />
                    </svg>
                    Go to GitHub
                </a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-[#161b22] border-t border-gray-700 text-center text-gray-500 text-sm py-4">
        &copy; {{ date('Y') }} GitHub Issues App — Built with ❤️ using Laravel & Livewire
    </footer>
</div>
