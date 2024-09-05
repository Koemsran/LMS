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
import AddPermission from "@/views/admin/AddPermission.vue";
import Subordinates from "@/views/admin/Subordinates.vue";
import Histories from "@/views/admin/Histories.vue";

//view for user layout 
import Users from "@/views/user/Users.vue";
import CreateUser from "@/views/user/CreateUser.vue";
import EditUser from "@/views/user/EditUser.vue";

// views for Auth layout

import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";

// views without layouts

import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";

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
        path: "/",
        component: Dashboard,
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
        path: "/auth/register",
        component: Register,
      },
    ],
  },
  {
    path: "/auth/login",
    component: Login,
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
    path: "/admin/subordinates",
    component: Subordinates,
  },
  {
    path: "/admin/histories",
    component: Histories,
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
    path: "/admin/users",
    component: Users,
  },
  {
    path: "/admin/create-user",
    component: CreateUser,
    name: 'AddUser',
    props: true
  },
  {
    path: "/admin/edit-user",
    component: EditUser,
    name: 'EditUser',
    props: true
  },
  {
    path: "/admin/permissions",
    component: Permissions,
  },
  {
    path: '/admin/add-permission',
    name: 'AddPermission',
    component: AddPermission,
    props: true
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
    path: "/admin/settings",
    component: Settings,
  },
  
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const publicRoutes = ['/auth/login', '/auth/register'];
  const isAuthenticated = localStorage.getItem('isAuthenticated') === 'true';

  if (publicRoutes.includes(to.path)) {
    next(); // Allow navigation to public routes
  } else if (isAuthenticated) {
    next(); // Allow navigation if authenticated
  } else {
    next('/auth/login'); // Redirect to login if not authenticated
  }
});
createApp(App).use(router).mount("#app");
