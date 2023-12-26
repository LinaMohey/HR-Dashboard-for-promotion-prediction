<template>
  <div>
    <div class="container d-flex mt-5">
      <div class="card shadow-lg p-3 mb-3 bg-body rounded container">
        <div class="card-body d-flex">
          <div class="title">
            <h2 class="pb-3 card-title fw-bold">
              What do you want <br />to achieve today?
            </h2>
            <p class="summary card-text">
              You completed <strong> {{ completedCount }} </strong> tasks, and
              you have <strong>{{ pendingCount }}</strong> tasks to finish!
            </p>
            <p>
              You Finished <strong>{{ completedPercentage }}% </strong>of you
              tasks!
            </p>
            <button
              @click="hideCompleted = !hideCompleted"
              type="button"
              class="btn toggle"
            >
              {{ hideCompleted ? "Show All" : "Hide completed" }}
            </button>

            <button @click="clearAll" type="button" class="m-2 btn clearAll">
              Clear All
            </button>
            <div class="row justify-content-between">
              <div class="col-12 mt-2">
                <!-- input todo text -->

                <div class="input-group">
                  <span class="input-group-text"> To Do</span>
                  <input
                    v-model="newTodo"
                    @keyup.enter="addTodo"
                    type="text"
                    class="form-control"
                    placeholder="Add Items"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="chart d-none d-md-flex">
            <canvas id="activity" class="my-auto"></canvas>
          </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Task</th>
                <th scope="col">Done</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="todo in filteredTodo" :key="todo.id">
                <td>{{ todo.text }}</td>
                <td>
                  <input
                    type="checkbox"
                    class="form-check-input mx-3"
                    v-model="todo.done"
                    @change="updateDone"
                  />
                </td>
                <td>
                  <button
                    @click="removeTodo(todo)"
                    type="button"
                    class="delete btn btn-sm"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="image">
        <img
          class="w-40 d-none d-xxl-flex"
          src="../../assets/Checklist2.gif"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
let id = 0;
import Chart from "chart.js/auto";
export default {
  mounted() {
    this.createChart();
  },
  data() {
    if (localStorage.length === 0) {
      localStorage.setItem(
        "todos",
        JSON.stringify([{ id: id++, text: "Example", done: false }])
      );
    }
    return {
      newTodo: "",
      hideCompleted: false,
      todos: JSON.parse(localStorage.getItem("todos")),
    };
  },
  computed: {
    filteredTodo() {
      return this.hideCompleted
        ? this.todos.filter((elem) => !elem.done)
        : this.todos;
    },
    completedCount() {
      return this.todos.filter((todo) => todo.done).length;
    },
    pendingCount() {
      return this.todos.filter((todo) => !todo.done).length;
    },
    completedPercentage() {
      const totalTasks = this.todos.length;
      const completedTasks = this.todos.filter((todo) => todo.done).length;
      if (totalTasks === 0) {
        return 0;
      } else {
        return Math.round((completedTasks / totalTasks) * 100);
      }
    },
  },
  methods: {
    updateChart() {
      const completedPercentage = this.completedPercentage;
      const pendingPercentage = 100 - completedPercentage;

      // Get the chart object
      const chart = Chart.getChart("activity");

      // Update the data
      chart.data.datasets[0].data = [completedPercentage, pendingPercentage];

      // Re-render the chart
      chart.update();
    },
    addTodo() {
      this.todos.push({ id: id++, text: this.newTodo, done: false });
      localStorage.setItem("todos", JSON.stringify(this.todos));
      this.newTodo = "";
      this.updateChart();
    },
    removeTodo(todo) {
      this.todos = this.todos.filter((elem) => elem !== todo);
      localStorage.setItem("todos", JSON.stringify(this.todos));
      this.updateChart();
    },
    updateDone() {
      localStorage.setItem("todos", JSON.stringify(this.todos));
      this.updateChart();
    },
    clearAll() {
      this.todos = [];
      localStorage.setItem("todos", JSON.stringify(this.todos));
      this.updateChart();
    },
    createChart() {
      const ctx = document.getElementById("activity");
      const completedPercentage = this.completedPercentage;
      const pendingPercentage = 100 - completedPercentage;
      new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Completed", "Pending"],
          datasets: [
            {
              label: "Tasks",
              data: [completedPercentage, pendingPercentage],
              backgroundColor: ["#8db4d8", "#ccc"],
            },
          ],
        },
        options: {
          cutout: 70,
          responsive: true,

          plugins: [{ afterInit: (chart) => (chart.id = "activity") }],
        },
      });
    },
  },
};
</script>

<style scoped>
.delete {
  background-color: #4f7cab;
  color: white;
}
.card-title {
  color: #7ea9d4;
}
.clearAll {
  background-color: #4f7cab;
  color: white;
}
.toggle {
  background-color: #a9c9e8;
  color: white;
}

strong {
  color: #4f7cab;
  font-weight: bold;
}
#activity {
  width: 230px;
}
input[type="checkbox"]:checked {
  background-color: #a9c9e8;
  border: none;
}
</style>
