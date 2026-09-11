@extends('layouts.app', [
    'pageTitle' => 'Terms of Service - QuickPaste',
    'pageDescription' => 'Read the Terms of Service for QuickPaste...'
])

@section('content')
    <article class="glassmorphism bg-gray-800 rounded-lg shadow-lg p-6 mb-8" itemscope itemtype="https://schema.org/Article">
        <header>
            <h1 class="text-2xl font-semibold mb-6 text-gray-200 border-b border-gray-700 pb-3" itemprop="headline">
                <i class="fas fa-gavel mr-2 text-blue-400"></i> Terms of Service
            </h1>
            <p class="italic text-gray-400" itemprop="dateModified">Last updated: June 1, 2024</p>
        </header>
        <section class="space-y-6 text-gray-300" itemprop="articleBody">
            <p>Welcome to QuickPaste (<a href="{{ route('home') }}" class="text-blue-400 hover:underline">quickpaste.in</a>)...</p>
            <!-- Include the rest of the terms content here -->
        </section>
    </article>
    <div class="mt-12 text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 border border-blue-400 text-blue-400 hover:bg-blue-500 hover:text-white transition-colors duration-300 rounded-md">
            <i class="fas fa-arrow-left mr-2"></i> Back to Home
        </a>
    </div>
@endsection
