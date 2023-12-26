import HomeView from "@/components/main/HomeView.vue";
import { fb } from "../firebase";

import { createRouter, createWebHistory } from "vue-router";
import AdminDashboard from "../components/dashboard/AdminDashboard.vue";
import PageNotFound from "../views/PageNotFound.vue";

const routes = [
  {
    path: "/",
    name: "HomeView",
    component: HomeView,
    alias: "/home",
  },

  {
    path: "/dashboard",

    name: "dashboard",
    component: AdminDashboard,
    meta: { requiresAuth: true },
    children: [
      {
        path: "/employees",
        component: () =>
          import(
            /* webpackChunkName:"allEmployees"*/
            "../views/employees/AllEmployees.vue"
          ),
      },

      {
        path: "/stats",
        component: () =>
          import(
            /* webpackChunkName:"EmployeeStats"*/
            "../views/statistics/EmployeesStats.vue"
          ),
      },

      {
        path: "/add",
        component: () =>
          import(
            /* webpackChunkName:"AddEmployees"*/
            "../views/employees/AddEmployees.vue"
          ),
      },
      {
        path: "/employees/edit/:employeeId",
        component: () =>
          import(
            /* webpackChunkName:"EditEmployee"*/
            "../views/employees/EditEmployee.vue"
          ),
      },
      {
        path: "/employees/view/:employeeId",
        component: () =>
          import(
            /* webpackChunkName:"EmployeeStats"*/
            "../views/employees/ViewEmployee.vue"
          ),
      },
      {
        path: "/promoted",
        component: () =>
          import(
            /* webpackChunkName:"PromotedEmployees"*/
            "../views/employees/PromotedEmployees.vue"
          ),
      },
      {
        path: "/todo",
        component: () =>
          import(
            /* webpackChunkName:"WorkGoals"*/
            "../views/WorkGoals.vue"
          ),
      },
      {
        path: "/predict",
        component: () =>
          import(
            /* webpackChunkName:"ThePrediction"*/
            "../views/ThePredictions.vue"
          ),
      },
    ],
  },

  {
    path: "/:pathMatch(.*)*",
    name: "PageNotFound",
    component: PageNotFound,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  mode: "history",
  routes,
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some((x) => x.meta.requiresAuth);
  const currenUser = fb.auth().currentUser;
  if (requiresAuth && !currenUser) {
    next("/");
  } else if (requiresAuth && currenUser) {
    next();
  } else {
    next();
  }
});

export default router;
