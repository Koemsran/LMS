<template>
    <div class="p-6 bg-white shadow-lg h-screen flex flex-col w-full">
        <div class="flex justify-between items-center mb-4 px-4 mt-4">
            <h2 class="text-2xl font-bold">Add Permissions</h2>
        </div>
        <div class="flex-grow overflow-y-auto" style="padding: 10px 50px;">
            <form @submit.prevent="savePermissions" class="w-full">
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div v-for="permission in allPermissions" :key="permission.id" class="flex items-center mt-4">
                        <input type="checkbox" :id="`permission-${permission.id}`" v-model="selectedPermissions"
                            :value="permission.id"
                            class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500" />
                        <label :for="`permission-${permission.id}`" class="ml-2 text-lg text-gray-700">
                            {{ permission.name }}
                        </label>
                    </div>
                </div>
                <div class="flex justify-start mt-5">
                    <button type="submit"
                        class="bg-emerald-600 text-sm text-white px-4 py-2 rounded hover:bg-emerald-700 mr-2">
                        Save
                    </button>
                    <button type="button" @click="cancel"
                        class="bg-red-500 text-white px-4 text-sm py-2 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

export default {
    data() {
        return {
            allPermissions: [],
            selectedPermissions: [],
            role_id: null, 
        };
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const roleId = route.query.roleId;
        const permissions = JSON.parse(route.query.permissions || '[]');
        return { roleId, permissions, router }; 
    },
    async mounted() {
        await this.fetchPermissions();
        this.role_id = this.$route.query.roleId;

        // Filter only the IDs from the permissions array and set them to selectedPermissions
        this.selectedPermissions = this.permissions.map(p => p.id);
    },
    methods: {
        async savePermissions() {
            try {
                await axios.put(`http://127.0.0.1:8000/api/roles/${this.role_id}/add-permissions`, {
                    "permission_ids": this.selectedPermissions
                });
                this.$router.push('/admin/roles');
            } catch (error) {
                console.error('Error saving permissions:', error);
            }
        },
        async fetchPermissions() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/permissions/list');
                this.allPermissions = response.data.data;
            } catch (error) {
                console.error('Error fetching permissions:', error);
            }
        },
        cancel() {
            this.selectedPermissions = [];
            this.$router.push('/admin/roles');
        },
    },
};
</script>
