<template>
  <div class="home">
    <main-nav></main-nav>
  </div>

  <div>
    <button class="arrow btn text-center my-auto pt-0">
      <i class="fa-solid fa-arrow-up"></i>
    </button>
  </div>
  <!--Show Case Starts -->

  <section class="show-case">
    <div class="container py-5">
      <div class="d-md-flex align-items-center justify-content-center">
        <div data-aos="fade-up" data-aos-delay=" 400" class="p-3">
          <p class="display-3 fw-bold">
            Revolutionize Your Promotion<span class="theme-text">
              Decisions</span
            >.
          </p>
          <p class="lead show-case mt-4">
            Say goodbye to biased and ineffective promotion decisions. Our HR
            performance dashboard leverages data-driven predictive analytics to
            objectively assess employee performance and potential for career
            advancement.With a user-friendly interface and powerful features,
            our website streamlines the promotion process, saving you time and
            effort.
            <span class="fw-bold">
              Try our HR performance dashboard today and revolutionize your
              promotion process!
            </span>
          </p>

          <a
            data-bs-toggle="modal"
            data-bs-target="#login"
            class="btn join btn-lg my-4"
            type="submit"
            >Join Our Community</a
          >
        </div>

        <img
          data-aos="fade-left"
          data-aos-delay="300"
          class="showcaseimg img-fluid d-none d-md-block"
          src="../../assets/Performance-overview-amico.png"
        />
      </div>
    </div>
  </section>

  <!-- About Us Section Starts -->

  <section id="about-us" class="about-us">
    <div class="pt-4 bg-light">
      <h1 data-aos="fade-down" class="text-center fw-bold mb-4 pt-4">
        About Us
      </h1>

      <div class="d-md-flex container about">
        <img
          data-aos="fade-right"
          data-aos-delay="300"
          class="img-fluid about-img"
          src="../../assets/Experts-cuate.png"
          alt=""
        />

        <p data-aos="fade-left" class="fade-left p-3">
          Promotivize dashboard is intuitive and user-friendly, with features
          that are designed to help you to achieve your career goals by
          predicting providing you with insights that you need to succeed and
          also it helps you stay organized, motivated, and on track. Whether
          you're just starting out in your career or looking to take the next
          step, our promotion prediction dashboard can help you get there as we
          believe that everyone deserves to reach their potential and we're here
          to make it happen.
        </p>
        <svg
          class="d-none d-xl-block"
          id="svg-blob"
          viewBox="0 0 50 50"
          xmlns="http://www.w3.org/2000/svg"
        >
          <defs>
            <linearGradient id="blob-gradient" x1="0" x2="1" y1="1" y2="0">
              <stop id="stop1" stop-color="#74aae2" offset="0%"></stop>
              <stop id="stop2" stop-color="#fff" offset="100%"></stop>
            </linearGradient>
          </defs>
          <path
            fill="url(#blob-gradient)"
            d="M23.6,-12.9C30.1,-2.4,34.5,10,30.2,18.1C25.9,26.2,12.9,30.1,0.4,29.8C-12.2,29.6,-24.3,25.3,-30.7,16C-37.1,6.7,-37.6,-7.7,-31.5,-17.9C-25.4,-28.1,-12.7,-34.2,-2.1,-33C8.6,-31.8,17.2,-23.3,23.6,-12.9Z"
            width="100%"
            height="100%"
            transform="translate(50 50)"
            stroke-width="0"
            style="transition: all 0.3s ease 0s"
            stroke="url(#blob-gradient)"
          ></path>
        </svg>
      </div>
    </div>
  </section>

  <!-- Section Tree starts (Perks) -->
  <section id="features" class="features container pt-5 mb-5 mt-5">
    <h1 data-aos="fade-up" class="text-center fw-bold pb-3">Features</h1>
    <p data-aos="fade-up" class="text-center mb-4">
      Our promotion prediction dashboard isn't just about predicting your next
      promotion - it's about helping you be the best you can be. That's why
      we've included a range of features designed to help you stay organized,
      focused, and productive. From visualizing data to managing your to-do
      list, our platform has everything you need to succeed. Here's a quick
      overview of our key features:
    </p>

    <div class="row g-4">
      <div data-aos="fade-up" data-aos-delay="350" class="col-xl-3 col-md-6">
        <div class="card">
          <img
            src="../../assets/Winners-rafiki.png "
            class="card-img-top"
            alt="... "
          />
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center fw-bold">Promotion Prediction</h5>
            </div>
            <div class="card-text">
              <p class="text-center">
                Get accurate predictions based on employee performance and
                demographic data.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div data-aos="fade-up" data-aos-delay="400" class="col-xl-3 col-md-6">
        <div class="card rounded-3">
          <img
            src="../../assets/Financial-data-rafiki.png "
            class="card-img-top"
            alt="... "
          />
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center fw-bold">Visualizing Data</h5>
            </div>
            <div class="card-text">
              <p class="text-center">
                Our dynamic data visualization tools allow you to see how
                promotion rates vary across different employees
              </p>
            </div>
          </div>
        </div>
      </div>

      <div data-aos="fade-up" data-aos-delay="500" class="col-xl-3 col-md-6">
        <div class="card">
          <img
            src="../../assets/Add-tasks-pana.png "
            class="card-img-top"
            alt="... "
          />
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center fw-bold">Task Manager</h5>
            </div>
            <div class="card-text">
              <p class="text-center">
                With our intuitive to do list, you can easily create tasks,
                ensuring that you're always on top of your workload
              </p>
            </div>
          </div>
        </div>
      </div>
      <div data-aos="fade-up" data-aos-delay="700" class="col-xl-3 col-md-6">
        <div class="card">
          <img
            src="../../assets/Data-report-amico.png"
            class="card-img-top"
            alt="... "
          />
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center fw-bold">Generate Report</h5>
            </div>
            <div class="card-text">
              <p class="text-center">
                Generate detailed reports on your performance and progress to
                help you make informed decisions.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section Three ends (Perks) -->
  <div class="footer text-center py-3 shadow">
    <p class="my-auto py-3">
      &copy; Copyright <strong> Promotivize dashboard</strong>. All Rights
      Reserved
    </p>
  </div>
  <the-login></the-login>
