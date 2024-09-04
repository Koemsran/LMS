<template>
    <div>
        <!-- Main Content -->
        <div :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 :class="[color === 'light' ? 'text-blueGray-700' : 'text-white']"
                            class="font-semibold text-3xl my-2">
                            Manage Leave Application
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Tabs for filtering -->
            <div class="px-4 py-2 rounded-t flex justify-between">
                <div class="flex space-x-2">
                    <button class="py-2 px-4 rounded focus:outline-none"
                        :class="{ 'bg-red-500 text-white': filter === 'all', 'border border-red-500': filter !== 'all' }"
                        @click="filterHistories('all')">
                        All
                    </button>
                    <button class="py-2 px-4 rounded focus:outline-none"
                        :class="{ 'bg-red-500 text-white': filter === 'pending', 'border border-red-500': filter !== 'pending' }"
                        @click="filterHistories('pending')">
                        Pending
                    </button>
                    <button class="py-2 px-4 rounded focus:outline-none"
                        :class="{ 'bg-red-500 text-white': filter === 'approved', 'border border-red-500': filter !== 'approved' }"
                        @click="filterHistories('approved')">
                        Approved
                    </button>
                    <button class="py-2 px-4 rounded focus:outline-none"
                        :class="{ 'bg-red-500 text-white': filter === 'rejected', 'border border-red-500': filter !== 'rejected' }"
                        @click="filterHistories('rejected')">
                        Rejected
                    </button>
                    <button class="py-2 px-4 rounded focus:outline-none"
                        :class="{ 'bg-red-500 text-white': filter === 'cancelled', 'border border-red-500': filter !== 'cancelled' }"
                        @click="filterHistories('cancelled')">
                        Cancelled
                    </button>
                </div>

                <button @click="showPopup = true"
                    class="bg-emerald-600 text-white px-4 py-3 rounded hover:bg-emerald-700 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    New Request
                </button>
            </div>

            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                        <tr>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Employee Name
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Leave Type
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Date From
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Date To
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Duration
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Status
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Reason
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                Action
                            </th>
                            <th :class="[color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700']"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="leave in filteredLeaves" :key="leave.id">
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                                <img :src="`http://127.0.0.1:8000/storage/${leave.profile}`"
                                    class="h-12 w-12 bg-white rounded-full border" alt="Profile Image" />
                                <span :class="[color === 'light' ? 'text-blueGray-600' : 'text-white']"
                                    class="ml-3 font-bold">
                                    {{ leave.user_name }}
                                </span>
                            </th>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ leave.leave_type }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ leave.date_from }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ leave.date_to }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ leave.duration }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <i :class="{
                                    'fas fa-circle text-red-500 mr-2': leave.status === 'rejected',
                                    'fas fa-circle text-orange-500 mr-2': leave.status === 'pending',
                                    'fas fa-circle text-red-500 mr-2': leave.status === 'cancelled',
                                    'fas fa-circle text-emerald-500 mr-2': leave.status === 'approved'
                                }"></i>
                                {{ leave.status }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs table-cell-wrap p-4">
                                {{ leave.reason }}
                            </td>
                            <td class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <a @click="cancelLeaveRequest(leave.id)" class="text-red-500 hover:text-blue-700 mr-4" title="Cancel">
                                    <i class="fas fa-times text-2xl" style="color: red"></i>
                                </a>
                            </td>
                            <!-- <td class="border-t-0 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-4" title="View">
                                    <i class="fas fa-eye text-lg" style="color: #006ca5"></i>
                                </a>
                                <a href="#" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                    <i class="fas fa-edit text-lg" style="color: orange"></i>
                                </a>
                            </td> -->
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Modal -->
        <transition name="fade">
            <div v-if="showPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-80">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
                    <div class="p-4 border-b flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-900">
                            New Request
                        </h3>
                        <button @click="showPopup = false" type="button"
                            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 inline-flex items-center">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4">
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="leaveType" class="block text-gray-700 text-sm font-bold mb-2">Leave
                                    Type</label>
                                <input id="leaveType" v-model="newLeave.leaveType" type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="dateFrom" class="block text-gray-700 text-sm font-bold mb-2">Date
                                    From</label>
                                <input id="dateFrom" v-model="newLeave.dateFrom" type="date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="dateTo" class="block text-gray-700 text-sm font-bold mb-2">Date To</label>
                                <input id="dateTo" v-model="newLeave.dateTo" type="date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Reason</label>
                                <textarea id="reason" v-model="newLeave.reason"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required></textarea>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Submit
                                </button>
                                <button @click="showPopup = false"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, reactive, onMounted, computed } from 'vue';

export default {
    props: {
        color: {
            type: String,
            default: 'light',
            validator: value => ['light', 'dark'].includes(value)
        }
    },
    setup() {
        const showPopup = ref(false);
        const leaves = ref([]);
        const filter = ref('all');
        const newLeave = reactive({
            leaveType: '',
            dateFrom: '',
            dateTo: '',
            reason: ''
        });
        const userId = ref(null);

        // Fetch userId and leave requests when component is mounted
        onMounted(async () => {
            try {
                const token = localStorage.getItem('authToken');
                const userResponse = await axios.get('http://127.0.0.1:8000/api/me', {
                    headers: { Authorization: `Bearer ${token}` }
                });
                userId.value = userResponse.data.data.id;
                await fetchLeaveRequest();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        });

        // Fetch leave requests
        const fetchLeaveRequest = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/leaves/list');
                leaves.value = response.data.data;
            } catch (error) {
                console.error('Error fetching leaves:', error);
            }
        };
        // Fetch leave requests
        const cancelLeaveRequest = async (id) => {
            try {
                await axios.post(`http://127.0.0.1:8000/api/leave/cancel-request/${id}`);
                await fetchLeaveRequest();
            } catch (error) {
                console.error('Error caceling leave request:', error);
            }
        };

        // Filter leaves based on the selected status
        const filteredLeaves = computed(() => {
            if (filter.value === 'all') {
                return leaves.value.filter(leave => leave.status == 'pending');
                // return leaves.value.filter(leave => leave.user_id === userId.value);
            }
            return leaves.value.filter(leave => leave.status === filter.value && leave.user_id === userId.value);
        });

        // Handle filter changes
        const filterHistories = (status) => {
            filter.value = status;
        };

        // Handle form submission
        const submitForm = async () => {
            // Handle form submission logic here
            console.log('New leave request:', newLeave);
            // Reset form and close popup
            newLeave.leaveType = '';
            newLeave.dateFrom = '';
            newLeave.dateTo = '';
            newLeave.reason = '';
            showPopup.value = false;
        };

        return {
            showPopup,
            leaves,
            filter,
            newLeave,
            userId,
            filteredLeaves,
            filterHistories,
            submitForm,
            cancelLeaveRequest
        };
    }
};
</script>

<style>
/* Add custom transition for the modal if needed */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

/* Ensure text wraps and does not overflow */
.table-cell-wrap {
    max-width: 50px;
    /* Adjust this value as needed */
    word-wrap: break-word;
    /* Allow text to wrap within the cell */
    overflow: hidden;
    /* Prevent content from overflowing */
    white-space: normal;
    /* Allow text to wrap */
}

/* Optional: Add ellipsis for long text if needed */
.table-cell-ellipsis {
    max-width: 50px;
    /* Adjust this value as needed */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
