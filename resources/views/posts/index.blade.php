<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-white">{{ __('Subject') }}</label>
                <input
                    type="text"
                    name="subject"
                    id="subject"
                    placeholder="{{ __('Enter the subject') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{ old('subject') }}">
                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
            </div>
            <div class="mb-4 flex justify-stretch space-x-4 space-y-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-white">{{ __('Price') }}</label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        placeholder="{{ __('Enter the price') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0">
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <label for="capacity" class="block text-sm font-medium text-white">{{ __('Capacity') }}</label>
                    <input
                        type="number"
                        name="capacity"
                        id="capacity"
                        placeholder="{{ __('Enter the capacity') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{ old('capacity') }}">
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>
            </div>
            <div class="mb-4">
                <label for="level" class="block text-sm font-medium text-white">{{ __('Level') }}</label>
                <select
                    name="level"
                    id="level"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach(\App\Enums\Level::cases() as $level)
                    <option value="{{ $level->value }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
        </form>


        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($posts as $post)
            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $post->user->name }}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($post->created_at->eq($post->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                        <div>
                            RM {{ $post->price }}
                        </div>
                        @if ($post->user->is(auth()->user()))
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('posts.edit', $post)">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                        @endif
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $post->subject }}</p>
                    <div class="mt-4 p-2 bg-gray-100 rounded-md">
                        <span class="text-gray-800">{{ $post->capacity }} students</span>
                    </div>
                    <div class="mt-4 p-2 bg-gray-100 rounded-md">
                        <span class="ml-2 text-gray-800">{{ $post->level }} Level</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>