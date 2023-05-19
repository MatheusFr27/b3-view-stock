<template>
    <section>
        <WarningComponent />
        <div class="my-6">
            <apexchart width="100%" type="area" :options="optionsBalanceQuantity" :series="[generateSeries[0]]">
            </apexchart>
        </div>
        <div class="my-6">
            <apexchart width="100%" type="area" :options="optionsTradeAveragePrice" :series="[generateSeries[1]]">
            </apexchart>
        </div>
    </section>
</template>

<script>
import { computed } from 'vue';
import { store } from '../store'
import WarningComponent from './WarningComponent.vue';

export default {
    name: 'GraphComponent',
    components: { WarningComponent },
    setup() {
        // Computed
        const historyActions = computed(() => store.getters['historyActions/getHistoryActions']);
        const generateSeries = computed(() => {

            const arrayFormated = [
                {
                    name: 'Quantidade Saldo Posição',
                    data: []
                },
                {
                    name: 'Preço médio',
                    data: []
                }
            ];

            if (historyActions.value.length < 1) return arrayFormated;

            historyActions.value.forEach((el) => {
                const actionBalanceQuantity = {
                    type: 'area',
                    x: new Date(el.date).getTime(),
                    y: el.balance_quantity
                }
                const actionTradeAveragePrice = {
                    type: 'area',
                    x: new Date(el.date).getTime(),
                    y: el.trade_average_price
                }

                arrayFormated[0].data.push(actionBalanceQuantity)
                arrayFormated[1].data.push(actionTradeAveragePrice)

            })

            return arrayFormated;
        });

        // Variables
        const optionsBalanceQuantity = {
            colors: ['#0ea5e9'],
            chart: {
                type: 'area',
                stacked: false,
                height: 350,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                title: 'fff',
                toolbar: {
                    tools: {
                        download: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
            },
            title: {
                text: 'Quantidade Saldo Posição',
                align: 'left',
                style: {
                    fontSize: '16px',
                    color: '#94a3b8'
                }
            },
            grid: {
                row: {
                    colors: ['#1e293b', 'transparent']
                },
            },
            fill: {
                colors: ['#0c4a6e', '#075985', '#0369a1'],
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.7,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                },
            },
            xaxis: {
                type: 'datetime',
            },
            // tooltip: {
            //     shared: false,
            //     y: {
            //         formatter: function (val) {
            //             return val + 'Olaaaa'
            //         }
            //     }
            // },
            // responsive: [
            //     {
            //         breakpoint: 1024,
            //         options: {
            //             chart: {
            //                 with: 300,
            //                 height: 400,

            //             }
            //         }
            //     }
            // ]
        };
        const optionsTradeAveragePrice = {
            colors: ['#0ea5e9'],
            chart: {
                type: 'area',
                stacked: false,
                height: 350,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                title: 'fff',
                toolbar: {
                    tools: {
                        download: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
            },
            title: {
                text: 'Preço Médio',
                align: 'left',
                style: {
                    fontSize: '16px',
                    color: '#94a3b8'
                }
            },
            grid: {
                row: {
                    colors: ['#1e293b', 'transparent']
                },
            },
            fill: {
                colors: ['#0c4a6e', '#075985', '#0369a1'],
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.7,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                },
            },
            xaxis: {
                type: 'datetime',
            },
            // tooltip: {
            //     shared: false,
            //     y: {
            //         formatter: function (val) {
            //             return val + 'Olaaaa'
            //         }
            //     }
            // },
            // responsive: [
            //     {
            //         breakpoint: 1024,
            //         options: {
            //             chart: {
            //                 with: 300,
            //                 height: 400,

            //             }
            //         }
            //     }
            // ]
        };


        return {
            optionsBalanceQuantity, optionsTradeAveragePrice, generateSeries, historyActions
        }
    }
}
</script>

<style></style>
