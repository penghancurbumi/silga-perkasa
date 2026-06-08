const thumbnailInput = document.getElementById('thumbnailInput')
const thumbnailPreview = document.getElementById('thumbnailPreview')
const uploadPlaceholder  = document.getElementById('uploadPlaceholder ')
const uploadArea  = document.getElementById('uploadArea ')


function handleFile(file){
    if(!file) return

    if (file.size > 5 * 1024 * 1024){
        alert('Ukuran file maksimal 5MB')
        this.value=''
        return
    }

    const render = new FileReader()
    reader.onload = function (e) {
        document.getElementById('thumbnailPreview').src = e.target.result
        document.getElementById('thumbnailPreview').classList.remove('hidden')
        document.getElementById('uploadPlaceholder').classList.add('hidden')
    }
    reader.readAsDataURL(file)
}

thumbnailInput.addEventListener('change', function () {
    handleFile(this.file[0])
})

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault()
    uploadArea.classList.add('border-gray-400', 'bg-gray-50')
})

uploadArea.addEventListener('dragover', () => {
    uploadArea.classList.remove('border-gray-400', 'bg-gray-50')
})

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault()
    uploadArea.classList.remove('border-gray-400', 'bg-gray-50')
    handleFile(e.dataTransfer.files[0])
})
