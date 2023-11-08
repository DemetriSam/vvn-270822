<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:description>
        {{ $description }}
    </x-slot:description>
    <h1 style="text-align: center">{{ $h1 }}</h1>
    <div class="decorline"><img src="../../../img/icons/DecorLine.svg" alt=""></div>
    <section id="article-text">{!! $text_content !!}</section>

</x-layout>