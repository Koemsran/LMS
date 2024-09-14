// src/stores/auth-store.js

import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false,
    user: null,
  }),
  actions: {
    async login(user) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: user.email,
          password: user.password,
        });

        // Save token and authentication state
        localStorage.setItem('authToken', response.data.access_token);
        localStorage.setItem('isAuthenticated', 'true');

        // Save user data (or any other relevant data)
        this.user = { ...response.data.user, roles: response.data.roles };
        this.isAuthenticated = true;
      } catch (error) {
        // Handle errors from API
        throw new Error(error.response?.data?.message || 'An error occurred during login.');
      }
    },
    async logout() {
      try {
        const token = localStorage.getItem('authToken');

        await axios.post('http://127.0.0.1:8000/api/logout', {}, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });

        // Clear local storage and state
        localStorage.removeItem('authToken');
        localStorage.setItem('isAuthenticated', 'false');
        this.user = null;
        this.isAuthenticated = false;
      } catch (error) {
        console.error('Logout error:', error);
      }
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        this.user = response.data.data;
      } catch (error) {
        console.error('Error fetching user data:', error);
      }
    },
  },
  getters: {
    userName: (state) => state.user?.name ?? 'Guest',
  },
});
