import axios from "axios";
import { getAuthToken } from "./auth";

const api = axios.create({
    baseURL: "http://localhost:8000/api",
    // timeout: 1000,
    // headers: { Accept: "application/json" },
});

api.interceptors.request.use(function (config) {
    const token = getAuthToken();

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
        return config;
    }

    return config;
});

export default api;
