/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    legendColor = config.colors_dark.bodyColor;
    labelColor = config.colors_dark.textMuted;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    legendColor = config.colors.bodyColor;
    labelColor = config.colors.textMuted;
    borderColor = config.colors.borderColor;
  }

  // Order Area Chart
  // --------------------------------------------------------------------
  const orderAreaChartEl = document.querySelector('#orderChart'),
    orderAreaChartConfig = {
      chart: {
        height: 80,
        type: 'area',
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 6,
            strokeColor: config.colors.success,
            strokeWidth: 2,
            size: 6,
            radius: 8
          }
        ],
        hover: {
          size: 7
        }
      },
      grid: {
        show: false,
        padding: {
          right: 8
        }
      },
      colors: [config.colors.success],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.8,
          opacityFrom: 0.8,
          opacityTo: 0.25,
          stops: [0, 85, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      series: [
        {
          data: [180, 175, 275, 140, 205, 190, 295]
        }
      ],
      xaxis: {
        show: false,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        stroke: {
          width: 0
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        stroke: {
          width: 0
        },
        show: false
      }
    };
  if (typeof orderAreaChartEl !== undefined && orderAreaChartEl !== null) {
    const orderAreaChart = new ApexCharts(orderAreaChartEl, orderAreaChartConfig);
    orderAreaChart.render();
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

  // Mengatur chart temprature dan humadity user umum
  // --------------------------------------------------------------------
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

				const id_chart_temperatureEl = document.querySelector('#id_chart_temperature_H'),
    id_chart_temperatureOptions = {
      series: [
        {
          name: 'Temperature',
          data: [hari_1, hari_2, hari_3, hari_4, hari_5, hari_6, hari_7, hari_8, hari_9, hari_10, hari_11, hari_12, hari_13, hari_14, hari_15, hari_16, hari_17, hari_18, hari_19, hari_20, hari_21, hari_22, hari_23, hari_24, hari_25, hari_26, hari_27, hari_28, hari_29, hari_30, hari_31]
        },
        {
          name: 'Humidity',
          data: [hari_1_humidity, hari_2_humidity, hari_3_humidity, hari_4_humidity, hari_5_humidity, hari_6_humidity, hari_7_humidity, hari_8_humidity, hari_9_humidity, hari_10_humidity, hari_11_humidity, hari_12_humidity, hari_13_humidity, hari_14_humidity, hari_15_humidity, hari_16_humidity, hari_17_humidity, hari_18_humidity, hari_19_humidity, hari_20_humidity, hari_21_humidity, hari_22_humidity, hari_23_humidity, hari_24_humidity, hari_25_humidity, hari_26_humidity, hari_27_humidity, hari_28_humidity, hari_29_humidity, hari_30_humidity, hari_31_humidity]
        }
      ],
      chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: legendColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: [
				'1',
				'2',
				'3',
				'4',
				'5',
				'6',
				'7',
				'8',
				'9',
				'10',
				'11',
				'12',
				'13',
				'14',
				'15',
				'16',
				'17',
				'18',
				'19',
				'20',
				'22',
				'23',
				'24',
				'25',
				'26',
				'27',
				'28',
				'29',
				'30',
				'31',],
        labels: {
          style: {
            fontSize: '13px',
            colors: labelColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: labelColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof id_chart_temperatureEl !== undefined && id_chart_temperatureEl !== null) {
    const id_chart_temperature = new ApexCharts(id_chart_temperatureEl, id_chart_temperatureOptions);
    id_chart_temperature.render();
  }
}
			
		});
	}


	//chart perbulan
	function dataPerbulan_t(tahun,wilayah){
		$.ajax({
			url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbybulan', //url
			type: 'GET',
			data: { tahun: tahun,wilayah:wilayah },
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

				const existingChartEl = document.querySelector('#id_chart_temperature');
				if (existingChartEl) {
					existingChartEl.remove();
				}
				const newChartContainer = document.createElement('div');
				newChartContainer.id = 'id_chart_temperature';
				newChartContainer.classList.add('px-2');
        document.querySelector('.card-body.chartbulan_temperature').appendChild(newChartContainer);

				const id_chart_temperatureEl = document.querySelector('#id_chart_temperature'),
    id_chart_temperatureOptions = {
      series: [
        {
          name: 'Temperature',
          data: [month_1, month_2, month_3, month_4, month_5, month_6, month_7,month_8,month_9,month_10,month_11,month_12]
        },
        {
          name: 'humidity',
          data: [month_1_humidity, month_2_humidity, month_3_humidity, month_4_humidity, month_5_humidity, month_6_humidity, month_7_humidity,month_8_humidity,month_9_humidity,month_10_humidity,month_11_humidity,month_12_humidity]
        }
      ],
      chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: legendColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Agust','Sep','Okt','Nov','Des'],
        labels: {
          style: {
            fontSize: '13px',
            colors: labelColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: labelColor
          }
        },
        // min: 0, // Pastikan titik tengahnya adalah nol
        // max: 100 // Sesuaikan dengan nilai maksimum yang diharapkan
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof id_chart_temperatureEl !== undefined && id_chart_temperatureEl !== null) {
    const id_chart_temperature = new ApexCharts(id_chart_temperatureEl, id_chart_temperatureOptions);
    id_chart_temperature.render();
  }
}
			
		});
	}



  

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector('#growthChart'),
    growthChartOptions = {
      series: [78],
      labels: ['Growth'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: legendColor,
              fontSize: '15px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Revenue Bar Chart
  // --------------------------------------------------------------------
  const revenueBarChartEl = document.querySelector('#revenueChart'),
    revenueBarChartConfig = {
      chart: {
        height: 80,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          barHeight: '80%',
          columnWidth: '75%',
          startingShape: 'rounded',
          endingShape: 'rounded',
          borderRadius: 2,
          distributed: true
        }
      },
      grid: {
        show: false,
        padding: {
          top: -20,
          bottom: -12,
          left: -10,
          right: 0
        }
      },
      colors: [
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors.primary,
        config.colors_label.primary,
        config.colors_label.primary
      ],
      dataLabels: {
        enabled: false
      },
      series: [
        {
          data: [40, 95, 60, 45, 90, 50, 75]
        }
      ],
      legend: {
        show: false
      },
      xaxis: {
        categories: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
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
          show: false
        }
      }
    };
  if (typeof revenueBarChartEl !== undefined && revenueBarChartEl !== null) {
    const revenueBarChart = new ApexCharts(revenueBarChartEl, revenueBarChartConfig);
    revenueBarChart.render();
  }

  // Profit Report Line Chart
  // --------------------------------------------------------------------
  const profileReportChartEl = document.querySelector('#profileReportChart'),
    profileReportChartConfig = {
      chart: {
        height: 80,
        // width: 175,
        type: 'line',
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: true,
          top: 10,
          left: 5,
          blur: 3,
          color: config.colors.warning,
          opacity: 0.15
        },
        sparkline: {
          enabled: true
        }
      },
      grid: {
        show: false,
        padding: {
          right: 8
        }
      },
      colors: [config.colors.warning],
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      series: [
        {
          data: [110, 270, 145, 245, 205, 285]
        }
      ],
      xaxis: {
        show: false,
        lines: {
          show: false
        },
        labels: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        show: false
      }
    };
  if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
    const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
    profileReportChart.render();
  }

  // Order Statistics Chart
  // --------------------------------------------------------------------
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
    orderChartConfig = {
      chart: {
        height: 165,
        width: 130,
        type: 'donut'
      },
      labels: ['Electronic', 'Sports', 'Decor', 'Fashion'],
      series: [85, 15, 50, 50],
      colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
      stroke: {
        width: 5,
        colors: [cardColor]
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      states: {
        hover: {
          filter: { type: 'none' }
        },
        active: {
          filter: { type: 'none' }
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '0.8125rem',
                color: legendColor,
                label: 'Weekly',
                formatter: function (w) {
                  return '38%';
                }
              }
            }
          }
        }
      }
    };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }

  // Income Chart - Area chart
  // --------------------------------------------------------------------
  const incomeChartEl = document.querySelector('#incomeChart'),
    incomeChartConfig = {
      series: [
        {
          data: [24, 21, 30, 22, 42, 26, 35, 29]
        }
      ],
      chart: {
        height: 215,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        show: false
      },
      markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8
          }
        ],
        hover: {
          size: 7
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          left: -10,
          right: 8
        }
      },
      xaxis: {
        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: true,
          style: {
            fontSize: '13px',
            colors: labelColor
          }
        }
      },
      yaxis: {
        labels: {
          show: false
        },
        min: 10,
        max: 50,
        tickAmount: 4
      }
    };
  if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
    incomeChart.render();
  }

  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector('#expensesOfWeek'),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '45%'
          },
          track: {
            strokeWidth: '50%',
            background: borderColor
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '$' + parseInt(val);
              },
              offsetY: 5,
              color: '#697a8d',
              fontSize: '13px',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
    weeklyExpenses.render();
  }
})();
