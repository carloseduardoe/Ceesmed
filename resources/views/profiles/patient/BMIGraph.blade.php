<div class="pb-5 w-100">
  <canvas class="w-100" BMI="500px" id="BMIChart"></canvas>
</div>
<script>
  var BMIColors = [
    ["rgba(255, 100, 000, 0.2)", "rgba(250, 100, 000, 0.7)"],
    ["rgba(255, 160, 000, 0.2)", "rgba(200, 150, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(150, 200, 000, 0.7)"],
    ["rgba(255, 220, 000, 0.2)", "rgba(050, 100, 000, 0.7)"],
    ["rgba(000, 123, 200, 0.2)", "rgba(000, 123, 200, 0.7)"]
  ];

  var sdh = [
    {label: 'SD3n', type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[0][0], borderColor: BMIColors[0][1], data: []},
    {label: 'SD2n', type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[1][0], borderColor: BMIColors[1][1], data: []},
    {label: 'SD1n', type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[2][0], borderColor: BMIColors[2][1], data: []},
    {label: 'SD0',  type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[3][0], borderColor: BMIColors[3][1], data: []},
    {label: 'SD1',  type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[2][0], borderColor: BMIColors[2][1], data: []},
    {label: 'SD2',  type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[1][0], borderColor: BMIColors[1][1], data: []},
    {label: 'SD3',  type: 'line', fill: false, pointRadius: 0, backgroundColor: BMIColors[0][0], borderColor: BMIColors[0][1], data: []},
  ];

  var pdbmi = {label: 'Patient Data',  type: 'line', fill: false, lineTension: 0.15, backgroundColor: BMIColors[4][0], borderColor: BMIColors[4][1], data: []};

  bmiAge.map((item, i) => {
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

  var BMIConfig = {
    type: 'line',
    data: {
      datasets: [pdbmi, sdh[0], sdh[1], sdh[2], sdh[3], sdh[4], sdh[5], sdh[6]],
    },
    options: {
      responsive: true,
      responsiveAnimationDuration: 1,
      maintainAspectRatio: true,
      title: {
        display: true,
        text: 'BMI'
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
            labelString: 'Value'
          }
        }]
      }
    }
  };

  var BMIChart = null;

  function initBMIChart() {
    vitals.map((item, i) => {
      pdbmi.data.push({'x': item.created_at, 'y': item.weight / Math.pow(item.height / 100, 2)});
    });
    BMIChart = new Chart(document.getElementById('BMIChart').getContext('2d'), BMIConfig);
  }
</script>
