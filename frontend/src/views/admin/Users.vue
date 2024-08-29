<template>
    <div>
      <sidebar />
      <div class="relative md:ml-64 bg-blueGray-100 right">
        <admin-navbar class="bg-green-600 shadow-md"/>
        <div class="px-4 md:px-10 mx-auto w-full app">
          <UserCom />
        </div>
      </div>
    </div>
  </template>
  <script>
  import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
  import UserCom from "@/components/Admin/UserCom.vue";
  import Sidebar from "@/components/Sidebar/Sidebar.vue";
  export default {
    components: {
          AdminNavbar,
          UserCom,
          Sidebar,
    },
  };
  </script>
  <style>
  .right{
    display: flex;
    flex-direction: column;
    gap: 50px;
  }
  .app{
    margin-top:90px
  }
  </style>