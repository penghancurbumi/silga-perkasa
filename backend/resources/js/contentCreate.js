document.addEventListener('livewire:navigated', () => {
    const thumbnailInput = document.getElementById('thumbnailInput')
    const thumbnailPreview = document.getElementById('thumbnailPreview')
    const uploadPlaceholder  = document.getElementById('uploadPlaceholder')
    const uploadArea  = document.getElementById('uploadArea')

    function handleFile(file){
        if(!file) return

        if (file.size > 5 * 1024 * 1024){
            alert('Ukuran file maksimal 5MB')
            return
        }

        const reader = new FileReader() // Fixed typo from 'render' to 'reader'
        reader.onload = function (e) {
            const preview = document.getElementById('thumbnailPreview')
            const placeholder = document.getElementById('uploadPlaceholder')
            if (preview) {
                preview.src = e.target.result
                preview.classList.remove('hidden')
            }
            if (placeholder) {
                placeholder.classList.add('hidden')
            }
        }
        reader.readAsDataURL(file)
    }

    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function () {
            handleFile(this.files[0]) // Fixed typo from 'file' to 'files'
        })
    }

    if (uploadArea) {
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault()
            uploadArea.classList.add('border-gray-400', 'bg-gray-50')
        })

        // Fixed from 'dragover' to 'dragleave'
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('border-gray-400', 'bg-gray-50')
        })

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault()
            uploadArea.classList.remove('border-gray-400', 'bg-gray-50')
            if (e.dataTransfer && e.dataTransfer.files) {
                handleFile(e.dataTransfer.files[0])
            }
        })
    }
});
