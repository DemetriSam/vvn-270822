<x-layout>
    <h1 style="text-align: center">{{ $category->name }}</h1>
    <section class="recomendations">
        @foreach ($grouped as $group)
        @php
        $color = is_string($group['color']) ? $group['color'] : $group['color']->name;
        @endphp
        <x-public.nodes :title="$color" :products="$group['products']" :route="$group['thereAreMore'] ? ['catalog.color', ['category' => $category->slug,
                                            'color' => $group['color']->slug]] : null" linktext="Смотреть другие {{ mb_strtolower($category->name) }} в этом цвете. Еще {{ $group['moreOnes'] }} вариантов" />
        @endforeach
    </section>
</x-layout>