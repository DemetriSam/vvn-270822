<x-layout>
    <h1 style="text-align: center">{{ $category->name }}</h1>
    <section class="recomendations">
        @foreach ($grouped as $group)
            <x-public.nodes 
                :title="$group['color']->name" 
                :products="$group['products']"
                :route="$group['thereAreMore'] ? ['catalog.color', ['category' => $category->slug,
                                            'color' => $group['color']->slug]] : null"
                linktext="Смотреть другие {{ mb_strtolower($category->name) }} в этом цвете. Еще {{ $group['moreOnes'] }} вариантов" />
        @endforeach
    </section>
</x-layout>