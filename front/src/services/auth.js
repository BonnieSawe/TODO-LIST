import $axios from "@/plugins/axios";

class Auth {
  constructor() {}

<<<<<<< HEAD
  async login(payload) {
    try {
      const { data } = await $axios.post(`/auth/login`, payload);
=======
  async login(form) {
    try {
      const { data } = await $axios.post(`/auth/login`, form);
      return data
    } catch (error) {
        return { success: false, data: null, message: 'Error during login'}
    }
  }

  async socialLogin(provider) {
    try {
      const { data } = await $axios.get(`/auth/${provider}/login`);
>>>>>>> develop
      return data
    } catch (error) {
        console.error(error);
        return { success: false, data: null, message: 'Error during login'}
    }
  }

<<<<<<< HEAD
=======
  async register(form) {
    try {
      const { data } = await $axios.post(`/auth/register`, form);
      return data
    } catch (error) {
        console.error(error);
        return { success: false, data: null, message: 'Error during sign up'}
    }
  }

>>>>>>> develop
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
