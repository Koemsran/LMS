<template>
  <div>
    <a class="text-blueGray-500 py-1 px-3" href="#pablo" ref="btnDropdownRef" v-on:click="toggleDropdown($event)">
      <i class="fas fa-ellipsis-v"></i>
    </a>
    <div ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }">
      <button @click="approvedStatus(1)"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-emerald-500 text-bold">
        Approve
      </button>
      <button @click="rejectedStatus(1)"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-red-500 text-bold">
        Reject
      </button>
      <button @click="deletedStatus(1)"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-red-500 text-bold">
        Delete
      </button>
    </div>
  </div>
</template>
<script>
import { createPopper } from "@popperjs/core";
import axios from "axios";
export default {
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
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

      } catch (error) {
        console.error('Error updating leave status to approve: ', error);
      }
    },
    async rejectedStatus(id) {
      try {
        await axios.post(`http://127.0.0.1:8000/api/leave/reject/${id}`);

      } catch (error) {
        console.error('Error updating leave status to reject:', error);
      }
    },
    async deletedStatus(id) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/leave/delete/${id}`);
      } catch (error) {
        console.error('Error updating leave status to cancel:', error);
      }
    }
  },
};
</script>
