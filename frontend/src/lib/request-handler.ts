import axios from "axios";
import type { AxiosInstance } from "axios";

const BASE_URL = import.meta.env.VITE_API_URL;

const requestHandler: AxiosInstance = axios.create({
  baseURL: BASE_URL,
  headers: {
    "Content-type": "application/json",
  },
});

export default requestHandler;
