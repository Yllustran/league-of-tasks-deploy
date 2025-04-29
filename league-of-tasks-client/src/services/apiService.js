import axios from "axios";

// API endpoint URL
const API_URL = process.env.REACT_APP_API_URL; 

// Create an Axios instance
const apiService = axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
  },
});

// Interceptor to include JWT token if the user is logged in
apiService.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default apiService;