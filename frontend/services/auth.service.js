/* eslint-disable no-unused-vars */

// import { AUTH_LOGIN, AUTH_ME } from "@/constants/edpoints";
import {AUTH_LOGIN, AUTH_ME, AUTH_REGISTER} from "../constants/edpoints";
import api from "@/utils/api";

const AuthService = {
  login(loginDto){
    return api.post(AUTH_LOGIN, loginDto);
  },

  register(userData) {
    return api.post(AUTH_REGISTER, userData);
  },

  me(){
    return api.get(AUTH_ME);
  }
}

export default AuthService;
