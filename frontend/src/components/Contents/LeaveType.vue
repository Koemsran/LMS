<template>
  <div class="p-6 bg-white shadow-lg rounded-lg h-screen flex flex-col">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">Manage Leave Types</h2>
      <button @click="addLeaveType"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add Leave Type
      </button>
    </div>
    <div class="flex-grow overflow-x-auto">
      <div class="w-full">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Leave Type
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="leaveType in leaveTypes" :key="leaveType.id">
              <td class="px-6 py-4 text-sm text-gray-900">
                {{ leaveType.name }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <button @click="editLeaveType(leaveType.id)" class="text-indigo-600 hover:text-indigo-900 mr-2">
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      leaveTypes: [
        { id: 1, name: "Sick Leave" },
        { id: 2, name: "Casual Leave" },
        { id: 3, name: "Maternity Leave" },
        { id: 4, name: "Paternity Leave" },
        { id: 5, name: "Annual Leave" },
        { id: 6, name: "Paid Leave" },  // New leave type
        { id: 7, name: "Unpaid Leave" },  // New leave type
        { id: 8, name: "Bereavement Leave" },  // New leave type
        { id: 9, name: "Special leave" },  // New leave type
        { id: 10, name: "Career over leave" }   // New leave type
      ],
    };
  },
  methods: {
    addLeaveType() {
      // Logic to add a leave type
      alert('Add Leave Type');
    },
    editLeaveType(id) {
      // Logic to edit a leave type
      alert(`Edit Leave Type ID: ${id}`);
    },
    deleteLeaveType(id) {
      // Logic to delete a leave type
      alert(`Delete Leave Type ID: ${id}`);
    },
  },
};
</script>

<style scoped>
/* Ensure the table takes up full width */
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
