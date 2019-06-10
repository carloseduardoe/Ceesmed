<div class="pb-5 w-100">
  <canvas class="w-100" weight="500px" id="weightChart"></canvas>
</div>
<script>
  var weightColors = [
    ["rgba(255, 100, 000, 0.2)", "rgba(250, 100, 000, 0.7)"],
    ["rgba(255, 160, 000, 0.2)", "rgba(200, 150, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(150, 200, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(050, 100, 000, 0.7)"],
    ["rgba(000, 123, 200, 0.2)", "rgba(000, 123, 200, 0.7)"]
  ];

  var sdw = [
    {label: 'SD3n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[0][0], borderColor: weightColors[0][1], data: []},
    {label: 'SD2n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[1][0], borderColor: weightColors[1][1], data: []},
    {label: 'SD1n', type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[2][0], borderColor: weightColors[2][1], data: []},
    {label: 'SD0',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[3][0], borderColor: weightColors[3][1], data: []},
    {label: 'SD1',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[2][0], borderColor: weightColors[2][1], data: []},
    {label: 'SD2',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[1][0], borderColor: weightColors[1][1], data: []},
    {label: 'SD3',  type: 'line', fill: false, pointRadius: 0, backgroundColor: weightColors[0][0], borderColor: weightColors[0][1], data: []},
  ];

  var pdw = {label: 'Patient Data',  type: 'line', fill: false, lineTension: 0.15, backgroundColor: weightColors[4][0], borderColor: weightColors[4][1], data: []};

  weightAge.map((item, i) => {
    var a = new Date("{{ $patient->birthdate }}");
    a.setMonth(birthdate.getMonth()+item.Month);
    sdw[0].data.push({'x': a.toISOString(), 'y': SD(-3, item.L, item.M, item.S)});
    sdw[1].data.push({'x': a.toISOString(), 'y': SD(-2, item.L, item.M, item.S)});
    sdw[2].data.push({'x': a.toISOString(), 'y': SD(-1, item.L, item.M, item.S)});
    sdw[3].data.push({'x': a.toISOString(), 'y': SD(0, item.L, item.M, item.S)});
    sdw[4].data.push({'x': a.toISOString(), 'y': SD(1, item.L, item.M, item.S)});
    sdw[5].data.push({'x': a.toISOString(), 'y': SD(2, item.L, item.M, item.S)});
    sdw[6].data.push({'x': a.toISOString(), 'y': SD(3, item.L, item.M, item.S)});
  });

  var weightConfig = {
    type: 'line',
    data: {
      datasets: [pdw, sdw[0], sdw[1], sdw[2], sdw[3], sdw[4], sdw[5], sdw[6]],
    },
    options: {
      responsive: true,
      responsiveAnimationDuration: 1,
      maintainAspectRatio: true,
      title: {
        display: true,
        text: 'Weight'
      },
      scales: {
        xAxes: [{
          type: 'time',
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Date'
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
            labelString: 'Weight (Kg)'
          }
        }]
      }
    }
  };

  var weightChart = null;

  function initWeightChart() {
    vitals.map((item, i) => {
      pdw.data.push({'x': item.created_at, 'y': item.weight});
    });
    weightChart = new Chart(document.getElementById('weightChart').getContext('2d'), weightConfig);
  }
</script>
