<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('settings-store') }}" method="POST">
                @csrf
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('General Settings') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Use a real address where you can receive mail.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" autocomplete="email"
                                                value="{{ $settings->email }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="telegram_user_id"
                                                class="block text-sm font-medium text-gray-700">{{ __('Telegram ID') }}</label>
                                            <input type="text" name="telegram_user_id" id="telegram_user_id"
                                                autocomplete="telegram_user_id"
                                                value="{{ $settings->telegram_user_id }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="telegram_bot_username"
                                                class="block text-sm font-medium text-gray-700">{{ __('Telegram Bot Username') }}</label>
                                            <input type="text" name="telegram_bot_username" id="telegram_bot_username"
                                                autocomplete="telegram_bot_username"
                                                value="{{ $settings->telegram_bot_username }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="telegram_bot_token"
                                                class="block text-sm font-medium text-gray-700">{{ __('Telegram Bot Token') }}</label>
                                            <input type="text" name="telegram_bot_token" id="telegram_bot_token"
                                                autocomplete="telegram_bot_token"
                                                value="{{ $settings->telegram_bot_token }}"
                                                class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="language" class="block text-sm font-medium text-gray-700">
                                                {{ __('System Language') }}
                                            </label>
                                            <select id="language" name="language" autocomplete="language"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                                @foreach (config('app.locales') as $locale)
                                                    <option value="{{ $locale }}" @if ($locale == app()->getLocale()) selected @endif>
                                                        {{ config('app.locale_names.' . $locale) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="is_active" class="block text-sm font-medium text-gray-700">
                                                {{ __('System Status') }}
                                            </label>
                                            <select id="is_active" name="is_active" autocomplete="is_active"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                                <option value="0" @if ($settings->is_active == 0) selected @endif>
                                                    {{ __('Disabled') }}
                                                </option>
                                                <option value="1" @if ($settings->is_active == 1) selected @endif>
                                                    {{ __('Enabled') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Decide which communications you'd like to receive and how.
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <fieldset>
                                        <div class="space-y-4">
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="comments" name="comments" type="checkbox"
                                                        class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="comments"
                                                        class="font-medium text-gray-700">Email</label>
                                                    <p class="text-gray-500">Get notified to the email entered in the
                                                        previous block.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="candidates" name="candidates" type="checkbox"
                                                        class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="candidates"
                                                        class="font-medium text-gray-700">Telegram</label>
                                                    <p class="text-gray-500">Get notified via the Telegram Bot.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
