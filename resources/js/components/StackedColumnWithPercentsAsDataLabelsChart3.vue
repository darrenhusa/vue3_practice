<template>
    <div ref="el" v-bind:style="styleObject"></div>
</template>

<script>
import Highcharts from 'highcharts';
import Exporting from 'highcharts/modules/exporting';
Exporting(Highcharts);

import { ref, onMounted } from 'vue'

export default {
    name : "StackedColumnChartWithDataLabelPercents2",
    props : {
      url : {
        type: String,
        required: true
      },
      // series : {
      //   // type: Array,
      //   type: Object,
      //   // required: true
      // },
      chartWidth: {
        type: Number,
        default: 300
      },
      chartHeight: {
        type: Number,
        default: 300
      }
	}, // end props

    setup(props) {
        console.log('inside setup')

        const el = ref(null);

        const styleObject = ref({
          width: props.chartWidth + 'px',
          height: props.chartHeight + 'px',
          border: '1px solid gray',
        });

        let data = ref({});
        let seriesTemp = ref([]);
        // const loading = ref(true);
        // const error = ref(null);

        function fetchData() {
          console.log('inside fetchData');

          // axios.get(props.url).then(response => console.log(response.data));
          axios.get(props.url).then(function(response) {

            data = response.data;
            // data.value = response.data;
            // console.log(response.data);
            console.log(data);
            // console.log(data.data[0].label);
            // console.log(data.data[0].values);
            // console.log(data.data[0].color);
            
            // console.log(data.title)
            // console.log(data.value.title);
            // console.log(data.subtitle);
          
            const number = data.data.length;
            // console.log(number);

            for(let i=0; i<number; i++){
              // seriesTemp.name = data.data[i].label;
              // seriesTemp.data = data.data[i].values;
              // seriesTemp.color = data.data[i].color;
              // 
              seriesTemp.value.push({
                  name: data.data[i].label,
                  data: data.data[i].values,
                  color: data.data[i].color
              }); // end push
            } // end for

            // console.log(seriesTemp.value);

          }) // end axios then

          // loading.value = true;

          // return axios(props.url, {
          //     method: 'get',
          //     headers: {
          //       'content-type': 'application/json'
          //     }
          //   })
          //     .then(res => {
          //       // a non-200 response code
          //       if (!res.ok) {
          //                        // create error instance with HTTP status text
          //         const error = new Error(res.statusText);
          //         error.json = res.json();
          //         throw error;
          //       }

          //       return res.json();
          //     })
          //     .then(json => {
          //       // set the response data
          //       data.value = json.data;

          //       console.log(data.value);
          //     })
          //     .catch(err => {
          //       error.value = err;
          //       // In case a custom JSON error response was provided
          //       if (err.json) {
          //         return err.json.then(json => {
          //           // set the JSON response message
          //           error.value.message = json.message;
          //         });
          //       }
          //     })
          //     .then(() => {
          //       loading.value = false;
          //     });
        } // end fetchData
        
        onMounted(() => {
          console.log('inside onMounted')
          fetchData();

          // const seriesTemp = [];
          // const number = 2
          // const number = data.data.length

          // console.log('inside onMounted function...')
          // console.log(props.series)
          // console.log(number)
      
        // for(let i=0; i<number; i++){
        //   seriesTemp.push({
        //       name: data.data[i].label,
        //       data: data.data[i].values,
        //       color: data.data[i].color
        //   });
        // } // end for

          const chartOptions = {
            chart: {
              type: 'column',
            },
            title: {
                text: data.title
            },
            subtitle: {                                                                                                                                                                                                                                                                 
                text: data.subtitle
            },
            xAxis: {
              title: {
                  text: data.x_axis
              },
              categories: data.categories
            },
            yAxis: {
              min: 0,
              title: {
                  text: data.y_axis
              },
              stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: 'gray'
                    //   color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
              }
              },
              // legend: {
              //     align: 'right',
              //     x: -70,
              //     verticalAlign: 'top',
              //     y: 20,
              //     floating: true,
              //     backgroundColor: 'white',
              //   //   backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
              //     borderColor: '#CCC',
              //     borderWidth: 1,
              //     shadow: false
              // },
              tooltip: {
                  formatter: function() {
                      return '<b>'+ this.x +'</b><br/>'+
                          this.series.name +': '+ this.y +'<br/>'+
                          'Total: '+ this.point.stackTotal;
                  }
              },
              plotOptions: {
                  column: {
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          formatter: function () {
                              return Math.round(100 * this.y / this.total) + '%';
                          },
                          color: 'white',
                          //   color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                          style: {
                              textShadow: '0 0 3px black, 0 0 3px black'
                          }
                      }
                  }
              },
              series: seriesTemp.value,

              legend: {
                      enabled: true,
                      layout: 'horizontal',
                      align: 'center',
                      verticalAlign: 'top',
                  },

              credits: {
                  enabled: false
              },
          } // end chartOptions

          Highcharts.chart(el.value, chartOptions); //end chart
          
        }); // end onMounted()

      return {
        el,
        styleObject,
        data,
        // loading,
        // error,
        // seriesTemp,
        // results,                                                                                                                                                                                                                                           
      }; // end return

    }, // end setup()  
  
  // see https://stackoverflow.com/questions/50144557/how-to-add-data-to-chart-js-with-a-for-loop/50144700
      
//   beforeDestroy: function() {
//     this.target.destroy();
//   },
} // end export default

</script>