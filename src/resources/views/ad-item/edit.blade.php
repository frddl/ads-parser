<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ad item') }} #{{ $adItem->id }}
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="max-w-7xl mx-auto pt-4 sm:px-6 lg:px-8">
            <div class="bg-green-500 text-white show mt-5 rounded-md p-2">
                <i data-feather="check" class="w-6 h-6 mr-2"></i> {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="pb-4 md:py-8 px-2 md:px-0">
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <form action="{{ route('edit-item', $adItem->id) }}" method="POST">
                @csrf
                <div class="mt-10 md:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 md:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('General Settings') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Use a real address where you can receive mail.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden rounded-md">
                                <div class="px-4 py-5 bg-white md:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-12 md:col-span-4">
                                            <label for="keyword"
                                                class="block text-sm font-medium text-gray-700">{{ __('Keyword') }}</label>
                                            <input type="text" name="keyword" id="keyword" autocomplete="keyword"
                                                value="{{ old('keyword', $adItem->keyword) }}" placeholder="keyword"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-12 md:col-span-2">
                                            <label for="provider"
                                                class="block text-sm font-medium text-gray-700">{{ __('Provider') }}</label>
                                            <select id="provider" name="provider" autocomplete="provider"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                @foreach ($providers as $provider => $data)
                                                    <option value="{{ $provider }}" @if ($adItem->provider == $provider) selected @endif>
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
                                                value="{{ old('start_url', $adItem->start_url) }}"
                                                placeholder="https://google.com"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-5 md:col-span-3">
                                            <label for="price_min"
                                                class="block text-sm font-medium text-gray-700">{{ __('Price Minimum, AZN') }}</label>
                                            <input type="number" name="price_min" id="price_min"
                                                autocomplete="price_min"
                                                value="{{ old('price_min', $adItem->price_min) }}" placeholder="0"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-7 md:col-span-3">
                                            <label for="price_max"
                                                class="block text-sm font-medium text-gray-700">{{ __('Price Maximum, AZN') }}</label>
                                            <input type="number" name="price_max" id="price_max"
                                                autocomplete="price_max"
                                                value="{{ old('price_max', $adItem->price_max) }}"
                                                placeholder="10000"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-12 md:col-span-6">
                                            <label for="blacklisted"
                                                class="block text-sm font-medium text-gray-700">{{ __('Blacklist') }}</label>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Enter comma-separated words to be blacklisted.') }}
                                            </p>
                                            <textarea name="blacklisted" id="blacklisted"
                                                autocomplete="blacklisted"
                                                placeholder="{{ __('word1,word2,word3') }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md"
                                                rows="5">{{ old('blacklisted', $adItem->blacklisted) }}</textarea>
                                        </div>

                                        <div class="col-span-12 md:col-span-2">
                                            <label for="telegram_id"
                                                class="block text-sm font-medium text-gray-700">{{ __('Telegram ID') }}</label>
                                            <input type="text" name="telegram_id" id="telegram_id"
                                                autocomplete="telegram_id"
                                                value="{{ old('telegram_id', $adItem->telegram_id) }}"
                                                placeholder="Telegram ID"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm md:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 md:col-span-2">
                                            <label for="minutes" class="block text-sm font-medium text-gray-700">
                                                {{ __('Repeat Every') }}
                                            </label>
                                            <select id="minutes" name="minutes" autocomplete="minutes"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                @foreach (config('parsers.periods') as $key)
                                                    <option value="{{ $key }}" @if ($adItem->minutes == $key) selected @endif>
                                                        {{ $key . ' ' . __('minute(s)') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 md:col-span-2">
                                            <label for="is_active" class="block text-sm font-medium text-gray-700">
                                                {{ __('Status') }}
                                            </label>
                                            <select id="is_active" name="is_active" autocomplete="is_active"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 md:text-sm">
                                                <option value="1" @if ($adItem->is_active == 1) selected @endif>
                                                    {{ __('Enabled') }}
                                                </option>
                                                <option value="0" @if ($adItem->is_active == 0) selected @endif>
                                                    {{ __('Disabled') }}
                                                </option>
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
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
