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
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">User Name</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Joining Date</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Total Leave Days</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Leave Token</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Leave Balance</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(leaveType, index) in leaveTypes" :key="leaveType.id">
              <td class="px-6 py-4 text-sm text-gray-900">{{ index + 1 }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ leaveType.userName }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ leaveType.joiningDate }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ leaveType.totalLeaveDays }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ leaveType.leaveToken }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ leaveType.leaveBalance }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <button @click="editLeaveType(leaveType)" class="text-indigo-600 hover:text-indigo-900 mr-2">
                  Edit |
                </button>
                <button @click="deleteLeaveType(leaveType.id)" class="text-red-500 hover:text-red-900">
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
        <h3 class="text-lg font-bold p-3">{{ typeId ? 'Edit Leave' : 'Add Leave' }}</h3>
        <!-- Form Start -->
        <form @submit.prevent="saveType" class="p-3">
          <div class="mb-4">
            <input v-model="typeData.userName" id="userName" type="text"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="User Name" required />
          </div>
          <div class="mb-4">
            <input v-model="typeData.joiningDate" id="joiningDate" type="date"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Joining Date" required />
          </div>
          <div class="mb-4">
            <input v-model="typeData.totalLeaveDays" id="totalLeaveDays" type="number"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Total Leave Days" required />
          </div>
          <div class="mb-4">
            <input v-model="typeData.leaveToken" id="leaveToken" type="text"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Leave Token" required />
          </div>
          <div class="mb-4">
            <input v-model="typeData.leaveBalance" id="leaveBalance" type="number"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Leave Balance" required />
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
export default {
  data() {
    return {
      leaveTypes: [
        { id: 1, userName: "Koemsran", joiningDate: "2023-09-01", totalLeaveDays: 30, leaveToken: 5, leaveBalance: 25 },
        { id: 2, userName: "John Doe", joiningDate: "2022-05-15", totalLeaveDays: 20, leaveToken: 4, leaveBalance: 16 },
        { id: 3, userName: "Jane Smith", joiningDate: "2020-07-10", totalLeaveDays: 25, leaveToken: 8, leaveBalance: 17 },
      ],
      typeData: {
        userName: '',
        joiningDate: '',
        totalLeaveDays: '',
        leaveToken: '',
        leaveBalance: '',
      },
      typeId: null,
      showAddTypeModal: false,
      showEditTypeModal: false,
    };
  },
  methods: {
    addLeaveType() {
      // Add logic to add leave type
      const newLeave = { ...this.typeData, id: this.leaveTypes.length + 1 };
      this.leaveTypes.push(newLeave);
      this.closeModal();
    },
    editLeaveType(leaveType) {
      this.typeId = leaveType.id;
      this.typeData = { ...leaveType };
      this.showEditTypeModal = true;
    },
    deleteLeaveType(id) {
      this.leaveTypes = this.leaveTypes.filter(type => type.id !== id);
    },
    saveType() {
      if (this.typeId) {
        // Update existing leave type
        const leave = this.leaveTypes.find(l => l.id === this.typeId);
        Object.assign(leave, this.typeData);
        this.typeId = null;
      } else {
        // Add new leave type
        this.addLeaveType();
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
