fetch('/ENSAH-service/inc/functions/general/get_stats.php')
  .then(response => response.json())
  .then(data => {
    // Extraire les rôles (catégories) et les totaux
    const categories = Object.keys(data);
    const values = Object.values(data).map(item => item[0].total);

    var options = {
      chart: {
        height: 300,
        type: 'bar',
        zoom: {
          enabled: false
        }
      },
      plotOptions: {
        bar: {
          distributed: true
        }
      },
      dataLabels: {
        enabled: false,
        width: 2
      },
      stroke: {
        curve: 'straight'
      },
      colors: ['#1890ff', '#52c41a', '#faad14', '#f5222d',"gray"], // Tu peux en ajouter plus si tu as plus de rôles
      series: [{
        name: 'nombre d\'utilisateurs',
        data: values
      }],
      grid: {
        row: {
          colors: ['#f3f6ff', 'transparent'],
          opacity: 0.5
        }
      },
      xaxis: {
        categories: categories
      }
    };

    var chart = new ApexCharts(document.querySelector('#bar-chart-1'), options);
    chart.render();
  })
  .catch(error => console.error('Erreur lors du chargement des données :', error));