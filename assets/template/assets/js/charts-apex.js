/**
 * Charts Apex
 */

'use strict';

(function () {
  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

  // Color constant
  const chartColors = {
    column: {
      series1: '#826af9',
      series2: '#d2b0ff',
      bg: '#f8d3ff'
    },
    donut: {
      series1: '#fee802',
      series2: '#3fd0bd',
      series3: '#826bf8',
      series4: '#2b9bf4'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };

  // Heat chart data generator
  function generateDataHeat(count, yrange) {
    let i = 0;
    let series = [];
    while (i < count) {
      let x = 'w' + (i + 1).toString();
      let y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

      series.push({
        x: x,
        y: y
      });
      i++;
    }
    return series;
  }

  // Line Area Chart
  // --------------------------------------------------------------------
  const areaChartEl = document.querySelector('#lineAreaChart'),
    areaChartConfig = {
      chart: {
        height: 400,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: false,
        curve: 'straight'
      },
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'start',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
      series: [
        {
          name: 'Visits',
          data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375]
        },
        {
          name: 'Clicks',
          data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275]
        },
        {
          name: 'Sales',
          data: [20, 40, 30, 70, 40, 60, 50, 140, 120, 100, 140, 180, 220]
        }
      ],
      xaxis: {
        categories: [
          '7/12',
          '8/12',
          '9/12',
          '10/12',
          '11/12',
          '12/12',
          '13/12',
          '14/12',
          '15/12',
          '16/12',
          '17/12',
          '18/12',
          '19/12',
          '20/12'
        ],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      fill: {
        opacity: 1,
        type: 'solid'
      },
      tooltip: {
        shared: false
      }
    };
  if (typeof areaChartEl !== undefined && areaChartEl !== null) {
    const areaChart = new ApexCharts(areaChartEl, areaChartConfig);
    areaChart.render();
  }

  // Bar Chart
  // --------------------------------------------------------------------
  const barChartEl = document.querySelector('#barChart'),
    barChartConfig = {
      chart: {
        height: 400,
        type: 'bar',
        stacked: true,
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '15%',
          colors: {
            backgroundBarColors: [
              chartColors.column.bg,
              chartColors.column.bg,
              chartColors.column.bg,
              chartColors.column.bg,
              chartColors.column.bg
            ],
            backgroundBarRadius: 10
          }
        }
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'start',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      colors: [chartColors.column.series1, chartColors.column.series2],
      stroke: {
        show: true,
        colors: ['transparent']
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [
        {
          name: 'Apple',
          data: [90, 120, 55, 100, 80, 125, 175, 70, 88, 180]
        },
        {
          name: 'Samsung',
          data: [85, 100, 30, 40, 95, 90, 30, 110, 62, 20]
        }
      ],
      xaxis: {
        categories: ['7/12', '8/12', '9/12', '10/12', '11/12', '12/12', '13/12', '14/12', '15/12', '16/12'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      fill: {
        opacity: 1
      }
    };
  if (typeof barChartEl !== undefined && barChartEl !== null) {
    const barChart = new ApexCharts(barChartEl, barChartConfig);
    barChart.render();
  }

let tahun = '';
	let bulan=''
	let wilayah = '';
	dataPerbulan_t();
	dataPerhari_t();
	$('#search_temperatureTahun').change(function () {
    var tahun = $(this).val().toLowerCase();
    var wilayah = $('#search_wilayahWilayah').val().toLowerCase();
		dataPerbulan_t(tahun,wilayah);
	});
	$('#search_wilayahWilayah').change(function () {
			var tahun = $('#search_temperatureTahun').val().toLowerCase();
			var wilayah = $(this).val().toLowerCase();
			dataPerbulan_t(tahun,wilayah);
	});

	//search harian
	$('#search_temperatureTahun_H').change(function () {
    var tahun = $(this).val().toLowerCase();
    var bulan = $('#search_temperatureBulan_H').val().toLowerCase();
    var wilayah = $('#search_wilayahTemperatureH').val().toLowerCase();
    console.log(tahun,bulan,wilayah);
		dataPerhari_t(tahun,bulan,wilayah);
	});
	$('#search_temperatureBulan_H').change(function () {
		var tahun = $('#search_temperatureTahun_H').val().toLowerCase();
		var bulan = $(this).val().toLowerCase();
		var wilayah = $('#search_wilayahTemperatureH').val().toLowerCase();
		console.log(tahun,bulan,wilayah);
			dataPerhari_t(tahun,bulan,wilayah);
		});
	$('#search_wilayahTemperatureH').change(function () {
			var tahun = $('#search_temperatureTahun_H').val().toLowerCase();
			var bulan = $('#search_temperatureBulan_H').val().toLowerCase();
			var wilayah = $(this).val().toLowerCase();
			console.log(tahun,bulan,wilayah);
			dataPerhari_t(tahun,bulan,wilayah);
	});

  function dataPerhari_t(tahun,bulan,wilayah){
		$.ajax({
			url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbyhari', //url
			type: 'GET',
			data: { tahun: tahun,bulan:bulan,wilayah:wilayah },
			dataType: 'json',
			success: function (response) {
				
				var hari_1 = (response['hari_1'] && response['hari_1']['temperature']) ? parseFloat(response['hari_1']['temperature']).toFixed(1) : 0;
				var hari_1 = (response['hari_1'] && response['hari_1']['temperature']) ? parseFloat(response['hari_1']['temperature']).toFixed(1) : 0;
				var hari_2 = (response['hari_2'] && response['hari_2']['temperature']) ? parseFloat(response['hari_2']['temperature']).toFixed(1) : 0;
				var hari_3 = (response['hari_3'] && response['hari_3']['temperature']) ? parseFloat(response['hari_3']['temperature']).toFixed(1) : 0;
				var hari_4 = (response['hari_4'] && response['hari_4']['temperature']) ? parseFloat(response['hari_4']['temperature']).toFixed(1) : 0;
				var hari_5 = (response['hari_5'] && response['hari_5']['temperature']) ? parseFloat(response['hari_5']['temperature']).toFixed(1) : 0;
				var hari_6 = (response['hari_6'] && response['hari_6']['temperature']) ? parseFloat(response['hari_6']['temperature']).toFixed(1) : 0;
				var hari_7 = (response['hari_7'] && response['hari_7']['temperature']) ? parseFloat(response['hari_7']['temperature']).toFixed(1) : 0;
				var hari_8 = (response['hari_8'] && response['hari_8']['temperature']) ? parseFloat(response['hari_8']['temperature']).toFixed(1) : 0;
				var hari_9 = (response['hari_9'] && response['hari_9']['temperature']) ? parseFloat(response['hari_9']['temperature']).toFixed(1) : 0;
				var hari_10 = (response['hari_10'] && response['hari_10']['temperature']) ? parseFloat(response['hari_10']['temperature']).toFixed(1) : 0;
				var hari_11 = (response['hari_11'] && response['hari_11']['temperature']) ? parseFloat(response['hari_11']['temperature']).toFixed(1) : 0;
				var hari_12 = (response['hari_12'] && response['hari_12']['temperature']) ? parseFloat(response['hari_12']['temperature']).toFixed(1) : 0;
				var hari_13 = (response['hari_13'] && response['hari_13']['temperature']) ? parseFloat(response['hari_13']['temperature']).toFixed(1) : 0;
				var hari_14 = (response['hari_14'] && response['hari_14']['temperature']) ? parseFloat(response['hari_14']['temperature']).toFixed(1) : 0;
				var hari_15 = (response['hari_15'] && response['hari_15']['temperature']) ? parseFloat(response['hari_15']['temperature']).toFixed(1) : 0;
				var hari_16 = (response['hari_16'] && response['hari_16']['temperature']) ? parseFloat(response['hari_16']['temperature']).toFixed(1) : 0;
				var hari_17 = (response['hari_17'] && response['hari_17']['temperature']) ? parseFloat(response['hari_17']['temperature']).toFixed(1) : 0;
				var hari_18 = (response['hari_18'] && response['hari_18']['temperature']) ? parseFloat(response['hari_18']['temperature']).toFixed(1) : 0;
				var hari_19 = (response['hari_19'] && response['hari_19']['temperature']) ? parseFloat(response['hari_19']['temperature']).toFixed(1) : 0;
				var hari_20 = (response['hari_20'] && response['hari_20']['temperature']) ? parseFloat(response['hari_20']['temperature']).toFixed(1) : 0;
				var hari_21 = (response['hari_21'] && response['hari_21']['temperature']) ? parseFloat(response['hari_21']['temperature']).toFixed(1) : 0;
				var hari_22 = (response['hari_22'] && response['hari_22']['temperature']) ? parseFloat(response['hari_22']['temperature']).toFixed(1) : 0;
				var hari_23 = (response['hari_23'] && response['hari_23']['temperature']) ? parseFloat(response['hari_23']['temperature']).toFixed(1) : 0;
				var hari_24 = (response['hari_24'] && response['hari_24']['temperature']) ? parseFloat(response['hari_24']['temperature']).toFixed(1) : 0;
				var hari_25 = (response['hari_25'] && response['hari_25']['temperature']) ? parseFloat(response['hari_25']['temperature']).toFixed(1) : 0;
				var hari_26 = (response['hari_26'] && response['hari_26']['temperature']) ? parseFloat(response['hari_26']['temperature']).toFixed(1) : 0;
				var hari_27 = (response['hari_27'] && response['hari_27']['temperature']) ? parseFloat(response['hari_27']['temperature']).toFixed(1) : 0;
				var hari_28 = (response['hari_28'] && response['hari_28']['temperature']) ? parseFloat(response['hari_28']['temperature']).toFixed(1) : 0;
				var hari_29 = (response['hari_29'] && response['hari_29']['temperature']) ? parseFloat(response['hari_29']['temperature']).toFixed(1) : 0;
				var hari_30 = (response['hari_30'] && response['hari_30']['temperature']) ? parseFloat(response['hari_30']['temperature']).toFixed(1) : 0;
				var hari_31 = (response['hari_31'] && response['hari_31']['temperature']) ? parseFloat(response['hari_31']['temperature']).toFixed(1) : 0;


				var hari_1_humidity = (response['hari_1'] && response['hari_1']['humidity']) ? parseFloat(response['hari_1']['humidity']).toFixed(1) : 0;
				var hari_2_humidity = (response['hari_2'] && response['hari_2']['humidity']) ? parseFloat(response['hari_2']['humidity']).toFixed(1) : 0;
				var hari_3_humidity = (response['hari_3'] && response['hari_3']['humidity']) ? parseFloat(response['hari_3']['humidity']).toFixed(1) : 0;
				var hari_4_humidity = (response['hari_4'] && response['hari_4']['humidity']) ? parseFloat(response['hari_4']['humidity']).toFixed(1) : 0;
				var hari_5_humidity = (response['hari_5'] && response['hari_5']['humidity']) ? parseFloat(response['hari_5']['humidity']).toFixed(1) : 0;
				var hari_6_humidity = (response['hari_6'] && response['hari_6']['humidity']) ? parseFloat(response['hari_6']['humidity']).toFixed(1) : 0;
				var hari_7_humidity = (response['hari_7'] && response['hari_7']['humidity']) ? parseFloat(response['hari_7']['humidity']).toFixed(1) : 0;
				var hari_8_humidity = (response['hari_8'] && response['hari_8']['humidity']) ? parseFloat(response['hari_8']['humidity']).toFixed(1) : 0;
				var hari_9_humidity = (response['hari_9'] && response['hari_9']['humidity']) ? parseFloat(response['hari_9']['humidity']).toFixed(1) : 0;
				var hari_10_humidity = (response['hari_10'] && response['hari_10']['humidity']) ? parseFloat(response['hari_10']['humidity']).toFixed(1) : 0;
				var hari_11_humidity = (response['hari_11'] && response['hari_11']['humidity']) ? parseFloat(response['hari_11']['humidity']).toFixed(1) : 0;
				var hari_12_humidity = (response['hari_12'] && response['hari_12']['humidity']) ? parseFloat(response['hari_12']['humidity']).toFixed(1) : 0;
				var hari_13_humidity = (response['hari_13'] && response['hari_13']['humidity']) ? parseFloat(response['hari_13']['humidity']).toFixed(1) : 0;
				var hari_14_humidity = (response['hari_14'] && response['hari_14']['humidity']) ? parseFloat(response['hari_14']['humidity']).toFixed(1) : 0;
				var hari_15_humidity = (response['hari_15'] && response['hari_15']['humidity']) ? parseFloat(response['hari_15']['humidity']).toFixed(1) : 0;
				var hari_16_humidity = (response['hari_16'] && response['hari_16']['humidity']) ? parseFloat(response['hari_16']['humidity']).toFixed(1) : 0;
				var hari_17_humidity = (response['hari_17'] && response['hari_17']['humidity']) ? parseFloat(response['hari_17']['humidity']).toFixed(1) : 0;
				var hari_18_humidity = (response['hari_18'] && response['hari_18']['humidity']) ? parseFloat(response['hari_18']['humidity']).toFixed(1) : 0;
				var hari_19_humidity = (response['hari_19'] && response['hari_19']['humidity']) ? parseFloat(response['hari_19']['humidity']).toFixed(1) : 0;
				var hari_20_humidity = (response['hari_20'] && response['hari_20']['humidity']) ? parseFloat(response['hari_20']['humidity']).toFixed(1) : 0;
				var hari_21_humidity = (response['hari_21'] && response['hari_21']['humidity']) ? parseFloat(response['hari_21']['humidity']).toFixed(1) : 0;
				var hari_22_humidity = (response['hari_22'] && response['hari_22']['humidity']) ? parseFloat(response['hari_22']['humidity']).toFixed(1) : 0;
				var hari_23_humidity = (response['hari_23'] && response['hari_23']['humidity']) ? parseFloat(response['hari_23']['humidity']).toFixed(1) : 0;
				var hari_24_humidity = (response['hari_24'] && response['hari_24']['humidity']) ? parseFloat(response['hari_24']['humidity']).toFixed(1) : 0;
				var hari_25_humidity = (response['hari_25'] && response['hari_25']['humidity']) ? parseFloat(response['hari_25']['humidity']).toFixed(1) : 0;
				var hari_26_humidity = (response['hari_26'] && response['hari_26']['humidity']) ? parseFloat(response['hari_26']['humidity']).toFixed(1) : 0;
				var hari_27_humidity = (response['hari_27'] && response['hari_27']['humidity']) ? parseFloat(response['hari_27']['humidity']).toFixed(1) : 0;
				var hari_28_humidity = (response['hari_28'] && response['hari_28']['humidity']) ? parseFloat(response['hari_28']['humidity']).toFixed(1) : 0;
				var hari_29_humidity = (response['hari_29'] && response['hari_29']['humidity']) ? parseFloat(response['hari_29']['humidity']).toFixed(1) : 0;
				var hari_30_humidity = (response['hari_30'] && response['hari_30']['humidity']) ? parseFloat(response['hari_30']['humidity']).toFixed(1) : 0;
				var hari_31_humidity = (response['hari_31'] && response['hari_31']['humidity']) ? parseFloat(response['hari_31']['humidity']).toFixed(1) : 0;
				const existingChartEl = document.querySelector('#id_chart_temperature_H');
				if (existingChartEl) {
					existingChartEl.remove();
				}
				const newChartContainer = document.createElement('div');
				newChartContainer.id = 'id_chart_temperature_H';
				newChartContainer.classList.add('px-2');
        document.querySelector('.card-body.charthari_temperature').appendChild(newChartContainer);

        const scatterChartEl = document.querySelector('#id_chart_temperature_H'),
        scatterChartConfig = {
          chart: {
            height: 400,
            type: 'scatter',
            zoom: {
              enabled: true,
              type: 'xy'
            },
            parentHeightOffset: 0,
            toolbar: {
              show: false
            }
          },
          grid: {
            borderColor: borderColor,
            xaxis: {
              lines: {
                show: true
              }
            }
          },
          legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'start',
            labels: {
              colors: legendColor,
              useSeriesColors: false
            }
          },
          colors: [config.colors.warning, config.colors.primary, config.colors.success],
          series: [
            {
              name: 'Temperature',
              data: [
                [1, hari_1],
                [2, hari_2],
                [3, hari_3],
                [4, hari_4],
                [5, hari_5],
                [6, hari_6],
                [7, hari_7],
                [8, hari_8],
                [9, hari_9],
                [10, hari_10],
                [11, hari_11],
                [12, hari_12],
                [13, hari_13],
                [14, hari_14],
                [15, hari_15],
                [16, hari_16],
                [17, hari_17],
                [18, hari_18],
                [19, hari_19],
                [20, hari_20],
                [21, hari_21],
                [22, hari_22],
                [23, hari_23],
                [24, hari_24],
                [25, hari_25],
                [26, hari_26],
                [27, hari_27],
                [28, hari_28],
                [29, hari_29],
                [30, hari_30],
                [31, hari_31],
              ]
            },
            {
              name: 'Humidity',
              data: [
                [1, hari_1_humidity],
                [2, hari_2_humidity],
                [3, hari_3_humidity],
                [4, hari_4_humidity],
                [5, hari_5_humidity],
                [6, hari_6_humidity],
                [7, hari_7_humidity],
                [8, hari_8_humidity],
                [9, hari_9_humidity],
                [10, hari_10_humidity],
                [11, hari_11_humidity],
                [12, hari_12_humidity],
                [13, hari_13_humidity],
                [14, hari_14_humidity],
                [15, hari_15_humidity],
                [16, hari_16_humidity],
                [17, hari_17_humidity],
                [18, hari_18_humidity],
                [19, hari_19_humidity],
                [20, hari_20_humidity],
                [21, hari_21_humidity],
                [22, hari_22_humidity],
                [23, hari_23_humidity],
                [24, hari_24_humidity],
                [25, hari_25_humidity],
                [26, hari_26_humidity],
                [27, hari_27_humidity],
                [28, hari_28_humidity],
                [29, hari_29_humidity],
                [30, hari_30_humidity],
                [31, hari_31_humidity],
              ]
            }
          ],
          xaxis: {
            tickAmount: 31,
            axisBorder: {
              show: false
            },
            axisTicks: {
              show: false
            },
            labels: {
              formatter: function (val) {
                return parseFloat(val).toFixed(0);
              },
              style: {
                colors: labelColor,
                fontSize: '13px'
              }
            }
          },
          yaxis: {
            labels: {
              style: {
                colors: labelColor,
                fontSize: '13px'
              }
            }
          }
        };
      if (typeof scatterChartEl !== undefined && scatterChartEl !== null) {
        const scatterChart = new ApexCharts(scatterChartEl, scatterChartConfig);
        scatterChart.render();
      }
}
			
		});
	}
  // Scatter Chart
  // --------------------------------------------------------------------
  
  
	//chart perbulan
  function dataPerbulan_t(tahun, wilayah) {
    $.ajax({
        url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbybulan', //url
        type: 'GET',
        data: { tahun: tahun, wilayah: wilayah },
        dataType: 'json',
        success: function (response) {
            
            var month_1 = (response['month_1'] && response['month_1']['temperature']) ? parseFloat(response['month_1']['temperature']).toFixed(1) : 0;
            var month_2 = (response['month_2'] && response['month_2']['temperature']) ? parseFloat(response['month_2']['temperature']).toFixed(1) : 0;
            var month_3 = (response['month_3'] && response['month_3']['temperature']) ? parseFloat(response['month_3']['temperature']).toFixed(1) : 0;
            var month_4 = (response['month_4'] && response['month_4']['temperature']) ? parseFloat(response['month_4']['temperature']).toFixed(1) : 0;
            var month_5 = (response['month_5'] && response['month_5']['temperature']) ? parseFloat(response['month_5']['temperature']).toFixed(1) : 0;
            var month_6 = (response['month_6'] && response['month_6']['temperature']) ? parseFloat(response['month_6']['temperature']).toFixed(1) : 0;
            var month_7 = (response['month_7'] && response['month_7']['temperature']) ? parseFloat(response['month_7']['temperature']).toFixed(1) : 0;
            var month_8 = (response['month_8'] && response['month_8']['temperature']) ? parseFloat(response['month_8']['temperature']).toFixed(1) : 0;
            var month_9 = (response['month_9'] && response['month_9']['temperature']) ? parseFloat(response['month_9']['temperature']).toFixed(1) : 0;
            var month_10 = (response['month_10'] && response['month_10']['temperature']) ? parseFloat(response['month_10']['temperature']).toFixed(1) : 0;
            var month_11 = (response['month_11'] && response['month_11']['temperature']) ? parseFloat(response['month_11']['temperature']).toFixed(1) : 0;
            var month_12 = (response['month_12'] && response['month_12']['temperature']) ? parseFloat(response['month_12']['temperature']).toFixed(1) : 0;

            var month_1_humidity = (response['month_1'] && response['month_1']['humidity']) ? parseFloat(response['month_1']['humidity']).toFixed(1) : 0;
            var month_2_humidity = (response['month_2'] && response['month_2']['humidity']) ? parseFloat(response['month_2']['humidity']).toFixed(1) : 0;
            var month_3_humidity = (response['month_3'] && response['month_3']['humidity']) ? parseFloat(response['month_3']['humidity']).toFixed(1) : 0;
            var month_4_humidity = (response['month_4'] && response['month_4']['humidity']) ? parseFloat(response['month_4']['humidity']).toFixed(1) : 0;
            var month_5_humidity = (response['month_5'] && response['month_5']['humidity']) ? parseFloat(response['month_5']['humidity']).toFixed(1) : 0;
            var month_6_humidity = (response['month_6'] && response['month_6']['humidity']) ? parseFloat(response['month_6']['humidity']).toFixed(1) : 0;
            var month_7_humidity = (response['month_7'] && response['month_7']['humidity']) ? parseFloat(response['month_7']['humidity']).toFixed(1) : 0;
            var month_8_humidity = (response['month_8'] && response['month_8']['humidity']) ? parseFloat(response['month_8']['humidity']).toFixed(1) : 0;
            var month_9_humidity = (response['month_9'] && response['month_9']['humidity']) ? parseFloat(response['month_9']['humidity']).toFixed(1) : 0;
            var month_10_humidity = (response['month_10'] && response['month_10']['humidity']) ? parseFloat(response['month_10']['humidity']).toFixed(1) : 0;
            var month_11_humidity = (response['month_11'] && response['month_11']['humidity']) ? parseFloat(response['month_11']['humidity']).toFixed(1) : 0;
            var month_12_humidity = (response['month_12'] && response['month_12']['humidity']) ? parseFloat(response['month_12']['humidity']).toFixed(1) : 0;

            // Remove existing chart and create new container
            const existingChartEl = document.querySelector('#scatterChart');
            if (existingChartEl) {
                existingChartEl.remove();
            }
            const newChartContainer = document.createElement('div');
            newChartContainer.id = 'scatterChart';
            newChartContainer.classList.add('px-3');
            document.querySelector('.card-body.chartbulan_temperature').appendChild(newChartContainer);

            // Configure bar chart
            const scatterChartEl = document.querySelector('#scatterChart'),
            scatterChartConfig = {
                chart: {
                    height: 400,
                    type: 'bar', // Changed to 'bar'
                    zoom: {
                        enabled: true
                    },
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%', // Customize width
                        endingShape: 'rounded' // Shape of the bars
                    }
                },
                grid: {
                    borderColor: borderColor,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'start',
                    labels: {
                        colors: legendColor,
                        useSeriesColors: false
                    }
                },
                colors: [config.colors.warning, config.colors.primary, config.colors.success],
                series: [
                    {
                        name: 'Temperature',
                        data: [
                            month_1, month_2, month_3, month_4, month_5, month_6,
                            month_7, month_8, month_9, month_10, month_11, month_12
                        ]
                    },
                    {
                        name: 'Humidity',
                        data: [
                            month_1_humidity, month_2_humidity, month_3_humidity, month_4_humidity,
                            month_5_humidity, month_6_humidity, month_7_humidity, month_8_humidity,
                            month_9_humidity, month_10_humidity, month_11_humidity, month_12_humidity
                        ]
                    }
                ],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px'
                        }
                    }
                }
            };
            
            // Render chart
            if (typeof scatterChartEl !== undefined && scatterChartEl !== null) {
                const scatterChart = new ApexCharts(scatterChartEl, scatterChartConfig);
                scatterChart.render();
            }
        }
    });
}


  // Line Chart
  // --------------------------------------------------------------------
  const lineChartEl = document.querySelector('#lineChart'),
    lineChartConfig = {
      chart: {
        height: 400,
        type: 'line',
        parentHeightOffset: 0,
        zoom: {
          enabled: false
        },
        toolbar: {
          show: false
        }
      },
      series: [
        {
          data: [280, 200, 220, 180, 270, 250, 70, 90, 200, 150, 160, 100, 150, 100, 50]
        }
      ],
      markers: {
        strokeWidth: 7,
        strokeOpacity: 1,
        strokeColors: [cardColor],
        colors: [config.colors.warning]
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      colors: [config.colors.warning],
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          top: -20
        }
      },
      tooltip: {
        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
          return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' + '</div>';
        }
      },
      xaxis: {
        categories: [
          '7/12',
          '8/12',
          '9/12',
          '10/12',
          '11/12',
          '12/12',
          '13/12',
          '14/12',
          '15/12',
          '16/12',
          '17/12',
          '18/12',
          '19/12',
          '20/12',
          '21/12'
        ],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      }
    };
  if (typeof lineChartEl !== undefined && lineChartEl !== null) {
    const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
    lineChart.render();
  }

  // Horizontal Bar Chart
  // --------------------------------------------------------------------
  const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
    horizontalBarChartConfig = {
      chart: {
        height: 400,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: true,
          barHeight: '30%',
          startingShape: 'rounded',
          borderRadius: 8
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: false
          }
        },
        padding: {
          top: -20,
          bottom: -12
        }
      },
      colors: config.colors.info,
      dataLabels: {
        enabled: false
      },
      series: [
        {
          data: [700, 350, 480, 600, 210, 550, 150]
        }
      ],
      xaxis: {
        categories: ['MON, 11', 'THU, 14', 'FRI, 15', 'MON, 18', 'WED, 20', 'FRI, 21', 'MON, 23'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      }
    };
  if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
    const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
    horizontalBarChart.render();
  }

  // Candlestick Chart
  // --------------------------------------------------------------------
  const candlestickEl = document.querySelector('#candleStickChart'),
    candlestickChartConfig = {
      chart: {
        height: 410,
        type: 'candlestick',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      series: [
        {
          data: [
            {
              x: new Date(1538778600000),
              y: [150, 170, 50, 100]
            },
            {
              x: new Date(1538780400000),
              y: [200, 400, 170, 330]
            },
            {
              x: new Date(1538782200000),
              y: [330, 340, 250, 280]
            },
            {
              x: new Date(1538784000000),
              y: [300, 330, 200, 320]
            },
            {
              x: new Date(1538785800000),
              y: [320, 450, 280, 350]
            },
            {
              x: new Date(1538787600000),
              y: [300, 350, 80, 250]
            },
            {
              x: new Date(1538789400000),
              y: [200, 330, 170, 300]
            },
            {
              x: new Date(1538791200000),
              y: [200, 220, 70, 130]
            },
            {
              x: new Date(1538793000000),
              y: [220, 270, 180, 250]
            },
            {
              x: new Date(1538794800000),
              y: [200, 250, 80, 100]
            },
            {
              x: new Date(1538796600000),
              y: [150, 170, 50, 120]
            },
            {
              x: new Date(1538798400000),
              y: [110, 450, 10, 420]
            },
            {
              x: new Date(1538800200000),
              y: [400, 480, 300, 320]
            },
            {
              x: new Date(1538802000000),
              y: [380, 480, 350, 450]
            }
          ]
        }
      ],
      xaxis: {
        type: 'datetime',
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        tooltip: {
          enabled: true
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          top: -20
        }
      },
      plotOptions: {
        candlestick: {
          colors: {
            upward: config.colors.success,
            downward: config.colors.danger
          }
        },
        bar: {
          columnWidth: '40%'
        }
      }
    };
  if (typeof candlestickEl !== undefined && candlestickEl !== null) {
    const candlestickChart = new ApexCharts(candlestickEl, candlestickChartConfig);
    candlestickChart.render();
  }

  // Heat map chart
  // --------------------------------------------------------------------
  const heatMapEl = document.querySelector('#heatMapChart'),
    heatMapChartConfig = {
      chart: {
        height: 350,
        type: 'heatmap',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        heatmap: {
          enableShades: false,

          colorScale: {
            ranges: [
              {
                from: 0,
                to: 10,
                name: '0-10',
                color: '#90B3F3'
              },
              {
                from: 11,
                to: 20,
                name: '10-20',
                color: '#7EA6F1'
              },
              {
                from: 21,
                to: 30,
                name: '20-30',
                color: '#6B9AEF'
              },
              {
                from: 31,
                to: 40,
                name: '30-40',
                color: '#598DEE'
              },
              {
                from: 41,
                to: 50,
                name: '40-50',
                color: '#4680EC'
              },
              {
                from: 51,
                to: 60,
                name: '50-60',
                color: '#3474EA'
              }
            ]
          }
        }
      },
      dataLabels: {
        enabled: false
      },
      grid: {
        show: false
      },
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'start',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        },
        markers: {
          offsetY: 0,
          offsetX: -3
        },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        }
      },
      stroke: {
        curve: 'smooth',
        width: 4,
        lineCap: 'round',
        colors: [cardColor]
      },
      series: [
        {
          name: 'SUN',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'MON',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'TUE',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'WED',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'THU',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'FRI',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        },
        {
          name: 'SAT',
          data: generateDataHeat(24, {
            min: 0,
            max: 60
          })
        }
      ],
      xaxis: {
        labels: {
          show: false,
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        },
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      }
    };
  if (typeof heatMapEl !== undefined && heatMapEl !== null) {
    const heatMapChart = new ApexCharts(heatMapEl, heatMapChartConfig);
    heatMapChart.render();
  }

  // Radial Bar Chart
  // --------------------------------------------------------------------
  const radialBarChartEl = document.querySelector('#radialBarChart'),
    radialBarChartConfig = {
      chart: {
        height: 380,
        type: 'radialBar'
      },
      colors: [chartColors.donut.series1, chartColors.donut.series2, chartColors.donut.series4],
      plotOptions: {
        radialBar: {
          size: 185,
          hollow: {
            size: '40%'
          },
          track: {
            margin: 10,
            background: config.colors_label.secondary
          },
          dataLabels: {
            name: {
              fontSize: '2rem',
              fontFamily: 'Public Sans'
            },
            value: {
              fontSize: '1.2rem',
              color: legendColor,
              fontFamily: 'Public Sans'
            },
            total: {
              show: true,
              fontWeight: 400,
              fontSize: '1.3rem',
              color: headingColor,
              label: 'Comments',
              formatter: function (w) {
                return '80%';
              }
            }
          }
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: -25,
          bottom: -20
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      stroke: {
        lineCap: 'round'
      },
      series: [80, 50, 35],
      labels: ['Comments', 'Replies', 'Shares']
    };
  if (typeof radialBarChartEl !== undefined && radialBarChartEl !== null) {
    const radialChart = new ApexCharts(radialBarChartEl, radialBarChartConfig);
    radialChart.render();
  }

  // Radar Chart
  // --------------------------------------------------------------------
  const radarChartEl = document.querySelector('#radarChart'),
    radarChartConfig = {
      chart: {
        height: 350,
        type: 'radar',
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: false,
          blur: 8,
          left: 1,
          top: 1,
          opacity: 0.2
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      plotOptions: {
        radar: {
          polygons: {
            strokeColors: borderColor,
            connectorColors: borderColor
          }
        }
      },
      yaxis: {
        show: false
      },
      series: [
        {
          name: 'iPhone 12',
          data: [41, 64, 81, 60, 42, 42, 33, 23]
        },
        {
          name: 'Samsung s20',
          data: [65, 46, 42, 25, 58, 63, 76, 43]
        }
      ],
      colors: [chartColors.donut.series1, chartColors.donut.series3],
      xaxis: {
        categories: ['Battery', 'Brand', 'Camera', 'Memory', 'Storage', 'Display', 'OS', 'Price'],
        labels: {
          show: true,
          style: {
            colors: [labelColor, labelColor, labelColor, labelColor, labelColor, labelColor, labelColor, labelColor],
            fontSize: '13px',
            fontFamily: 'Public Sans'
          }
        }
      },
      fill: {
        opacity: [1, 0.8]
      },
      stroke: {
        show: false,
        width: 0
      },
      markers: {
        size: 0
      },
      grid: {
        show: false,
        padding: {
          top: -20,
          bottom: -20
        }
      }
    };
  if (typeof radarChartEl !== undefined && radarChartEl !== null) {
    const radarChart = new ApexCharts(radarChartEl, radarChartConfig);
    radarChart.render();
  }

  // Donut Chart
  // --------------------------------------------------------------------
  const donutChartEl = document.querySelector('#donutChart'),
    donutChartConfig = {
      chart: {
        height: 390,
        type: 'donut'
      },
      labels: ['Operational', 'Networking', 'Hiring', 'R&D'],
      series: [42, 7, 25, 25],
      colors: [
        chartColors.donut.series1,
        chartColors.donut.series4,
        chartColors.donut.series3,
        chartColors.donut.series2
      ],
      stroke: {
        show: false,
        curve: 'straight'
      },
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseInt(val, 10) + '%';
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        markers: { offsetX: -3 },
        itemMargin: {
          vertical: 3,
          horizontal: 10
        },
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Public Sans'
              },
              value: {
                fontSize: '1.2rem',
                color: legendColor,
                fontFamily: 'Public Sans',
                formatter: function (val) {
                  return parseInt(val, 10) + '%';
                }
              },
              total: {
                show: true,
                fontSize: '1.5rem',
                color: headingColor,
                label: 'Operational',
                formatter: function (w) {
                  return '42%';
                }
              }
            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            },
            legend: {
              position: 'bottom',
              labels: {
                colors: legendColor,
                useSeriesColors: false
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            chart: {
              height: 280
            },
            legend: {
              show: false
            }
          }
        },
        {
          breakpoint: 360,
          options: {
            chart: {
              height: 250
            },
            legend: {
              show: false
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
})();
