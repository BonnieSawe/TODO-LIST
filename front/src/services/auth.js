import $axios from "@/plugins/axios";

class Auth {
  constructor() {}

  async login(payload) {
    try {
      const { data } = await $axios.post(`/auth/login`, payload);
      return data
    } catch (error) {
        console.error(error);
        return { success: false, data: null, message: 'Error during login'}
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
