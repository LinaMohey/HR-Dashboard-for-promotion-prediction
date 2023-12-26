<template>
  <div class="container m-3">
    <canvas id="myChartSix" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      gender: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestGender: "",
      lowestGender: "",
    };
  },
  created() {
    this.fetchGender();
  },

  methods: {
    async fetchGender() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=gender"
      );

      const resData = res.data;
      const gender = resData.gender.map((d) => d.gender);
      const promotedCounts = resData.gender.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.gender.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const genderSummary = gender.map((dept, index) => ({
        gender: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      genderSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.gender = gender;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestGender = genderSummary[0].gender;
      this.lowestGender = [genderSummary.length - 1].gender;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartSix");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: this.gender,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              backgroundColor: "#BAD5F1", // set color for promotion rates bar
            },
            {
              label: "Promoted",
              data: this.promotedCounts,
              backgroundColor: "#74AAE2",
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
              backgroundColor: "#4f7cab",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Gender Distribution And Promotion",
            },
          },
          responsive: true,
          scales: {
            x: {
              stacked: true,
            },
            y: {
              stacked: true,
            },
          },
        },
      });
    },
  },
};
</script>
