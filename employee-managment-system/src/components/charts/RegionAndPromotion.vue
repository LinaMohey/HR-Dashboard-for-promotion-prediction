<template>
  <div class="container m-3">
    <canvas id="myChartNine" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      regions: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestRegion: "",
      lowestRegion: "",
    };
  },
  created() {
    this.fetchRegion();
  },

  methods: {
    async fetchRegion() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=region"
      );

      const resData = res.data;
      const regions = resData.region.map((d) => d.region);
      const promotedCounts = resData.region.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.region.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const regionSummary = regions.map((dept, index) => ({
        region: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      regionSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.regions = regions;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestRegion = regionSummary[0].region;
      this.lowestRegion = [regionSummary.length - 1].region;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartNine");
      new Chart(ctx, {
        type: "doughnut", // change chart type to doughnut
        data: {
          labels: this.regions,
          datasets: [
            {
              label: "Promotion Rates",
              data: this.promotionRates.map((rate) =>
                rate === "NaN" ? 0 : rate < 0 ? 0 : rate > 100 ? 100 : rate
              ),
            },
            {
              label: "Promoted",
              data: this.promotedCounts,
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
            },
          ],
        },
        options: {
          responsive: true,
        },
      });
    },
  },
};
</script>
