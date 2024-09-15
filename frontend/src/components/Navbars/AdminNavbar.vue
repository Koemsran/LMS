<template>
  <div>
    <!-- Navbar -->
    <nav
      class="bg-emerald-600 absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
      <div class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
        <!-- Brand -->
        <button @click="showPopup = true"
          class="text-white text-sm uppercase hidden lg:inline-block font-semibold bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
          <i class="fas fa-paper-plane mr-2"></i> New Request
        </button>
        <!-- Form -->
        <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
          <div class="relative flex w-full flex-wrap items-stretch">
            <span
              class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
              <i class="fas fa-search"></i>
            </span>
            <input type="text" placeholder="Search here..."
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
          </div>
        </form>
        <!-- User -->
        <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
          <user-dropdown />
        </ul>
      </div>
    </nav>

    <!-- Main Modal -->
    <div v-if="showPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-80">
      <div class="relative w-full max-w-lg bg-white rounded-lg shadow overflow-auto">
        <!-- Modal content -->
        <div class="relative p-4">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">
              New Request
            </h3>
            <button @click="showPopup = false" type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-5 h-5 inline-flex justify-center items-center">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4">
            <form @submit.prevent="submitForm">
              <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select id="type" v-model="form.type"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                  <option disabled value="">Select leave type</option>
                  <option v-for="leaveType in leaveTypes" :key="leaveType.id" :value="leaveType.id">
                    {{ leaveType.name }}
                  </option>
                </select>
              </div>
              <div class="mb-4">
                <label for="dateFrom" class="block text-sm font-medium text-gray-700">Date From</label>
                <input id="dateFrom" v-model="form.dateFrom" type="date"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div class="mb-4">
                <label for="dateTo" class="block text-sm font-medium text-gray-700">Date To</label>
                <input id="dateTo" v-model="form.dateTo" type="date"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div class="mb-4">
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                <input id="duration" disabled v-model="form.duration" type="text"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required />
              </div>
              <div class="mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason (optional)</label>
                <textarea id="reason" v-model="form.reason"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
              </div>
              <div class="flex justify-center">
                <button type="submit"
                  class="bg-emerald-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';
import UserDropdown from '@/components/Dropdowns/UserDropdown.vue';

export default {
  components: {
    UserDropdown,
  },
  setup() {
    const showPopup = ref(false);
    const userId = ref(null);
    const form = ref({
      duration: '', // Initially empty, will be calculated
      type: '', // Default to empty string
      dateFrom: '',
      dateTo: '',
      reason: '',
    });
    const leaveTypes = ref([]);

    const fetchTypes = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/type-leave/list');
        leaveTypes.value = response.data.data;

      } catch (error) {
        console.error('Error fetching leave types:', error);
      }
    };


    const calculateDuration = () => {
      if (form.value.dateFrom && form.value.dateTo) {
        const fromDate = new Date(form.value.dateFrom);
        const toDate = new Date(form.value.dateTo);

        if (fromDate > toDate) {
          form.value.dateTo = form.value.dateFrom; // Reset to avoid invalid range
          form.value.duration = ''; // Reset duration
        } else {
          const duration = Math.ceil((toDate - fromDate) / (1000 * 60 * 60 * 24)); // Duration in days
          form.value.duration = duration;
        }
      }
    };

    const validateDates = () => {
      const today = new Date().toISOString().split('T')[0]; // Current date in YYYY-MM-DD format
      let isValid = true;

      if (form.value.dateFrom < today) {
        alert('Date From cannot be earlier than today.');
        form.value.dateFrom = today; // Reset to today's date
        isValid = false;
      }
      if (form.value.dateTo < form.value.dateFrom) {
        alert('Date To cannot be earlier than Date From.');
        form.value.dateTo = form.value.dateFrom; // Reset to Date From
        isValid = false;
      }

      return isValid;
    };

    const submitForm = async () => {
      if (validateDates()) { // Validate dates before submission
        try {

          // Proceed with leave request if the duration is valid
          await axios.post('http://127.0.0.1:8000/api/leave/request', {
            user_id: userId.value,
            leave_type_id: form.value.type,
            date_from: form.value.dateFrom,
            date_to: form.value.dateTo,
            duration: form.value.duration,
            reason: form.value.reason
          });
          // await axios.post('http://127.0.0.1:8000/api/send-email', {
          //   user_id: userId.value,
          //   leave_type_id: form.value.type,
          //   date_from: form.value.dateFrom,
          // });

          // Update token_balance after successful leave request submission
          await axios.put(`http://127.0.0.1:8000/api/balance/update/${userId.value}`, {
            token_balance: form.value.duration
          })
            .then(response => {
              console.log('Token balance updated:', response.data);
            });

          // Clear the form after successful submission
          clearForm();
          showPopup.value = false;

        } catch (error) {
          console.error('Error submitting leave request:', error);
        }
      }
    };

    const clearForm = () => {
      form.value = {
        duration: '',
        type: '',
        dateFrom: '',
        dateTo: '',
        reason: '',
      };
    };

    // Fetch userId and leave types when component is mounted
    onMounted(async () => {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        userId.value = response.data.data.id;
        fetchTypes();
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    });

    // Watch dateFrom and dateTo to recalculate duration when they change
    watch([() => form.value.dateFrom, () => form.value.dateTo], calculateDuration);

    return {
      showPopup,
      userId,
      form,
      leaveTypes,
      calculateDuration,
      submitForm,
    };
  }
};
</script>

<style scoped>
/* Scoped styles here if needed */
</style>
