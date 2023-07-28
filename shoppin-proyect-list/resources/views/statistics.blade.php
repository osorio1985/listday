@extends('layouts.app')

@section('main')
@livewire('statistics')
@endsection 

@section('sidebar')
<section>
    <h1 class="text-2xl font-bold">Shopping Lists</h1>
    @php
    $dates = [];
    @endphp

    @php
    $sortedLists = $shoppingLists->sortBy('created_at');
    @endphp

    @foreach($sortedLists as $shoppingList)
    @php
    $formattedDate = date('F Y', strtotime($shoppingList->created_at));
    @endphp

    @if(!in_array($formattedDate, $dates))
    <div>
        <h1 class="my-5 ps-7 font-bold text-md">
            {{$formattedDate}}
        </h1>
        <div class="max-w-[85rem] px-6 mx-auto">
            <div class="grid gap-4">
                @php
                $printedLists = [];
                @endphp

                @foreach($sortedLists as $shoppingListItem)
                @if(date('F Y', strtotime($shoppingList->created_at)) === date('F Y',
                strtotime($shoppingListItem->created_at)))

                @if(!in_array($shoppingListItem->name, $printedLists))
                <div class="group flex flex-col bg-white border shadow-md rounded-xl">
                    <div class="p-3 md:p-4">
                        <div class="flex justify-between items-center">
                            <h1 class="font-bold">
                                {{$shoppingListItem->name}}
                            </h1>
                            <div class="flex">
                                <div class="flex">
                                    <div class="my-auto me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#aeaeb1"
                                            class="bi bi-calendar2-range" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                            <path
                                                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM9 8a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1zm-8 2h4a1 1 0 1 1 0 2H1v-2z" />
                                        </svg>
                                    </div>
                                    <div class="text-[#aeaeb1]">
                                        {{date('l d.m.Y', strtotime($shoppingListItem->created_at))}}
                                    </div>
                                </div>
                                <button class="my-auto ms-3"
                                    data-hs-overlay="#hs-notifications{{$shoppingListItem->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f9a109"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="hs-notifications{{$shoppingListItem->id}}"
                                class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                                <div
                                    class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                    <div
                                        class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden">
                                        <div class="absolute top-2 right-2">
                                            <button type="button"
                                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
                                                data-hs-overlay="#hs-notifications{{$shoppingListItem->id}}">
                                                <span class="sr-only">Close</span>
                                                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4 sm:p-10 overflow-y-auto">
                                            <div class="mb-6 text-center">
                                                <h3 class="mb-2 text-xl font-bold text-black">
                                                    {{$shoppingListItem->name}}
                                                </h3>
                                                <div class="flex justify-center">
                                                    <div class="my-auto me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="#aeaeb1" class="bi bi-calendar2-range"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                                            <path
                                                                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM9 8a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1zm-8 2h4a1 1 0 1 1 0 2H1v-2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="text-[#aeaeb1]">
                                                        {{date('l d.m.Y', strtotime($shoppingListItem->created_at))}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-y-4">
                                                @foreach($items as $item)
                                                <?php
                                                $shoppingItems = $sortedLists->where('item_id', $item->id)->where('name', $shoppingListItem->name);
                                                ?>
                                                @foreach($shoppingItems as $shoppingItem)
                                                <div
                                                    class="flex justify-between bg-[#fafafe] border shadow-sm rounded-xl py-8 px-4">
                                                    <h1 class="font-semibold">{{ $item->name }}</h1>
                                                    <p class="text-[#f9a10a] font-semibold">pcs <span>{{
                                                            $shoppingItem->pieces
                                                            }}</span></p>
                                                </div>
                                                @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $printedLists[] = $shoppingListItem->name;
                @endphp
                @endif
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @php
    $dates[] = $formattedDate;
    @endphp
    @endif
    @endforeach
</section>
@endsection