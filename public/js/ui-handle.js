document.addEventListener('DOMContentLoaded', function () {
    const editor = document.getElementById('editor');
    const fileInput = document.getElementById('file-upload');
    const fileNameDisplay = document.getElementById('file-name');
    const fileSizeDisplay = document.getElementById('file-size');
    const fileInfoContainer = document.getElementById('file-info');
    const urlInput = document.getElementById('url-input');
    const expirySelect = document.getElementById('expiry-select');

    let currentTab = 'text';
    let currentFile = null;

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            currentTab = tabName;

            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-blue-400', 'text-blue-400');
                btn.classList.add('text-gray-400');
            });
            button.classList.add('active', 'border-blue-400', 'text-blue-400');
            button.classList.remove('text-gray-400');

            tabContents.forEach(content => {
                if (content.id === `tab-content-${tabName}`) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });

    const formatButtons = document.querySelectorAll('.format-btn');

    formatButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const format = btn.getAttribute('data-format');
            if (format) {
                document.execCommand(format, false, null);
                if (editor) editor.focus();
                updateActiveToolbarStates();
            }
        });
    });

    if (editor) {
        ['keyup', 'mouseup', 'click'].forEach(eventType => {
            editor.addEventListener(eventType, updateActiveToolbarStates);
        });
    }

    function updateActiveToolbarStates() {
        formatButtons.forEach(btn => {
            const format = btn.getAttribute('data-format');
            if (!format) return;

            // Check if the current selection has this formatting applied
            let isActive = false;
            try {
                isActive = document.queryCommandState(format);
            } catch (_) {
                isActive = false;
            }

            if (isActive) {
                btn.classList.add('bg-gray-600', 'text-blue-400', 'ring-1', 'ring-blue-400');
            } else {
                btn.classList.remove('bg-gray-600', 'text-blue-400', 'ring-1', 'ring-blue-400');
            }
        });
    }

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                currentFile = file;
                fileNameDisplay.textContent = file.name;
                fileSizeDisplay.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                fileInfoContainer.classList.remove('hidden');
            }
        });
    }

    function resetForm() {
        if (editor) editor.innerHTML = '';
        if (fileInput) fileInput.value = '';
        if (urlInput) urlInput.value = '';
        if (fileInfoContainer) fileInfoContainer.classList.add('hidden');
        currentFile = null;
        updateActiveToolbarStates();
    }

    window.appState = {
        editor,
        selectedFile: () => currentFile,
        urlInput,
        expirySelect,
        activeTab: () => currentTab,
        resetForm
    };
});
