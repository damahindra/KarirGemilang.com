// src/store.js
import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    user: null,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    clearUser(state) {
      state.user = null;
    },
  },
  actions: {
    login({ commit }, credentials) {
      // Ganti URL dengan endpoint API login Anda
      return axios.post('http://127.0.0.1:8000/login', credentials)
        .then(response => {
          const user = response.data.user; // Sesuaikan dengan struktur respons API Anda
          commit('setUser', user);
          return user;
        })
        .catch(error => {
          console.log(error.response);
          throw error;
        });
    },
    logout({ commit }) {
      commit('clearUser');
    },
  },
  getters: {
    isAuthenticated: state => !!state.user,
    getUser: state => state.user,
  }
});
