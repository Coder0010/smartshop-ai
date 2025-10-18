@props([
    'data',
    'tableColumns',
    'showModelColumns' => [],
    'actions' => [],
    'destroyRouteName' => null,
])

<table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            @foreach ($tableColumns as $header)
                <th scope="col"
                    class="p-6 text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    {{ is_string($header) ? ucfirst($header) : $header }}
                </th>
            @endforeach
            @if (!empty($actions))
                <th scope="col"
                    class="px-6 text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                </th>
            @endif
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
        @forelse ($data as $row)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                {{-- Dynamic Columns --}}
                @foreach ($tableColumns as $column)
                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-xs truncate">
                        @if($column == 'type')
                            {{ $row->type->label() }}
                        @else
                            {{ $row->$column }}
                        @endif
                    </td>
                @endforeach
                {{-- Conditional Actions --}}
                @if (!empty($actions))
                    <td class="px-6 py-4">
                        @if (in_array('show', $actions))
                            <x-admin.product.actions.show-action
                            :showModelColumns="$showModelColumns"
                            :row="$row"
                            />
                        @endif

                        @if (in_array('edit', $actions))
                            <x-admin.product.actions.edit-action
                                :row="$row"
                            />
                        @endif

                        @if (in_array('delete', $actions) && $destroyRouteName && Route::has($destroyRouteName))
                            <x-danger-button
                                x-data
                                x-on:click.prevent="$dispatch('open-modal', 'delete-{{ $row->id }}')"
                            >
                                Delete
                            </x-danger-button>

                            <!-- Delete Modal -->
                            <x-modal name="delete-{{ $row->id }}" focusable>
                                <form method="POST" action="{{ route($destroyRouteName, $row->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <h2 class="p-6 text-lg font-medium">Confirm Deletion</h2>
                                    <p class="p-6">Are you sure you want to delete this record?</p>

                                    <div class="p-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                        <x-danger-button class="ml-3">Delete</x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        @endif
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-gray-500 dark:text-gray-400" style="text-align: center;">
                    No leads found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
@if ($data && $data->hasPages())
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
        {{ $data->links() }}
    </div>
@endif
