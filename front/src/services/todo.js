import $axios from "@/plugins/axios";

class Todo {
  constructor() {}

  async get() {
    try {
      const { data } = await $axios.get("/todo-items");
      return data;
    } catch (error) {
      return error.response.data;
    }
  }

  async getDayItems(date){
    try {
      const {data} = await $axios.get(`/todo-items/day?date=${date}`);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }

  async getWeekItems(startDate, endDate){
    try {
      const {data} = await $axios.get(`/todo-items/week?startDate=${startDate}&endDate=${endDate}`);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }
  
  async store(form) {
    try {
      const { data } = await $axios.post("/todo-items/store", form);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }
  async delete(id) {
    try {
      const { data } = await $axios.delete("/todo-items/delete/$"+id);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }
}

export default new Todo();
