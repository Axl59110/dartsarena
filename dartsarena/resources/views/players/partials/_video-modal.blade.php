{{-- VIDEO MODAL --}}
<div x-show="videoModal.isOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90"
     @click="videoModal.close()"
     @keydown.escape.window="videoModal.close()"
     style="display: none;">

    <div class="relative w-full max-w-5xl" @click.stop>
        {{-- Close Button --}}
        <button
            @click="videoModal.close()"
            class="absolute -top-12 right-0 text-white/70 hover:text-white text-xl font-bold transition-colors">
            ✕ {{ __('Fermer') }}
        </button>

        {{-- Video Container --}}
        <div class="bg-black rounded-xl overflow-hidden shadow-2xl">
            <div class="aspect-video">
                <iframe
                    :src="videoModal.videoUrl"
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</div>
