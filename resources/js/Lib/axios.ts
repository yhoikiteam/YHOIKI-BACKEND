import axios from "axios";

const apiClient = axios.create({
    baseURL: "http://127.0.0.1:8000/spa",
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
    withCredentials: true,
    withXSRFToken: true,
});

export default apiClient;