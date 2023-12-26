<template>
  <div class="container m-3">
    <canvas id="myChart6" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      no_of_trainings: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highest_no_of_trainings: "",
      lowest_no_of_trainings: "",
    };
  },
  created() {
    this.fetchno_of_trainings();
  },

  methods: {
    async fetchno_of_trainings() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=no_of_trainings"
      );

      const resData = res.data;
      const no_of_trainings = resData.no_of_trainings.map(
        (d) => d.no_of_trainings
      );
      const promotedCounts = resData.no_of_trainings.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.no_of_trainings.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const no_of_trainingsSummary = no_of_trainings.map((dept, index) => ({
        no_of_trainings: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      no_of_trainingsSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.no_of_trainings = no_of_trainings;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highest_no_of_trainings = no_of_trainingsSummary[0].no_of_trainings;
      this.lowest_no_of_trainings = [
        no_of_trainingsSummary.length - 1,
      ].no_of_trainings;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChart6");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: this.no_of_trainings,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),

              backgroundColor: "#DDEAF8",
            },
            {
              label: "Promoted",
              data: this.promotedCounts,
              backgroundColor: "#9EC4EB",
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
              text: "Number of Trainings And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
