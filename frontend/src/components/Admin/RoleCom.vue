<template>
  <div class="p-6 bg-white shadow-lg rounded-lg h-screen flex flex-col">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">Manage Roles</h2>
      <button @click="showAddModal = true"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add Role
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
                Role
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
              <td class="px-6 py-4 text-gray-900">
                {{ role.id }}
              </td>
              <td class="px-6 py-4 text-gray-900">
                {{ role.name }}
              </td>

              <td class="py-4 px-6 border-b border-grey-light">

                <span v-for="permission in role.permissions" :key="permission.id"
                  class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-orange-500 rounded-full">{{
                  permission.name }}</span>

              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <button @click="addPermission(role.id, role.permissions)"
                  class="text-indigo-600 hover:text-indigo-900 mr-2">
                  Edit Permission
                </button>
                <button @click="editRole(role)" class="text-indigo-500 hover:text-indigo-900 mr-2">
                  Edit |
                </button>
                <button @click="deleteRole(role.id)" class="text-red-500 hover:text-red-900">
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
        <h3 class="text-lg font-bold p-3">{{ roleId ? 'Edit Role' : 'Add Role' }}</h3>
        <!-- Form Start -->
        <form @submit.prevent="saveRole" class="p-3">
          <div class="mb-4">
            <input v-model="roleName" id="roleName" type="text"
              class="border p-2 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500"
              placeholder="Role Name" required />
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
      roles: [],
      roleName: '',
      roleId: null,
      showAddModal: false,
      showEditModal: false,
    };
  },
  mounted() {
    this.fetchRoles();
  },
  methods: {
    async fetchRoles() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/roles/list');
        this.roles = response.data.data;
      } catch (error) {
        console.error('Error fetching roles:', error);
      }
    },
    async addRole() {
      try {
        await axios.post('http://127.0.0.1:8000/api/role/create', {
          name: this.roleName,
        });
        this.fetchRoles();
        this.closeModal();
      } catch (error) {
        console.error('Error creating role:', error);
      }
    },
    addPermission(roleId, permissions) {
      this.$router.push({
        name: 'AddPermission',
        query: {
          roleId,
          permissions: JSON.stringify(permissions)
        }
      });
    },
    editRole(role) {
      this.roleId = role.id;
      this.roleName = role.name;
      this.showEditModal = true;
    },
    async saveRole() {
      try {
        if (this.roleId) {
          await axios.put(`http://127.0.0.1:8000/api/role/update/${this.roleId}`, {
            name: this.roleName,
          });
        }
        else {
          this.addRole();
        }
        this.fetchRoles();
        this.closeModal();

      } catch (error) {
        console.error('Error updating role:', error);
        this.closeModal();
      }
    },
    async deleteRole(id) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/role/delete/${id}`);
        this.fetchRoles();
      } catch (error) {
        console.error('Error deleting role:', error);
      }
    },
    closeModal() {
      this.roleName = '';
      this.roleId = null;
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
