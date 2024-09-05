<template>
    <div class="h-screen flex flex-col mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']">
        <!-- Header -->
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-3xl my-2"
                        :class="[color === 'light' ? 'text-blueGray-700' : 'text-white']">
                        Manage Leave Application
                    </h3>
                </div>
            </div>
        </div>

        <!-- Tabs for filtering -->
        <div class="px-4 py-2 rounded-t bg-white">
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
        </div>

        <!-- Table -->
        <div class="flex-grow overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                    <tr>
                        <!-- Table headers -->
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Employee Name
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Leave Type
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Date From
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Date To
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Duration
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Status
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Reason
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                            Action
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="color === 'light' ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100' : 'bg-emerald-800 text-emerald-300 border-emerald-700'">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="leave in filteredLeaves" :key="leave.id">
                        <th
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                            <img v-if="leave.profile" :src="`http://127.0.0.1:8000/storage/${leave.profile}`" class="h-12 w-12 bg-white rounded-full border" alt="..." />
                            <img v-else src="../../assets/img/def-logo.png" class="h-12 w-12 bg-white rounded-full border" alt="..." />
                            <span class="ml-3 font-bold"
                                :class="[color === 'light' ? 'text-blueGray-600' : 'text-white']">
                                {{ leave.user_name }}
                            </span>
                        </th>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ leave.leave_type }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ leave.date_from }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ leave.date_to }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ leave.duration }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <i :class="[
                                leave.status === 'rejected' ? 'fas fa-circle text-red-500 mr-2' :
                                    leave.status === 'pending' ? 'fas fa-circle text-orange-500 mr-2' :
                                        leave.status === 'cancelled' ? 'fas fa-circle text-red-500 mr-2' :
                                            'fas fa-circle text-emerald-500 mr-2'
                            ]"></i>
                            {{ leave.status }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ leave.reason }}
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right">
                            <div class="relative inline-block ">
                                <!-- Toggle button for the dropdown -->
                                <a class="text-blueGray-500 py-1 px-3" href="#pablo" ref="btnDropdownRef"
                                    v-on:click="toggleDropdown($event)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <!-- Dropdown menu -->
                                <div ref="popoverDropdownRef"
                                    class="bg-white text-base z-50 absolute left-0 mt-2 rounded shadow-lg min-w-48"
                                    v-bind:class="{ hidden: !dropdownPopoverShow, block: dropdownPopoverShow }"
                                    style="top: calc(100% + 8px);">
                                    <button @click="approvedStatus(leave.id)"
                                        class="text-sm p-2 font-normal block w-full whitespace-nowrap bg-transparent text-emerald-500 flex items-center">
                                        <i class="fas fa-check-circle mr-2"></i> Approve
                                    </button>
                                    <button @click="rejectedStatus(leave.id)"
                                        class="text-sm p-2 font-normal block w-full whitespace-nowrap bg-transparent text-red-500 flex items-center">
                                        <i class="fas fa-times-circle mr-2"></i> Reject
                                    </button>
                                    <button @click="deletedStatus(leave.id)"
                                        class="text-sm p-2 font-normal block w-full whitespace-nowrap bg-transparent text-red-500 flex items-center">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { createPopper } from "@popperjs/core";
export default {
    data() {
        return {
            leaves: [],
            filter: 'all', // Default filter status
            dropdownPopoverShow: false,
        };
    },

    mounted() {
        this.fetchLeaveRequest();
    },
    computed: {
        filteredLeaves() {
            if (this.filter === 'all') {
                return this.leaves;
            }
            return this.leaves.filter(leave => leave.status === this.filter);
        }
    },
    methods: {
        async fetchLeaveRequest() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/leaves/list');
                this.leaves = response.data.data;
            } catch (error) {
                console.error('Error fetching leaves:', error);
            }
        },
        filterHistories(status) {
            this.filter = status;
        },
        toggleDropdown: function (event) {
            event.preventDefault();
            if (this.dropdownPopoverShow) {
                this.dropdownPopoverShow = false;
            } else {
                this.dropdownPopoverShow = true;
                createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
                    placement: "bottom-start",
                });
            }
        },
        async approvedStatus(id) {
            try {
                await axios.post(`http://127.0.0.1:8000/api/leave/approve/${id}`);
                this.dropdownPopoverShow = false;
                this.fetchLeaveRequest()
            } catch (error) {
                console.error('Error updating leave status to approve: ', error);
            }
        },
        async rejectedStatus(id) {
            try {
                await axios.post(`http://127.0.0.1:8000/api/leave/reject/${id}`);
                this.dropdownPopoverShow = false;
                this.fetchLeaveRequest()
            } catch (error) {
                console.error('Error updating leave status to reject:', error);
            }
        },
        async deletedStatus(id) {
            try {
                await axios.delete(`http://127.0.0.1:8000/api/leave/delete/${id}`);
                this.dropdownPopoverShow = false;
                this.fetchLeaveRequest()
            } catch (error) {
                console.error('Error updating leave status to cancel:', error);
            }
        }
    },
    props: {
        color: {
            default: "light",
            validator: function (value) {
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
    },
};
</script>
