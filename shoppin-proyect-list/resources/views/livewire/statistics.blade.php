<div class="w-full min-h-screen container px-5">
  <section class="w-full flex justify-around gap-10">
    <div class="py-4 w-1/3">
      <h1 class="text-2xl text-center font-bold">Top Items</h1>
    
      @php
      $topItems = [];
      $itemCounts = [];
    
      foreach ($shoppingLists as $shoppingList) {
      $itemId = $shoppingList->item_id;
      if (isset($itemCounts[$itemId])) {
      $itemCounts[$itemId]++;
      } else {
      $itemCounts[$itemId] = 1;
      }
      }
    
      arsort($itemCounts);
      $topItemIds = array_slice(array_keys($itemCounts), 0, 3);
    
      foreach ($topItemIds as $itemId) {
      $item = $items->find($itemId);
      if ($item) {
      $count = $itemCounts[$itemId];
      $percentage = round(($count / count($shoppingLists)) * 100);
    
      $topItems[] = [
      'name' => $item->name,
      'percentage' => $percentage,
      ];
      }
      }
      @endphp
    
      @foreach ($topItems as $item)
      <div>{{ $item['name'] }}</div>
      <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 my-3">
        <div class="flex flex-col justify-center overflow-hidden bg-blue-500 text-xs text-white text-center"
          role="progressbar" style="width: {{ $item['percentage'] }}%" aria-valuenow="{{ $item['percentage'] }}"
          aria-valuemin="0" aria-valuemax="100">{{ $item['percentage'] }}%</div>
      </div>
      @endforeach
    </div>
    <div class="py-4 w-1/3">
      <h1 class="text-2xl text-center font-bold">Top Categories</h1>
    
      @php
      $topCategories = [];
      $categoryCounts = [];
    
      foreach ($shoppingLists as $shoppingList) {
      $itemId = $shoppingList->item_id;
      $item = $items->find($itemId);
      if ($item) {
      $category = $item->category;
      if (isset($categoryCounts[$category])) {
      $categoryCounts[$category]++;
      } else {
      $categoryCounts[$category] = 1;
      }
      }
      }
    
      arsort($categoryCounts);
      $topCategories = array_slice(array_keys($categoryCounts), 0, 3);
    
      @endphp
    
      @foreach ($topCategories as $category)
      <div class="mt-4">{{ $category }}</div>
      <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 my-3">
        <div class="flex flex-col justify-center overflow-hidden bg-blue-500 text-xs text-white text-center"
          role="progressbar" style="width: {{ round(($categoryCounts[$category] / count($shoppingLists)) * 100) }}%"
          aria-valuenow="{{ round(($categoryCounts[$category] / count($shoppingLists)) * 100) }}" aria-valuemin="0"
          aria-valuemax="100">{{ round(($categoryCounts[$category] / count($shoppingLists)) * 100) }}%</div>
      </div>
      @endforeach
    </div>
  </section>
  <section class="container mt-10">
    <h1 class="text-2xl text-center font-bold">Monthly Summary</h1>
    <canvas id="monthlySummary"></canvas>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  let rawData = {!! json_encode($shoppingLists) !!};
  let data = {};

  rawData.forEach(function(item) {
    let month = item.created_at.substr(0, 7);
    if (data.hasOwnProperty(month)) {
      data[month] += item.pieces;
    } else {
      data[month] = item.pieces;
    }
  });

  let sortedData = {};
  Object.keys(data).sort().forEach(function(key) {
    sortedData[key] = data[key];
  });

  //console.log(sortedData);
  const ctx = document.getElementById('monthlySummary');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: Object.keys(sortedData),
      datasets: [{
        data: Object.values(sortedData),
        borderWidth: 2,
        label: '# of Items'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>