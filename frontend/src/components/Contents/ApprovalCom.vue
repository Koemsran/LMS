<template>
    <div class="flex flex-col h-screen">
      <div class="flex-1 p-4 overflow-auto">
        <h2 class="text-xl font-bold mb-4">Approval Requests</h2>
        <div v-if="requests.length === 0" class="text-gray-500">No requests to approve.</div>
        <ul v-else class="space-y-4">
          <li v-for="request in paginatedRequests" :key="request.id" class="bg-white shadow rounded-lg p-4 mb-3 flex justify-between items-center">
            <div>
              <p class="font-semibold">{{ request.name }}</p>
              <p class="text-gray-600">{{ request.details }}</p>
            </div>
            <div class="flex space-x-2">
              <button @click="handleApprove(request.id)" class="bg-emerald-500 mr-3 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-600 transition">
                Approve
              </button>
              <button @click="handleReject(request.id)" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                Reject
              </button>
            </div>
          </li>
        </ul>
      </div>
      <!-- Pagination Controls -->
      <div class="bg-white shadow-md p-4 flex justify-center items-center space-x-4 border-t border-gray-200">
        <!-- Previous Button -->
        <button @click="prevPage" :disabled="currentPage === 1" class="pagination-button" aria-label="Previous Page">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        
        <!-- Page Numbers -->
        <template v-if="totalPages > 1">
          <!-- Show first page and ellipses if needed -->
          <button v-if="currentPage > 1" @click="changePage(1)" class="pagination-button">1</button>
          <template v-if="currentPage > 3">
            <span class="text-gray-600">...</span>
          </template>
  
          <!-- Page numbers around the current page -->
          <button v-for="page in visiblePages" :key="page" @click="changePage(page)" :class="['pagination-button', { 'bg-blue-500 text-white': page === currentPage }]">
            {{ page }}
          </button>
  
          <!-- Show ellipses and last page if needed -->
          <template v-if="currentPage < totalPages - 2">
            <span class="text-gray-600">...</span>
          </template>
          <button v-if="currentPage < totalPages" @click="changePage(totalPages)" class="pagination-button">{{ totalPages }}</button>
        </template>
        
        <!-- Next Button -->
        <button @click="nextPage" :disabled="currentPage === totalPages" class="pagination-button" aria-label="Next Page">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, computed } from 'vue';
  
  export default {
    setup() {
      const requests = ref([
        { id: 1, name: 'John Doe', details: 'Request details here...' },
        { id: 2, name: 'Jane Smith', details: 'Another request details here...' },
        { id: 3, name: 'Michael Johnson', details: 'Yet another request details here...' },
        { id: 4, name: 'Emily Davis', details: 'More request details here...' },
        { id: 5, name: 'Sarah Wilson', details: 'Additional request details here...' },
        { id: 6, name: 'Chris Lee', details: 'Extra request details here...' },
        { id: 1, name: 'John Doe', details: 'Request details here...' },
        { id: 2, name: 'Jane Smith', details: 'Another request details here...' },
        { id: 3, name: 'Michael Johnson', details: 'Yet another request details here...' },
        { id: 4, name: 'Emily Davis', details: 'More request details here...' },
        { id: 5, name: 'Sarah Wilson', details: 'Additional request details here...' },
        { id: 6, name: 'Chris Lee', details: 'Extra request details here...' },
      ]);
  
      const itemsPerPage = 5;
      const currentPage = ref(1);
  
      const totalPages = computed(() => Math.ceil(requests.value.length / itemsPerPage));
  
      const paginatedRequests = computed(() => {
        const start = (currentPage.value - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        return requests.value.slice(start, end);
      });
  
      const visiblePages = computed(() => {
        const pages = [];
        const total = totalPages.value;
        const current = currentPage.value;
  
        // Show at most 5 pages at a time
        let startPage = Math.max(1, current - 2);
        let endPage = Math.min(total, current + 2);
  
        for (let i = startPage; i <= endPage; i++) {
          pages.push(i);
        }
  
        // Prevent duplicate pages
        return [...new Set(pages)];
      });
  
      const prevPage = () => {
        if (currentPage.value > 1) {
          currentPage.value--;
        }
      };
  
      const nextPage = () => {
        if (currentPage.value < totalPages.value) {
          currentPage.value++;
        }
      };
  
      const changePage = (page) => {
        if (page === '...') return;
        currentPage.value = Number(page);
      };
  
      const handleApprove = (id) => {
        console.log(`Request ${id} approved`);
        // Implement actual approval logic here
      };
  
      const handleReject = (id) => {
        console.log(`Request ${id} rejected`);
        // Implement actual rejection logic here
      };
  
      return {
        requests,
        paginatedRequests,
        currentPage,
        totalPages,
        visiblePages,
        prevPage,
        nextPage,
        changePage,
        handleApprove,
        handleReject,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Improved styling for pagination controls */
  .pagination-button {
    background-color: #f0f0f0;
    color: #333;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  
  .pagination-button:hover {
    background-color: #e0e0e0;
  }
  
  .pagination-button:disabled {
    background-color: #d0d0d0;
    color: #888;
    cursor: not-allowed;
    box-shadow: none;
  }
  
  .pagination-controls {
    border-top: 1px solid #e0e0e0;
  }
  
  .pagination-button.bg-blue-500 {
    background-color: #3b82f6;
    color: white;
  }
  
  .pagination-button.bg-blue-500:hover {
    background-color: #2563eb;
  }
  </style>
  