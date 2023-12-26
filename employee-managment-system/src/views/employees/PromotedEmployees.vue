<template>
  <div class="container m-4">
    <div class="row gx-2">
      <div class="col-xl-6">
        <button class="btn btn-promoted mx-3 mb-4" @click="generateReport()">
          <i class="fa-solid fa-download me-2"></i> Promoted Employees Report
        </button>
      </div>

      <div class="d-flex justify-content-xl-end col-xl-6">
        <div class="col-xl-4 me-2">
          <select
            class="form-select"
            v-model="department"
            id="department-select"
          >
            <option value="Sales & Marketing">Sales & Marketing</option>
            <option value="Operations">Operations</option>
            <option value="HR">HR</option>
            <option value="Procurement">Procurement</option>
            <option value="Analytics">Analytics</option>
            <option value="Finance">Finance</option>
            <option value="Technology">Technology</option>
          </select>
        </div>

        <div class="col-xl-4">
          <select
            class="form-select form-select-auto me-2"
            v-model="limit"
            id="employee-select"
          >
            <option class="dropdown-item" value="5">5</option>
            <option class="dropdown-item" value="10">10</option>
            <option class="dropdown-item" value="50">100</option>
            <option class="dropdown-item" value="10">100</option>
            <option class="dropdown-item" value="150">150</option>
            <option class="dropdown-item" value="250">250</option>
            <option class="dropdown-item" value="350">350</option>
            <option class="dropdown-item" value="500">500</option>
            <option class="dropdown-item" value="650">650</option>
            <option class="dropdown-item" value="700">700</option>
          </select>
        </div>
      </div>
    </div>
    <div class="card shadow m-3">
      <div class="card-body">
        <p class="card-text fw-bold">
          Here are the names of employees that are eligible for promotion listed
          by department
        </p>
      </div>

      <div class="row g-0">
        <div class="col-xl-6">
          <div class="container promoted">
            <table class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th class="px-4">Name:</th>
                  <th class="px-4">Department</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="employee in filteredPromotedEmployees"
                  :key="employee.name"
                >
                  <td class="p-3">
                    {{ employee.name }}
                    <i class="fw-bold fa-solid fa-award ms-1"> </i>
                  </td>
                  <td class="p-3">{{ employee.department }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-xl-6 p-0">
          <img
            src="../../assets/Hired-pana.png"
            class="promoted image-fluid w-100"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "jquery";
import "bootstrap/dist/js/bootstrap.bundle";
import axios from "axios";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

export default {
  name: "PromotedEmployees",
  mounted() {
    this.fetchPromotedEmployees();
  },
  data() {
    return {
      promotedEmployees: [],
      department: "Sales & Marketing",
      limit: 5,
    };
  },

  methods: {
    fetchPromotedEmployees() {
      axios
        .get(
          "http://localhost/employee-managment-system/src/api/index.php?action=promoted"
        )
        .then((response) => {
          this.promotedEmployees = response.data.promoted;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async generateReport() {
      const pdf = new jsPDF({
        orientation: "landscape",
        unit: "mm",
        format: "a4",
      });

      // Add title to the first page
      pdf.setFontSize(20);
      pdf.text(
        "Names of employees that are eligble for promotion Report",
        10,
        25
      );

      // Calculate the available width and height on each page
      const pageWidth = pdf.internal.pageSize.getWidth();
      const pageHeight = pdf.internal.pageSize.getHeight();
      const tableWidth = (pageWidth - 40) / 2; // Subtract 40 for margins (20px left and right)
      const tableHeight = tableWidth * 0.9; // Maintain aspect ratio

      // Use html2canvas to convert each chart to an image and add it to the PDF
      let x = 10; // Starting X position
      let y = 40; // Starting Y position
      let chartCount = 0; // Counter for number of charts added
      const tableElements = document.querySelectorAll(".promoted");
      for (let i = 0; i < tableElements.length; i++) {
        const tableImage = await html2canvas(tableElements[i], { scale: 2 });
        if (x + tableWidth > pageWidth) {
          // If chart would go off the edge of the page, move to next row
          x = 10;
          y += tableHeight + 10; // Add 10 for margins
        }
        if (y + tableHeight > pageHeight) {
          // If chart would go off the bottom of the page, add new page
          pdf.addPage();
          x = 10;
          y = 10;
          chartCount = 0;
          // Add title to subsequent pages
          pdf.setFontSize(18);
          pdf.text("Promoted Employees Report (cont.)", 10, 20);
        }
        pdf.addImage(tableImage, "JPEG", x, y, tableWidth, tableHeight);
        x += tableWidth + 10; // Add 10 for margins
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

  computed: {
    filteredPromotedEmployees() {
      return this.promotedEmployees

        .filter((employee) => employee.department === this.department)
        .slice(0, this.limit);
    },
  },
};
</script>

<style scoped>
.btn-promoted {
  background-color: #6ea2d6;
  color: white;
}
h1 {
  color: #7ea9d4;
}
th {
  background-color: #f3f3f3dc;
  color: #7ea9d4;
}
label,
td,
.card-text,
#employee-select,
#department-select {
  color: #626161;
}
.fa-award {
  color: #b0ceec;
}

.form-select-auto {
  display: inline-block;
  max-width: 100%;
  width: auto;
}
</style>
