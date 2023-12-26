<template>
  <div class="container mt-3">
    <h2
      v-for="employee in currentEmployeeData"
      :key="employee.id"
      class="text-center m-4"
    >
      Update {{ employee.name }}'s Profile
    </h2>

    <the-spinner v-if="this.loading"> </the-spinner>

    <div class="row">
      <div
        class="col-md-4 col-sm-6 container"
        v-for="employee in currentEmployeeData"
        :key="employee.id"
      >
        <form @submit.prevent="updateEmployee(employee)" method="post">
          <label for="edit-employee-id" class="">ID</label>
          <input
            disabled
            type="text"
            class="form-control"
            placeholder="ID"
            id="edit-employee-id"
            name="id"
            v-model="employee.id"
          />

          <label for="edit-name" class="">Name</label>
          <input
            type="text"
            class="form-control"
            placeholder="Name"
            id="edit-name"
            v-model="employee.name"
          />
          <label for="edit-age" class="">Age</label>
          <input
            type="text"
            class="form-control"
            placeholder="age"
            id="edit-age"
            v-model="employee.age"
            min="18"
            max="60"
          />

          <label for="edit-gender" class="">Gender</label>

          <select
            class="form-select"
            id="edit-gender"
            v-model="employee.gender"
          >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
          <label for="department" class="">Department</label>

          <select
            class="form-select"
            id="edit-department"
            v-model="employee.department"
          >
            <option value="Sales & Marketing">Sales & Marketing</option>
            <option value="Operations">Operations</option>
            <option value="Technology">Technology</option>
            <option value="Analytics">Analytics</option>
            <option value="Procurement">Procurement</option>
            <option value="Finance">Finance</option>
            <option value="HR">HR</option>
            <option value="Legal">Legal</option>
          </select>

          <label for="edit-education" class="">Education</label>
          <select
            class="form-select"
            id="edit-education"
            v-model="employee.education"
          >
            <option value="Masters">Masters</option>
            <option value="Bachelors">Bachelors</option>
            <option value="Below Secondary">Below Secondary</option>
          </select>
          <label for="edit-region" class="">Region</label>

          <select
            class="form-select"
            id="edit-region"
            v-model="employee.region"
          >
            <option value="region_1">Region 1</option>
            <option value="region_2">Region 2</option>
            <option value="region_3">Region 3</option>
            <option value="region_4">Region 4</option>
            <option value="region_5">Region 5</option>
            <option value="region_6">Region 6</option>
            <option value="region_7">Region 7</option>
            <option value="region_8">Region 8</option>
            <option value="region_9">Region 9</option>
            <option value="region_10">Region 10</option>
            <option value="region_11">Region 11</option>
            <option value="region_12">Region 12</option>
            <option value="region_13">Region 13</option>
            <option value="region_14">Region 14</option>
            <option value="region_15">Region 15</option>
            <option value="region_16">Region 16</option>
            <option value="region_17">Region 17</option>
            <option value="region_18">Region 18</option>
            <option value="region_19">Region 19</option>
            <option value="region_20">Region 20</option>
            <option value="region_21">Region 21</option>
            <option value="region_22">Region 22</option>
            <option value="region_23">Region 23</option>
            <option value="region_24">Region 24</option>
            <option value="region_25">Region 25</option>
            <option value="region_26">Region 26</option>
            <option value="region_27">Region 27</option>
            <option value="region_28">Region 28</option>
            <option value="region_29">Region 29</option>
            <option value="region_30">Region 30</option>
            <option value="region_31">Region 31</option>
            <option value="region_32">Region 32</option>
            <option value="region_33">Region 33</option>
            <option value="region_34">Region 34</option>
          </select>

          <label for="edit-recruitment_channel">Recruitment Channel</label>

          <select
            class="form-select"
            id="edit-recruitment_channel"
            v-model="employee.recruitment_channel"
          >
            <option value="sourcing">Sourcing</option>
            <option value="other">Other</option>
            <option value="referred">Referred</option>
          </select>
          <label for="edit-service" class=""
            >Length of service (in years)</label
          >
          <input
            type="number"
            class="form-control"
            placeholder="Length of service"
            id="edit-service"
            v-model="employee.length_of_service"
            min="1"
            max="37"
          />

          <label for="edit-average_montly_hours" class=""> Monthly Hours</label>
          <input
            type="text"
            class="form-control"
            placeholder="Monthly Hours"
            id="edit-average_montly_hours"
            v-model="employee.average_montly_hours"
            min="96"
            max="310"
          />

          <label for="edit-rate" class="">Previous year rating</label>
          <input
            type="number"
            class="form-control"
            placeholder="Previous year rating"
            id="edit-rate"
            v-model="employee.previous_year_rating"
            min="1"
            max="5"
          />

          <label for="edit-awards_won" class="">Awards won</label>
          <select
            class="form-select"
            id="edit_awards_won"
            v-model="employee.awards_won"
          >
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>

          <label for="edit-no_of_trainings" class="">Number of trainings</label>
          <input
            type="number"
            class="form-control"
            placeholder="Number of trainings"
            id="edit-no_of_trainings"
            v-model="employee.no_of_trainings"
            min="1"
            max="10"
          />
          <label for="edit-average_score" class=""
            >Average training score</label
          >
          <input
            type="number"
            class="form-control"
            placeholder="Average training score"
            id="edit-average_score"
            v-model="employee.avg_training_score"
            min="39"
            max="90"
          />

          <button class="update-btn btn">Update Employee</button>
        </form>
      </div>
      <div class="col-md-5">
        <img
          class="d-none d-md-block"
          src="../../assets/installation-amico.png"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
