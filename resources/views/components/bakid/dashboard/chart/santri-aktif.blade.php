<div class="grow">
    <x-card-simple class="h-full flex items-center justify-center">
        <div id="chart-santri-aktif"></div>
    </x-card-simple>

    <x-splade-script>

        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
            width: 380,
            type: 'pie',
          },
          labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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
          }]
          };
  
          var chart = new ApexCharts(document.querySelector("#chart-santri-aktif"), options);
          chart.render();
    </x-splade-script>
</div>
