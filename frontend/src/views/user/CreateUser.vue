<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-blueGray-100 right">
            <admin-navbar class="bg-green-600 shadow-md" />
            <div class="px-4 md:px-10 mx-auto w-full app">
                <div class="container mx-auto bg-white shadow-md" style="width: 60%; padding: 30px;">
                    <h2 class="text-2xl font-bold mb-6">Create User</h2>

                    <form @submit.prevent="submitForm">
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input v-model="form.name" type="text" id="name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                        </div>

                        <!-- Profile Field (Optional) -->
                        <div class="mb-4">
                            <label for="profile" class="block text-sm font-medium text-gray-700">Profile
                                (Optional)</label>
                            <input type="file" @change="handleFileUpload" id="profile"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input v-model="form.email" type="email" id="email"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input v-model="form.password" type="password" id="password"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                        </div>

                        <!-- Role Select -->
                        <div class="mb-4">
                            <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                            <select v-model="form.roles" id="roles" multiple
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>

                        <!-- Leave Balance (Decimal) -->
                        <div class="mb-4">
                            <label for="leave_balance" class="block text-sm font-medium text-gray-700">Leave
                                Balance</label>
                            <input v-model="form.leave_balance" type="number" step="0.01" id="leave_balance"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>

                        <!-- Department Select -->
                        <div class="mb-4">
                            <label for="department_id"
                                class="block text-sm font-medium text-gray-700">Department</label>
                            <select v-model="form.department" id="department_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Select Department</option>
                                <option v-for="department in departments" :key="department.id" :value="department.id">{{
                                    department.name }}</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md mr-3">Create
                                User</button>
                            <router-link to="/admin/users" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancel</router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import axios from 'axios';
import { useRouter } from 'vue-router'; // Import useRouter

export default {
    components: {
        AdminNavbar,
        Sidebar,
    },
    setup() {
        const router = useRouter(); // Get the router instance
        return { router };
    },
    data() {
        return {
            form: {
                name: '',
                profile: null,
                email: '',
                password: '',
                roles: [], // Changed to an array
                leave_balance: null,
                department: ''
            },
            departments: [],
            roles: [],
        };
    },
    mounted() {
        this.fetchDepartments();
        this.fetchRoles();
    },
    methods: {
        handleFileUpload(event) {
            this.form.profile = event.target.files[0];
        },
        async submitForm() {
            // Create a FormData object to handle file upload
            let formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('password', this.form.password);

            // Append roles as an array
            this.form.roles.forEach(role => {
                formData.append('roles[]', role);
            });

            formData.append('leave_balance', this.form.leave_balance);
            formData.append('department_id', this.form.department); // Keep this as is
            if (this.form.profile) {
                formData.append('profile', this.form.profile);
            }

            try {
                // Post form data to your API
                await axios.post('http://127.0.0.1:8000/api/user/create', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                // Navigate to /admin/users on success
                this.router.push('/admin/users');
                this.resetForm();
            } catch (error) {
                // Handle error response
                alert('Error creating user');
                this.resetForm();
            }
        },
        async fetchDepartments() {
            try {
                // Fetch departments from your API
                const response = await axios.get('http://127.0.0.1:8000/api/departements/list');
                this.departments = response.data.data;
            } catch (error) {
                console.error('Error fetching departments:', error);
            }
        },
        async fetchRoles() {
            try {
                // Fetch roles from your API
                const response = await axios.get('http://127.0.0.1:8000/api/roles/list');
                this.roles = response.data.data;
            } catch (error) {
                console.error('Error fetching roles:', error);
            }
        },
        resetForm() {
            this.form = {
                name: '',
                profile: null,
                email: '',
                password: '',
                roles: [], // Reset to an empty array
                leave_balance: null,
                department: ''
            };
        }
    }
};
</script>


<style>
.right {
    display: flex;
    flex-direction: column;
    gap: 50px;
}

.app {
    margin-top: 90px
}
</style>