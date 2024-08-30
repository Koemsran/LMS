<template>
    <div class="min-h-screen flex flex-col">
      <!-- Main Content -->
      <main class="flex-grow p-4 bg-gray-100">
        <div class="max-w-7xl mx-auto p-4">
          <div class="block w-full overflow-x-auto">
          <h2 class="text-2xl font-bold mb-6">Leave History</h2>
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
                            #
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Leave Type
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Date From
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Date To
                        </th>

                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Status
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Reason
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]">
                            Action
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="leave in leavesHistory" :key="leave.id">
                        
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ leave.id }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ leave.type }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ leave.dateFrom }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ leave.dateTo }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            <i :class="[
                                leave.status === 'Rejected' ? 'fas fa-circle text-red-500 mr-2' :
                                leave.status === 'Pending' ? 'fas fa-circle text-orange-500 mr-2' :
                                leave.status === 'Approved' ? 'fas fa-circle text-emerald-600 mr-2' :
                                'fas fa-circle text-emerald-500 mr-2'
                            ]"></i>
                            {{ leave.status }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                            {{ leave.reason }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0  whitespace-nowrap p-4">
                            <button class="bg-orange-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-3 rounded">
                                Edit
                            </button>
                            <button class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
      </main>
  
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        leavesHistory: [
          { id: 1, type: 'Sick Leave', dateFrom: '2024-08-01', dateTo: '2024-08-05', status: 'Approved', reason: 'Doctor’s note provided' },
          { id: 2, type: 'Paid Leave', dateFrom: '2024-08-01', dateTo: '2024-08-05', status: 'Rejected', reason: 'Doctor’s note provided' },
          { id: 3, type: 'Vacation', dateFrom: '2024-07-15', dateTo: '2024-07-20', status: 'Pending', reason: '-' },
          // Add more leave records as needed
        ],
      };
    },
    methods: {
      viewDetails(leaveId) {
        // Implement view details logic
        console.log('View details for leave ID:', leaveId);
      },
    },
  };
  </script>
  
  <style scoped>
  /* Optional: Additional custom styles */
  </style>
  