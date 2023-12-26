<template>
  <div class="container">
    <div v-for="employee in employeeData" :key="employee.id" class="main-body">
      <div class="row">
        <div class="col-lg-8 container">
          <div class="card mt-4">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">ID :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    type="text"
                    class="form-control"
                    v-model="employee.id"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Name :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    type="text"
                    class="form-control"
                    v-model="employee.name"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Age :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    type="text"
                    class="form-control"
                    v-model="employee.age"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Gender :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="gender"
                    type="text"
                    class="form-control"
                    v-model="employee.gender"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Department :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="department"
                    type="text"
                    class="form-control"
                    v-model="employee.department"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Region :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="region"
                    type="text"
                    class="form-control"
                    v-model="employee.region"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Education :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="education"
                    type="text"
                    class="form-control"
                    v-model="employee.education"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Recruitment Channel :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="recruitment_channel"
                    type="text"
                    class="form-control"
                    v-model="employee.recruitment_channel"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Average Hours :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="average_montly_hours"
                    type="number"
                    class="form-control"
                    v-model="employee.average_montly_hours"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Previous Year Rating :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="previous_year_rating"
                    type="text"
                    class="form-control"
                    v-model="employee.previous_year_rating"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Length Of Service :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="length_of_service"
                    type="text"
                    class="form-control"
                    v-model="employee.length_of_service"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Awards Won? :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="awards_won"
                    type="text"
                    class="form-control"
                    v-model="employee.awards_won"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Number of Trainings :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    type="text"
                    class="form-control"
                    name="no_of_trainings"
                    v-model="employee.no_of_trainings"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Average Score :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    name="avg_training_score"
                    type="text"
                    class="form-control"
                    v-model="employee.avg_training_score"
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mb-0">Is Promoted? :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input
                    disabled
                    type="text"
                    class="form-control"
                    v-model="employee.is_promoted"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          v-if="$route.query.APIResult"
          class="predictions-card col-md-4 p-5"
        >
          <div class="card">
            <div class="card-body">
              <p class="pred-title">
                <strong>{{
                  JSON.parse(decodeURIComponent($route.query.APIResult))
                    .prediction_text
                }}</strong>
              </p>
              <p class="prob">
                Based on th current data, this employee has a
                <strong>{{
                  JSON.parse(decodeURIComponent($route.query.APIResult))
                    .prob_result
                }}</strong>
                chance of being promoted.
              </p>

              <img
                class="img-fluid mx-2"
                :src="
                  JSON.parse(decodeURIComponent($route.query.APIResult))
                    .image_url
                "
                alt="Promotion Image"
              />
            </div>
          </div>

          <div
            v-if="
              JSON.parse(decodeURIComponent($route.query.APIResult)).promoted ==
              0
            "
            class="card"
          >
            <div class="card-body">
              <h5 class="fw-bold mb-2">
                Suggestions <i class="fa-solid fa-wrench"></i>
              </h5>

              <ul
                v-for="(recommendation, reason) in JSON.parse(
                  decodeURIComponent($route.query.APIResult)
                ).training_recommendations"
                :key="reason"
              >
                <li>{{ reason }} - {{ recommendation }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "ViewEmployee",
  mounted() {
    this.viewEmployee(this.employeeId);
  },

  data() {
    return {
      APIResult: [],
      employeeData: [],

      employeeId: this.$route.params.employeeId,
    };
  },
  props: {},
  methods: {
    async viewEmployee(id) {
      let res = await axios.get(
        `http://localhost/employee-managment-system/src/api/index.php?action=readAll&id=${id}`
      );
      const resData = res.data;
      if (res.status == 200) {
        if (resData.error) {
          console.log("error");
        } else {
          this.employeeData = resData.allEmployeesData;
        }
      }
    },
  },
};
</script>

<style scoped>
h6 {
  font-weight: bolder;
}

strong,
h5,
h6 {
  color: #94bce4;
}

input {
  color: #626161;
}
.card {
  color: #626161;
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 0 solid transparent;
  border-radius: 0.25rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%),
    0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
  margin-right: 0.5rem !important;
}
</style>
