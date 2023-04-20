import axios from "axios";
import AppService from "@/services/app.service";


// eslint-disable-next-line no-undef
const api = axios.create({baseURL: process.env.BACKEND_URL});


api.interceptors.request.use(async (req) => {
  const accessToken = AppService.getToken();
  if (accessToken) {
    req.headers.Authorization = `Bearer ${accessToken}`;
  }
  return req;
});

api.interceptors.response.use(
  async (res) => res.data,
  (err) => {
    if (err.response.status === 401) {
      AppService.clearToken();
    }
    return Promise.reject(err);
  }
);

export default api;