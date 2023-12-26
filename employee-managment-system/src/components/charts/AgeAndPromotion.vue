<template>
  <div class="container m-3">
    <canvas id="myChart" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      age: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestAge: "",
      lowestaAge: "",
    };
  },
  created() {
    this.fetchage();
  },

  methods: {
    async fetchage() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=age"
      );

      const resData = res.data;
      const age = resData.age.map((d) => d.age);
      const promotedCounts = resData.age.map((d) => parseInt(d.promoted ?? 0));
      const notPromotedCounts = resData.age.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const ageSummary = age.map((dept, index) => ({
        age: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      ageSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.age = age;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestAge = ageSummary[0].age;
      this.lowestAge = [ageSummary.length - 1].age;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChart");
      new Chart(ctx, {
        type: "line", // change chart type to doughnut
        data: {
          labels: this.age,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              borderColor: "#a7c7e7",
              backgroundColor: "rgba(167, 199, 231, 0.2)",
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Age Distribution And Promotion",
            },
            legend: {
              display: false, // Set display to false to remove the chart border
            },
          },
          responsive: true,

          elements: {
            point: {
              radius: 0, // Set point radius to 0 to remove the sketch inside the line chart
            },
          },
        },
      });
    },
  },
};
</script>
