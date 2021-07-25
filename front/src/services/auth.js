import $axios from "@/plugins/axios";

class Auth {
  constructor() {}

  async login(form) {
    try {
      console.log(process.env.VUE_APP_API_BASE_URL)
      const { data } = await $axios.post(`/auth/login`, form);
      return data
    } catch (error) {
        return { success: false, data: null, message: 'Error during login'}
    }
  }

  async socialLogin(provider) {
    try {
      const { data } = await $axios.get(`/auth/${provider}/login`);
      return data
    } catch (error) {
        console.error(error);
        return { success: false, data: null, message: 'Error during login'}
    }
  }

  async register(form) {
    try {
      const { data } = await $axios.post(`/auth/register`, form);
      return data
    } catch (error) {
        console.error(error);
        return { success: false, data: null, message: 'Error during sign up'}
    }
  }

  async getUser(){
    try{
      const { data } =  await $axios.get('/auth/user')
      return data
    } 
    catch(error){
      console.error(error);
      return { error: true, data: null }
    }
  }
  
  async logout(){
    try{
      await $axios.post("/auth/logout");
    }
    catch(e){
      console.error(e);
    }
  }
}

export default new Auth();
