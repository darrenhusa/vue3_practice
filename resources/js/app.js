require('./bootstrap');

import { createApp } from 'vue'

// import HelloWorld from './components/HelloWorld.vue';
// import StackedColumnWithDataLabelPercents from './components/StackedColumnWithPercentsAsDataLabelsChart.vue';
// import StackedColumnWithDataLabelPercents2 from './components/StackedColumnWithPercentsAsDataLabelsChart2.vue';
import StackedColumnWithDataLabelPercents3 from './components/StackedColumnWithPercentsAsDataLabelsChart3.vue';

const app = createApp({});

// registers our HelloWorld component globally
// app.component('hello-world', HelloWorld);
// app.component('stacked-column-with-data-label-percents', StackedColumnWithDataLabelPercents);
app.component('stacked-column-with-data-label-percents3', StackedColumnWithDataLabelPercents3);

// mount the app to the DOM
app.mount('#app');
