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

        localStorage.setItem('authToken', response.data.access_token);

        // Fetch user data and set it in the state
        await this.fetchUser(response.data.access_token);
        this.isAuthenticated = true;
      } catch (error) {
        throw new Error(error.response?.data?.message || 'An error occurred during login.');
      }
    },

    async logout() {
      try {
        const token = localStorage.getItem('authToken');

        await axios.post('http://127.0.0.1:8000/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        localStorage.removeItem('authToken');
        this.$reset(); // Reset the store to its initial state
      } catch (error) {
        console.error('Logout error:', error);
      }
    },

    async fetchUser(token) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.user = response.data.data;
        this.isAuthenticated = true;
      } catch (error) {
        console.error('Error fetching user data:', error);
      }
    },

    loadUserFromLocalStorage() {
      const storedUser = localStorage.getItem('user');
      const isAuthenticated = localStorage.getItem('isAuthenticated') === 'true';

      if (storedUser) {
        this.user = JSON.parse(storedUser);
        this.isAuthenticated = isAuthenticated;
      }
    },
  },

  getters: {
    userName: (state) => state.user?.name ?? 'Guest',
  },

  // Enable persistence for the store
  persist: {
    enabled: true,
    strategies: [
      {
        key: 'auth',
        storage: localStorage, // Persist data to localStorage
      },
    ],
  },
});
