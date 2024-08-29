<template>
    <div class="p-6 bg-white shadow-lg rounded-lg">
      <h2 class="text-2xl font-bold mb-4">User Management</h2>
      
      <!-- Add Role Form -->
      <div class="mb-4">
        <input
          v-model="newRoleName"
          type="text"
          placeholder="Enter new role name"
          class="p-2 border border-gray-300 rounded"
        />
        <button
          @click="addRole"
          class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 ml-2"
        >
          Add Role
        </button>
      </div>
      
      <!-- Roles Table -->
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Role Name
            </th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Permissions
            </th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="role in roles" :key="role.id">
            <td class="px-6 py-4 text-sm text-gray-900">{{ role.name }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">
              <ul>
                <li v-for="permission in role.permissions" :key="permission">{{ permission }}</li>
              </ul>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
              <button
                @click="editRole(role.id)"
                class="text-indigo-600 hover:text-indigo-900 mr-2"
              >
                Edit
              </button>
              <button
                @click="deleteRole(role.id)"
                class="text-red-600 hover:text-red-900"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      
      <!-- Edit Role Modal -->
      <div v-if="editingRole" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-xl font-bold mb-4">Edit Role</h3>
          <input
            v-model="editingRole.name"
            type="text"
            class="p-2 border border-gray-300 rounded mb-4"
          />
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Permissions:</label>
            <div class="mt-2">
              <label class="inline-flex items-center">
                <input
                  type="checkbox"
                  v-model="editingRole.permissions"
                  value="create"
                  class="form-checkbox"
                />
                <span class="ml-2">Create</span>
              </label>
              <label class="inline-flex items-center ml-4">
                <input
                  type="checkbox"
                  v-model="editingRole.permissions"
                  value="edit"
                  class="form-checkbox"
                />
                <span class="ml-2">Edit</span>
              </label>
              <label class="inline-flex items-center ml-4">
                <input
                  type="checkbox"
                  v-model="editingRole.permissions"
                  value="delete"
                  class="form-checkbox"
                />
                <span class="ml-2">Delete</span>
              </label>
              <label class="inline-flex items-center ml-4">
                <input
                  type="checkbox"
                  v-model="editingRole.permissions"
                  value="view"
                  class="form-checkbox"
                />
                <span class="ml-2">View</span>
              </label>
            </div>
          </div>
          <button
            @click="saveRole"
            class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700"
          >
            Save
          </button>
          <button
            @click="closeEditModal"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 ml-2"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        newRoleName: '',
        roles: [
          { id: 1, name: 'Admin', permissions: ['create', 'edit', 'delete', 'view'] },
          { id: 2, name: 'Editor', permissions: ['edit', 'view'] },
          // Add more roles here
        ],
        editingRole: null,
      };
    },
    methods: {
      addRole() {
        if (!this.newRoleName) return;
        const newRole = {
          id: Date.now(), // Simple unique ID generation for demo purposes
          name: this.newRoleName,
          permissions: [], // You may want to initialize with some default permissions
        };
        this.roles.push(newRole);
        this.newRoleName = '';
      },
      editRole(roleId) {
        this.editingRole = { ...this.roles.find(role => role.id === roleId) };
      },
      saveRole() {
        const index = this.roles.findIndex(role => role.id === this.editingRole.id);
        if (index !== -1) {
          this.$set(this.roles, index, this.editingRole);
        }
        this.editingRole = null;
      },
      deleteRole(roleId) {
        this.roles = this.roles.filter(role => role.id !== roleId);
      },
      closeEditModal() {
        this.editingRole = null;
      },
    },
  };
  </script>
  
  <style scoped>
  /* You can add custom styles here */
  </style>
  