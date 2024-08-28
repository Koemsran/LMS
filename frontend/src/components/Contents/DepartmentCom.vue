<template>
  <div class="p-6 bg-white shadow-lg rounded-lg h-screen flex flex-col">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">Manage Departments</h2>
      <button @click="showAddDepartmentModal = true"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add Department
      </button>
    </div>
    <div class="flex-grow overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Department Name
            </th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="department in departments" :key="department.id">
            <td class="px-6 py-4 text-sm text-gray-900">
              {{ department.name }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
              <button @click="editDepartment(department)" class="text-indigo-600 hover:text-indigo-900 mr-2">
                Edit
              </button>
              <button @click="deleteDepartment(department.id)" class="text-red-500 hover:text-red-900">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add/Edit Department Modal -->
    <div v-if="showAddDepartmentModal || showEditDepartmentModal"
      class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-bold p-3">{{ editDepartmentId ? 'Edit Department' : 'Add Department' }}</h3>
        <!-- Form Start -->
        <form @submit.prevent="saveDepartment" class="p-3">
          <div class="mb-4">
            <input v-model="departmentName" id="departmentName" type="text"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Department Name" required />
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
      departments: [
        { id: 1, name: "IT" },
        { id: 2, name: "English" },
        { id: 3, name: "Finance" },
        { id: 4, name: "Student Life" },
        { id: 5, name: "ERO" },
        { id: 5, name: "HR" },
      ],
      departmentName: '',
      editDepartmentId: null,
      showAddDepartmentModal: false,
      showEditDepartmentModal: false,
    };
  },
  methods: {
    addDepartment() {
      // Logic to add a department
      this.departments.push({
        id: this.departments.length + 1,
        name: this.departmentName,
      });
      this.closeModal();
    },
    editDepartment(department) {
      this.editDepartmentId = department.id;
      this.departmentName = department.name;
      this.showEditDepartmentModal = true;
    },
    saveDepartment() {
      if (this.editDepartmentId) {
        // Update existing department
        const department = this.departments.find(d => d.id === this.editDepartmentId);
        department.name = this.departmentName;
        this.editDepartmentId = null;
      } else {
        // Add new department
        this.addDepartment();
      }
      this.closeModal();
    },
    deleteDepartment(id) {
      this.departments = this.departments.filter(department => department.id !== id);
    },
    closeModal() {
      this.departmentName = '';
      this.editDepartmentId = null;
      this.showAddDepartmentModal = false;
      this.showEditDepartmentModal = false;
    }
  }
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

/* Modal styling */
.modal {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>