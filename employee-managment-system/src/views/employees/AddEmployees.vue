<template>
  <div class="container mt-3">
    <h2 class="m-4 text-center">Add New Employee</h2>
    <div class="row">
      <the-spinner v-if="this.loading"> </the-spinner>
      <div class="col-md-4 col-sm-8 container">
        <div
          v-if="successMsg"
          class="alert alert-success alert-dismissible fade show"
          role="alert"
        >
          Employee Added Successfully!
        </div>
        <form
          @submit.prevent="
            addEmployee(
              this.newEmployee.name,
              this.newEmployee.age,
              this.newEmployee.gender,
              this.newEmployee.department,
              this.newEmployee.region,
              this.newEmployee.channel,
              this.newEmployee.service,
              this.newEmployee.average_montly_hours,
              this.newEmployee.rate,
              this.newEmployee.education,
              this.newEmployee.awards,
              this.newEmployee.no_of_training,
              this.newEmployee.average_score
            )
          "
        >
          <div>
            <label class="form-label" for="name">Name:</label>
            <input
              :class="{ 'form-group-error': v$.newEmployee.name.$error }"
              type="text"
              class="form-control"
              id="name"
              v-model.trim="newEmployee.name"
            />
          </div>
          <div>
            <label class="form-label" for="age">Age:</label>
            <input
              class="form-control"
              :class="{ 'form-group-error': v$.newEmployee.age.$error }"
              v-model="newEmployee.age"
              type="number"
              id="age"
              min="18"
              max="60"
            />
          </div>

          <div>
            <label class="form-label" for="gender">Gender:</label>
            <select
              class="form-select"
              :class="{ 'form-group-error': v$.newEmployee.gender.$error }"
              id="gender"
              v-model="newEmployee.gender"
            >
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

          <div>
            <label class="form-label" for="department">Department:</label>
            <select
              :class="{ 'form-group-error': v$.newEmployee.department.$error }"
              class="form-select"
              id="department"
              v-model="newEmployee.department"
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
          </div>

          <div class="">
            <label class="form-label" for="region">Region:</label>
            <select
              :class="{ 'form-group-error': v$.newEmployee.region.$error }"
              class="form-select"
              id="region"
              v-model="newEmployee.region"
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
          </div>
          <div class="">
            <label class="form-label" for="education">Education:</label>
            <select
              :class="{ 'form-group-error': v$.newEmployee.education.$error }"
              class="form-select"
              id="education"
              v-model="newEmployee.education"
            >
              <option value="Masters">Masters</option>
              <option value="Bachelors">Bachelors</option>
              <option value="Below Secondary">Below Secondary</option>
            </select>
          </div>

          <div>
            <label class="form-label" for="recruitment_channel"
              >Recruitment Channel:</label
            >
            <select
              :class="{ 'form-group-error': v$.newEmployee.channel.$error }"
              class="form-select"
              id="recruitment_channel"
              v-model="newEmployee.channel"
            >
              <option value="sourcing">Sourcing</option>
              <option value="other">Other</option>
              <option value="referred">Referred</option>
            </select>
          </div>

          <div>
            <label class="form-label" for="average_montly_hours"
              >Monthly Hours:</label
            >
            <input
              :class="{
                'form-group-error': v$.newEmployee.average_montly_hours.$error,
              }"
              class="form-control"
              id="average_montly_hours"
              v-model="newEmployee.average_montly_hours"
              type="number"
              min="96"
              max="310"
            />
          </div>

          <div>
            <label class="form-label" for="previous_year_rating"
              >Previous Year Rating:</label
            >
            <input
              :class="{ 'form-group-error': v$.newEmployee.rate.$error }"
              class="form-control"
              v-model="newEmployee.rate"
              type="number"
              id="previous_year_rating"
              min="1"
              max="5"
            />
          </div>

          <div>
            <label class="form-label" for="length_of_service"
              >Length of Service:</label
            >
            <input
              :class="{ 'form-group-error': v$.newEmployee.service.$error }"
              class="form-control"
              v-model="newEmployee.service"
              type="number"
              id="length_of_service"
              min="1"
              max="37"
            />
          </div>

          <div>
            <label class="form-label" for="awards_won">Awards Won:</label>
            <select
              :class="{
                'form-group-error': v$.newEmployee.awards.$error,
              }"
              class="form-select"
              id="awards_won"
              v-model="newEmployee.awards"
            >
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <div>
            <label class="form-label" for="no_of_trainings"
              >Number of Trainings:</label
            >
            <input
              class="form-control"
              type="number"
              id="no_of_trainings"
              v-model="newEmployee.no_of_training"
              min="1"
              max="10"
            />
          </div>
          <div>
            <label class="form-label" for="avg_training_score"
              >Average Training Score:</label
            >
            <input
              :class="{
                'form-group-error': v$.newEmployee.average_score.$error,
              }"
              class="form-control"
              v-model="newEmployee.average_score"
              type="number"
              id="avg_training_score"
              min="39"
              max="99"
            />
          </div>

          <button type="submit" class="btn btn-add">Add Employee</button>
        </form>
      </div>

      <div class="col-md-6">
        <img
          class="d-none d-md-block"
          src="../../assets/Add-User-rafiki.png"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
