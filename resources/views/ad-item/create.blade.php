<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new ad item') }}
        </h2>
    </x-slot>

    <div class="pb-4 md:py-8 px-2 md:px-0">
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <form action="{{ route('item-store') }}" method="POST">
                @csrf
                <div class="mt-10 md:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 md:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('General Settings') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('To get precisely correct ad items, please, fill all the necessary information.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden rounded-md">
                                <div class="px-4 py-5 bg-white md:p-6">
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-12 md:col-span-4">
                                            <label for="keyword"
                                                class="block text-sm font-medium text-gray-700">{{ __('Keyword') }}</label>
                                            <input type="text" name="keyword" id="keyword" autocomplete="keyword"
                                                value="{{ old('keyword', '') }}" placeholder="keyword"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-12 md:col-span-2">
                                            <label for="provider"
                                                class="block text-sm font-medium text-gray-700">{{ __('Provider') }}</label>
                                            <select id="provider" name="provider" autocomplete="provider"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                @foreach ($providers as $provider => $data)
                                                    <option value="{{ $provider }}">
                                                        {{ $data['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-12 md:col-span-6">
                                            <label for="start_url"
                                                class="block text-sm font-medium text-gray-700">{{ __('Starting URL') }}</label>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('If not specified, the default url will be used.') }}
                                            </p>
                                            <input type="text" name="start_url" id="start_url" autocomplete="start_url"
                                                value="{{ old('start_url', '') }}" placeholder="https://google.com"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-5 md:col-span-3">
                                            <label for="price_min" class="block text-sm font-medium text-gray-700">
                                                {{ __('Price Minimum, AZN') }}
                                                <span class="text-red-600">*</span>
                                            </label>
                                            <input type="number" name="price_min" id="price_min"
                                                autocomplete="price_min" value="{{ old('price_min', '') }}"
                                                placeholder="0" required
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-7 md:col-span-3">
                                            <label for="price_max" class="block text-sm font-medium text-gray-700">
                                                {{ __('Price Maximum, AZN') }}
                                                <span class="text-red-600">*</span>
                                            </label>
                                            <input type="number" name="price_max" id="price_max"
                                                autocomplete="price_max" value="{{ old('price_max', '') }}"
                                                placeholder="10000" required
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-12 md:col-span-6">
                                            <label for="blacklisted"
                                                class="block text-sm font-medium text-gray-700">{{ __('Blacklist') }}</label>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Enter comma-separated words to be blacklisted.') }}
                                            </p>
                                            <input type="text" name="blacklisted" id="blacklisted"
                                                autocomplete="blacklisted" value="{{ old('blacklisted', '') }}"
                                                placeholder="{{ __('word1,word2,word3') }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 md:col-span-3">
                                            <label for="minutes" class="block text-sm font-medium text-gray-700">
                                                {{ __('Repeat Every') }}
                                            </label>
                                            <select id="minutes" name="minutes" autocomplete="minutes"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                @foreach (config('parsers.periods') as $key)
                                                    <option value="{{ $key }}">
                                                        {{ $key . ' ' . __('minute(s)') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 md:col-span-3">
                                            <label for="is_active" class="block text-sm font-medium text-gray-700">
                                                {{ __('Status') }}
                                            </label>
                                            <select id="is_active" name="is_active" autocomplete="is_active"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                <option value="1" selected>{{ __('Enabled') }}</option>
                                                <option value="0">{{ __('Disabled') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-right">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
