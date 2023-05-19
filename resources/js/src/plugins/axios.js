import axios from "axios";

const config = {
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    timeout: 5000
}

const api = axios.create(config);

export default api;
