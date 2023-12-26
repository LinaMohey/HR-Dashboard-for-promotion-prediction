<template>
  <div class="container m-3">
    <canvas id="myChartFour" class="card col-lg-3 shadow"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";
import axios from "axios";
export default {
  data() {
    return {
      departments: [],
      promotedCounts: [],
      notPromotedCounts: [],
      promotionRates: [],
      highestDepartment: "",
      lowestDepartment: "",
    };
  },
  created() {
    this.fetchDepartent();
  },

  methods: {
    async fetchDepartent() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=department"
      );

      const resData = res.data;
      const departments = resData.department.map((d) => d.department);
      const promotedCounts = resData.department.map((d) =>
        parseInt(d.promoted ?? 0)
      );
      const notPromotedCounts = resData.department.map((d) =>
        parseInt(d.not_promoted ?? 0)
      );
      const promotionRates = promotedCounts.map((p, index) =>
        ((p / (p + notPromotedCounts[index])) * 100).toFixed(2)
      );

      const departmentSummary = departments.map((dept, index) => ({
        department: dept,
        promoted: promotedCounts[index],
        notPromoted: notPromotedCounts[index],
        promotionRate: promotionRates[index],
      }));

      departmentSummary.sort((a, b) => b.promotionRate - a.promotionRate);

      this.departments = departments;
      this.promotionRates = promotionRates;
      this.promotedCounts = promotedCounts;
      this.notPromotedCounts = notPromotedCounts;
      this.highestDepartment = departmentSummary[0].department;
      this.lowestDepartment =
        departmentSummary[departmentSummary.length - 1].department;

      this.renderChart();
    },

    renderChart() {
      const ctx = document.getElementById("myChartFour");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: this.departments,
          datasets: [
            {
              label: "Promoted",
              data: this.promotedCounts,
              backgroundColor: "#9EC4EB",
              borderWidth: 1,
            },
            {
              label: "Not Promoted",
              data: this.notPromotedCounts,
              backgroundColor: "#5D88B5",
              borderWidth: 1,
            },
          ],
        },
        options: {
          plugins: {
            title: {
              display: true,
              text: "Department And Promotion",
            },
          },

          indexAxis: "y",
          responsive: true,
          scales: {},
        },
      });
    },
  },
};
</script>
