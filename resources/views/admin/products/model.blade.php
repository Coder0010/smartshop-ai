@props([
    'row' => null,
    'route' => '',
    'method' => 'POST',
    'name' => 'modal',
])

<x-modal :name="$name"
         :show="session('open_popup_modal') === $name"
         focusable>
    <div class="max-h-[80vh] overflow-y-auto p-6 space-y-6 bg-white dark:bg-gray-800 rounded-lg">
        <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ $row ? __('Update') : __('Add') }}
            </h2>

            <div class="mb-4">
                <x-input-label :for="'name'" :value="__('Name')" />
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name', $row?->name)"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- price -->
            <div class="mb-4">
                <x-input-label for="price" :value="__('price')" />
                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                              value="{{ old('price', $row?->price) }}" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                    style="resize: none"
                >{{ old('description', $row?->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- File -->
            <div class="mb-4">
                <x-input-label for="image" :value="__('Image')" />
                <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-primary-button>{{ $row ? __('Update') : __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
