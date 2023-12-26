<template>
  <div class="container m-3">
    <canvas id="myChartTen" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      length_of_service: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highest_length_of_service: "",
      lowest_length_of_service: "",
    };
  },
  created() {
    this.fetch_length_of_service();
  },

  methods: {
    async fetch_length_of_service() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=length_of_service"
      );

      const resData = res.data;
      const length_of_service = resData.length_of_service.map(
        (d) => d.length_of_service
      );
      const promotedCounts = resData.length_of_service.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.length_of_service.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const length_of_serviceSummary = length_of_service.map((dept, index) => ({
        length_of_service: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      length_of_serviceSummary.sort(
        (a, b) => b.promotionRate - a.promotionRate
      );

      this.length_of_service = length_of_service;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highest_length_of_service =
        length_of_serviceSummary[0].length_of_service;
      this.lowestl_ength_of_service = [
        length_of_serviceSummary.length - 1,
      ].length_of_service;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartTen");
      new Chart(ctx, {
        type: "line", // change chart type to doughnut
        data: {
          labels: this.length_of_service,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              borderColor: "#74AAE2",
              backgroundColor: "rgba(167, 199, 231, 0.2)",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Length of Service And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
