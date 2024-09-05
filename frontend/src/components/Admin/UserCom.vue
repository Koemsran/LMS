<template>
  <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']">
    <div class="flex justify-between items-center mb-4 px-4 mt-4">
      <h2 class="text-2xl font-bold">List of Users</h2>
      <router-link to="/admin/create-user"
        class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        Add User
      </router-link>
    </div>
    <div class="block w-full overflow-x-auto">
      <!-- Projects table -->
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>

            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              ID
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Profile
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Full Name
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Email
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Leave Balance
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Role
            </th>
            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Department
            </th>

            <th
              class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
              :class="[
                color === 'light'
                  ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                  : 'bg-emerald-800 text-emerald-300 border-emerald-700',
              ]">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">

            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              {{ user.id }}
            </td>
            <td v-if="user.profile" class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              <img :src="`http://127.0.0.1:8000/storage/${user.profile}`" class="h-12 w-12 bg-white rounded-full border"
                alt="..." />
            </td>
            <td v-else class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              <img src="../../assets/img/def-logo.png" class="h-12 w-12 bg-white rounded-full border" alt="..." />
            </td>
            <td class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              {{ user.name }}
            </td>
            <td class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              {{ user.email }}
            </td>
            <td class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              {{ user.leave_balance }}
            </td>
            <td class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              <span v-for="role in user.roles" :key="role.id">{{ role.name }}</span>
            </td>
            <td v-if="user.department.name" class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              {{ user.department.name }}
            </td>
            <td v-else class="border-t-0 px-6 text-sm align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              No Department
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
              <router-link :to="{ path: '/admin/edit-user', query: { id: user.id } }">
                <i style="color: orange" class="fas fa-edit text-lg mr-3"></i>
              </router-link>
              <i @click="deleteUser(user.id)" style="color: red" class="fas fa-trash text-lg"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

import axios from 'axios';
export default {
  data() {
    return {
      users: [

      ],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users/list');
        this.users = response.data.data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async deleteUser(id) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/user/delete/${id}`);
        this.fetchUsers();
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
  },
  props: {
    color: {
      default: "light",
      validator: function (value) {
        // The value must match one of these strings
        return ["light", "dark"].indexOf(value) !== -1;
      },
    },
  },
};
</script>
