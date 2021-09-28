<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="max-w-7xl mx-auto pt-4 sm:px-6 lg:px-8">
            <div class="bg-green-500 text-white show mt-5 rounded-md p-2">
                <i data-feather="check" class="w-6 h-6 mr-2"></i> {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('edit-item') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</x-app-layout>
