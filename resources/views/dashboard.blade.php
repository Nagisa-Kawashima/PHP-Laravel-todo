<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex flex-row-reverse py-2">
            <a href="/"
                class="inline-block text-black text-x2">皆のタスク一覧へ
            </a>
        </div>
    </x-slot>
    
    <h3 class="py-3">現在のあなたのタスク</h3>
    @if ($todo_lists->isNotEmpty())
        <div class="container px-5 py-5 mx-auto">
            <ul class="font-medium text-gray-900 bg-white rounded-lg border border-gray-200">
                @foreach ($todo_lists as $item)
                    <li class="py-4 px-5 w-full rounded-t-lg border-b last:border-b-0 border-gray-200">
                        {{ $item->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
