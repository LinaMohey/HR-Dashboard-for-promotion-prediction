<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <img class="error-img" src="../assets/error.png" alt="" />

        <router-link to="/" class="btn btn-primary rounded-pill btn-lg">
          <i class="fa-solid fa-arrow-left"></i> Back To Home</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PageNotFound",
};
</script>

<style scoped>
.error-img {
  width: 60%;
  text-align: center;
  padding: 0;
}
.btn {
  animation: mover 3s infinite alternate;
}

@keyframes mover {
  0%,
  100% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(-20px);
    -webkit-transform: translateX(-20px);
    -moz-transform: translateX(-20px);
    -ms-transform: translateX(-20px);
    -o-transform: translateX(-20px);
  }
}
</style>
