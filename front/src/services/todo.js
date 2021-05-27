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
      const { data } = await $axios.post("/todo-items/delete/", {id: id});
      return data;
    } catch (error) {
      return error.response.data;
    }
  }

  async complete(form) {
    try {
      const { data } = await $axios.post("/todo-items/complete/", form);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }

  async pin(form) {
    try {
      const { data } = await $axios.post("/todo-items/pin/", form);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }

  async addMemo(form) {
    try {
      const { data } = await $axios.post("/todo-items/add-memo/", form);
      return data;
    } catch (error) {
      return error.response.data;
    }
  }
}

export default new Todo();
