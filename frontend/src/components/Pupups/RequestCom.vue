<template>
  <!-- Main modal -->
  <div id="crud-modal" v-if="isVisible" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-lg z-10">
        <div class="p-4 border-b">
          <h3 class="text-xl font-semibold">New Request</h3>
          <button class="absolute top-2 right-2" @click="closeModal">X</button>
        </div>
        <div class="p-4">
          <!-- Your form content here -->
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="type" class="form-label">Type</label>
              <select id="type" class="form-select">
                <option value="leave">Leave</option>
                <!-- Add more options as needed -->
              </select>
            </div>
            <div class="mb-3">
              <label for="dateFrom" class="form-label">Date From</label>
              <input type="date" class="form-control" id="dateFrom">
            </div>
            <div class="mb-3">
              <label for="dateTo" class="form-label">Date To</label>
              <input type="date" class="form-control" id="dateTo">
            </div>
            <div class="mb-3">
              <label for="reason" class="form-label">Reason (Optional)</label>
              <textarea class="form-control" id="reason" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="p-4 border-t">
          <button class="btn btn-primary" @click="submitRequest">Submit Request</button>
          <button class="btn btn-secondary" @click="closeModal">Close</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      isVisible: false
    };
  },
  methods: {
    openModal() {
      this.isVisible = true;
    },
    closeModal() {
      this.isVisible = false;
    },
    submitRequest() {
      // Handle form submission here
      this.closeModal();
    }
  }
};
</script>

<style scoped>
.btn {
  padding: 8px 16px;
  margin: 4px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn-primary {
  background-color: #007bff;
  color: white;
}

.btn-secondary {
  background-color: #6c757d;
  color: white;
}
</style>
