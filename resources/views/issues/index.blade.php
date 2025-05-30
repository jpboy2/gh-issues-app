<x-layouts.app>
    <!-- Navbar -->
    <header class="bg-black border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" class="w-9 h-9"
                    alt="GitHub Logo" />
                <h1 class="text-xl font-bold text-white">GitHub Issues</h1>
            </div>

            <nav class="flex items-center gap-6 text-sm">
                <a href="/" class="text-gray-300 hover:text-white flex items-center gap-1">🏠 Home</a>
                <a href="/github-issues"
                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full hover:bg-blue-500 flex items-center gap-1">
                    📘 My Issues
                </a>
                <div class="flex items-center gap-2">
                    <span class="text-white">johndoe</span>
                    <img src="https://i.pravatar.cc/32" class="w-8 h-8 rounded-full border border-gray-600"
                        alt="Avatar" />
                </div>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="max-w-6xl mx-auto px-6 py-10">
        <livewire:issues-list />
        <livewire:issue-detail />
    </main>

    <!-- Footer -->
    <footer class="bg-[#161b22] border-t border-gray-700 text-center text-gray-500 text-sm py-4">
        &copy; {{ date('Y') }} GitHub Issues App — Built with ❤️ using Laravel & Livewire
    </footer>
</x-layouts.app>
