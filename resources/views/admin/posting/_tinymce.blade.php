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
        content_style: `
            body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.75; }
            img { max-width: 100%; height: auto; }
            p[style*="text-align: center"] img,
            p[style*="text-align:center"] img,
            .aligncenter, img.aligncenter, figure.image {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            figure.image { text-align: center; margin: 1em auto; }
        `,
        formats: {
            alignleft: [
                { selector: 'p,h1,h2,h3,h4,h5,h6,div,figure,td,th', styles: { textAlign: 'left' } },
                { selector: 'img', styles: { display: 'block', marginLeft: '0', marginRight: 'auto' } },
            ],
            aligncenter: [
                { selector: 'p,h1,h2,h3,h4,h5,h6,div,figure,td,th', styles: { textAlign: 'center' } },
                { selector: 'img', styles: { display: 'block', marginLeft: 'auto', marginRight: 'auto' } },
            ],
            alignright: [
                { selector: 'p,h1,h2,h3,h4,h5,h6,div,figure,td,th', styles: { textAlign: 'right' } },
                { selector: 'img', styles: { display: 'block', marginLeft: 'auto', marginRight: '0' } },
            ],
            alignjustify: [
                { selector: 'p,h1,h2,h3,h4,h5,h6,div,figure,td,th', styles: { textAlign: 'justify' } },
            ],
        },
        paste_data_images: true,
        automatic_uploads: true
    };

    const csrf = @json(csrf_token());
    const uploadUrl = @json($tinymceUploadUrl ?? route('admin.posting.upload-editor-image'));

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
