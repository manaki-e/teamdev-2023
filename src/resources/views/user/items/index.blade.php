<x-user-app>
    <x-slot name="header_slot">
        <x-user-header textColor="text-blue-400" bgColor="bg-blue-400">
            <x-slot:app_name>Peer Item</x-slot:app_name>
            <x-slot:button_text>アイテム登録</x-slot:button_text>
            <x-slot:button_link>{{ route('items.create') }}</x-slot:button_link>
            <x-slot:earned_point>{{Auth::user()->earned_point}}</x-slot:earned_point>
            <x-slot:distribution_point>{{Auth::user()->distribution_point}}</x-slot:distribution_point>
            <x-slot:top_title_link>{{ route('items.index') }}</x-slot:top_title_link>
        </x-user-header>
    </x-slot>
    <x-slot name="body_slot">
        <x-user-side-navi>
            <div class="mx-auto max-w-5xl">
                <x-user-search-box bgColor="bg-blue-400">
                    <x-user-search-item bgColor="bg-blue-400">
                        <x-slot name="filter_by_radio">
                            <x-user-search-radio>
                                <x-slot name="radio_name">利用状況</x-slot>
                                <x-slot name="radios">
                                    @foreach($filter_statuses as $key=>$filter_status)
                                    <div class="flex items-center mb-4">
                                        <input id="box-{{ $key }}" type="radio" value="{{ $key }}" name="status" class="w-4 h-4 bg-gray-100 border-gray-300 filter-input">
                                        <label for="box-{{ $key }}" class="ml-2 text-sm font-medium text-gray-900">{{ $filter_status  }}</label>
                                    </div>
                                    @endforeach
                                </x-slot>
                            </x-user-search-radio>
                        </x-slot>
                        <x-slot name="filter_by_tags">
                            <x-user-search-tags>
                                <x-slot name="category_tags">
                                    @foreach($product_tags as $key=>$value)
                                    <div class="w-auto">
                                        <div class="flex items-center">
                                            <input hidden name="tag" id="tag_{{ $key }}" type="checkbox" value="{{ $value->id }}" class="filter-input w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <label for="tag_{{ $key }}" class="rounded-full border border-gray-300 bg-gray-50 px-2 py-1 text-xs font-semibold text-gray-400 cursor-pointer">{{ $value->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </x-slot>
                            </x-user-search-tags>
                        </x-slot>
                    </x-user-search-item>
                </x-user-search-box>

                <section class="text-gray-600 body-font mx-auto max-w-5xl">
                    <div class="py-12 mx-auto">
                        <div class="grid grid-cols-4 justify-items-stretch gap-8 mb-8">
                            @foreach ($products as $product)
                            <div data-status="{{ $product->status }}" data-tag="{{ $product->data_tag  }}" class="col-span-1 filter-target shadow-md bg-white rounded-lg flex flex-col justify-between">
                                <a href="/items/{{$product->id}}">
                                    <div class="bg-white relative h-48 rounded-t-lg overflow-hidden shadow-sm">
                                        <img alt="no image" class="object-cover w-full h-full block" src="{{asset('images/'.$product->productImages->first()->image_url)}}">
                                        @if ( $product->japanese_status !== '貸出可能' )
                                        <span class="absolute left-0 top-0 rounded-br-lg bg-red-500 px-3 py-1.5 text-sm uppercase tracking-wider text-white">
                                            貸出中
                                        </span>
                                        @endif
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h2 class="text-gray-900 title-font text-lg font-medium">{{$product->title}}</h2>
                                    </div>
                                </a>
                                <div class="mx-2 mt-2 p-2 flex justify-between border-t border-gray-300">
                                    <div class="flex flex-col">
                                        <p class="mb-4 text-2xl text-gray-700 font-sans font-bold">{{$product->point}} pt</p>
                                        <a href="{{ route('users.profile',['user_id'=>$product->user->id]) }}">
                                            <div class="flex">
                                                <div class="h-6 w-6 relative z-30">
                                                    <img class="h-full w-full rounded-full object-cover object-center border border-gray-800" src="{{ $product->user->icon }}" alt="icon" />
                                                </div>
                                                <div class="flex items-center">
                                                    <p class="pl-1 text-sm font-medium text-gray-900 truncate">
                                                        {{ $product->user->display_name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="flex items-end relative likes" data-item_id="{{ $product->id }}" data-is_liked="{{ $product->isLiked }}">
                                        <button class="mt-1 text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="@if($product->isLiked) red @else none @endif" viewBox="0 0 24 24" stroke-width="1.5" stroke="@if($product->isLiked) red @else currentColor @endif" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                        </button>
                                        <div class="mt-3">
                                            <p class="text-xs like-count">{{$product->product_likes_count}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </section>
            </div>
        </x-user-side-navi>

    </x-slot>
</x-user-app>
<script>
    //絞り込みタグの色
    const checkboxes = document.querySelectorAll('input[name="tag"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const checkboxId = checkbox.id;
            const targetLabel = document.querySelector(`label[for="${checkboxId}"]`);

            if (checkbox.checked) {
                targetLabel.classList.add('bg-gray-500');
            } else {
                targetLabel.classList.remove('bg-gray-500');
            }
        });
    });

    // Get all filter inputs
    let filterInputs = document.querySelectorAll('.filter-input');

    // Add event listener to each filter button
    filterInputs.forEach(input => {
        input.addEventListener('click', () => {
            //選択したステータスを変数にいれる
            let checkedStatus = document.querySelector('input[name=status]:checked');
            let checkedStatusValue;
            if (checkedStatus === null) {
                checkedStatusValue = null;
            } else {
                checkedStatusValue = checkedStatus.value;
            }
            // 選択したタグを配列に入れる
            let checkedTags = Array.from(document.querySelectorAll('input[name=tag]:checked'));
            let checkedTagsValues = checkedTags.map(e => e.value);
            // 絞り込み対象全て取得
            let filterTargets = document.querySelectorAll('.filter-target');

            // Show/hide targets based on the integer variable checkedStatus and array variable checkedTags
            filterTargets.forEach(filterTarget => {
                //ターゲットタグを配列に変換
                let targetTags = JSON.parse(filterTarget.dataset.tag);
                //ターゲットタグが空か判定
                let targetTagsEmpty = targetTags.length === 0;
                //インプットタグとターゲットタグの共通項を取得
                let commonTags = checkedTagsValues.filter(value => targetTags.includes(parseInt(value)));
                let filterByTags;
                //ターゲットステータスとステータスラジオの値が一致するか判定
                let statusEqual = filterTarget.dataset.status === checkedStatusValue;
                //インプットタグが空か判定
                let tagsNotChosen = checkedTagsValues.length === 0;
                //ステータスラジオが空か判定
                let statusNotChosen = checkedStatusValue === null;
                //インプットタグとターゲットタグの共通項が空か判定
                let commonTagsEmpty = commonTags.length === 0;

                //共通タグ、選択したタグ、ターゲットタグをコンソールに表示＝＞デバッグ用
                console.log(commonTags, checkedTagsValues, targetTags);

                //ターゲットタグが空かつインプットタグが空ではない場合タグによる絞り込みは偽判定
                if (targetTagsEmpty && !tagsNotChosen) {
                    filterByTags = false;
                }
                //インプットタグが空の場合タグによる絞り込みは真判定
                else if (tagsNotChosen) {
                    filterByTags = true;
                }
                //インプットタグとターゲットタグの共通項がある場合タグによる絞り込みは偽判定
                else if (commonTagsEmpty) {
                    filterByTags = false;
                }
                //インプットタグとターゲットタグの共通項がない場合タグによる絞り込みは真判定
                else if (!commonTagsEmpty) {
                    filterByTags = true;
                }
                if (statusNotChosen) {
                    if (filterByTags) {
                        filterTarget.style.display = 'block';
                    } else {
                        filterTarget.style.display = 'none';
                    }
                } else if (statusEqual && filterByTags) {
                    filterTarget.style.display = 'block';
                } else {
                    filterTarget.style.display = 'none';
                }
            });
        });
    });
</script>
