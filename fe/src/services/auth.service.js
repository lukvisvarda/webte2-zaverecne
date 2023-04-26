/* eslint-disable no-unused-vars */

import { AUTH_LOGIN, AUTH_ME } from "@/constants/edpoints";
import api from "@/utils/api";

const AuthService = {
  login(loginDto){
    return api.post(AUTH_LOGIN, loginDto);
  },

  me(){
    return api.get(AUTH_ME);
  }
}

export default AuthService;