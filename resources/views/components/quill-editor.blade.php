<div class="mt-1" wire:ignore>
    <div x-data="{
        content: @entangle($attributes->wire('model')),
        editor: null,
        init() {
            tinymce.init({
                target: this.$refs.editor,
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | image link | help',
                images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '/admin/upload-image');
                    
                    const tokenElement = document.querySelector('meta[name=csrf-token]');
                    if (tokenElement) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', tokenElement.getAttribute('content'));
                    }
                    
                    xhr.upload.onprogress = (e) => {
                        progress(e.loaded / e.total * 100);
                    };
                    
                    xhr.onload = () => {
                        if (xhr.status === 403) {
                            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                            return;
                        }
                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }
                        const json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        resolve(json.location);
                    };
                    
                    xhr.onerror = () => {
                        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };
                    
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    
                    xhr.send(formData);
                }),
                setup: (editor) => {
                    this.editor = editor;
                    
                    editor.on('init', () => {
                        if (this.content != null) {
                            editor.setContent(this.content);
                        }
                    });

                    editor.on('change keyup', () => {
                        this.content = editor.getContent();
                    });
                }
            });

            this.$watch('content', (val) => {
                if (this.editor && val !== this.editor.getContent()) {
                    this.editor.setContent(val || '');
                }
            });
        }
    }">
        <textarea x-ref="editor" class="bg-white text-base border-zinc-300 rounded-lg"></textarea>
    </div>
</div>
