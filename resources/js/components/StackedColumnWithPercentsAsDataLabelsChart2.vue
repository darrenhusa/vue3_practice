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
      //   required: true
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
        const el = ref(null)

        const styleObject = ref({
          width: props.chartWidth + 'px',
          height: props.chartHeight + 'px',
          border: '1px solid gray',
        })

        // console.log(series)
        // console.log(props.chartWidth)

      console.log(props.url)

      axios.get(props.url)
        .then((response) => {
        console.log('outputing response values...')
        // console.log(response);
        console.log(response.data);
        console.log(response.data['data']['length']);
        console.log('---');
        console.log(response.data['title']);
        console.log(response.data['categories']);
        console.log(response.data['data'][0].label);
        console.log(response.data['data'][0].color);
        console.log(response.data['data'][0].values);

        const series = response.data;
        const number = response.data['data']['length']

        for(let i=0; i<number; i++){
          series.push({
              name: response.data['data'][i].label,
              data: response.data['data'][i].values,
              color: response.data['data'][i].color,

              // name: props.series.data[i].label,
              // data: props.series.data[i].values,
              // color: props.series.data[i].color
          });
        }
      });
        
      onMounted(() => {
        // const seriesTemp = [];
        // const number = props.series.data.length

        console.log('inside onMounted function...')
        // console.log(props.series)
        // console.log(number)
      
        // for(let i=0; i<number; i++){
        //   seriesTemp.push({
        //       name: props.series.data[i].label,
        //       data: props.series.data[i].values,
        //       color: props.series.data[i].color
        //   });
        // }
        console.log(series)

        const chartOptions = {
          chart: {
            type: 'column',
          },
          title: {
              text: props.series.title
          },
          subtitle: {
              text: props.series.subtitle
          },
          xAxis: {
            title: {
                text: props.series.x_axis
            },
            categories: props.series.categories
          },
          yAxis: {
            min: 0,
            title: {
                text: props.series.y_axis
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
            series: seriesTemp,

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

        Highcharts.chart(el.value, chartOptions) //end chart
        
      }) // end onMounted()

      return {
            el,
            styleObject,
      } // end return

    }, // end setup()  
  
  // see https://stackoverflow.com/questions/50144557/how-to-add-data-to-chart-js-with-a-for-loop/50144700
      
//   beforeDestroy: function() {
//     this.target.destroy();
//   },
} // end export default

</script>