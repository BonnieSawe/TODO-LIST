import $axios from "@/plugins/axios";

class Staff {
  constructor() {}

  async get() {
    try {
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
      return error.response.data;
    }
  }
}

export default new Staff();
