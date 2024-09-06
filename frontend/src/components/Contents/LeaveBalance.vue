<template>
  <div class="p-6 bg-white shadow-lg rounded-lg h-screen flex flex-col">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">Manage Leave Balance</h2>
      <button @click="showAddTypeModal = true"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add Leave Balance
      </button>
    </div>
    <div class="flex-grow overflow-x-auto">
      <div class="w-full">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">User Name
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Joining Date
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Total Leave
                Days</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Leave Token
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Leave Balance
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(balance, index) in leaveBalances" :key="balance.id">
              <td class="px-6 py-4 text-sm text-gray-900">{{ index + 1 }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ balance.user_name }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ balance.joining_date }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ balance.total_leave }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ balance.token_balance }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ balance.leave_balance }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <router-link :to="{ path: '/admin/leave-balance-detail', query: { id: balance.id } }" class="text-indigo-600 hover:text-indigo-900 mr-2">
                  Detail |
                </router-link>
                <button @click="editBalance(balance)" class="text-teal-600 hover:text-indigo-900 mr-2">
                  Edit |
                </button>
                <button @click="deleteBalance(balance.id)" class="text-red-500 hover:text-red-900">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Add/Edit Modal -->
    <div v-if="showAddTypeModal || showEditTypeModal"
      class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-bold p-3">{{ userId ? 'Edit Leave Balance' : 'Add Leave Balance' }}</h3>
        <!-- Form Start -->
        <form @submit.prevent="saveLeaveBalance" class="p-3">
          <div class="mb-4">
            <input v-model="totalLeaveDays" id="totalLeaveDays" type="number"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Total Leave Days" required />
          </div>
          <div class="flex justify-end">
            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 mr-2">
              Save
            </button>
            <button type="button" @click="closeModal" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      leaveBalances: [],
      leaves: [],
      totalLeaveDays: '',
      userId: null,
      showAddTypeModal: false,
      showEditTypeModal: false,
    };
  },
  mounted() {
    this.fetchLeaveBalance();
  },

  methods: {

    async fetchLeaveBalance() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/balances/list');
        this.leaveBalances = response.data.data;
      } catch (error) {
        console.error('Error fetching leave balance:', error);
      }
    },
    async deleteBalance(id) {
      try {
        await axios.get(`http://127.0.0.1:8000/api/balance/delete/${id}`);
        this.fetchLeaveBalance();
      } catch (error) {
        console.error('Error deleting leave balance:', error);
      }
    },

    addLeaveBalance() {
      // Add logic to add leave type
      const newLeave = { ...this.typeData, id: this.leaveBalance.length + 1 };
      this.leaveBalance.push(newLeave);
      this.closeModal();
    },
    editBalance(leaveBalance) {
      this.totalLeaveDays = leaveBalance.total_leave;
      this.userId = leaveBalance.user_id
      console.log(this.userId)
      this.showEditTypeModal = true;
    },
    async saveLeaveBalance() {
      if (this.userId) {
        try {
          await axios.post(`http://127.0.0.1:8000/api/user/update/${this.userId}`, {
            leave_balance: this.totalLeaveDays
          });
          await axios.put(`http://127.0.0.1:8000/api/balance/update/${this.userId}`)
            .then(response => {
              console.log('Token balance updated:', response.data);
            });
          this.fetchLeaveBalance();
        } catch (error) {
          console.error('Error updating leave balance:', error);
        }
      } else {
        // Add new leave type
        this.addLeaveBalance();
      }
      this.closeModal();
    },
    closeModal() {
      this.typeData = {
        userName: '',
        joiningDate: '',
        totalLeaveDays: '',
        leaveToken: '',
        leaveBalance: '',
      };
      this.typeId = null;
      this.showAddTypeModal = false;
      this.showEditTypeModal = false;
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
}

th,
td {
  text-align: left;
  padding: 0.75rem;
}

th {
  background-color: #f3f4f6;
}
</style>
