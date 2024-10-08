<template>
  <div class="min-h-screen flex flex-col">
    <!-- Main Content -->
    <main class="flex-grow p-4 bg-gray-100">
      <div class="max-w-7xl mx-auto p-4">
        <div class="block w-full overflow-x-auto">
          <h2 class="text-2xl font-bold mb-6">Leave History</h2>
          <!-- Tabs -->
          <div class="mb-4">
            <div class="flex space-x-2">
              <button class="py-2 px-4 rounded focus:outline-none"
                :class="{ 'bg-red-500 text-white': filter === 'all', 'border border-red-500': filter !== 'all' }"
                @click="filterHistories('all')">
                All
              </button>
              <button class="py-2 px-4 rounded focus:outline-none"
                :class="{ 'bg-red-500 text-white': filter === 'approved', 'border border-red-500': filter !== 'approved' }"
                @click="filterHistories('approved')">
                Approved
              </button>
              <button class="py-2 px-4 rounded focus:outline-none"
                :class="{ 'bg-red-500 text-white': filter === 'rejected', 'border border-red-500': filter !== 'rejected' }"
                @click="filterHistories('rejected')">
                Rejected
              </button>
              <button class="py-2 px-4 rounded focus:outline-none"
                :class="{ 'bg-red-500 text-white': filter === 'cancelled', 'border border-red-500': filter !== 'cancelled' }"
                @click="filterHistories('cancelled')">
                Cancelled
              </button>
            </div>
          </div>
          <!-- Projects table -->
          <table class="items-center w-full border-collapse">
            <thead>
              <tr>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Leave Type
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Date From
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Date To
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Status
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Reason
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Requested
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="leave in filteredHistories" :key="leave.id">
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  {{ leave.leave_type }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  {{ leave.date_from }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  {{ leave.date_to }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  <i :class="[
                    leave.status === 'rejected' ? 'fas fa-circle text-red-500 mr-2' :
                      leave.status === 'pending' ? 'fas fa-circle text-orange-500 mr-2' :
                        leave.status === 'cancelled' ? 'fas fa-circle text-red-500 mr-2' :
                          'fas fa-circle text-emerald-500 mr-2'
                  ]"></i>
                  {{ leave.status }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  {{ leave.reason }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  {{ leave.created_at }}
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                  <a href="#" class="text-blue-500 hover:text-blue-700 mr-4" title="View">
                    <i class="fas fa-eye text-lg" style="color: #006ca5"></i>
                  </a>
                  <a @click="deleteHistory(leave.id)" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                    <i class="fas fa-trash text-lg" style="color: red"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      leavesHistories: [],
      filter: 'all' ,// Default filter
      user:''
    };
  },
  mounted() {
    this.fetchHistories();
    this.fetchUser();
  },
  computed: {
    filteredHistories() {
      const filteredLeaves = this.leavesHistories.filter(leave => leave.status !== 'pending' && (leave.user_id === this.user.id || leave.manager_id === this.user.id));
      if (this.filter === 'all') {
        return filteredLeaves;
      }

      // Return filtered leaves based on selected status
      return filteredLeaves.filter(leave => leave.status === this.filter);
    }
  },
  methods: {
    async fetchHistories() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/histories/list');
        this.leavesHistories = response.data.data;
      } catch (error) {
        console.error('Error fetching history:', error);
      }
    },
    async deleteHistory(id) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/history/delete/${id}`);
        this.fetchHistories(); // Refresh the data after deletion
      } catch (error) {
        console.error('Error deleting history:', error);
      }
    },
    async fetchUser() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.user = response.data.data;
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },
    filterHistories(status) {
      this.filter = status;
    }
  }
};
</script>
