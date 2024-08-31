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
                <button
                  class="py-2 px-4 rounded focus:outline-none"
                  :class="{ 'bg-red-500 text-white': filter === 'all', 'border border-red-500': filter !== 'all' }"
                  @click="filterHistories('all')"
                >
                  All
                </button>
                <button
                  class="py-2 px-4 rounded focus:outline-none"
                  :class="{ 'bg-red-500 text-white': filter === 'pending', 'border border-red-500': filter !== 'pending' }"
                  @click="filterHistories('pending')"
                >
                  Pending
                </button>
                <button
                  class="py-2 px-4 rounded focus:outline-none"
                  :class="{ 'bg-red-500 text-white': filter === 'approved', 'border border-red-500': filter !== 'approved' }"
                  @click="filterHistories('approved')"
                >
                  Approved
                </button>
                <button
                  class="py-2 px-4 rounded focus:outline-none"
                  :class="{ 'bg-red-500 text-white': filter === 'rejected', 'border border-red-500': filter !== 'rejected' }"
                  @click="filterHistories('rejected')"
                >
                  Rejected
                </button>
                <button
                  class="py-2 px-4 rounded focus:outline-none"
                  :class="{ 'bg-red-500 text-white': filter === 'cancelled', 'border border-red-500': filter !== 'cancelled' }"
                  @click="filterHistories('cancelled')"
                >
                  Cancelled
                </button>
              </div>
            </div>
            <!-- Projects table -->
            <table class="items-center w-full bg-transparent border-collapse">
              <thead>
                <tr>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      #
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Leave Type
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Date From
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Date To
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Status
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Reason
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Requested Date
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]">
                      Action
                  </th>
                  <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                      :class="[
                          color === 'light'
                              ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                              : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                      ]"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="leave in filteredHistories" :key="leave.id">
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                      {{ leave.id }}
                  </td>
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
                  <td class="border-t-0 px-6 align-middle border-l-0 border-r-0  whitespace-nowrap p-4">
                      <button @click="deleteHistory(leave.id)" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                          Delete
                      </button>
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
      filter: 'all' // Default filter
    };
  },
  mounted(){
    this.fetchHistories();
  },
  computed: {
    filteredHistories() {
      if (this.filter === 'all') {
        return this.leavesHistories;
      }
      return this.leavesHistories.filter(leave => leave.status === this.filter);
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
        this.fetchHistories();
      } catch (error) {
        console.error('Error deleting history:', error);
      }
    },
    filterHistories(status) {
      this.filter = status;
    }
  }
};
</script>

  