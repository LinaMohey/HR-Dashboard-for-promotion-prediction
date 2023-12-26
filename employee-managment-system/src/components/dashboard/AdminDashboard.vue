<template>
  <div class="dashboard">
    <dashboard-siderbar
      v-if="isLoggedIn"
      @logout="logout()"
    ></dashboard-siderbar>

    <div class="content" v-if="isLoggedIn">
      <router-view></router-view>
    </div>
    <div v-if="loading">
      <the-spinner></the-spinner>
    </div>
  </div>
</template>
<script>
import DashboardSiderbar from "./DashboardSiderbar.vue";
import TheSpinner from "../TheSpinner.vue";

export default {
  name: "AdminDashboard",

  components: {
    DashboardSiderbar,
    TheSpinner,
  },
  data() {
    return {
      isLoggedIn: true,
      loading: false,
    };
  },

  methods: {
    logout() {
      this.handleLogout();
    },
  },
};
</script>

<style scoped>
.dashboard {
  background-color: #e7e7e7a6;
  display: grid;
  grid-template-columns: 0.5fr 5fr;
}

.content {
  background-color: white;
  border-radius: 10px;
  margin: 10px;
}
</style>