import TheSpinner from "../../components/TheSpinner.vue";
import axios from "axios";
import useValidate from "@vuelidate/core";
import { required, minLength } from "@vuelidate/validators";
export default {
  name: "AddEmployee",
  components: {
    TheSpinner,
  },

  data() {
    return {
      v$: useValidate(),
      newEmployee: {
        name: "",
        age: "",
        gender: "",
        department: "",
        region: "",
        education: "",
        channel: "",
        service: "",
        average_montly_hours: "",
        rate: "",
        awards: "",
        no_of_training: "",
        average_score: "",
      },
      successMsg: false,
      loading: false,
    };
  },

  validations() {
    return {
      newEmployee: {
        name: { required, minLength: minLength(5) },
        age: { required },
        department: { required },
        gender: { required },
        region: { required },
        education: { required },
        channel: { required },
        service: { required },
        average_montly_hours: { required },
        rate: { required },
        awards: { required },
        no_of_training: {
          required,
        },
        average_score: {
          required,
        },
      },
    };
  },

  methods: {
    async addEmployee(
      name,
      age,
      gender,
      department,
      region,
      channel,
      service,
      average_montly_hours,
      rate,
      education,
      awards,
      no_of_training,
      average_score
    ) {
      this.v$.newEmployee.$validate();
      if (!this.v$.newEmployee.$error) {
        console.log("Add Employee: Validated Successfully");

        this.loading = true;
        this.successMsg = true;
        const form_data = new FormData();
        form_data.append("name", name);
        form_data.append("age", age);
        form_data.append("gender", gender);
        form_data.append("department", department);
        form_data.append("region", region);
        form_data.append("channel", channel);
        form_data.append("service", service);
        form_data.append("average_montly_hours", average_montly_hours);
        form_data.append("rate", rate);
        form_data.append("education", education);
        form_data.append("awards", awards);
        form_data.append("no_of_training", no_of_training);
        form_data.append("average_score", average_score);

        setTimeout(async () => {
          await axios.post(
            `http://localhost/employee-managment-system/src/api/index.php?action=create`,
            form_data
          );

          // Reset the form data
          console.log("Avg Hours: ", average_montly_hours);
          console.log("Form Data:");
          for (const [key, value] of form_data.entries()) {
            console.log(`${key}: ${value}`);
          }

          this.loading = false;
          this.successMsg = false;
          this.$router.push("/employees");
        }, 2000); //2 second delay
      } else {
        console.log("Add Employee:Not Validated");
      }
    },
  },
};
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.form-group-error {
  border-color: red;
  color: red;
}
input,
select {
  margin-bottom: 1rem;
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
.btn-add {
  margin: 10px 0;
  color: white;
  position: relative;
  left: 25%;
  background-color: #6191c1;
}
img {
  width: 100%;
}
h3 {
  font-weight: 700;
}
</style>
