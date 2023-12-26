<template>
  <div class="container m-3">
    <canvas id="myChartFive" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      education: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestEducation: "",
      lowestEducation: "",
    };
  },
  created() {
    this.fetchEducation();
  },

  methods: {
    async fetchEducation() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=education"
      );

      const resData = res.data;
      const education = resData.education.map((d) => d.education);
      const promotedCounts = resData.education.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.education.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const educationSummary = education.map((dept, index) => ({
        education: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      educationSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.education = education;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestEducation = educationSummary[0].education;
      this.lowestEducation =
        educationSummary[educationSummary.length - 1].education;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartFive");
      new Chart(ctx, {
        type: "pie",
        data: {
          labels: this.education,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              backgroundColor: ["#74AAE2", "#BAD5F1", "#90BBE8", "#5D88B5"],
              borderColor: "rgba(255, 255, 255, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Education And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
