@props([
    'action',
    'title' => 'Delete Confirmation',
    'message' => 'Are you sure you want to delete this item?'
])

<x-modal name="confirm-delete" focusable>
    <form method="POST" action="{{ $action }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ $message }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3">
                Delete
            </x-danger-button>
        </div>
    </form>
</x-modal>
