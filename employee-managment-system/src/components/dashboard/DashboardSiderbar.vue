<template>
  <div class="side rounded">
    <div class="p-3 sticky-top min-vh-100">
      <ul class="nav nav-pills flex-column mt-4" id="menu">
        <li class="nav-item py-2 my-3">
          <router-link class="nav-link text-center text-light" link to="/stats">
            <i class="fs-3 fa fa-chart-simple"></i>
            <span class="d-none d-sm-inline"> Dashboard </span>
          </router-link>
        </li>

        <li class="nav-item py-2 my-3">
          <router-link class="nav-link text-center text-light" to="/employees">
            <i class="fs-3 fa fa-users"> </i>
            <span class="d-none d-sm-inline"> Employees </span>
          </router-link>
        </li>

        <li class="nav-item py-2 my-3">
          <router-link class="nav-link text-center text-light" to="/promoted">
            <i class="fs-3 fa-solid fa-trophy"></i>
            <span class="d-none d-sm-inline"> Promoted Employees </span>
          </router-link>
        </li>

        <li class="nav-item py-2 my-3">
          <router-link class="nav-link text-center text-light" to="/todo">
            <i class="fs-3 fa fa-list-check"></i>
            <span class="d-none d-sm-inline"> Work Goals </span>
          </router-link>
        </li>
        <li class="nav-item py-2 my-3">
          <router-link class="nav-link text-center text-light" to="/predict">
            <i class="fs-3 fa fa-magnifying-glass-dollar"></i>
            <span class="d-none d-sm-inline"> Predictions </span>
          </router-link>
        </li>
        <hr />
        <li class="nav-item">
          <a
            href="#"
            @click="handleLogout()"
            class="nav-link text-center text-light"
          >
            <i class="fs-3 fa-solid fa-arrow-right-from-bracket"></i>
            <span class="d-none d-sm-inline"> Logout </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { fb } from "../../firebase";

export default {
  components: {},
  data() {
    return {
      loading: false,
      isLoggedIn: false,
    };
  },
  methods: {
    handleLogout() {
      this.loading = true;
      setTimeout(() => {
        fb.auth()
          .signOut()
          .then(() => {
            this.isLoggedIn = false;

            this.$router.push({ path: "/" }).then(() => {
              this.$router.go();
              this.loading = false;
            });
          })
          .catch((err) => {
            console.log(err);
            this.loading = false;
          });
      }, 2000);
    },
  },
};
</script>

<style scoped>
.nav-link {
  padding: 0;
}
.nav-pills li:hover {
  background-color: #c4bdbd3c;
  border-radius: 10px;
}

i {
  display: block;
  margin-bottom: 10px;
}

.side {
  background-color: #6e99c4;
}
</style>
