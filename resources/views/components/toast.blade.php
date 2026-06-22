<div
    x-data="{ 
        toasts: [],
        add(event) {
            const toast = {
                id: Date.now(),
                type: event.detail.type || 'info',
                message: event.detail.message,
                visible: true
            };
            this.toasts.push(toast);
            setTimeout(() => {
                this.remove(toast.id);
            }, 4000); // auto dismiss after 4s
        },
        remove(id) {
            const toast = this.toasts.find(t => t.id === id);
            if (toast) {
                toast.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 300); // wait for fade out animation
            }
        }
    }"
    @window-toast.window="add($event)"
    class="fixed top-4 right-4 z-50 flex flex-col gap-3 pointer-events-none"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-show="toast.visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-8"
            class="relative flex items-center p-4 min-w-[320px] max-w-sm text-gray-100 bg-zinc-900/95 backdrop-blur-sm rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-zinc-800 pointer-events-auto"
        >
            <div class="flex-shrink-0">
                <!-- Error Icon -->
                <template x-if="toast.type === 'error'">
                    <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500/10 text-red-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </template>
                <!-- Success Icon -->
                <template x-if="toast.type === 'success'">
                    <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-500/10 text-green-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </template>
            </div>
            <div class="ml-3 mr-4 text-sm font-medium" x-text="toast.message"></div>
            <button @click="remove(toast.id)" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-gray-400 hover:text-gray-100 rounded-lg focus:ring-2 focus:ring-zinc-700 p-1.5 hover:bg-zinc-800 inline-flex h-8 w-8 transition-colors">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            
            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 w-full h-1 bg-zinc-800/50 rounded-b-xl overflow-hidden">
                <div class="h-full bg-zinc-600 animate-[shrink_4s_linear_forwards]"></div>
            </div>
        </div>
    </template>
    
    <style>
        @keyframes shrink {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>
</div>
