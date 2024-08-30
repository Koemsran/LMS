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
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                  ID
                </th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                  Leave Type
                </th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                  Leave Balance
                </th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="leaveType in leaveTypes" :key="leaveType.id">
                <td class="px-6 py-4 text-sm text-gray-900">
                  {{ leaveType.id }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">
                  {{ leaveType.name }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">
                  {{ leaveType.balance }}
                </td>
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
      <!-- Add/Edit Department Modal -->
      <div v-if="showAddTypeModal || showEditTypeModal"
        class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
          <h3 class="text-lg font-bold p-3">{{ typeId ? 'Edit Type' : 'Add Type' }}</h3>
          <!-- Form Start -->
          <form @submit.prevent="saveType" class="p-3">
            <div class="mb-4">
              <input v-model="typeName" id="typeName" type="text"
                class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
                placeholder="Type Name" required />
            </div>
            <div class="flex justify-end">
              <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 mr-2">
                Save
              </button>
              <button type="button" @click="closeModal" style="background-color: red;"
                class="bg-gray-300 text-white px-4 py-2 rounded hover:bg-gray-400">
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
          { id: 1, name: "Sick Leave", balance:2 },
          { id: 2, name: "Casual Leave", balance:2 },
          { id: 3, name: "Maternity Leave", balance:2 },
          { id: 4, name: "Paternity Leave", balance:2 },
          { id: 5, name: "Annual Leave", balance:2 },
          { id: 6, name: "Paid Leave", balance:2 },  // New leave type
          { id: 7, name: "Unpaid Leave" , balance:2 },  // New leave type
          { id: 8, name: "Bereavement Leave" , balance:2 },  // New leave type
          { id: 9, name: "Special leave" , balance:2 },  // New leave type
          { id: 10, name: "Career over leave" , balance:2 }   // New leave type
        ],
        typeName: '',
        typeId: null,
        showAddTypeModal: false,
        showEditTypeModal: false,
      };
    },
    methods: {
      addLeaveType() {
        // Logic to add a department
        this.leaveTypes.push({
          id: this.typeId.length + 1,
          name: this.typeName,
        });
        this.closeModal();
      },
      editLeaveType(type) {
        this.typeId = type.id;
        this.typeName = type.name;
        this.showEditTypeModal = true;
      },
      deleteLeaveType(id) {
        this.leaveTypes = this.leaveTypes.filter(type => type.id !== id);
      },
      saveType() {
        if (this.typeId) {
          // Update existing department
          const type = this.leaveTypes.find(d => d.id === this.typeId);
          type.name = this.typeName;
          this.typeId = null;
        } else {
          // Add new department
          this.addLeaveType();
        }
        this.closeModal();
      },
      closeModal() {
        this.typeName = '';
        this.typeId = null;
        this.showAddTypeModal = false;
        this.showEditTypeModal = false;
      }
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
  