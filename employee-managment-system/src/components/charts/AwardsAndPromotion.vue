<template>
  <div class="container m-3">
    <canvas id="myChartTwo" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      awards_won: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highest_awards_won: "",
      lowest_awards_won: "",
    };
  },
  created() {
    this.fetch_awards_won();
  },

  methods: {
    async fetch_awards_won() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=awards_won"
      );

      const resData = res.data;
      const awards_won = resData.awards_won.map((d) => d.awards_won);
      const promotedCounts = resData.awards_won.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.awards_won.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const awards_wonSummary = awards_won.map((dept, index) => ({
        awards_won: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      awards_wonSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.awards_won = awards_won;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highest_awards_won = awards_wonSummary[0].awards_won;
      this.lowest_awards_won = [awards_wonSummary.length - 1].awards_won;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartTwo");
      new Chart(ctx, {
        type: "bar", // change chart type to doughnut
        data: {
          labels: this.awards_won,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              backgroundColor: "#9EC4EB",
            },
            {
              label: "Promoted",
              data: this.promotedCounts,
              backgroundColor: "#DDEAF8",
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
              backgroundColor: "#5D88B5",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Awards Taken And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
