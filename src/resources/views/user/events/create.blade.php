<?php

$tags = ['勉強会', 'スポーツ', '娯楽', 'プログラミング', 'React', 'Vue', 'Laravel']

?>

<x-user-app>
    <x-slot name="header_slot">
        <x-user-header textColor="text-pink-600" bgColor="bg-pink-600">
            <x-slot:app_name>Peer Event</x-slot:app_name>
            <x-slot:button_text>イベント登録</x-slot:button_text>
            <x-slot:earned_point>580</x-slot:earned_point>
            <x-slot:distribution_point>5000</x-slot:distribution_point>
        </x-user-header>
    </x-slot>
    <x-slot name="body_slot">
        <x-user-side-navi>
            <div class="w-full mx-auto">
                <x-user-form method="POST">
                    <x-slot name="title">イベントの開催</x-slot>
                    <section class="text-left w-full flex gap-8">
                        <div class="w-1/2">
                            <section class="my-6">
                                <h3 class="mb-2 text-xl text-gray-600 font-extrabold border-b border-gray-500">イベントの詳細</h3>
                                <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">カテゴリ</h4>
                                <div class="w-full flex flex-wrap max-w-lg text-sm font-medium text-gray-900 bg-white">
                                    @foreach ($tags as $index => $tag)
                                    <div class="min-w-max m-1 border rounded border-gray-200">
                                        <div class="flex items-center px-3">
                                            <input id="tag_{{ $index }}" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <label for="tag_{{ $index }}" class="w-auto py-3 pl-1 text-sm font-medium text-gray-900">{{ $tag }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">開催形態<span class="text-red-600">*</span></h4>
                                <div class="mb-4 border border-gray-300 rounded-md">
                                    <select id="example1" class="p-1 block w-full rounded-md border-gray-300 shadow-sm text-lg text-gray-500" required>
                                        <option value="">選択してください</option>
                                        <option value="">対面</option>
                                        <option value="">オンライン</option>
                                        <option value="">対面・オンライン併用</option>
                                        <option value="">未定</option>
                                    </select>
                                </div>
                                <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">開催予定日</h4>
                                <div date-rangepicker class="flex items-center justify-between">
                                    <div class="relative">
                                        <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5" placeholder="開始日">
                                    </div>
                                    <span class="mx-4 text-gray-500">〜</span>
                                    <div class="relative">
                                        <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5" placeholder="終了日">
                                    </div>
                                </div>
                            </section>
                        </div>

                        <section class="my-6 w-1/2">
                            <h3 class="mb-2 text-xl text-gray-600 font-extrabold border-b border-gray-500">イベント名と概要</h3>
                            <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">イベント名<span class="text-red-600">*</span></h4>
                            <div class="mx-auto">
                                <input type="text" class="p-1 block w-full rounded-md border border-gray-300" required />
                            </div>
                            <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">イベントの概要</h4>
                            <div class="mx-auto">
                                <textarea class="p-1 block w-full rounded-md border border-gray-300" rows="3"></textarea>
                            </div>
                            <h4 class="mb-1 mt-4 block text-sm font-medium text-gray-700">関連するリクエスト</h4>
                            <div class="mb-4 border border-gray-300 rounded-md">
                                <select id="example1" class="p-1 block w-full rounded-md border-gray-300 shadow-sm text-lg text-gray-500">
                                    <option value="">なし</option>
                                    <option value="">リクエスト1</option>
                                    <option value="">リクエスト2</option>
                                    <option value="">リクエスト3</option>
                                    <option value="">リクエスト4</option>
                                </select>
                            </div>
                        </section>
                    </section>
                    <x-user-register-button textColor="text-white" bgColor="bg-pink-600" borderColor="border-pink-600">
                        <x-slot name="button">
                            登録する
                        </x-slot>
                    </x-user-register-button>
                </x-user-form>
            </div>
        </x-user-side-navi>
    </x-slot>
</x-user-app>
