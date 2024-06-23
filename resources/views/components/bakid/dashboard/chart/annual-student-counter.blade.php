<div>
    <x-card-simple class="p-1 h-42">
        <div id="chart-annual-counter"></div>
    </x-card-simple>

    <x-splade-script>
        var options = {
            series: [{
                name: 'Jml',
                data:  @json($jml_data)
            }],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                    enabled: false
                }
            },
            {{-- stroke: {
                curve: 'straight'
            }, --}}

            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            {{-- dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + " ";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            }, --}}

            xaxis: {
                categories: @json($label_data),
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "";
                    }
                }

            },
            title: {
                text: 'Statistik Jumlah Santri',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-annual-counter"), options);
        chart.render();
    </x-splade-script>
</div>