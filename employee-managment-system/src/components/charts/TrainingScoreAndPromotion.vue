<template>
  <div class="container m-3">
    <canvas id="mChart11" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      avg_training_score: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highest_avg_training_score: "",
      lowest_avg_training_score: "",
    };
  },
  created() {
    this.fetch_avg_training_score();
  },

  methods: {
    async fetch_avg_training_score() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=avg_training_score"
      );

      const resData = res.data;
      const avg_training_score = resData.avg_training_score.map(
        (d) => d.avg_training_score
      );
      const promotedCounts = resData.avg_training_score.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.avg_training_score.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const avg_training_scoreSummary = avg_training_score.map(
        (dept, index) => ({
          avg_training_score: dept,
          promoted: promotedCounts[index],
          notPromoted: notPromotedCounts[index],
          promotionRate: promotionRates[index],
        })
      );

      avg_training_scoreSummary.sort(
        (a, b) => b.promotionRate - a.promotionRate
      );

      this.avg_training_score = avg_training_score;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highest_avg_training_score =
        avg_training_scoreSummary[0].avg_training_score;
      this.lowest_avg_training_score = [
        avg_training_scoreSummary.length - 1,
      ].avg_training_score;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("mChart11");
      new Chart(ctx, {
        type: "scatter",
        data: {
          labels: this.avg_training_score,
          datasets: [
            {
              label: "Promoted",
              data: this.promotedCounts,
              backgroundColor: "#7ea9d4",
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
              backgroundColor: "#4F7CAB",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Average Training Score And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
