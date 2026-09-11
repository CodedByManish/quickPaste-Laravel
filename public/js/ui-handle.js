document.addEventListener('DOMContentLoaded', function () {
    // Elements
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const formatButtons = document.querySelectorAll('.format-btn');
    const editor = document.getElementById('editor');
    const fileUpload = document.getElementById('file-upload');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const urlInput = document.getElementById('url-input');
    const expirySelect = document.getElementById('expiry-select');

    // Current active tab
    let activeTab = 'text';
    let selectedFile = null;

    // Tab switching
    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tab = this.dataset.tab;
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            tabContents.forEach(content => content.classList.add('hidden'));
            document.getElementById(`tab-content-${tab}`).classList.remove('hidden');
            activeTab = tab;
            updateSubmitButtonText();
        });
    });

    // Formatting
    formatButtons.forEach(button => {
        button.addEventListener('click', function () {
            const format = this.dataset.format;
            if (format === 'createLink') {
                const url = prompt('Enter the URL:');
                if (url) document.execCommand(format, false, url);
            } else {
                document.execCommand(format, false, null);
            }
            const isActive = document.queryCommandState(format);
            if (isActive) {
                this.classList.add('bg-gray-600');
            } else {
                this.classList.remove('bg-gray-600');
            }
            editor.focus();
        });
    });

    editor.addEventListener('mouseup', updateButtonStates);
    editor.addEventListener('keyup', updateButtonStates);

    function updateButtonStates() {
        formatButtons.forEach(button => {
            const format = button.dataset.format;
            const isActive = document.queryCommandState(format);

            // Always white text
            button.classList.add('text-white');
            button.classList.remove('text-gray-300', 'text-gray-400');

            if (isActive) {
                button.classList.add('bg-gray-600');
            } else {
                button.classList.remove('bg-gray-600');
            }
        });
    }


    // File input
    fileUpload.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            selectedFile = this.files[0];
            fileName.textContent = selectedFile.name;
            fileSize.textContent = formatFileSize(selectedFile.size);
            fileInfo.classList.remove('hidden');
        }
    });

    // Drag-and-drop
    const dropArea = document.querySelector('#tab-content-file .border-dashed');
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
        dropArea.addEventListener(event, e => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    ['dragenter', 'dragover'].forEach(event =>
        dropArea.addEventListener(event, () => {
            dropArea.classList.add('bg-blue-50', 'dark:bg-blue-900', 'bg-opacity-50');
        })
    );

    ['dragleave', 'drop'].forEach(event =>
        dropArea.addEventListener(event, () => {
            dropArea.classList.remove('bg-blue-50', 'dark:bg-blue-900', 'bg-opacity-50');
        })
    );

    dropArea.addEventListener('drop', function (e) {
        const files = e.dataTransfer.files;
        if (files && files[0]) {
            fileUpload.files = files;
            selectedFile = files[0];
            fileName.textContent = selectedFile.name;
            fileSize.textContent = formatFileSize(selectedFile.size);
            fileInfo.classList.remove('hidden');
        }
    });

    // Export elements & state
    window.appState = {
        editor,
        fileUpload,
        fileInfo,
        fileName,
        fileSize,
        urlInput,
        expirySelect,
        activeTab: () => activeTab,
        selectedFile: () => selectedFile,
        updateSubmitButtonText,
        resetForm: () => {
            editor.innerHTML = '';
            fileUpload.value = '';
            fileInfo.classList.add('hidden');
            urlInput.value = '';
            expirySelect.value = 'never';
        }
    };

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function updateSubmitButtonText() {
        const submitBtn = document.getElementById('submit-btn');
        const tab = activeTab;
        const label = {
            text: '<i class="fas fa-paper-plane mr-2"></i>Create Paste',
            file: '<i class="fas fa-cloud-upload-alt mr-2"></i>Upload File',
            url: '<i class="fas fa-link mr-2"></i>Shorten URL'
        }[tab];
        submitBtn.innerHTML = `<span class="relative z-10 flex items-center justify-center">${label}</span>`;
    }
});
