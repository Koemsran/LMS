<template>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']">
        <div class="flex justify-between items-center mb-4 px-4 mt-4">
            <h2 class="text-2xl font-bold">List of My Subordinates</h2>
            <button v-if="!manager" @click="showAddModal = true"
                class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Subordinate
            </button>
            <button v-if="admin" @click="showAddModal = true"
                class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add Subordinate
            </button>
        </div>
        <div class="block w-full overflow-x-auto">
            <!-- Projects table -->
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>

                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            ID
                        </th>

                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Manager Name
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Manager Email
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Subordinate Name
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Subordinate Email
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Leave Balance
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Assigned Date
                        </th>

                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
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
                    <tr v-for="subordinate in subordinates" :key="subordinate.id">

                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.id }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.namager }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.namager_email }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.subordinator }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.subordinator_email }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.subordinator_balance }}
                        </td>
                        <td class="border-t-0 px-6 align-middle text-xs border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ subordinate.created_at }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            <i @click="editSubordinate(subordinate)" style="color: #006ca5"
                                class="fas fa-edit text-lg mr-3"></i>
                            <i @click="removeSubordinate(subordinate.id)" style="color: red"
                                class="fas fa-trash text-lg"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Add/Edit Subordinate Modal -->
        <div v-if="showAddModal || showEditModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg" style="max-width: 800px; width: 100%;">
                <h3 class="text-lg font-bold p-3">{{ subId ? 'Edit Subordinate' : 'Add Subordinate' }}</h3>
                <!-- Form Start -->
                <form @submit.prevent="SaveSubordinate" class="p-3">
                    <div class="mb-4">
                        <select v-model="manager_id" name="manager" id="manager"
                            class="border py-2 px-4 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Select Manager</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <select name="subordinate" v-model="subordinate_id" id="subordinate"
                            class="border py-2 px-4 w-full mt-1 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Select Subordinate</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 mr-2">
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

import axios from "axios";
export default {
    data() {
        return {
            subordinates: [],
            users: [],
            showAddModal: false,
            showEditModal: false,
            manager_id: '',
            subordinate_id: '',
            subId: null,
            user: '',
            manager:false,
        };
    },
    mounted() {
        this.fetchSubordinates();
        this.fetchUsers();
        this.fetchUser();
    },
    methods: {
        closeModal() {
            this.subId = null;
            this.showAddModal = false;
            this.showEditModal = false;
        },
        async fetchSubordinates() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/subordinates/list');
                this.subordinates = response.data.data;

            } catch (error) {
                console.error('Error fetching users:', error);
            }
        },
        async fetchUsers() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/users/list');
                this.users = response.data.data;

            } catch (error) {
                console.error('Error fetching users:', error);
            }
        },
        async fetchUser() {
            try {
                const token = localStorage.getItem('authToken');
                const response = await axios.get('http://127.0.0.1:8000/api/me', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                this.user = response.data.data;
                this.manager = response.data.data.roles.some(role => role.name === 'Manager')
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
        async createSubordinate() {
            try {
                await axios.post('http://127.0.0.1:8000/api/subordinate/assign', {
                    manager_id: this.manager_id,
                    subordinator_id: this.subordinate_id,
                });
                alert("Subordinate assigned successfully");
                this.closeModal(); 
                this.fetchSubordinates(); 
            } catch (error) {
                console.error('Error assigning subordinate:', error.response?.data?.message || error.message);
            }
        },

        async editSubordinate(subordinate) {
            this.subId = subordinate.id;
            this.manager_id = subordinate.manager_id;
            this.subordinate_id = subordinate.subordinator_id;
            this.showEditModal = true;
        },
        async SaveSubordinate() {
            if (this.subId) {
                try {
                    await axios.put(`http://127.0.0.1:8000/api/subordinate/update/${this.subId}`, {
                        manager_id: this.manager_id,
                        subordinator_id: this.subordinate_id,
                    });
                    alert("Subordinate updated successfully");
                    this.fetchSubordinates();  // Refresh the subordinates list after successful assignment
                    this.closeModal(); // Close the modal after assigning
                } catch (error) {
                    console.error('Error assigning subordinate:', error.response?.data?.message || error.message);
                }
            }
            else {
                this.createSubordinate()
            }
            this.fetchSubordinates()
            this.closeModal()
        },
        async removeSubordinate(id) {
            try {
                await axios.delete(`http://127.0.0.1:8000/api/subordinate/remove/${id}`);
                alert("Subordinate removed successfully");
                this.fetchSubordinates();  // Refresh the subordinates list after successful assignment
            } catch (error) {
                console.error('Error removing subordinate:', error.response?.data?.message || error.message);
            }
        }

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
