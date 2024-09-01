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
                        <img id="profile" alt="Profile Picture" :src="profile"
                          class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px" />
                      </div>
                      <div class="relative" style="margin-top: 95px;">
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
                      <div class="mb-4 ">
                        <label for="name" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-user mr-2 text-lg text-blueGray-400"></i>
                          Name
                        </label>
                        <input type="text" id="name" name="name" class="w-full p-2 border rounded-md"
                          placeholder="Enter user name" :value="name" required>
                      </div>

                      <div class="mb-4">
                        <label for="email" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-envelope mr-2 text-lg text-blueGray-400"></i>
                          Email
                        </label>
                        <input type="email" id="email" name="email" :value="email" class="w-full p-2 border rounded-md"
                          placeholder="Enter user email" required>
                      </div>

                      <div class="mb-4">
                        <label for="department" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-building mr-2 text-lg text-blueGray-400"></i>
                          Department
                        </label>
                        <input type="text" id="department" disabled name="department" :value="department"
                          class="w-full p-2 border rounded-md" placeholder="Enter department" required>
                      </div>

                      <div class="mb-4">
                        <label for="role" class="block text-blueGray-700 font-bold mb-2 flex flex-start">
                          <i class="fas fa-user-tag mr-2 text-lg text-blueGray-400"></i>
                          Role
                        </label>
                        <input type="text" id="role" name="role" disabled :value="role" class="w-full p-2 border rounded-md"
                          placeholder="Enter role" required>
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
import team1 from "../assets/img/me.jpg";
export default {
  data() {
    return {
      name: "Koemsran PHON",
      profile: team1,
      email: "koemsran@gmail.com",
      department: "IT Department",
      role: "Manager",
    };
  },
  components: {
    AdminNavbar,
    Sidebar,
  },
  methods: {
    updateProfileImage(event) {
      const profile = document.getElementById('profile');
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          profile.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
  }
};

</script>
