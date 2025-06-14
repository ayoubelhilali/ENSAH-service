fetch("/ENSAH-service/inc/functions/general/get_stats.php")
  .then((response) => response.json())
  .then((data) => {
    // Extraire les rôles (catégories) et les totaux
    const categories = Object.keys(data);
    const values = Object.values(data).map((item) => item[0].total);

    var options = {
      chart: {
        height: 300,
        type: "bar",
        zoom: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          distributed: true,
        },
      },
      dataLabels: {
        enabled: false,
        width: 2,
      },
      stroke: {
        curve: "straight",
      },
      colors: ["#1890ff", "#52c41a", "#faad14", "#f5222d", "gray"], // Tu peux en ajouter plus si tu as plus de rôles
      series: [
        {
          name: "nombre d'utilisateurs",
          data: values,
        },
      ],
      grid: {
        row: {
          colors: ["#f3f6ff", "transparent"],
          opacity: 0.5,
        },
      },
      xaxis: {
        categories: categories,
      },
    };

    var chart = new ApexCharts(document.querySelector("#bar-chart-1"), options);
    chart.render();
  })
  .catch((error) =>
    console.error("Erreur lors du chargement des données :", error)
  );

fetch("/ENSAH-service/inc/functions/general/get_volume.php")
  .then((response) => response.json())
  .then((data) => {
    // Extraire les noms des unités et leurs volumes
    const categories = data.map((item) => item.nom_unite);
    const values = data.map((item) => item.volume);

    var options = {
      chart: {
        height: 300,
        type: "bar",
        zoom: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          distributed: true,
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: "straight",
      },
      colors: [
        "#1890ff",
        "#52c41a",
        "#faad14",
        "#f5222d",
        "gray",
        "#722ed1",
        "#13c2c2",
      ], // Tu peux ajouter plus si besoin
      series: [
        {
          name: "Volume horaire",
          data: values,
        },
      ],
      grid: {
        row: {
          colors: ["#f3f6ff", "transparent"],
          opacity: 0.5,
        },
      },
      xaxis: {
        categories: categories,
      },
    };

    var chart = new ApexCharts(document.querySelector("#bar-chart-2"), options);
    chart.render();
  })
  .catch((error) =>
    console.error("Erreur lors du chargement des données :", error)
);

fetch("/ENSAH-service/inc/functions/general/get_units.php")
  .then((response) => response.json())
  .then((data) => {
    const totalUnits = data.unite[0].total;
    const affectedUnits = data.unite_affecte[0].total;
    const nonAffectedUnits = data.unite_non_affecte[0].total;

    const series = [affectedUnits, nonAffectedUnits];
    const labels = ["Unités affectées", "Unités non affectées"];

    const options = {
      chart: {
        type: "pie",
        height: 300,
      },
      labels: labels,
      series: series,
      colors: ["#28a745", "#dc3545"],
    };

    const chart = new ApexCharts(
      document.querySelector("#bar-chart-3"),
      options
    );
    chart.render();
  })
  .catch((error) =>
    console.error("Erreur lors du chargement des données :", error)
  );

  

