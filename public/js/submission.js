window.appState = undefined;
document.addEventListener('DOMContentLoaded', function () {
    const {
        editor,
        selectedFile,
        urlInput,
        expirySelect,
        activeTab,
        resetForm
    } = window.appState;

    const submitBtn = document.getElementById('submit-btn');
    const resultContainer = document.getElementById('result-container');
    const resultUrl = document.getElementById('result-url');
    const copyBtn = document.getElementById('copy-btn');
    const newPasteBtn = document.getElementById('new-paste-btn');
    const loadingOverlay = document.getElementById('loading-overlay');
    const successSound = document.getElementById('success-sound');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    submitBtn.addEventListener('click', handleSubmit);

    copyBtn.addEventListener('click', function () {
        resultUrl.select();
        document.execCommand('copy');
        if (successSound) successSound.play().catch(() => {});
        const originalHTML = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => (this.innerHTML = originalHTML), 2000);
    });

    newPasteBtn.addEventListener('click', () => {
        resetForm();
        resultContainer.classList.add('hidden');
    });

    async function handleSubmit() {
        loadingOverlay.classList.remove('hidden');

        try {
            let response;
            const tab = activeTab();

            switch (tab) {
                case 'text':
                    const content = editor.innerHTML.trim();
                    if (!content) throw new Error('Please enter some text to paste.');
                    response = await postData('/paste', { type: 'text', content, expiry: expirySelect.value });
                    break;

                case 'file':
                    const file = selectedFile();
                    if (!file) throw new Error('Please select a file to upload.');
                    const formData = new FormData();
                    formData.append('type', 'file');
                    formData.append('file', file);
                    formData.append('expiry', expirySelect.value);
                    response = await postFormData('/paste', formData);
                    break;

                case 'url':
                    const url = urlInput.value.trim();
                    if (!url || !isValidURL(url)) throw new Error('Please enter a valid URL to shorten.');
                    response = await postData('/paste', { type: 'url', url, expiry: expirySelect.value });
                    break;
            }

            if (response?.success && response.url) {
                showResult(response.url);
            } else {
                throw new Error(response?.error || 'Unexpected error occurred.');
            }

        } catch (error) {
            alert(`Error: ${error.message}`);
        } finally {
            loadingOverlay.classList.add('hidden');
        }
    }

    function showResult(url) {
        resultUrl.value = url;
        resultContainer.classList.remove('hidden');
        if (successSound) successSound.play().catch(() => {});
        setTimeout(() => resultUrl.focus(), 100);
    }

    async function postData(endpoint, payload) {
        const res = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });
        return await res.json();
    }

    async function postFormData(endpoint, formData) {
        const res = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });
        return await res.json();
    }

    function isValidURL(string) {
        try { new URL(string); return true; } catch (_) { return false; }
    }
});
