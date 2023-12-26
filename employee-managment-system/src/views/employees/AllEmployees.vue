<template>
  <img class="spinner" src="../../assets/cleanup-amico.png" />
  <!-- Show Add Employees Button -->
  <div class="d-md-flex justify-content-md-between m-3">
    <div class="delete-all-btn mb-3">
      <!-- Show Delete All Employees Button -->
      <button
        style="background-color: #4f7cab; color: white"
        @click="deleteAllEmployees()"
        class="btn"
        v-if="employeeData.length > 0"
      >
        <i class="fa-solid fa-trash"> </i>
        <span class="d-none d-md-inline"> Delete All Employees </span>
      </button>
    </div>
    <div class="add-btn">
      <router-link
        to="/add"
        class="btn"
        style="background-color: #a9c9e8; color: white"
      >
        <i class="fa-solid fa-user-plus"></i>

        <span class="d-none d-md-inline"> Add Employee</span>
      </router-link>
    </div>
  </div>

  <div class="clearfix"></div>
  <hr class="bg-info" />

  <!-- Show Error Message -->

  <!-- Search Box -->
  <div class="container my-4">
    <div class="d-flex justify-content-between">
      <!-- <div class="col-md-4"> -->
      <div class="input-group w-50">
        <input
          @keyup="searchMonitor(keyword.word)"
          v-model="keyword.word"
          name="keyword"
          type="search"
          class="form-control rounded"
          placeholder="Search Name "
        />
      </div>

      <div>
        <select class="form-select" v-model="limit" id="limit-select ">
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="150">150</option>
          <option value="250">250</option>
          <option value="350">350</option>
          <option value="500">500</option>
          <option value="650">650</option>
          <option value="700">700</option>
          <option value="700">850</option>
          <option value="700">1000</option>
        </select>
      </div>
      <!-- </div> -->
    </div>
  </div>

  <!-- Table -->
  <div class="container">
    <div class="row mt-3">
      <div class="col-md-12">
        <table class="table table-border caption-top">
          <caption>
            List of Registered Employees({{
              filteredEmployeeData.length
            }})
          </caption>

          <thead>
            <tr class="text-center">
              <th class="p-2">ID</th>
              <th class="p-2">Name</th>
              <th class="p-2">Gender</th>
              <th class="p-2">Department</th>

              <th class="p-2">Eligibility for promotion</th>
              <th class="p-2">
                <i class="fa fa-gear"></i>
                Actions
              </th>
            </tr>
          </thead>

          <tbody>
            <tr
              class="text-center"
              v-for="employee in filteredEmployeeData"
              :key="employee.id"
            >
              <td class="py-3">{{ employee.id }}</td>
              <td class="py-3">{{ employee.name }}</td>
              <td class="py-3">{{ employee.gender }}</td>
              <td class="py-3">{{ employee.department }}</td>

              <td class="py-3">
                {{ employee.is_promoted == 1 ? "Eligible" : "Not Eligible" }}
              </td>

              <td class="d-flex justify-content-center">
                <button
                  to="/"
                  class="btn btn-sm py-3"
                  @click="deleteEmployee(employee.id, employee.name)"
                  style="color: #d94343"
                >
                  Delete
                </button>
                &nbsp;
                <router-link
                  :to="`/employees/edit/${employee.id}`"
                  class="btn btn-sm py-3"
                  style="color: #d69d22"
                >
                  Update
                </router-link>
                <router-link
                  :to="
                    employee.APIResult
                      ? {
                          path: `/employees/view/${employee.id}`,
                          query: {
                            APIResult: encodeURIComponent(
                              JSON.stringify(employee.APIResult)
                            ),
                          },
                        }
                      : `/employees/view/${employee.id}`
                  "
                  class="btn btn-sm py-3"
                  style="color: #325981"
                >
                  View
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import { dynamicAPI } from "../../axios.js";
export default {
  name: "AllEmployees",
  mounted() {
    this.getEmployeeData();
  },
  data() {
    return {
      limit: 50, // default limit is 5

      employeeData: [],
      APIResult: [],

      keyword: {
        name: "",
      },
    };
  },

  methods: {
    async deleteEmployee(id, name) {
      const formData = new FormData();

      formData.append("id", id);
      const { value: confirmed } = await Swal.fire({
        title: `Are you sure u want to delete ${name} with ID: ${id}`,
        icon: null,
        showCancelButton: true,
        confirmButtonColor: "#74aae2",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      });
      if (confirmed) {
        const spinner = document.querySelector(".spinner");
        spinner.style.display = "block"; // show the spinner

        try {
          await axios.post(
            `http://localhost/employee-managment-system/src/api/index.php?action=delete`,
            formData
          );
          setTimeout(() => {
            spinner.style.display = "none"; // hide the spinner after 2 seconds
            setTimeout(() => {
              location.reload(); // reload the page after a delay
            }, 500);
          }, 2000);
        } catch (error) {
          console.log(error);
          spinner.style.display = "none"; // hide the spinner if an error occurs
        }
      }
    },

    async deleteAllEmployees() {
      const { value: confirmed } = await Swal.fire({
        title: "Are you sure u want to delete all employees?",
        showCancelButton: true,
        confirmButtonColor: "#a9c9e8",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete all!",
      });
      if (confirmed) {
        const spinner = document.querySelector(".spinner");
        spinner.style.display = "block"; // show the spinner

        try {
          await axios.get(
            "http://localhost/employee-managment-system/src/api/index.php?action=deleteAll"
          );
          setTimeout(() => {
            spinner.style.display = "none"; // hide the spinner after 2 seconds
            setTimeout(() => {
              location.reload(); // reload the page after a delay
            }, 500);
          }, 2000);
        } catch (error) {
          console.log(error);
          spinner.style.display = "none"; // hide the spinner if an error occurs
        }
      }
    },

    async getEmployeeData() {
      let res = await axios.get(
        "http://localhost/employee-managment-system/src/api/index.php?action=read"
      );
      const resData = res.data;

      //Check connection
      if (res.status == 200) {
        if (resData.error) {
          this.errorMsg = resData.message;
        } else {
          this.employeeData = resData.employees;
          this.predict();
        }
      }
    },

    async predict() {
      for (const employee of this.employeeData) {
        const department = employee.department;
        const region = employee.region;
        const gender = employee.gender;
        const average_montly_hours = employee.average_montly_hours;
        const education = employee.education;
        const age = employee.age;
        const length_of_service = employee.length_of_service;
        const no_of_trainings = employee.no_of_trainings;
        const previous_year_rating = employee.previous_year_rating;
        const recruitment_channel = employee.recruitment_channel;
        const awards_won = employee.awards_won;
        const avg_training_score = employee.avg_training_score;

        console.log("Dynamic Data: ", {
          department,
          region,
          education,
          gender,
          average_montly_hours,
          age,
          length_of_service,
          no_of_trainings,
          previous_year_rating,
          recruitment_channel,
          awards_won,
          avg_training_score,
        });

        try {
          const response = await dynamicAPI.get("/predict", {
            params: {
              department,
              region,
              education,
              gender,
              average_montly_hours,
              age,
              length_of_service,
              no_of_trainings,
              previous_year_rating,
              recruitment_channel,
              awards_won,
              avg_training_score,
            },
          });
          console.log("Received data successfully");
          employee.APIResult = response.data;
          const promoted = response.data.promoted;

          employee.is_promoted = promoted;

          // Send a PUT request to update the database
          const putResponse = await axios.put(
            `http://localhost/employee-managment-system/src/api/index.php?action=updatePromoted`,
            {
              id: employee.id,
              is_promoted: employee.is_promoted,
            }
          );
          console.log(putResponse.data.message);
        } catch (error) {
          console.log("Error getting or updating data: ", error);
        }
      }
    },

    async searchMonitor(key) {
      const form_data = new FormData();
      form_data.append("keyword", key);
      let res = await axios.post(
        `http://localhost/employee-managment-system/src/api/index.php?action=search`,
        form_data
      );

      const resData = res.data;
      this.employeeData = resData.employees;
    },
  },
  computed: {
    filteredEmployeeData() {
      // filter the employeeData based on the selected limit
      return this.employeeData.slice(0, this.limit);
    },
  },
};
</script>

<style scoped>
th {
  background-color: #f3f3f3dc;
  color: #7ea9d4;
}
td {
  color: #626161;
}

.centered {
  display: block;
  margin: 0 auto;
}
img.spinner {
  display: none;
  margin: auto;
  width: 4%;
  animation-name: spin;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
