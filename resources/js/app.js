require('./bootstrap');

import { createApp } from 'vue'

import HelloWorld from './components/HelloWorld.vue';
import StackedColumnWithDataLabelPercents from './components/StackedColumnWithPercentsAsDataLabelsChart.vue';
import StackedColumnWithDataLabelPercents2 from './components/StackedColumnWithPercentsAsDataLabelsChart2.vue';

const app = createApp({});

// registers our HelloWorld component globally
app.component('hello-world', HelloWorld);
app.component('stacked-column-with-data-label-percents', StackedColumnWithDataLabelPercents);
app.component('stacked-column-with-data-label-percents2', StackedColumnWithDataLabelPercents2);

// mount the app to the DOM
app.mount('#app');
