@props([
    'autoresize' => true,
])

<div class="mt-1" wire:ignore>
    <div x-data="{
        content: @entangle($attributes->wire('model')),
        editor: null,
        isUpdating: false,
        init() {
            try {
                tinymce.init({
                    target: this.$refs.editor,
                    ui_container: this.$refs.editor.parentElement,
                    min_height: 400,
                    menubar: false,
                    content_style: `body { font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif; font-size: 16px; color: #18181b; line-height: 1.6; transition: max-width 0.3s ease; } body.is-fullscreen { max-width: 800px; margin: 0 auto; padding: 2rem 1rem; }`,
                    font_size_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
                    font_size_input_default_unit: 'pt',
                    font_family_formats: 'Default=Inter, ui-sans-serif, system-ui, -apple-system, sans-serif; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva',
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                        'quickbars', 'codesample', 'nonbreaking'
                        {{ $autoresize ? ", 'autoresize'" : "" }}
                    ],
                    convert_urls: false,
                    toolbar: 'undo redo | fontfamily fontsize blocks | ' +
                        'bold italic underline strikethrough forecolor backcolor | ' +
                        'alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | ' +
                        'link image media table charmap emoticons codesample | ' +
                        'removeformat | preview fullscreen code help',
                    quickbars_selection_toolbar: 'bold italic underline | blocks | quicklink blockquote',
                    quickbars_insert_toolbar: false,
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
                        
                        editor.on('FullscreenStateChanged', (e) => {
                            if (e.state) {
                                editor.getBody().classList.add('is-fullscreen');
                            } else {
                                editor.getBody().classList.remove('is-fullscreen');
                            }
                        });

                        editor.on('keydown', (e) => {
                            // If Backspace (8) or Delete (46) is pressed on an Image
                            if (e.keyCode === 8 || e.keyCode === 46) {
                                const node = editor.selection.getNode();
                                if (node && node.nodeName === 'IMG') {
                                    // Wait for TinyMCE to remove the image, then reset the cursor
                                    setTimeout(() => {
                                        editor.selection.collapse();
                                    }, 50);
                                }
                            }
                        });

                        editor.on('init', () => {
                            if (this.content != null) {
                                editor.setContent(this.content);
                            }
                        });

                        editor.on('change keyup', () => {
                            this.isUpdating = true;
                            this.content = editor.getContent();
                            this.$nextTick(() => { this.isUpdating = false; });
                        });
                    }
                }).catch(err => {
                    console.error('TinyMCE Init Error:', err);
                    alert('TinyMCE Error: ' + err.message);
                });

                this.$watch('content', (val) => {
                    if (!this.isUpdating && this.editor && val !== this.editor.getContent()) {
                        this.editor.setContent(val || '');
                    }
                });
            } catch (error) {
                console.error('Alpine Init Error:', error);
                alert('Alpine Error: ' + error.message);
            }
        }
    }">
        <textarea x-ref="editor" class="bg-white text-base border-zinc-300 rounded-lg"></textarea>
    </div>
</div>
