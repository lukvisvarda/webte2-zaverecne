const AppService = {
  getToken(){
    window.localStorage.getItem("accessToken");
  },
  setToken(token){
    window.localStorage.setItem("accessToken", token);
  },
  clearToken(){
    window.localStorage.removeItem("accessToken");
  }
}

export default AppService;