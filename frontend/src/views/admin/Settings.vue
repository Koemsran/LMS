<template>
  <div>
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100 right">
      <admin-navbar class="bg-green-600 shadow-md" />
      <div class="px-4 md:px-10 mx-auto w-full app">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-8/12 px-4">
            <CardSettings />
          </div>
          <div class="w-full lg:w-4/12 px-4">
            <CardProfile />
          </div>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import CardSettings from "@/components/Cards/CardSettings.vue";
import CardProfile from "@/components/Cards/CardProfile.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";

export default {
  components: {
    CardSettings,
    CardProfile,
    AdminNavbar,
    Sidebar,
  },
};
</script>
<style>
.right {
  display: flex;
  flex-direction: column;
  gap: 50px;
}

.app {
  margin-top: 90px
}
</style>