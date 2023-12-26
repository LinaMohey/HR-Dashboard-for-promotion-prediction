<template>
  <div class="login">
    <!-- Modal -->

    <div
      class="modal fade"
      id="login"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div v-if="loading">
        <div class="container">
          <div class="row">
            <the-spinner></the-spinner>
          </div>
        </div>
      </div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="img-login">
            <img class="img-fluid" src="../../assets/Login-cuate.png" alt="" />
          </div>
          <div class="modal-header">
            <h4 class="modal-title fw-bold m-auto" id="exampleModalLabel">
              Admin Login
            </h4>
          </div>
          <div class="modal-body">
            <div class="mb-3 row">
              <label for="loginEmail" class="col-sm-2 col-form-label"
                >Email</label
              >
              <div class="col-sm-10">
                <input
                  v-model="email"
                  type="email"
                  id="loginEmail"
                  class="form-control rounded"
                />
              </div>
            </div>
            <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-2 col-form-label"
                >Password</label
              >
              <div class="col-sm-10">
                <input
                  @keyup.enter="loginUser"
                  v-model="password"
                  type="password"
                  class="form-control rounded"
                  id="inputPassword"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="loginUser()"
              type="button"
              class="btn login-btn btn rounded"
            >
              Login
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { fb } from "../../firebase";
import TheSpinner from "../TheSpinner.vue";

export default {
  name: "TheLogin",
  components: {
    TheSpinner,
  },

  data() {
    return {
      email: "",
      password: "",
      loading: false,
    };
  },

  methods: {
    //Firbase check user's data
    loginUser() {
      this.loading = true;
      setTimeout(() => {
        fb.auth()
          .signInWithEmailAndPassword(this.email, this.password)
          .then(() => {
            this.$router.replace({ path: "stats" }).then(() => {
              this.$router.go();
              this.loading = false;
            });
          })
          .catch((error) => {
            var errorCode = error.code;
            var errorMessage = error.message;
            if (errorCode === "auth/wrong-password") {
              alert("Wrong Password");
            } else {
              alert(errorMessage);
            }
            console.log(error);
            this.loading = false;
          });
      }, 2000);
    },
  },
};
</script>

<style scoped>
.img-login {
  width: 90%;
}
.login-btn {
  background-color: #74aae2;
  color: #fff;
}
.login-btn:hover {
  background-color: #74a9e2c7;
  color: #fff;
}
</style>
