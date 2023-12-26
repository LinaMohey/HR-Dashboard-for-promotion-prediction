<template>
  <div class="container m-3">
    <canvas id="myChartThree" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      recruitment_channel: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highest_recruitment_channel: "",
      lowest_recruitment_channel: "",
    };
  },
  created() {
    this.fetch_recruitment_channel();
  },

  methods: {
    async fetch_recruitment_channel() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=recruitment_channel"
      );

      const resData = res.data;
      const recruitment_channel = resData.recruitment_channel.map(
        (d) => d.recruitment_channel
      );
      const promotedCounts = resData.recruitment_channel.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.recruitment_channel.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const recruitment_channelSummary = recruitment_channel.map(
        (dept, index) => ({
          recruitment_channel: dept,
          promoted: promotedCounts[index],
          notPromoted: notPromotedCounts[index],
          promotionRate: promotionRates[index],
        })
      );

      recruitment_channelSummary.sort(
        (a, b) => b.promotionRate - a.promotionRate
      );

      this.recruitment_channel = recruitment_channel;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highest_recruitment_channel =
        recruitment_channelSummary[0].recruitment_channel;
      this.lowest_recruitment_channel = [
        recruitment_channelSummary.length - 1,
      ].recruitment_channel;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartThree");
      new Chart(ctx, {
        type: "doughnut", // change chart type to doughnut
        data: {
          labels: this.recruitment_channel,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
              backgroundColor: ["#7EA9D4", "#90BBE8", "#7BA0D9", "#4F7CAB"],
              borderColor: "rgba(255, 255, 255, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Recruitment Channel And Promotion",
            },
          },
          responsive: true,
        },
      });
    },
  },
};
</script>
