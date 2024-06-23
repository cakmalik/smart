<div class="grow">
    <x-card-simple class="h-full flex flex-col items-center justify-center">
        <div id="chart-santri-aktif"></div>
        <div class="text-sm mt-10 font-semibold">Santri Aktif</div>
    </x-card-simple>

    <x-splade-script>

        var options = {
            series: @json($series),
            chart: {
            width: 380,
            type: 'pie',
          },
          labels: @json($labels),
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }], 
        };
  
          var chart = new ApexCharts(document.querySelector("#chart-santri-aktif"), options);
          chart.render();
    </x-splade-script>
</div>
