<div>
<div class="flex flex-row w-full pt-16 pb-16">
    <div class="max-w-md mx-auto mt-10 p-5 bg-white shadow-lg rounded-lg">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 font-bold rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-5">
            <div class="flex flex-col space-y-2">
                <label class="block text-lg font-medium">Name</label>
                <input type="text" wire:model="name" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                @error('name') <span class="text-red-400 font-bold invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label class="block text-lg font-medium">Email</label>
                <input type="email" wire:model="email" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                @error('email') <span class="text-red-400 font-bold invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label class="block text-lg font-medium">Content</label>
                <textarea wire:model="content" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal"></textarea>
                @error('content') <span class="text-red-400 font-bold invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label class="block text-lg font-medium">Rating</label>
                <input type="number" placeholder="0 to 5" wire:model="rating" min="1" max="5" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                @error('rating') <span class="text-red-400 font-bold invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col space-y-2">
                <label class="block text-lg font-medium">Image</label>
                <input type="file" wire:model="image" class="flex px-3 py-2 font-medium border-2 border-black rounded-lg md:px-4 md:py-3 placeholder:font-normal" />
                @error('image') <span class="text-red-400 font-bold invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="flex items-center justify-center flex-none px-3 py-2 font-medium text-white bg-black border-2 border-black rounded-lg md:px-4 md:py-3">Submit a Review</button>
            </div>
        </form>
    </div>
</div>

</div>