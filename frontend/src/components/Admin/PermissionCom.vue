<template>
    <div class="p-6 bg-white shadow-lg rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Permission Management</h2>
  
      <!-- Add Permission Form -->
      <div class="mb-4">
        <input
          v-model="newPermissionName"
          type="text"
          placeholder="Enter new permission name"
          class="p-2 border border-gray-300 rounded"
        />
        <button
          @click="addPermission"
          class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 ml-2"
        >
          Add Permission
        </button>
      </div>
  
      <!-- Permissions Table -->
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Permission Name
            </th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="permission in permissions" :key="permission.id">
            <td class="px-6 py-4 text-sm text-gray-900">{{ permission.name }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">
              <button
                @click="editPermission(permission.id)"
                class="text-indigo-600 hover:text-indigo-900 mr-2"
              >
                Edit
              </button>
              <button
                @click="deletePermission(permission.id)"
                class="text-red-600 hover:text-red-900"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Edit Permission Modal -->
      <div v-if="editingPermission" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-xl font-bold mb-4">Edit Permission</h3>
          <input
            v-model="editingPermission.name"
            type="text"
            class="p-2 border border-gray-300 rounded mb-4"
          />
          <button
            @click="savePermission"
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
        newPermissionName: '',
        permissions: [
          { id: 1, name: 'Create' },
          { id: 2, name: 'Edit' },
          { id: 3, name: 'Delete' },
          { id: 4, name: 'View' },
          // Add more permissions here
        ],
        editingPermission: null,
      };
    },
    methods: {
      addPermission() {
        if (!this.newPermissionName) return;
        const newPermission = {
          id: Date.now(), // Simple unique ID generation for demo purposes
          name: this.newPermissionName,
        };
        this.permissions.push(newPermission);
        this.newPermissionName = '';
      },
      editPermission(permissionId) {
        this.editingPermission = { ...this.permissions.find(permission => permission.id === permissionId) };
      },
      savePermission() {
        const index = this.permissions.findIndex(permission => permission.id === this.editingPermission.id);
        if (index !== -1) {
          this.$set(this.permissions, index, this.editingPermission);
        }
        this.editingPermission = null;
      },
      deletePermission(permissionId) {
        this.permissions = this.permissions.filter(permission => permission.id !== permissionId);
      },
      closeEditModal() {
        this.editingPermission = null;
      },
    },
  };
  </script>
  
  <style scoped>
  /* You can add custom styles here */
  </style>
  