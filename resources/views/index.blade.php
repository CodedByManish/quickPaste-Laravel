@extends('layouts.app')

@section('content')
    <!-- Top Feature Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <div class="text-blue-400 text-3xl mb-3"><i class="fas fa-pen-nib"></i></div>
            <h2 class="text-lg font-semibold text-white mb-1">Rich Text Editing</h2>
            <p class="text-sm text-gray-400">Format your text with styling options and create professional-looking content.</p>
        </div>
        <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <div class="text-blue-400 text-3xl mb-3"><i class="fas fa-file-upload"></i></div>
            <h2 class="text-lg font-semibold text-white mb-1">File Sharing</h2>
            <p class="text-sm text-gray-400">Upload and share files up to 100MB with customizable expiration settings.</p>
        </div>
        <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <div class="text-blue-400 text-3xl mb-3"><i class="fas fa-link"></i></div>
            <h2 class="text-lg font-semibold text-white mb-1">URL Shortening</h2>
            <p class="text-sm text-gray-400">Create compact, shareable links that redirect to your original long URLs.</p>
        </div>
    </div>

    <!-- Main Workspace Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Section: Create Paste Form (Spans 2 cols) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-plus-circle text-blue-400 mr-2"></i> Create New Paste
                </h2>

                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-700 mb-6 space-x-4">
                    <button class="tab-btn active pb-2 px-3 text-sm font-medium border-b-2 border-blue-400 text-blue-400 flex items-center" data-tab="text">
                        <i class="fas fa-font mr-2"></i> Text
                    </button>
                    <button class="tab-btn pb-2 px-3 text-sm font-medium text-gray-400 hover:text-white flex items-center" data-tab="file">
                        <i class="fas fa-file-upload mr-2"></i> File Upload
                    </button>
                    <button class="tab-btn pb-2 px-3 text-sm font-medium text-gray-400 hover:text-white flex items-center" data-tab="url">
                        <i class="fas fa-link mr-2"></i> Shorten URL
                    </button>
                </div>

                <!-- Tab Content: Text Editor -->
                <div id="tab-content-text" class="tab-content">
                    <!-- Rich Text Toolbar -->
                    <div class="bg-gray-700 p-2 rounded-t-lg flex flex-wrap gap-1 border border-gray-600 border-b-0">
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="bold" title="Bold"><i class="fas fa-bold"></i></button>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="italic" title="Italic"><i class="fas fa-italic"></i></button>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="underline" title="Underline"><i class="fas fa-underline"></i></button>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="strikeThrough" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                        <span class="border-r border-gray-600 mx-1"></span>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="insertUnorderedList" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="insertOrderedList" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                        <span class="border-r border-gray-600 mx-1"></span>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="undo" title="Undo"><i class="fas fa-undo"></i></button>
                        <button type="button" class="format-btn p-2 hover:bg-gray-600 rounded text-white" data-format="redo" title="Redo"><i class="fas fa-redo"></i></button>
                    </div>
                    <div id="editor" contenteditable="true" class="w-full min-h-[200px] p-4 bg-gray-900 text-gray-200 rounded-b-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 overflow-y-auto"></div>
                </div>

                <!-- Tab Content: File Upload -->
                <div id="tab-content-file" class="tab-content hidden">
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-8 text-center hover:border-blue-400 transition-colors cursor-pointer relative bg-gray-900">
                        <input type="file" id="file-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-gray-400">
                            <i class="fas fa-cloud-upload-alt text-4xl mb-3 text-blue-400"></i>
                            <p class="text-base">Drag and drop your file here, or <span class="text-blue-400 underline">browse</span></p>
                            <p class="text-xs text-gray-500 mt-2">Maximum file size: 100MB</p>
                        </div>
                    </div>
                    <div id="file-info" class="hidden mt-4 p-3 bg-gray-700 rounded-lg flex justify-between items-center text-sm text-gray-300">
                        <span id="file-name" class="font-medium truncate max-w-xs"></span>
                        <span id="file-size" class="text-xs bg-gray-800 px-2 py-1 rounded"></span>
                    </div>
                </div>

                <!-- Tab Content: URL Shortener -->
                <div id="tab-content-url" class="tab-content hidden">
                    <div class="space-y-2">
                        <label for="url-input" class="block text-sm font-medium text-gray-300">Target URL</label>
                        <input type="url" id="url-input" class="w-full p-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="https://example.com/very-long-url-path">
                    </div>
                </div>

                <!-- Form Controls: Expiry & Submit Button -->
                <div class="mt-6 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                    <div class="w-full sm:w-1/2">
                        <label for="expiry-select" class="block text-xs text-gray-400 mb-1 flex items-center">
                            <i class="fas fa-clock mr-1"></i> Expiry Time
                        </label>
                        <select id="expiry-select" class="w-full p-2.5 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                            <option value="never">Never</option>
                            <option value="10m">10 Minutes</option>
                            <option value="1h">1 Hour</option>
                            <option value="1d">1 Day</option>
                            <option value="1w">1 Week</option>
                        </select>
                    </div>

                    <button id="submit-btn" type="button" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition-colors flex items-center justify-center mt-auto">
                        <span class="relative z-10 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Create Paste
                        </span>
                    </button>
                </div>

                <!-- Submission Result Panel -->
                <div id="result-container" class="hidden mt-6 p-4 bg-gray-900 border border-blue-500 rounded-lg">
                    <label class="block text-xs font-semibold text-blue-400 mb-2">YOUR SHAREABLE LINK</label>
                    <div class="flex gap-2">
                        <input type="text" id="result-url" readonly class="w-full p-2 bg-gray-800 text-green-400 border border-gray-700 rounded font-mono text-sm focus:outline-none">
                        <button id="copy-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button id="new-paste-btn" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded text-sm">
                            New
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar Section -->
        <div class="space-y-6">
            <!-- Why QuickPaste Card -->
            <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                <h3 class="text-base font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-question-circle text-blue-400 mr-2"></i> Why QuickPaste?
                </h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Simple & secure text sharing</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> No registration required</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Custom expiration times</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> File uploads up to 100MB</li>
                    <li class="flex items-center"><i class="fas fa-check-circle text-green-400 mr-2"></i> Fast URL shortening</li>
                </ul>
            </div>

            <!-- Tips Card -->
            <div class="glassmorphism bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 space-y-3">
                <h3 class="text-base font-semibold text-white mb-2 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-400 mr-2"></i> Tips
                </h3>
                <div class="bg-gray-900 bg-opacity-60 p-3 rounded border border-gray-700 text-xs text-gray-300">
                    <span class="font-semibold text-blue-400">Quick Share:</span> Use keyboard shortcuts like Ctrl+B for bold text formatting.
                </div>
                <div class="bg-gray-900 bg-opacity-60 p-3 rounded border border-gray-700 text-xs text-gray-300">
                    <span class="font-semibold text-green-400">Secure Files:</span> Set expiry times for sensitive uploads to auto-delete.
                </div>
                <div class="bg-gray-900 bg-opacity-60 p-3 rounded border border-gray-700 text-xs text-gray-300">
                    <span class="font-semibold text-purple-400">URL Tip:</span> Use shortened URLs in social media posts to save character space.
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl text-center border border-gray-700">
            <div class="inline-block animate-spin rounded-full h-10 w-10 border-4 border-blue-400 border-t-transparent mb-3"></div>
            <p class="text-white text-sm font-medium">Processing your request...</p>
        </div>
    </div>
@endsection
