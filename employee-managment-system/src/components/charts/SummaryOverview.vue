<template>
  <div class="text-center">
    <div v-for="summary in promotionSummary" :key="summary.id">
      <div class="row g-4 align-items-center justify-content-center">
        <div class="card col-xl-5 mx-3">
          <div class="card-body">
            <h2 class="card-title">
              <strong>{{ summary.total_employees }}</strong>
            </h2>
            <p class="card-text">Employees</p>
          </div>
        </div>
        <div class="card col-xl-5 mx-3">
          <div class="card-body">
            <h2 class="card-title">
              <strong>{{ summary.total_promoted }}</strong>
            </h2>

            <p class="card-text">Total Promoted</p>
          </div>
        </div>

        <div class="card col-xl-5 mx-3">
          <div class="card-body">
            <h2 class="card-title">
              <strong
                >{{ Math.round(summary.promotion_percentage * 100) / 100 }}%
              </strong>
            </h2>
            <p class="card-text">Total Promotion</p>
          </div>
        </div>
        <div class="card col-xl-5 mx-3">
          <div class="card-body">
            <h2 class="card-title">
              <strong
                >{{ Math.round(summary.non_promotion_percentage * 100) / 100 }}%
              </strong>
            </h2>
            <p class="card-text">Total Non Promotion</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      promotionSummary: [],
    };
  },
  mounted() {
    this.fetchPromotionSummary();
  },
  methods: {
    fetchPromotionSummary() {
      axios
        .get(
          "http://localhost/employee-managment-system/src/api/index.php?action=summary"
        )
        .then((response) => {
          this.promotionSummary = response.data.summary;
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.card-title {
  color: #92bfeb;
}
.card-text {
  color: #626161;
}
</style>
