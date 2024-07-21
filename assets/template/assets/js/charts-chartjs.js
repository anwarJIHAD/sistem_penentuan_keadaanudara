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
	function dataPerhari(tahun,bulan,wilayah){
		$.ajax({
			url: 'http://localhost/tracking_pengendara/C_DashboardUmum/getbyhari', //url
			type: 'GET',
			data: { tahun: tahun,bulan:bulan,wilayah:wilayah },
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
								'1-07-2024',
								'2-07-2024',
								'3-07-2024',
								'4-07-2024',
								'5-07-2024',
								'6-07-2024',
								'7-07-2024',
								'8-07-2024',
								'9-07-2024',
								'10-07-2024',
								'11-07-2024',
								'12-07-2024',
								'13-07-2024',
								'14-07-2024',
								'15-07-2024',
								'16-07-2024',
								'17-07-2024',
								'18-07-2024',
								'19-07-2024',
								'20-07-2024',
								'22-07-2024',
								'23-07-2024',
								'24-07-2024',
								'25-07-2024',
								'26-07-2024',
								'27-07-2024',
								'28-07-2024',
							],
							datasets: [
								{
								name: 'Rata-Rata PM25',
									data: [2.275, 3.45, 3.21, 4.89, 2.86, 4.89, 7.54, 4.67, 2.82, 1.76, 7.87, 5.82,2.275, 3.45, 3.21, 4.89, 2.86, 4.89, 7.54, 4.67, 2.82, 1.76, 7.87, 5.82,2.82, 1.76, 7.87, 5.82],
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
									max: 10,
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
