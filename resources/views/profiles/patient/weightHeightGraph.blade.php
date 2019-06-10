<div class="pb-5 w-100">
  <canvas class="w-100" height="500px" id="weightHeightChart"></canvas>
</div>
<script>
  var weightHeightColors = [
    ["rgba(255, 100, 000, 0.2)", "rgba(250, 100, 000, 0.7)"],
    ["rgba(255, 160, 000, 0.2)", "rgba(200, 150, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(150, 200, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(050, 100, 000, 0.7)"],
    ["rgba(000, 123, 200, 0.2)", "rgba(000, 123, 200, 0.7)"]
  ];

  var sdwh = [
    {label: 'SD3n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[0][0], borderColor: weightHeightColors[0][1], data: []},
    {label: 'SD2n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[1][0], borderColor: weightHeightColors[1][1], data: []},
    {label: 'SD1n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[2][0], borderColor: weightHeightColors[2][1], data: []},
    {label: 'SD0',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[3][0], borderColor: weightHeightColors[3][1], data: []},
    {label: 'SD1',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[2][0], borderColor: weightHeightColors[2][1], data: []},
    {label: 'SD2',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[1][0], borderColor: weightHeightColors[1][1], data: []},
    {label: 'SD3',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightHeightColors[0][0], borderColor: weightHeightColors[0][1], data: []},
  ];

  var pdwh = {label: 'Patient Data',  type: 'line', fill: false, lineTension: 0.15, backgroundColor: weightHeightColors[4][0], borderColor: weightHeightColors[4][1], data: []};

  weightHeight.map((item, i) => {
    sdwh[0].data.push({'x': item.Height, 'y': SD(-3, item.L, item.M, item.S)});
    sdwh[1].data.push({'x': item.Height, 'y': SD(-2, item.L, item.M, item.S)});
    sdwh[2].data.push({'x': item.Height, 'y': SD(-1, item.L, item.M, item.S)});
    sdwh[3].data.push({'x': item.Height, 'y': SD(0, item.L, item.M, item.S)});
    sdwh[4].data.push({'x': item.Height, 'y': SD(1, item.L, item.M, item.S)});
    sdwh[5].data.push({'x': item.Height, 'y': SD(2, item.L, item.M, item.S)});
    sdwh[6].data.push({'x': item.Height, 'y': SD(3, item.L, item.M, item.S)});
  });

  var weightHeightConfig = {
    type: 'line',
    data: {
      datasets: [pdwh, sdwh[0], sdwh[1], sdwh[2], sdwh[3], sdwh[4], sdwh[5], sdwh[6]],
    },
    options: {
      responsive: true,
      responsiveAnimationDuration: 1,
      maintainAspectRatio: true,
      title: {
        display: true,
        text: 'Height / Weight'
      },
      scales: {
        xAxes: [{
          type: 'linear',
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Height (cm)'
          },
          ticks: {
            major: {
              fontStyle: 'normal',
              fontColor: '#000000'
            }
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Weight (kg)'
          }
        }]
      }
    }
  };

  var weightHeightChart = null;

  function initWeightHeightChart() {
    vitals.map((item, i) => {
      pdwh.data.push({'x': item.height, 'y': item.weight});
    });
    weightHeightChart = new Chart(document.getElementById('weightHeightChart').getContext('2d'), weightHeightConfig);
  }
</script>
