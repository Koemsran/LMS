<template>
  <div>
    <a
      class="text-blueGray-500 block"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
        >
          <img
            alt="..."
            class="w-full rounded-full align-middle border shadow-lg"
            src="../../assets/img/me.jpg"
          />
        </span>
      </div>
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <a
        href="/profile"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
      >
        <i class="fas fa-user mr-2"></i> My Account
      </a>
      <a
        href="/auth/login"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
      >
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </a>
      <div class="h-0 my-2 border border-solid border-blueGray-100" />
      <a
        href="/admin/settings"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
      >
        <i class="fas fa-cog mr-2"></i> Account Setting
      </a>
    </div>
  </div>
</template>

<!-- Add Font Awesome CSS -->
<style scoped>
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css';
</style>

<script>
import { createPopper } from "@popperjs/core";

import image from "@/assets/img/team-1-800x800.jpg";

export default {
  data() {
    return {
      dropdownPopoverShow: false,
      image: image,
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
  },
};
</script>
