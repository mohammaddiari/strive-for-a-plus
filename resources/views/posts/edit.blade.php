<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-white">{{ __('Subject') }}</label>
                <input
                    type="text"
                    name="subject"
                    id="subject"
                    placeholder="{{ __('Enter the subject') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    value="{{ old('subject', $post->subject) }}">
                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
            </div>
            <div class="mb-4 flex justify-between">
                <div>
                    <label for="price" class="block text-sm font-medium text-white">{{ __('Price') }}</label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        placeholder="{{ __('Enter the price') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        value="{{ old('price', $post->price) }}"
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
                        value="{{ old('capacity', $post->capacity) }}">
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
                    <option value="{{ $level->value }}">{{ ucwords(str_replace('_', ' ', $level->value)) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('level')" class="mt-2" />
            </div>
            <div class="mt-4 space-x-2 text-white">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>