/**
 * Charts ChartsJS
 */
'use strict';

(function () {
  // Color Variables
  const purpleColor = '#836AF9',
    yellowColor = '#ffe800',
    cyanColor = '#28dac6',
    orangeColor = '#FF8132',
    orangeLightColor = '#FDAC34',
    oceanBlueColor = '#299AFF',
    greyColor = '#4F5D70',
    greyLightColor = '#EDF1F4',
    blueColor = '#2B9AFF',
    blueLightColor = '#84D0FF';

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

  // Set height according to their data-height
  // --------------------------------------------------------------------
  const chartList = document.querySelectorAll('.chartjs');
  chartList.forEach(function (chartListItem) {
    chartListItem.height = chartListItem.dataset.height;
  });

	let tahun = '';
	let bulan=''
	let wilayah = '';
	dataPerbulan();
	dataPerhari();
	$('#search_tahunA').change(function () {
    var tahun = $(this).val().toLowerCase();
    var wilayah = $('#search_wilayahA').val().toLowerCase();
    console.log(tahun,wilayah);
		dataPerbulan(tahun,wilayah);
		});
	$('#search_wilayahA').change(function () {
			var tahun = $('#search_tahunA').val().toLowerCase();
			var wilayah = $(this).val().toLowerCase();
			console.log(tahun,wilayah);
			dataPerbulan(tahun,wilayah);
	});

	//search harian
	$('#search_tahunH').change(function () {
    var tahun = $(this).val().toLowerCase();
    var bulan = $('#search_bulanH').val().toLowerCase();
    var wilayah = $('#search_wilayahH').val().toLowerCase();
    console.log(tahun,bulan,wilayah);
		dataPerhari(tahun,bulan,wilayah);
	});
	$('#search_bulanH').change(function () {
		var tahun = $('#search_tahunH').val().toLowerCase();
		var bulan = $(this).val().toLowerCase();
		var wilayah = $('#search_wilayahH').val().toLowerCase();
		console.log(tahun,bulan,wilayah);
			dataPerhari(tahun,bulan,wilayah);
		});
	$('#search_wilayahH').change(function () {
			var tahun = $('#search_tahunH').val().toLowerCase();
			var bulan = $('#search_bulanH').val().toLowerCase();
			var wilayah = $(this).val().toLowerCase();
			console.log(tahun,bulan,wilayah);
			dataPerhari(tahun,bulan,wilayah);
	});


	function dataPerhari(tahun,bulan,wilayah){
		$.ajax({
			url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbyhari', //url
			type: 'GET',
			data: { tahun: tahun,bulan:bulan,wilayah:wilayah },
			dataType: 'json',
			success: function (response) {
				
				var hari_1 = (response['hari_1'] && response['hari_1']['pm25']) || 0;
				var hari_2 = (response['hari_2'] && response['hari_2']['pm25']) || 0;
				var hari_3 = (response['hari_3'] && response['hari_3']['pm25']) || 0;
				var hari_4 = (response['hari_4'] && response['hari_4']['pm25']) || 0;
				var hari_5 = (response['hari_5'] && response['hari_5']['pm25']) || 0;
				var hari_6 = (response['hari_6'] && response['hari_6']['pm25']) || 0;
				var hari_7 = (response['hari_7'] && response['hari_7']['pm25']) || 0;
				var hari_8 = (response['hari_8'] && response['hari_8']['pm25']) || 0;
				var hari_9 = (response['hari_9'] && response['hari_9']['pm25']) || 0;
				var hari_10 = (response['hari_10'] && response['hari_10']['pm25']) || 0;
				var hari_11 = (response['hari_11'] && response['hari_11']['pm25']) || 0;
				var hari_12 = (response['hari_12'] && response['hari_12']['pm25']) || 0;
				var hari_13 = (response['hari_13'] && response['hari_13']['pm25']) || 0;
				var hari_14 = (response['hari_14'] && response['hari_14']['pm25']) || 0;
				var hari_15 = (response['hari_15'] && response['hari_15']['pm25']) || 0;
				var hari_16 = (response['hari_16'] && response['hari_16']['pm25']) || 0;
				var hari_17 = (response['hari_17'] && response['hari_17']['pm25']) || 0;
				var hari_18 = (response['hari_18'] && response['hari_18']['pm25']) || 0;
				var hari_19 = (response['hari_19'] && response['hari_19']['pm25']) || 0;
				var hari_20 = (response['hari_20'] && response['hari_20']['pm25']) || 0;
				var hari_21 = (response['hari_21'] && response['hari_21']['pm25']) || 0;
				var hari_22 = (response['hari_22'] && response['hari_22']['pm25']) || 0;
				var hari_23 = (response['hari_23'] && response['hari_23']['pm25']) || 0;
				var hari_24 = (response['hari_24'] && response['hari_24']['pm25']) || 0;
				var hari_25 = (response['hari_25'] && response['hari_25']['pm25']) || 0;
				var hari_26 = (response['hari_26'] && response['hari_26']['pm25']) || 0;
				var hari_27 = (response['hari_27'] && response['hari_27']['pm25']) || 0;
				var hari_28 = (response['hari_28'] && response['hari_28']['pm25']) || 0;
				var hari_29 = (response['hari_29'] && response['hari_29']['pm25']) || 0;
				var hari_30 = (response['hari_30'] && response['hari_30']['pm25']) || 0;
				var hari_31 = (response['hari_31'] && response['hari_31']['pm25']) || 0;
				const existingChartEl = document.querySelector('#du_hari');
				if (existingChartEl) {
					existingChartEl.remove();
				}
				// Recreate chart container element
				const newChartContainer = document.createElement('canvas');
				newChartContainer.id = 'du_hari';
				document.querySelector('.card-body.charthari').appendChild(newChartContainer);
				const du_hari = document.getElementById('du_hari');

				if (du_hari) {
					const du_hariVar = new Chart(du_hari, {
						type: 'bar',
						data: {
							labels: [
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
								'31',
							],
							datasets: [
								{
								name: 'Rata-Rata PM25',
									data: [hari_1, hari_2, hari_3, hari_4, hari_5, hari_6, hari_7, hari_8, hari_9, hari_10, hari_11, hari_12, hari_13, hari_14, hari_15, hari_16, hari_17, hari_18, hari_19, hari_20, hari_21, hari_22, hari_23, hari_24, hari_25, hari_26, hari_27, hari_28, hari_29, hari_30, hari_31],
									backgroundColor: cyanColor,
									borderColor: 'transparent',
									maxBarThickness: 15,
									borderRadius: {
										topRight: 15,
										topLeft: 15
									}
								}
							]
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							animation: {
								duration: 500
							},
							plugins: {
								tooltip: {
									rtl: isRtl,
									backgroundColor: cardColor,
									titleColor: headingColor,
									bodyColor: legendColor,
									borderWidth: 1,
									borderColor: borderColor
								},
								legend: {
									display: false
								}
							},
							scales: {
								x: {
									grid: {
										color: borderColor,
										drawBorder: false,
										borderColor: borderColor
									},
									ticks: {
										color: labelColor
									}
								},
								y: {
									min: 0,
									max: 100,
									grid: {
										color: borderColor,
										drawBorder: false,
										borderColor: borderColor
									},
									ticks: {
										stepSize: 100,
										color: labelColor
									}
								}
							}
						}
					});
				}
			}
		});
	}
	function dataPerbulan(tahun,wilayah){
		$.ajax({
			url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbybulan', //url
			type: 'GET',
			data: { tahun: tahun,wilayah:wilayah },
			dataType: 'json',
			success: function (response) {

				var month_1 = (response['month_1'] && response['month_1']['pm25']) || 0;
				var month_2 = (response['month_2'] && response['month_2']['pm25']) || 0;
				var month_3 = (response['month_3'] && response['month_3']['pm25']) || 0;
				var month_4 = (response['month_4'] && response['month_4']['pm25']) || 0;
				var month_5 = (response['month_5'] && response['month_5']['pm25']) || 0;
				var month_6 = (response['month_6'] && response['month_6']['pm25']) || 0;
				var month_7 = (response['month_7'] && response['month_7']['pm25']) || 0;
				var month_8 = (response['month_8'] && response['month_8']['pm25']) || 0;
				var month_9 = (response['month_9'] && response['month_9']['pm25']) || 0;
				var month_10 = (response['month_10'] && response['month_10']['pm25']) || 0;
				var month_11 = (response['month_11'] && response['month_11']['pm25']) || 0;
				var month_12 = (response['month_12'] && response['month_12']['pm25']) || 0;
				const existingChartEl = document.querySelector('#du_bulan');
        if (existingChartEl) {
          existingChartEl.remove();
        }
         // Recreate chart container element
        const newChartContainer = document.createElement('canvas');
        newChartContainer.id = 'du_bulan';
        document.querySelector('.card-body.chartbulan').appendChild(newChartContainer);

				//chart per bulan
				const du_bulan = document.getElementById('du_bulan');
				if (du_bulan) {
					const du_bulanVar = new Chart(du_bulan, {
						type: 'bar',
						data: {
							labels: [
								'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
							],
							datasets: [
								{
								name: 'Rata-Rata PM25',
									data: [month_1, month_2, month_3, month_4, month_5,month_6, month_7, month_8, month_9, month_10, month_11, month_12],
									backgroundColor: blueColor,
									borderColor: 'transparent',
									maxBarThickness: 15,
									borderRadius: {
										topRight: 15,
										topLeft: 15
									}
								}
							]
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							animation: {
								duration: 500
							},
							plugins: {
								tooltip: {
									rtl: isRtl,
									backgroundColor: cardColor,
									titleColor: headingColor,
									bodyColor: legendColor,
									borderWidth: 1,
									borderColor: borderColor
								},
								legend: {
									display: false
								}
							},
							scales: {
								x: {
									grid: {
										color: borderColor,
										drawBorder: false,
										borderColor: borderColor
									},
									ticks: {
										color: labelColor
									}
								},
								y: {
									min: 0,
									max: 100,
									grid: {
										color: borderColor,
										drawBorder: false,
										borderColor: borderColor
									},
									ticks: {
										stepSize: 100,
										color: labelColor
									}
								}
							}
						}
					});
				}
			}
		});
	}
  
	
})();
