<template>
  <div class="dashboard container m-3 row">
    <div class="cards col-md-7">
      <div class="card shadow">
        <div class="card-body d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-3">
              Welcome Back, <strong>Admin </strong>
            </h4>

            <p class="card-text">
              Here's Employees Overview , you can download from here!
            </p>
            <button class="btn" @click="generateReport()">
              <i class="fa-solid fa-download me-2"></i>Employee's Overview
              Report
            </button>
          </div>
          <div>
            <img class="" src="../../assets/life-pana.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <summary-overview class="chart"></summary-overview>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <age-and-promotion class="chart"></age-and-promotion>
      </div>

      <div class="col-lg-6">
        <trainings-and-promotion class="chart"></trainings-and-promotion>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3">
        <channel-and-promotion class="chart"></channel-and-promotion>
      </div>
      <div class="col-lg-6">
        <department-and-promotion class="chart"></department-and-promotion>
      </div>
      <div class="col-lg-3">
        <education-and-promotion class="chart"></education-and-promotion>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <gender-and-promotion class="chart"></gender-and-promotion>
      </div>
      <div class="col-lg-4">
        <rate-and-promotion class="chart"></rate-and-promotion>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <service-and-promotion class="chart"></service-and-promotion>
      </div>
      <div class="col-lg-4">
        <training-score-and-promotion
          class="chart"
        ></training-score-and-promotion>
      </div>
      <div class="col-lg-4">
        <awards-and-promotion class="chart"></awards-and-promotion>
      </div>
    </div>
  </div>
</template>

<script>
import SummaryOverview from "../../components/charts/SummaryOverview.vue";
import AgeAndPromotion from "../../components/charts/AgeAndPromotion.vue";
import AwardsAndPromotion from "../../components/charts/AwardsAndPromotion.vue";
import ChannelAndPromotion from "../../components/charts/ChannelAndPromotion.vue";
import DepartmentAndPromotion from "../../components/charts/DepartmentAndPromotion.vue";
import EducationAndPromotion from "../../components/charts/EducationAndPromotion.vue";
import GenderAndPromotion from "../../components/charts/GenderAndPromotion.vue";
import RateAndPromotion from "../../components/charts/RateAndPromotion.vue";
import ServiceAndPromotion from "../../components/charts/ServiceAndPromotion.vue";
import TrainingsAndPromotion from "../../components/charts/TrainingsAndPromotion.vue";
import TrainingScoreAndPromotion from "../../components/charts/TrainingScoreAndPromotion.vue";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

export default {
  components: {
    SummaryOverview,
    AgeAndPromotion,
    AwardsAndPromotion,
    ChannelAndPromotion,
    DepartmentAndPromotion,
    EducationAndPromotion,
    GenderAndPromotion,
    RateAndPromotion,
    ServiceAndPromotion,
    TrainingsAndPromotion,
    TrainingScoreAndPromotion,
  },

  methods: {
    async generateReport() {
      const pdf = new jsPDF({
        orientation: "landscape",
        unit: "mm",
        format: "a4",
      });

      // Add title to the first page
      pdf.setFontSize(20);
      pdf.text("Employee Overview Report", 10, 20);

      // Calculate the available width and height on each page
      const pageWidth = pdf.internal.pageSize.getWidth();
      const pageHeight = pdf.internal.pageSize.getHeight();
      const chartWidth = pageWidth / 2 - 10; // Subtracting 10 to account for margins
      const chartHeight = chartWidth * 0.75; // Maintain aspect ratio

      // Use html2canvas to convert each chart to an image and add it to the PDF
      let x = 10; // Starting X position
      let y = 40; // Starting Y position
      let chartCount = 0; // Counter for number of charts added
      const chartElements = document.querySelectorAll(".chart");
      for (let i = 0; i < chartElements.length; i++) {
        const chartImage = await html2canvas(chartElements[i], { scale: 2 });
        if (x + chartWidth > pageWidth) {
          // If chart would go off the edge of the page, move to next row
          x = 10;
          y += chartHeight + 10; // Add 10 for margins
        }
        if (y + chartHeight > pageHeight) {
          // If chart would go off the bottom of the page, add new page
          pdf.addPage();
          x = 10;
          y = 10;
          chartCount = 0;
          // Add title to subsequent pages
          pdf.setFontSize(18);
          pdf.text("Employee Overview Report (cont.)", 10, 20);
        }
        pdf.addImage(chartImage, "JPEG", x, y, chartWidth, chartHeight);
        x += chartWidth + 10; // Add 10 for margins
        chartCount++;
        if (chartCount === 6) {
          // Add a new page after 6 charts on each page
          pdf.addPage();
          x = 10;
          y = 10;
          chartCount = 0;
        }
      }

      // Add footer to the last page
      pdf.setFontSize(14);
      pdf.text(
        "Generated by Employee Overview System on " +
          new Date().toLocaleDateString(),
        pageWidth / 2,
        pageHeight - 5 // Add 5 for bottom margin
      );

      pdf.save("report.pdf");
    },
  },
};
</script>

<style scoped>
img {
  width: 200px;
}
.card-title {
  color: #7ea9d4;
}
.card-text {
  color: #626161;
}
.btn {
  background-color: #6ea2d6;

  /* background-color: #4f7cab; */
  color: white;
}
</style>
