<template>
  <nav
    class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div
      class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
      <!-- Toggler -->
      <button
        class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
        type="button" v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')">
        <i class="fas fa-bars"></i>
      </button>
      <!-- Brand -->
      <router-link
        class="md:block text-left text-blueGray-600 inline-block text-sm uppercase font-bold py-0 flex items-center justify-center mx-auto"
        to="/admin/dashboard">
        <img width="170" height="160" src="../../assets/img/logo5.png" alt="" class="mx-auto">
      </router-link>

      <!-- User -->
      <ul class="md:hidden items-center flex flex-wrap list-none">
        <li class="inline-block relative">
          <notification-dropdown />
        </li>
        <li class="inline-block relative">
          <user-dropdown />
        </li>
      </ul>
      <!-- Collapse -->
      <div
        class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
        v-bind:class="collapseShow">
        <!-- Collapse header -->
        <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
          <div class="flex flex-wrap">
            <div class="w-6/12">
              <router-link
                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                to="/admin/dashboard">
                Vue Notus
              </router-link>
            </div>
            <div class="w-6/12 flex justify-end">
              <button type="button"
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                v-on:click="toggleCollapseShow('hidden')">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-6 mb-4 md:hidden">
          <div class="mb-3 pt-0">
            <input type="text" placeholder="Search"
              class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal" />
          </div>
        </form>
        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
          User Layout Pages
        </h6>
        <!-- Navigation -->

        <ul class="md:flex-col md:min-w-full flex flex-col list-none" v-if="admin">
          <li class="items-center">
            <router-link to="/admin/dashboard" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-tachometer-alt mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Dashboard
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/approvals" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-check-circle mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Approval
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/departments" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-cogs mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Department
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/subordinates" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-users mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Subordinates
              </a>
            </router-link>
          </li>


          <li class="items-center">
            <router-link to="/admin/leave-types" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clipboard-list mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Type
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/leaves" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clipboard-check mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Management
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/leave-balance" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-check mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Balance
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/histories" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clock mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                History
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/calendars" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-alt mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Calendar
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/reports" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-chart-line mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Report
              </a>
            </router-link>
          </li>
        </ul>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none" v-if="manager">
          <li class="items-center">
            <router-link to="/admin/dashboard" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-tachometer-alt mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Dashboard
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/approvals" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-check-circle mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Approval
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/subordinates" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-users mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Subordinates
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/leave-types" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clipboard-list mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Type
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/leave-balance" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-check mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Balance
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/histories" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clock mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                History
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/calendars" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-alt mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Calendar
              </a>
            </router-link>
          </li>
        </ul>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none" v-if="staff">
          <li class="items-center">
            <router-link to="/admin/leaves" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clipboard-check mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Management
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/leave-balance-detail" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-check mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Leave Balance
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/histories" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-clock mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                History
              </a>
            </router-link>
          </li>

          <li class="items-center">
            <router-link to="/admin/calendars" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-calendar-alt mr-2 text-sm"
                  :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Calendar
              </a>
            </router-link>
          </li>
          <li class="items-center">
            <router-link to="/admin/reports" v-slot="{ href, navigate, isActive }">
              <a :href="href" @click="navigate" class="text-xs uppercase py-3 font-bold block" :class="[
                isActive
                  ? 'text-emerald-500 hover:text-emerald-600'
                  : 'text-blueGray-700 hover:text-blueGray-500',
              ]">
                <i class="fas fa-chart-line mr-2 text-sm" :class="[isActive ? 'opacity-75' : 'text-blueGray-300']"></i>
                Report
              </a>
            </router-link>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6 v-if="admin"
          class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
          Admin Pages
        </h6>
        <!-- Navigation -->

        <ul v-if="admin" class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
          <li class="items-center">
            <router-link class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
              to="/admin/users">
              <i class="fas fa-user text-blueGray-300 mr-2 text-sm"></i>
              Users
            </router-link>
          </li>
          <li class="items-center">
            <router-link class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
              to="/admin/roles">
              <i class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"></i>
              Roles
            </router-link>
          </li>

          <li class="items-center">
            <router-link class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
              to="/admin/permissions">
              <i class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"></i>
              Permission
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
); }

<script>
import NotificationDropdown from "@/components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";
import { useAuthStore } from '@/stores/auth-store';
import { computed } from 'vue';

export default {
  data() {
    return {
      collapseShow: "hidden",
    };
  },
  setup() {
    const authStore = useAuthStore(); // Access the auth store

    const user = computed(() => authStore.user);

    const admin = computed(() => {
      if (Array.isArray(user.value.roles)) {
        for (const role of user.value.roles) {
          if (role.name === 'Admin') {
            return true; // Return true if an 'Admin' role is found
          }
        }
      }
      return false; // Return false if no 'Admin' role is found
    });

    const staff = computed(() => {
      if (Array.isArray(user.value.roles)) {
        for (const role of user.value.roles) {
          if (role.name === 'Staff') {
            return true; // Return true if a 'Staff' role is found
          }
        }
      }
      return false; // Return false if no 'Staff' role is found
    });

    const manager = computed(() => {
      if (Array.isArray(user.value.roles)) {
        for (const role of user.value.roles) {
          if (role.name === 'Manager') {
            return true; // Return true if a 'Manager' role is found
          }
        }
      }
      return false; // Return false if no 'Manager' role is found
    });

    return {
      user,
      admin,
      staff,
      manager,
    };
  },
  methods: {
    toggleCollapseShow(classes) {
      this.collapseShow = classes;
    },
  },
  components: {
    NotificationDropdown,
    UserDropdown,
  },
};
</script>
