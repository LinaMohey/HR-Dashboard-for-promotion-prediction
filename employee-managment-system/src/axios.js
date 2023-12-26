import axios from "axios";

const dynamicAPI = axios.create({
  baseURL: "http://127.0.0.1:5000",
  timeout: 1000,
});

const formAPI = axios.create({
  baseURL: "http://127.0.0.1:5001",
  timeout: 1000,
});

export { formAPI, dynamicAPI };
