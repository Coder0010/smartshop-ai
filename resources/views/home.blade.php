<x-guest-layout>
    <div class="container mx-auto py-8 px-4">
        <section class="mb-6 bg-white p-5 rounded shadow">
            <form action="{{ route('home') }}" method="GET" class="flex gap-2">
                <input name="q" value="{{ $searchQuery ?? '' }}" type="text" placeholder="Search products..." class="flex-1 border rounded p-2" />
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
            </form>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1">
                    @foreach($products as $product)
                        <x-guest.products.single-product :product="$product"/>
                    @endforeach
                </div>

                {{-- If paginator --}}
                @if(method_exists($products, 'links'))
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

            <aside class="md:col-span-1">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold mb-3">Recommended for you</h2>
                    @forelse($recommendations as $recommendedProduct)
                        <x-guest.products.recommanded-product :product="$recommendedProduct"/>
                    @empty
                        <h3 class="text-center">No products found</h3>
                    @endforelse
                </div>
            </aside>
        </div>
    </div>
</x-guest-layout>