import TheSpinner from "../../components/TheSpinner.vue";

import axios from "axios";

export default {
  components: {
    TheSpinner,
  },
  name: "EditEmployee",
  mounted() {
    this.viewEmployee(this.employeeId);
  },
  data() {
    return {
      employeeId: this.$route.params.employeeId,
      currentEmployeeData: [],
      employeeData: [],
      loading: false,
    };
  },

  methods: {
    //To Get The Value first

    async viewEmployee(id) {
      let res = await axios.get(
        `http://localhost/employee-managment-system/src/api/index.php?action=readAll&id=${id}`
      );
      const resData = res.data;
      if (res.status == 200) {
        if (resData.error) {
          // this.errorMsg = resData.message;
        } else {
          this.currentEmployeeData = resData.allEmployeesData;
        }
      }
    },

    async updateEmployee(employee) {
      this.loading = true;

      let form_data = new FormData();
      form_data.append("id", employee.id);
      form_data.append("name", employee.name);
      form_data.append("age", employee.age);
      form_data.append("department", employee.department);
      form_data.append("education", employee.education);
      form_data.append("gender", employee.gender);
      form_data.append("region", employee.region);
      form_data.append("channel", employee.recruitment_channel);
      form_data.append("service", employee.length_of_service);
      form_data.append("average_montly_hours", employee.average_montly_hours);
      form_data.append("rate", employee.previous_year_rating);
      form_data.append("awards", employee.awards_won);
      form_data.append("no_of_training", employee.no_of_trainings);
      form_data.append("average_score", employee.avg_training_score);

      setTimeout(async () => {
        await axios.post(
          `http://localhost/employee-managment-system/src/api/index.php?action=update`,

          form_data
        );

        // Reset the form data
        this.$router.push("/employees");
        this.loading = false;
        this.successMsg = false;
      }, 2000);
    },
  },
};
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.update-btn {
  background-color: #72a4d6;
  margin: 10px 0;
  color: white;
  position: relative;
  left: 25%;
}
.form-group-error {
  border-color: red;
}
input,
select {
  margin: 1rem 0;
  color: #626161;
}

h2 {
  font-weight: bold;
  color: #7ea9d4;
}

label {
  color: #94bce4;
  font-weight: bold;
}
img {
  width: 100%;
}
h2 {
  font-weight: 700;
  margin: 50px 0;
}
</style>
