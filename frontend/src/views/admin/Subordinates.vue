<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-blueGray-100 right">
            <admin-navbar class="bg-green-600 shadow-md" />
            <div class="px-4 md:px-10 mx-auto w-full app">
                <SubordinateCom />
            </div>
        </div>
    </div>
</template>
<script>
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import SubordinateCom from "@/components/Contents/SubordinateCom.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
export default {
    components: {
        AdminNavbar,
        Sidebar,
        SubordinateCom,
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