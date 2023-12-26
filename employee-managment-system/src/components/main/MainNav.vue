<template>
  <nav
    class="navbar navbar-expand-lg navbar-white bg-white text-dark py-4 shadow-sm"
  >
    <div class="container">
      <a href="#" class="navbar-brand px-3">
        <img
          src="../../assets/speedometer.png"
          class="me-1"
          style="width: 40px"
          alt=""
        />
        Promotivize Dashboard</a
      >

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navmenu"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="#" class="nav-link"> Home </a>
          </li>
          <li class="nav-item">
            <a href="#about-us" class="nav-link"> About Us </a>
          </li>
          <li class="nav-item">
            <a href="#features" class="nav-link"> Features </a>
          </li>
          <li class="nav-item">
            <a
              data-bs-toggle="modal"
              data-bs-target="#login"
              class="btn ms-3 rounded-pill px-4"
              type="submit"
              >Sign In</a
            >
          </li>
        </ul>
      </div>
    </div>
    <the-login></the-login>
  </nav>
</template>

<script>
import TheLogin from "./TheLogin.vue";
export default {
  name: "MainNav",
  components: {
    TheLogin,
  },
};
</script>

<style scoped>
a.btn {
  border: 1px solid #74aae2;
  color: #74aae2;
}
a.btn:hover {
  color: #fff;
  background-color: #74aae2;
}
</style>
