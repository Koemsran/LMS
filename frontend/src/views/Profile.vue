<template>
  <div>
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100 right">
      <admin-navbar class="bg-green-600 shadow-md" />
      <div class="px-4 md:px-10 mx-auto w-full app">
        <main class="profile-page">
          <section class="relative mt-10">
            <div class="container mx-auto" style="padding: 5px 70px;">
              <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg ">
                <div class="px-6">
                  <div class="flex flex-wrap justify-center">
                    <div class="w-full lg:w-3/12 px-4 lg:order-2 flex flex-col items-center">
                      <div class="relative">
                        <img v-if="user.profile" :alt="user.name + ' Profile Picture'" :src="user.profile"
                          class="profile-img" />
                        <img v-else :alt="user.name + ' Default Profile Picture'" :src="user.def_rofile"
                          class="profile-img" />
                      </div>
                      <div class="relative mt-3">
                        <label for="profile-upload"
                          class="cursor-pointer flex items-center justify-center text-blueGray-600">
                          <i class="fas fa-camera text-lg mr-2"></i> Upload New Profile
                        </label>
                        <input id="profile-upload" type="file" class="hidden" accept="image/*"
                          @change="updateProfileImage">
                      </div>
                    </div>
                  </div>
                  <div class="text-center" style="margin-top: 20px; padding-bottom: 20px;">
                    <form action="/your-action-url" method="POST" class="space-y-4">
                      <div class="mb-4">
                        <label for="name" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-user mr-2 text-lg text-blueGray-400"></i>
                          Name
                        </label>
                        <input type="text" id="name" name="name" class="w-full p-2 border rounded-md"
                          placeholder="Enter user name" v-model="user.name" required>
                      </div>

                      <div class="mb-4">
                        <label for="email" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-envelope mr-2 text-lg text-blueGray-400"></i>
                          Email
                        </label>
                        <input type="email" id="email" name="email" class="w-full p-2 border rounded-md"
                          placeholder="Enter user email" v-model="user.email" required>
                      </div>

                      <div class="mb-4">
                        <label for="leave_balance" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-wallet mr-2 text-lg text-blueGray-400"></i>
                          Leave Balance
                        </label>
                        <input type="text" id="leave_balance" name="leave_balance" disabled
                          class="w-full p-2 border rounded-md" placeholder="Enter leave balance"
                          v-model="user.leave_balance" required>
                      </div>

                      <div class="mb-4">
                        <label for="department" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-building mr-2 text-lg text-blueGray-400"></i>
                          Department
                        </label>
                        <input type="text" id="department" name="department" disabled v-model="user.department"
                          class="w-full p-2 border rounded-md" placeholder="Enter department" required>
                      </div>

                      <div class="mb-4">
                        <label for="role" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-user-tag mr-2 text-lg text-blueGray-400"></i>
                          Role
                        </label>
                        <input type="text" id="role" name="role" disabled v-model="user.role"
                          class="w-full p-2 border rounded-md" placeholder="Enter role" required>
                      </div>

                      <button type="submit" class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-md mr-2">
                        Save
                      </button>
                      <router-link to="/admin/dashboard">
                        <button type="button" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md">
                          Cancel
                        </button>
                      </router-link>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import axios from "axios";
import defProfile from '../assets/img/def-logo.png';
import { ref, onMounted } from 'vue';

export default {
  components: {
    AdminNavbar,
    Sidebar,
  },
  setup() {
    const user = ref({
      name: '',
      email: '',
      department: '',
      role: '',
      leave_balance: '',
      profile: '',
      def_rofile: defProfile
    });

    onMounted(async () => {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get('http://127.0.0.1:8000/api/me', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        user.value = {
          ...user.value,
          ...response.data.data,
          profile: response.data.data.profile
            ? `http://127.0.0.1:8000/storage/${response.data.data.profile}`
            : defProfile
        };
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    });

    function updateProfileImage(event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          user.value.profile = e.target.result; // Update profile image URL
        };
        reader.readAsDataURL(file);
      }
    }

    return {
      user,
      updateProfileImage
    };
  }
};
</script>
<style scoped>
.profile-img {
  margin-top: -80px;
  width: 250px;
  /* Fixed width */
  height: 180px;
  /* Fixed height */
  object-fit: cover;
  /* Ensures the image covers the area without stretching */
  border-radius: 50%;
  /* Makes the image circular */
  border: 2px solid #e2e8f0;
  /* Optional: Adds a border around the image */
}
</style>