<div class="pb-5 w-100">
  <canvas class="w-100" height="500px" id="heightChart"></canvas>
</div>
<script>
  var heightColors = [
    ["rgba(255, 100, 000, 0.2)", "rgba(250, 100, 000, 0.7)"],
    ["rgba(255, 160, 000, 0.2)", "rgba(200, 150, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(150, 200, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(050, 100, 000, 0.7)"],
    ["rgba(000, 123, 200, 0.2)", "rgba(000, 123, 200, 0.7)"]
  ];

  var sdh = [
    {label: 'SD3n', type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[0][0], borderColor: heightColors[0][1], data: []},
    {label: 'SD2n', type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[1][0], borderColor: heightColors[1][1], data: []},
    {label: 'SD1n', type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[2][0], borderColor: heightColors[2][1], data: []},
    {label: 'SD0',  type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[3][0], borderColor: heightColors[3][1], data: []},
    {label: 'SD1',  type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[2][0], borderColor: heightColors[2][1], data: []},
    {label: 'SD2',  type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[1][0], borderColor: heightColors[1][1], data: []},
    {label: 'SD3',  type: 'line', fill: false, pointRadius: 0, backgroundColor: heightColors[0][0], borderColor: heightColors[0][1], data: []},
  ];

  var pdh = {label: 'Patient Data',  type: 'line', fill: false, lineTension: 0.15, backgroundColor: heightColors[4][0], borderColor: heightColors[4][1], data: []};

  heightAge.map((item, i) => {
    var a = new Date("{{ $patient->birthdate }}");
    a.setMonth(birthdate.getMonth()+item.Month);
    sdh[0].data.push({'x': a.toISOString(), 'y': SD(-3, item.L, item.M, item.S)});
    sdh[1].data.push({'x': a.toISOString(), 'y': SD(-2, item.L, item.M, item.S)});
    sdh[2].data.push({'x': a.toISOString(), 'y': SD(-1, item.L, item.M, item.S)});
    sdh[3].data.push({'x': a.toISOString(), 'y': SD(0, item.L, item.M, item.S)});
    sdh[4].data.push({'x': a.toISOString(), 'y': SD(1, item.L, item.M, item.S)});
    sdh[5].data.push({'x': a.toISOString(), 'y': SD(2, item.L, item.M, item.S)});
    sdh[6].data.push({'x': a.toISOString(), 'y': SD(3, item.L, item.M, item.S)});
  });

  var heightConfig = {
    type: 'line',
    data: {
      datasets: [pdh, sdh[0], sdh[1], sdh[2], sdh[3], sdh[4], sdh[5], sdh[6]],
    },
    options: {
      responsive: true,
      responsiveAnimationDuration: 1,
      maintainAspectRatio: true,
      title: {
        display: true,
        text: 'Height'
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
            labelString: 'Height (cm)'
          }
        }]
      }
    }
  };

  var heightChart = null;

  function initHeightChart() {
    vitals.map((item, i) => {
      pdh.data.push({'x': item.created_at, 'y': item.height});
    });
    heightChart = new Chart(document.getElementById('heightChart').getContext('2d'), heightConfig);
  }
</script>
