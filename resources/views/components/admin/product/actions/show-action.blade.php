@props([
    'row',
    'showModelColumns'
])
<x-secondary-button
    x-data
    x-on:click.prevent="$dispatch('open-modal', 'show-{{ $row->id }}')">
    {{ __('Show') }}
</x-secondary-button>

<x-modal name="show-{{ $row->id }}" focusable>
    <h2 class="p-6 text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        {{ __('Details') }}
    </h2>

    @foreach($showModelColumns as $column)
        <div class="p-4 mb-4 border border-gray-200 dark:border-gray-700 rounded-lg flex justify-between">
            <span class="block font-semibold w-32">{{ is_string($column) ? ucfirst($column) : $column }}:</span>
            <span class="block  text-gray-700 dark:text-gray-300">
                @if($column == 'file')
                    @isset($row->file)
                        <img src="{{ asset('storage/' . $row->file) }}" class="w-16 h-16 rounded" alt="Image">
                    @endisset
                @elseif($column == 'type')
                    {{ $row->type->label() }}
                @else
                    {{ $row->$column }}
                @endif
            </span>
        </div>
    @endforeach

    <div class="p-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">{{ __('Close') }}</x-secondary-button>
    </div>
</x-modal>
