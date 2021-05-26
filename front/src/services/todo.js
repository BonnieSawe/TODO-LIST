import $axios from "@/plugins/axios";

<<<<<<< HEAD
class Staff {
=======
class Todo {
>>>>>>> develop
  constructor() {}

  async get() {
    try {
<<<<<<< HEAD
      const { data } = await $axios.get("/admin/staff");
      return data;
    } catch (error) {
      console.error(error);
      return error.response.data;
    }
  }
  async save(payload) {
    try {
      const { data } = await $axios.post("/admin/staff/create", payload);
      return data;
    } catch (error) {
      console.error(error);
      return error.response.data;
    }
  }
  async delete(staff) {
    try {
      const { data } = await $axios.delete("/admin/staff/remove", {
        staff,
      });
      return data;
    } catch (error) {
      console.error(error);
=======
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
      const { data } = await $axios.post("/todo-items/complete/", form);
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
>>>>>>> develop
      return error.response.data;
    }
  }
}

<<<<<<< HEAD
export default new Staff();
=======
export default new Todo();
>>>>>>> develop
