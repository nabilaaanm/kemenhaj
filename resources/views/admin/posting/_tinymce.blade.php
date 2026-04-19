<script src="https://cdn.tiny.cloud/1/7d9sxbgag2cw1r4ro2xb9fd14o86qhizw4iys2ac1rg5kh7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
(function () {
    const baseTinyConfig = {
        menubar: 'file edit view insert format tools table help',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help quickbars emoticons',
        toolbar: [
            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify',
            'bullist numlist outdent indent | link image media table | removeformat | preview fullscreen | code'
        ],
        toolbar_mode: 'sliding',
        branding: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }',
        paste_data_images: true,
        automatic_uploads: true
    };

    const csrf = @json(csrf_token());
    const uploadUrl = @json(route('admin.posting.upload-editor-image'));

    const images_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', uploadUrl);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.withCredentials = true;
        xhr.upload.onprogress = (e) => {
            if (e.lengthComputable) {
                progress((e.loaded / e.total) * 100);
            }
        };
        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({ message: 'Akses ditolak.', remove: true });
                return;
            }
            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP ' + xhr.status + ': ' + (xhr.responseText || 'Unggah gagal'));
                return;
            }
            let json;
            try {
                json = JSON.parse(xhr.responseText);
            } catch (err) {
                reject('Respons server tidak valid.');
                return;
            }
            if (!json || typeof json.location !== 'string') {
                reject(json.message || json.error || 'Unggah gambar gagal.');
                return;
            }
            resolve(json.location);
        };
        xhr.onerror = () => reject('Kesalahan jaringan saat mengunggah gambar.');
        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append('_token', csrf);
        xhr.send(formData);
    });

    tinymce.init({
        ...baseTinyConfig,
        selector: 'textarea.js-rich-content',
        height: 420,
        images_upload_handler: images_upload_handler
    });
})();
</script>
