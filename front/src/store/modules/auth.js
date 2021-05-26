<<<<<<< HEAD
import axios from "axios";
import Cookies from "js-cookie";
import Auth from "@/services/auth";
import * as types from "../mutation-types";

const storedUser = Cookies.get("user") ? JSON.parse(Cookies.get("user")) : null;
// state
export const state = {
  user: storedUser,
  token: Cookies.get("token"),
  storeUser: false,
  role: Cookies.get("role"),
};

// getters
export const getters = {
  user: (state) => state.user,
  token: (state) => state.token,
  check: (state) => state.user !== null,
  role: (state) => state.role,
};

// mutations
export const mutations = {
  [types.SAVE_TOKEN](state, { token, remember }) {
    state.token = token;
    state.storeUser = remember;
    Cookies.set("token", token, { expires: remember ? 365 : null });
  },

  [types.FETCH_USER_SUCCESS](state, { user }) {
    state.user = user;
    if (state.storeUser) {
      Cookies.set("user", user, { expires: state.storeUser ? 365 : null });
    }
  },

  [types.FETCH_USER_FAILURE](state) {
    state.token = null;
    Cookies.remove("token");
  },

  [types.LOGOUT](state) {
    state.user = null;
    state.token = null;

    Cookies.remove("token");
    Cookies.remove("user");
    Cookies.remove("role");
  },

  [types.UPDATE_USER](state, { user }) {
    state.user = user;
  },

  [types.SET_ROLE](state, { role }) {
    state.role = role;
    if (state.storeUser) {
      Cookies.set("role", role, {
        expires: state.storeUser ? 365 : null,
      });
    }
  },
};

// actions
export const actions = {
  saveToken({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload);
  },

  async fetchUser({ commit }) {
    try {
      const { data } = await Auth.getUser();

      var role = data.user.role_id;

      commit(types.FETCH_USER_SUCCESS, { user: data.user });
      commit(types.SET_ROLE, { role });

    } catch (e) {
      commit(types.FETCH_USER_FAILURE);
    }
  },

  updateUser({ commit }, payload) {
    commit(types.UPDATE_USER, payload);
  },

  changeRole({ commit }, payload) {
    commit(types.SET_ROLE, { role: payload.role });
  },

  async logout({ commit }) {
    try {
      await Auth.logout();
    } catch (e) {
      console.log("Error logging you out");
    }

    commit(types.LOGOUT);
  },
};
=======
import axios from '@/plugins/axios'
import Cookies from 'js-cookie'

// state
export const state = () => ({
  user: null,
  token: null
})

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
}

// mutations
export const mutations = {
  SET_TOKEN (state, token) {
    state.token = token
  },

  FETCH_USER_SUCCESS (state, user) {
    state.user = user
    console.log('state', state)
  },

  FETCH_USER_FAILURE (state) {
    state.token = null
  },

  LOGOUT (state) {
    state.user = null
    state.token = null
  },

  UPDATE_USER (state, { user }) {
    state.user = user
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, { token }) {
    commit('SET_TOKEN', token)

    Cookies.set('token', token, { expires:  365 })
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/auth/user')
      console.log('data', data)
      commit('FETCH_USER_SUCCESS', data)
    } catch (e) {
      Cookies.remove('token')

      commit('FETCH_USER_FAILURE')
    }
  },

  updateUser ({ commit }, payload) {
    commit('UPDATE_USER', payload)
  },

  async logout ({ commit }) {
    try {
      await axios.post('/logout')
    } catch (e) { }

    Cookies.remove('token')

    commit('LOGOUT')
  },

  async fetchOauthUrl (ctx, { provider }) {
    const { data } = await axios.post(`/oauth/${provider}`)

    return data.url
  }
}
>>>>>>> develop
