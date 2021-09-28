<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="max-w-7xl mx-auto pt-4 px-2 md:px-8">
            <div class="bg-green-500 text-white show mt-5 rounded-md p-2">
                <i data-feather="check" class="w-6 h-6 mr-2"></i> {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="py-6 px-2 md:px-0">
        <div class="flex max-w-7xl mx-auto px-8 mb-2">
            <a class="ml-auto" href="{{ route('create-item') }}">
                <x-button>{{ __('Create new') }}</x-button>
            </a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="my-2 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('ID') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Keyword') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Created at') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($ad_items as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->keyword }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->created_at }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap flex flex-wrap">
                                                <div>
                                                    <a href="{{ route('item-results', $item->id) }}"
                                                        class="text-gray-600 hover:text-gray-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="ml-2">
                                                    <a href="{{ route('edit-item', $item->id) }}"
                                                        class="text-gray-600 hover:text-gray-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-edit">
                                                            <path
                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                            </path>
                                                            <path
                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="ml-2">
                                                    <form method="POST" id="ap-{{ $item->id }}"
                                                        action="{{ route('delete-item', $item->id) }}">
                                                        @csrf
                                                        <a href="#"
                                                            onclick="confirm('Are you sure?') ? document.getElementById('ap-{{ $item->id }}').submit() : false"
                                                            class="text-gray-600 hover:text-gray-900">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $ad_items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
