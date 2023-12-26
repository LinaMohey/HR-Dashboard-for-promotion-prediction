import { createApp } from "vue";
import AOS from "aos";
import "aos/dist/aos.css";
import App from "./App.vue";
import router from "./router";
import "aos/dist/aos.css";
import { fb } from "./firebase.js";

//font awesome icons
import "../node_modules/@fortawesome/fontawesome-free/css/all.css";

// Bootstrap css, js

import "../node_modules/bootstrap/dist/css/bootstrap.css";
import "../node_modules/bootstrap/dist/js/bootstrap.bundle";

const app = createApp(App);

let comp = "";

fb.auth().onAuthStateChanged(function () {
  if (!comp) {
    app.use(router);

    app.component("MainNav", require("./components/main/MainNav.vue").default);
    app.use(
      AOS.init({
        offset: 400,
        duration: 1000,
        once: true,
      })
    );
    app.mount("#app");
  }
});
