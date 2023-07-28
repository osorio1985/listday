<div class="w-full min-h-screen container mx-5 my-3">
    <section class="w-full flex justify-between">
        <div>
            <h1 class="text-2xl">
                <span class=" text-[#f9a109] font-bold">
                    Shoppingify
                </span>
                <span>
                    allows you take your shopping list wherever you go
                </span>
            </h1>
        </div>
        <div>
            <div class="relative me-6">
                <input wire:model="filterItem" type="text" id="hs-leading-icon" name="hs-leading-icon"
                    class="py-3 px-4 pl-11 block w-full rounded-md text-sm border-2 border-black"
                    placeholder="search item">
                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <section>
        @php
        $printedCategories = [];
        @endphp

        @foreach($items as $itemCategory)
        @if (!in_array($itemCategory->category, $printedCategories))
        <div>
            <h1 class="my-5 ps-7 font-bold text-xl">
                {{strtoupper($itemCategory->category)}}
            </h1>
            <div class="max-w-[85rem] px-6 mx-auto">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($items as $item)
                    @if ($item->category === $itemCategory->category)
                    <div class="group flex flex-col bg-white border shadow-md rounded-xl">
                        <div class="p-3 md:p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <button class="group-hover:text-blue-600 font-bold text-[#000]"
                                        data-hs-overlay="#hs-overlay-body-scrolling{{$item->id}}">
                                        {{$item->name}}
                                    </button>
                                    <p class="text-sm text-gray-500">
                                        $ {{$item->price}}
                                    </p>
                                </div>
                                <div id="hs-overlay-body-scrolling{{$item->id}}"
                                    class="hs-overlay hs-overlay-open:translate-x-0 hidden fixed top-0 right-0  h-full max-w-md w-full z-[60] bg-white border-r [--body-scroll:true] [--overlay-backdrop:false]"
                                    tabindex="-1">
                                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                                        <h3 class="font-bold text-gray-800 ">
                                            Information
                                        </h3>
                                        <button type="button"
                                            class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800"
                                            data-hs-overlay="#hs-overlay-body-scrolling{{$item->id}}">
                                            <span class="sr-only">Close modal</span>
                                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <div class="aspect-w-16 aspect-h-8">
                                            <img class="w-full object-cover rounded-t-xl" src="{{$item->image}}" alt="Image Description">
                                        </div>
                                        
                                        <div class="p-4 sm:p-10 overflow-y-auto">
                                            <p class="mb-2 font-bold text-gray-800 dark:text-gray-400">
                                                Name
                                            </p>
                                            <h3 class="mb-2 text-2xl font-bold text-gray-800">
                                                {{$item->name}}
                                            </h3>
                                            <p class="mb-2 font-bold text-gray-800 dark:text-gray-400">
                                                Category
                                            </p>
                                            <h4 class="mb-2 text-xl font-bold text-gray-800">
                                                {{$item->category}}
                                            </h4>
                                            <p class="mb-2 font-bold text-gray-800 dark:text-gray-400">
                                                Note
                                            </p>
                                            <h4 class="mb-2 text-xl font-bold text-gray-800 ">
                                                {{$item->note}}
                                            </h4>
                                        
                                            <div class="mt-6 flex justify-center gap-x-4">
                                                <button
                                                    class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold text-blue-500 hover:text-blue-700 focus:outline-none focus:ring-2 ring-offset-white focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm"
                                                    data-hs-overlay="#hs-overlay-body-scrolling{{$item->id}}">
                                                    Close
                                                </button>
                                                <button type="button"
                                                    class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-[#f9a109] text-gray-700 shadow-sm align-middle hover:bg-[#d28707] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm"
                                                    onclick="addToCart({{$item}})" data-hs-overlay="#hs-overlay-body-scrolling{{$item->id}}">
                                                    Add to list
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="pl-3" onclick="addToCart({{$item}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000"
                                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @php
        $printedCategories[] = $itemCategory->category;
        @endphp
        @endif
        @endforeach
    </section>
</div>

<script>
    function addToCart(item) {
        let cartList = document.getElementById("cart");
        let existingItem = cartList.querySelector('input[value="' + item.name + '"]');
        let cartCount = document.getElementById("cartCount");
        let countHTML = 1;
        
        let itemHTML = '<div class="font-bold flex gap-2 justify-between my-2">' +
            '<h4 class="my-auto">' + item.name + '</h4>' +
            '<div class="ms-16">' + 
            '<input class="py-3 px-5 block w-full border-gray-200 rounded-full text-sm focus:border-blue-500 focus:ring-blue-500" name="addItemCount,' + item.id + '" type="number" min="0" value="1">' +
            '<input name="addItem,' + item.id + '" type="text" value="' + item.name + '" hidden>' +
            '</div>' +
            '</div>';
        cartList.innerHTML += itemHTML;

        let currentCount = parseInt(cartCount.innerHTML);
        if (!isNaN(currentCount)) {
            cartCount.innerHTML = currentCount + countHTML;
        } else {
            cartCount.innerHTML = countHTML;
        }
    }
</script>