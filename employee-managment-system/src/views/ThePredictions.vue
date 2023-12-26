<template>
  <h2 class="fw-bold p-3 my-4 text-center" v-if="!APIResult.length">
    Enter Employees Data to Make Quick Predictions
    <i class="fa-solid fa-wand-magic-sparkles"></i>
  </h2>

  <div class="row gx-2">
    <form @submit.prevent class="container col-md-4 p-4">
      <label class="form-label" for="predict-age">Age:</label>
      <input
        class="form-control"
        v-model="employee.age"
        type="number"
        id="predict-age"
        name="age"
        min="18"
        max="60"
        required
      />

      <label class="form-label" for="predict-gender">Gender:</label>
      <select
        class="form-select"
        id="predict-gender"
        name="gender"
        v-model="employee.gender"
      >
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      <label class="form-label" for="predict-department">Department:</label>
      <select
        class="form-select"
        id="predict-department"
        name="department"
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

      <label class="form-label" for="predict-region">Region:</label>
      <select
        class="form-select"
        id="predict-region"
        name="region"
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

      <label class="form-label" for="predict-education">Education:</label>
      <select
        class="form-select"
        id="predict-education"
        name="education"
        v-model="employee.education"
      >
        <option value="Masters">Masters</option>
        <option value="Bachelors">Bachelors</option>
        <option value="Below Secondary">Below Secondary</option>
      </select>

      <label class="form-label" for="predict-recruitment_channel"
        >Recruitment Channel:</label
      >
      <select
        class="form-select"
        id="predict-recruitment_channel"
        name="recruitment_channel"
        v-model="employee.recruitment_channel"
      >
        <option value="sourcing">Sourcing</option>
        <option value="other">Other</option>
        <option value="referred">Referred</option>
      </select>

      <label class="form-label" for="predict-no_of_trainings"
        >Number of Trainings:</label
      >
      <input
        class="form-control"
        type="number"
        id="predict-no_of_trainings"
        name="no_of_trainings"
        v-model="employee.no_of_trainings"
        min="1"
        max="10"
        required
      />

      <label class="form-label" for="predict-previous_year_rating"
        >Previous Year Rating:</label
      >
      <input
        class="form-control"
        v-model="employee.previous_year_rating"
        type="number"
        id="predict-previous_year_rating"
        name="previous_year_rating"
        min="1"
        max="5"
        required
      />

      <label class="form-label" for="predict-length_of_service"
        >Length of Service:</label
      >
      <input
        class="form-control"
        v-model="employee.length_of_service"
        type="number"
        id="predict-length_of_service"
        name="length_of_service"
        min="1"
        max="37"
        required
      />

      <label class="form-label" for="predict-average_montly_hours"
        >Monthly Hours:</label
      >
      <input
        class="form-control"
        v-model="employee.average_montly_hours"
        type="number"
        id="predict-average_montly_hours"
        name="average_montly_hours"
        min="96"
        max="310"
        required
      />
      <label class="form-label" for="predict-avg_training_score"
        >Average Training Score:</label
      >
      <input
        class="form-control"
        v-model="employee.avg_training_score"
        type="number"
        id="predict-avg_training_score"
        name="avg_training_score"
        min="39"
        max="99"
        required
      />

      <label class="form-label" for="predict-awards_won">Awards Won:</label>
      <select
        class="form-select"
        id="predict-awards_won"
        name="awards_won"
        v-model="employee.awards_won"
      >
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <button @click="predict" type="submit" class="btn mt-3">
        Predict now
      </button>
    </form>

    <div v-if="APIResult.prediction_text" class="predictions-card col-md-6 p-5">
      <div class="card shadow">
        <div class="card-body">
          <p class="pred-title">
            <strong>{{ APIResult.prediction_text }}</strong>
          </p>
          <p class="prob">
            Based on the data selected, this employee has a
            <strong>{{ APIResult.prob_result }}</strong>
            chance of being promoted.
          </p>
          <img
            class="img-fluid"
            :src="APIResult.image_url"
            alt="Promotion Image"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { formAPI } from "../axios.js";

export default {
  name: "ThePredictions",
  data() {
    return {
      employee: {
        department: "",
        region: "",
        education: "",
        gender: "",
        recruitment_channel: "",
        no_of_trainings: "",
        age: "",
        previous_year_rating: "",
        length_of_service: "",
        average_montly_hours: "",
        avg_training_score: "",

        awards_won: "",
      },
      APIResult: [],
    };
  },

  methods: {
    predict() {
      formAPI
        .get("/pred", {
          params: {
            department: this.employee.department,
            region: this.employee.region,
            education: this.employee.education,
            gender: this.employee.gender,
            recruitment_channel: this.employee.recruitment_channel,
            no_of_trainings: this.employee.no_of_trainings,
            age: this.employee.age,
            previous_year_rating: this.employee.previous_year_rating,
            length_of_service: this.employee.length_of_service,
            average_montly_hours: this.employee.average_montly_hours,
            avg_training_score: this.employee.avg_training_score,
            awards_won: this.employee.awards_won,
          },
        })
        .then((response) => {
          console.log("Recieved data successfuly");
          this.APIResult = response.data;
          console.log(response.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
input,
select {
  margin-bottom: 2rem;
  color: #626161;
}

label {
  color: #94bce4;
  font-weight: bold;
}
strong {
  color: #94bce4;
}
h2 {
  font-weight: bold;
  color: #7ea9d4;
}
.fa-wand-magic-sparkles {
  color: #4f7dad;
}

.prob {
  color: #626161;
}
.btn {
  background-color: #7ea9d4;
  color: white;
}
</style>
