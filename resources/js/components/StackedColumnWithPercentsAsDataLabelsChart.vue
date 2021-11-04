<template>
    <div ref="el"></div>
</template>

<script>
import Highcharts from 'highcharts';
import Exporting from 'highcharts/modules/exporting';
Exporting(Highcharts);

import { ref, onMounted } from 'vue'

export default {
    name : "StackedColumnChartWithDataLabelPercents",
    props : {
      series : {
        // type: Array,
        type: Object,
        required: true
      },
    //   chartWidth: {
    //     type: Number,
    //     default: 300
    //   },
    //   chartHeight: {
    //     type: Number,
    //     default: 300
    //   }
    // showDataTable : {
    //     type: Boolean,
    //     default: false
    //   },
	}, // end props

    setup(props) {
        const el = ref(null)
        // const series = ref({})
        // const chartHeight = ref(300)
        // const chartWidth = ref(300)

        // const styleObject = ref ({
        //   width: chartWidth + 'px',
        //   height: chartHeight + 'px',
        //   border: '1px solid gray',
        // })

        // console.log(series)

      onMounted(() => {
        const seriesTemp = [];
        const number = props.series.data.length

        console.log('inside onMounted function...')
        // console.log(props.series)
        // console.log(number)
      
        for(let i=0; i<number; i++){
          seriesTemp.push({
              name: props.series.data[i].label,
              data: props.series.data[i].values,
              color: props.series.data[i].color
          });
        }
        console.log(seriesTemp)

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
      } // end return

    }, // end setup()

  	// data : function() {
    //   return {
    //     // target: 'container'
    //     // target: undefined,
    //     styleObject: {
    //       width: this.chartWidth + 'px',
    //       height: this.chartHeight + 'px',
    //       border: '1px solid gray',
    //     },
    //   }
    // },

    // mounted : function() {

      // console.log(this.series);
      // console.log(this.series.title);

      // see https://stackoverflow.com/questions/50144557/how-to-add-data-to-chart-js-with-a-for-loop/50144700
      
//   } // end mounted()
//   beforeDestroy: function() {
//     this.target.destroy();
//   },
} // end export default

</script>