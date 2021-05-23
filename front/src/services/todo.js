import $axios from "@/plugins/axios";

class TodoItem {
  constructor() {}

  async get() {
    try {
      const { data } = await $axios.get("/todo-items");
      return data;
    } catch (error) {
      console.error(error);
      return error.response.data;
    }
  }
  async store(form) {
    try {
      const { data } = await $axios.post("/todo-items/store", form);
      return data;
    } catch (error) {
      console.error(error);
      return error.response.data;
    }
  }
  async delete(id) {
    try {
      const { data } = await $axios.delete("/todo-items/delete/$"+id);
      return data;
    } catch (error) {
      console.error(error);
      return error.response.data;
    }
  }
}

export default new TodoItem();
