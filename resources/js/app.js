import './bootstrap';
import VueApexCharts from "vue3-apexcharts";

import { createApp } from 'vue';

import App from './src/App.vue'
import { store } from './src/store'

const app = createApp(App);

app.use(store);
app.use(VueApexCharts);

app.mount('#app');
