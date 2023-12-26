<template>
  <div class="container m-3">
    <canvas id="myChartEight" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      rate: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestRate: "",
      lowestRate: "",
    };
  },
  created() {
    this.fetchRate();
  },

  methods: {
    async fetchRate() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=rate"
      );

      const resData = res.data;
      const rate = resData.rate.map((d) => d.rate);
      const promotedCounts = resData.rate.map((d) => parseInt(d.promoted ?? 0));
      const notPromotedCounts = resData.rate.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const rateSummary = rate.map((dept, index) => ({
        rate: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      rateSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.rate = rate;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestRate = rateSummary[0].rate;
      this.lowestRate = [rateSummary.length - 1].rate;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartEight");
      new Chart(ctx, {
        type: "radar",
        data: {
          labels: this.rate,
          datasets: [
            {
              label: "Promoted",
              data: this.promotedCounts,
              borderColor: "#74AAE2",
              backgroundColor: "#BAD5F1",
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
              borderColor: "#7ba0d9",
              backgroundColor: "#4f7cab",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Previous Year Rating And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
