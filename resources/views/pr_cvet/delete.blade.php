<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ДАННОЕ ДЕЙСТВИЕ НЕОБРАТИМО
        </h2>
    </x-slot>
    <x-form-card>
        <form method="POST" action="{{ route('pr_cvets.destroy', ['pr_cvet' => $prCvet]) }} " enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
            <!-- Title -->
            Вы собираетесь удалить {{ $prCvet->title }} <br/>
            Вы уверены, что хотите удалить этот цвет?
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    <p>УДАЛИТЬ НАВСЕГДА</p>
                </x-button>
            </div>
        </form>
    </x-form-card>
    <style>
        .wide {
            display: none;
        }

        .narrow {
            display: block;
        }

        @media (min-width: 981.98px) {
            .narrow {
                display: none;
            }

            .wide {
                display: block;
            }
        }
    </style>
    <div class="narrow">
        @if($prCvet->getFirstMedia('images'))
        {{$prCvet->getFirstMedia('images')('product_narrow')}}
        @endif
    </div>
    <div class="wide"> @if($prCvet->getFirstMedia('images'))
        {{$prCvet->getFirstMedia('images')('product_wide')}}
        @endif
    </div>


</x-app-layout>