</template>

<script>
import MainNav from "./MainNav.vue";
import TheLogin from "./TheLogin.vue";

export default {
  name: "HomeView",
  components: { MainNav, TheLogin },

  data() {
    return {};
  },
  mounted() {
    const arrowTop = document.querySelector(".arrow");
    window.addEventListener("scroll", checkHeight);

    function checkHeight() {
      if (window.scrollY > 200) {
        arrowTop.style.display = "block";
      } else {
        arrowTop.style.display = "none";
      }
    }
    arrowTop.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
      });
    });
  },
  methods: {},
};
</script>

<style scoped>
* {
  box-sizing: border-box;
}
p.show-case {
  font-size: 1rem;
}
img.showcaseimg {
  max-width: 45%;
  animation: mover 3s infinite alternate;
}

@keyframes mover {
  0%,
  100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px);
    -webkit-transform: translateY(-20px);
    -moz-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    -o-transform: translateY(-20px);
  }
}
.join {
  background-color: #74aae2;
  color: white;
}
.join:hover {
  background-color: #74a9e2c7;
  color: #fff;
}

.about {
  border-radius: 10px;
  font-size: 1rem;
}

.about-img {
  min-width: 40%;
}

.features p {
  font-size: 1rem;
}
.features div.card-text p {
  font-size: 0.9rem;
}

@media (max-width: 768px) {
  .about-img {
    width: 100%;
  }
  div.about p {
    margin: 0;
  }
}

.theme-text {
  color: #a7c7e7;
}

section h1::before,
section h1::after {
  display: inline-block;
  content: "";
  border-top: 0.2rem solid #a7c7e7;
  width: 3rem;
  margin: 0 1rem;
  transform: translateY(-0.5rem);
  -webkit-transform: translateY(-0.5rem);
  -moz-transform: translateY(-0.5rem);
  -ms-transform: translateY(-0.5rem);
  -o-transform: translateY(-0.5rem);
}

.card:hover {
  cursor: pointer;
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  transform: translateY(-20px);
  transition: 0.3s;
  -webkit-transition: 0.3s;
  -moz-transition: 0.3s;
  -ms-transition: 0.3s;
  -o-transition: 0.3s;
  -webkit-transform: translateY(-20px);
  -moz-transform: translateY(-20px);
  -ms-transform: translateY(-20px);
  -o-transform: translateY(-20px);
}

.arrow {
  display: none;
  border-radius: 5px;
  position: fixed;
  width: 43px;
  height: 43px;
  background-color: #6191c1;
  color: white;
  bottom: 30px;
  right: 15px;
  text-decoration: none;
  text-align: center;
  line-height: 50px;
  color: white;
  font-size: 18px;
  z-index: 99999;
}
#svg-blob {
  position: relative;

  right: -110px;
}

.footer p {
  font-size: 14px;
}
</style>
