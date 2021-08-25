<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @<?if (\Illuminate\Support\Facades\Session::has('status')): ?>
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="text-sm">{{ \Illuminate\Support\Facades\Session::get('status') }}</p>
                </div>
            </div>
        </div>
    <? endif?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.setting.store') }}" method="post">
                        @csrf
                        <label>URL Calback для Telegram</label>
                        <div class="mt-1 relative rounded-md shadow-sm ">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <select id="currency" name="currency"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                    <option>Отправить URL</option>
                                    <option>Получить</option>
                                </select>
                            </div>
                            <input style="padding-left: 9rem;" type="url"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-7 sm:text-sm border-gray-300 rounded-md"
                                   id="url_callback_bot" name="url_callback_bot"
                                   value="{{ $url_callback_bot ?? ''}}">

                        </div>
                        <button type="submit"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mt-3 rightButton">
                            Сохранить
                        </button>
                    </form>
                </div>

                <form id="setwebhook" action="{{ route('admin.setting.setwebhook') }}" method="post" style="">
                    @csrf
                    <input type="hidden" name="url" value="{{ $url_callback_bot ?? '' }}">
                    <button type="submit"
                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mt-3 rightButton">
                        Сохранить
                    </button>
                </form>

                <form id="getwebhookinfo" action="{{ route('admin.setting.getwebhookinfo') }}" method="post" style="display:none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
