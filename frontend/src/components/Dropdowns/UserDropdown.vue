<template>
  <div>
    <a class="text-blueGray-500 block" href="#pablo" ref="btnDropdownRef" v-on:click="toggleDropdown($event)">
      <div class="items-center flex">
        <span class="profile-container inline-flex items-center justify-center rounded-full">
          <img v-if="user.profile" alt="Profile Picture" class="profile-img"
            :src="`http://127.0.0.1:8000/storage/${user.profile}`" />
          <img v-else alt="Default Profile Picture" class="profile-img" src="../../assets/img/def-logo.png" />
        </span>
      </div>
    </a>
    <div ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }">
      <a href="/profile"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
        <i class="fas fa-user mr-2"></i> My Account
      </a>
      <a @click="userLogout"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 cursor-pointer">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </a>
      <div class="h-0 my-2 border border-solid border-blueGray-100" />
      <a href="/admin/settings"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
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
import axios from 'axios';
import { ref, onMounted } from "vue";
import { useRouter } from 'vue-router';

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
  },
  setup() {
    const router = useRouter();
    const user = ref({
      name: '',
      email: '',
      department: '',
      role: '',
      leave_balance: '',
      profile: '',
    });

    onMounted(async () => {
      try {
        // Retrieve the token from localStorage or your preferred storage
        const token = localStorage.getItem('authToken');
        // Make the request with the token in the Authorization header
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        // Update the user object with response data
        user.value = {
          ...user.value,
          ...response.data.data
        };
      } catch (error) {
        // Handle any errors that occur during the request
        console.error('Error fetching data:', error);
      }
    });
    async function userLogout() {
      try {
        // Retrieve the token from localStorage
        const token = localStorage.getItem('authToken');

        // Make a POST request to the logout endpoint
        await axios.post('http://127.0.0.1:8000/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        // Clear the token from localStorage
        localStorage.setItem('isAuthenticated', 'false'); 
        localStorage.removeItem('authToken');
        // Redirect to login or home page
        router.push('/auth/login'); // Adjust the route based on your application

      } catch (error) {
        console.error('Error logging out:', error);
      }
    }
    return {
      user,
      userLogout
    };
  }
};
</script>

<style scoped>
.profile-container {
  width: 50px;
  /* Fixed width */
  height: 50px;
  /* Fixed height */
  background-color: #e2e8f0;
  /* Background color (optional) */
  border: 2px solid #e2e8f0;
  /* Border color to match background */
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  /* Makes the container circular */
  overflow: hidden;
  /* Ensures the image doesn't overflow the container */
}

.profile-img {
  width: 100%;
  /* Ensures the image takes up the full width of the container */
  height: 100%;
  /* Ensures the image takes up the full height of the container */
  object-fit: cover;
  /* Ensures the image covers the container without stretching */
}
</style>
