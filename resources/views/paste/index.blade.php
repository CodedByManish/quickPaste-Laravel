@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main Form Section -->
        <div class="lg:col-span-2">
            <div class="glassmorphism bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-200 flex items-center">
                    <i class="fas fa-plus-circle mr-2 text-blue-500"></i> Create New Paste
                </h2>

                <form action="{{ route('paste.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-200 mb-1">Title (Optional)</label>
                        <input type="text" name="title" placeholder="Paste title..." class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-200 mb-1">Content</label>
                        <textarea name="content" rows="10" placeholder="Paste your text or code here..." class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 font-mono"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-200 mb-1">Upload File (Optional)</label>
                        <input type="file" name="file" class="w-full text-gray-400 bg-gray-700 p-2 rounded-lg border border-gray-600">
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 items-start sm:items-center mb-4">
                        <div class="w-full sm:w-1/2">
                            <label class="block text-sm font-medium text-gray-200 mb-1">
                                <i class="fas fa-clock mr-1"></i> Expiry Time
                            </label>
                            <select name="expiry" class="w-full p-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500">
                                <option value="never">Never</option>
                                <option value="1h">1 Hour</option>
                                <option value="1d">1 Day</option>
                                <option value="3d">3 Days</option>
                                <option value="7d">7 Days</option>
                            </select>
                        </div>

                        <div class="w-full sm:w-auto sm:ml-auto pt-6">
                            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors pulse-btn">
                                <i class="fas fa-paper-plane mr-2"></i> Create Paste
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="lg:col-span-1">
            <div class="glassmorphism bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-200">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i> Why QuickPaste?
                </h3>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i><span>Simple & secure text sharing</span></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i><span>No registration required</span></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i><span>Custom expiration times</span></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
