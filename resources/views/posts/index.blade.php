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
                        </div>
                        <div>
                            RM {{ $post->price }}
                        </div>
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