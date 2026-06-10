<div class="mt-1" wire:ignore>
    <div x-data="{
        content: @entangle($attributes->wire('model')),
        quill: null
    }"
    x-init="
        quill = new Quill($refs.quillEditor, {
            theme: 'snow',
            placeholder: 'Tulis konten di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        // Set initial content
        if (content) {
            quill.clipboard.dangerouslyPasteHTML(content);
        }

        // Listen for changes from Quill and update Livewire
        quill.on('text-change', function() {
            let html = quill.root.innerHTML;
            if(html === '<p><br></p>') {
                html = null;
            }
            content = html;
        });

        // Listen for changes from Livewire
        $watch('content', value => {
            if (value !== quill.root.innerHTML) {
                if(!value) {
                    quill.setText('');
                } else {
                    quill.clipboard.dangerouslyPasteHTML(value);
                }
            }
        });
    ">
        <div x-ref="quillEditor" class="bg-white min-h-[300px] text-base border-zinc-300 rounded-b-lg rounded-t-none"></div>
    </div>
</div>
