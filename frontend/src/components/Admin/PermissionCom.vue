<template>
  <div class="p-6 bg-white shadow-lg rounded-lg h-screen flex flex-col">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">Manage Permissions</h2>
      <button @click="showAddModal = true"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add Permission
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
                Permission Name
              </th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="permission in permissions" :key="permission.id">
              <td class="px-6 py-4 text-sm text-gray-900">
                {{ permission.id }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-900">
                {{ permission.name }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <button @click="editPermission(permission)" class="text-indigo-600 hover:text-indigo-900 mr-2">
                  Edit |
                </button>
                <button @click="deletePermission(permission.id)" class="text-red-500 hover:text-red-900">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Add/Edit Department Modal -->
    <div v-if="showAddModal || showEditModal"
      class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-bold p-3">{{ permissionId ? 'Edit Permission' : 'Add Permission' }}</h3>
        <!-- Form Start -->
        <form @submit.prevent="savePermission" class="p-3">
          <div class="mb-4">
            <input v-model="permissionName" id="permissionName" type="text"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Permission Name" required />
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
import axios from 'axios';
export default {
  data() {
    return {
      permissions: [],
      permissionName: '',
      permissionId: null,
      showAddModal: false,
      showEditModal: false,
    };
  },
  mounted() {
    this.fetchPermissions();
  },
  methods: {
    async fetchPermissions() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/permissions/list');
        this.permissions = response.data.data;
      } catch (error) {
        console.error('Error fetching permissions:', error);
      }
    },
    async addPermission() {
      try {
        await axios.post('http://127.0.0.1:8000/api/permission/create', {
          name: this.permissionName,
        });
        this.fetchPermissions();
        this.closeModal();
      } catch (error) {
        console.error('Error creating permission:', error);
      }
    },
    editPermission(permission) {
      this.permissionId = permission.id;
      this.permissionName = permission.name;
      this.showEditModal = true;
    },
    async savePermission() {
      try {
        if (this.permissionId) {
          await axios.put(`http://127.0.0.1:8000/api/permission/update/${this.permissionId}`, {
            name: this.permissionName,
          });
        }
        else {
          this.addPermission();
        }
        this.fetchPermissions();
        this.closeModal();

      } catch (error) {
        console.error('Error updating permission:', error);
        this.closeModal();
      }
    },
    async deletePermission(id) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/permission/delete/${id}`);
        this.fetchPermissions();
      } catch (error) {
        console.error('Error deleting permission:', error);
      }
    },
    closeModal() {
      this.permissionName = '';
      this.permissionId = null;
      this.showAddModal = false;
      this.showEditModal = false;
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
