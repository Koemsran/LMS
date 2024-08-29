import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";

// styles

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";
// mouting point for the whole app

import App from "@/App.vue";

// layouts

import Admin from "@/layouts/Admin.vue";
import Auth from "@/layouts/Auth.vue";

// views for Admin layout

import Dashboard from "@/views/admin/Dashboard.vue";
import Settings from "@/views/admin/Settings.vue";
import Tables from "@/views/admin/Tables.vue";
import Approvals from "@/views/admin/Approvals.vue";
import Leaves from "@/views/admin/Leaves.vue";
import LeaveTypes from "@/views/admin/LeaveTypes.vue";
import LeaveBalances from "@/views/admin/LeaveBalances.vue";
import Departments from "@/views/admin/Departments.vue";
import Reports from "@/views/admin/Reports.vue";
import Calendars from "@/views/admin/Calendars.vue";
import Roles from "@/views/admin/Roles.vue";
import Permissions from "@/views/admin/Permissions.vue";

// views for Auth layout

import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";

// views without layouts

import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";
import Index from "@/views/Index.vue";

// routes

const routes = [
  {
    path: "/admin",
    redirect: "/admin/dashboard",
    component: Admin,
    children: [
      {
        path: "/admin/dashboard",
        component: Dashboard,
      },
      {
        path: "/admin/settings",
        component: Settings,
      },
      {
        path: "/admin/tables",
        component: Tables,
      }
    ],
  },
  {
    path: "/auth",
    redirect: "/auth/login",
    component: Auth,
    children: [
      {
        path: "/auth/login",
        component: Login,
      },
      {
        path: "/auth/register",
        component: Register,
      },
    ],
  },

  {
    path: "/admin/approvals",
    component: Approvals,
  },
  {
    path: "/admin/leave-types",
    component: LeaveTypes,
  },
  {
    path: "/admin/leaves",
    component: Leaves,
  },
  {
    path: "/admin/leave-balance",
    component: LeaveBalances,
  },
  {
    path: "/admin/reports",
    component: Reports,
  },
  {
    path: "/admin/departments",
    component: Departments,
  },
  {
    path: "/admin/calendars",
    component: Calendars,
  },
  {
    path: "/admin/roles",
    component: Roles,
  },
  {
    path: "/admin/permissions",
    component: Permissions,
  },
  {
    path: "/landing",
    component: Landing,
  },
  {
    path: "/profile",
    component: Profile,
  },
  {
    path: "/",
    component: Index,
  },
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(router).mount("#app");
