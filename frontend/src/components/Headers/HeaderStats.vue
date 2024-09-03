<template>
  <!-- Header -->
  <div class="relative bg-emerald-600 md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats :statSubtitle="stats.managers.subtitle" :statTitle="stats.managers.title"
              :statArrow="stats.managers.arrow" :statPercent="stats.managers.percent"
              :statPercentColor="stats.managers.percentColor" :statDescripiron="stats.managers.description"
              :statIconName="getIcon('MANAGERS')" :statIconColor="stats.managers.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats :statSubtitle="stats.employees.subtitle" :statTitle="stats.employees.title"
              :statArrow="stats.employees.arrow" :statPercent="stats.employees.percent"
              :statPercentColor="stats.employees.percentColor" :statDescripiron="stats.employees.description"
              :statIconName="getIcon('EMPLOYEES')" :statIconColor="stats.employees.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats :statSubtitle="stats.leaveType.subtitle" :statTitle="stats.leaveType.title"
              :statArrow="stats.leaveType.arrow" :statPercent="stats.leaveType.percent"
              :statPercentColor="stats.leaveType.percentColor" :statDescripiron="stats.leaveType.description"
              :statIconName="getIcon('LEAVE TYPE')" :statIconColor="stats.leaveType.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats :statSubtitle="stats.department.subtitle" :statTitle="stats.department.title"
              :statArrow="stats.department.arrow" :statPercent="stats.department.percent"
              :statPercentColor="stats.department.percentColor" :statDescripiron="stats.department.description"
              :statIconName="getIcon('DEPARTMENT')" :statIconColor="stats.department.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-5">
            <card-stats :statSubtitle="stats.approved.subtitle" :statTitle="stats.approved.title"
              :statArrow="stats.approved.arrow" :statPercent="stats.approved.percent"
              :statPercentColor="stats.approved.percentColor" :statDescripiron="stats.approved.description"
              :statIconName="getIcon('APPROVED')" :statIconColor="stats.approved.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-5">
            <card-stats :statSubtitle="stats.requested.subtitle" :statTitle="stats.requested.title"
              :statArrow="stats.requested.arrow" :statPercent="stats.requested.percent"
              :statPercentColor="stats.requested.percentColor" :statDescripiron="stats.requested.description"
              :statIconName="getIcon('REQUESTED')" :statIconColor="stats.requested.iconColor" />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-5">
            <card-stats :statSubtitle="stats.rejected.subtitle" :statTitle="stats.rejected.title"
              :statArrow="stats.rejected.arrow" :statPercent="stats.rejected.percent"
              :statPercentColor="stats.rejected.percentColor" :statDescripiron="stats.rejected.description"
              :statIconName="getIcon('REJECTED')" :statIconColor="stats.rejected.iconColor" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CardStats from "@/components/Cards/CardStats.vue";
import axios from "axios";

export default {
  components: {
    CardStats,
  },
  data() {
    return {
      departments: [],
      users: [],
      leaveTypes: [],
      leaves: [],
      stats: {
        managers: {
          subtitle: "MANAGERS",
          title: "350,897", // Placeholder, will be updated dynamically
          arrow: "up",
          percent: "3.48",
          percentColor: "text-emerald-500",
          description: "Since last month",
          iconColor: "bg-red-500",
        },
        employees: {
          subtitle: "EMPLOYEES",
          title: "0", // Placeholder, will be updated dynamically
          arrow: "up",
          percent: "3.48",
          percentColor: "text-emerald-500",
          description: "Since last month",
          iconColor: "bg-red-500",
        },
        leaveType: {
          subtitle: "LEAVE TYPE",
          title: "0",
          arrow: "down",
          percent: "3.48",
          percentColor: "text-red-500",
          description: "Since last week",
          iconColor: "bg-orange-500",
        },
        department: {
          subtitle: "DEPARTMENT",
          title: "0", // Placeholder, will be updated dynamically
          arrow: "down",
          percent: "1.10",
          percentColor: "text-orange-500",
          description: "Since yesterday",
          iconColor: "bg-pink-500",
        },
        approved: {
          subtitle: "APPROVED",
          title: "0", // Placeholder, will be updated dynamically
          arrow: "up",
          percent: "12",
          percentColor: "text-emerald-500",
          description: "Since last month",
          iconColor: "bg-emerald-500",
        },
        requested: {
          subtitle: "REQUESTED",
          title: "0", // Placeholder, will be updated dynamically
          arrow: "up",
          percent: "12",
          percentColor: "text-emerald-500",
          description: "Since last month",
          iconColor: "bg-emerald-500",
        },
        rejected: {
          subtitle: "REJECTED",
          title: "0", // Placeholder, will be updated dynamically
          arrow: "up",
          percent: "12",
          percentColor: "text-emerald-500",
          description: "Since last month",
          iconColor: "bg-red-500",
        },
      },
    };
  },
  mounted() {
    this.fetchDepartments();
    this.fetchUsers();
    this.fetchLeaveTypes();
    this.fetchLeaveRequest();
  },
  methods: {
    getIcon(statSubtitle) {
      switch (statSubtitle) {
        case 'MANAGERS':
          return 'fas fa-users';
        case 'EMPLOYEES':
          return 'fas fa-user';
        case 'LEAVE TYPE':
          return 'fas fa-calendar-alt';
        case 'DEPARTMENT':
          return 'fas fa-building';
        case 'APPROVED':
          return 'fas fa-check';
        case 'REQUESTED':
          return 'fas fa-clock';
        case 'REJECTED':
          return 'fas fa-times';
        default:
          return 'fas fa-info-circle';
      }
    },
    async fetchDepartments() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/departements/list');
        this.departments = response.data.data;
        this.stats.department.title = this.departments.length;
      } catch (error) {
        console.error('Error fetching departments:', error);
      }
    },
    async fetchUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users/list');
        this.users = response.data.data;
        this.stats.employees.title = this.users.length;
        this.stats.managers.title = this.users.length; // Assuming managers count is same as users count
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async fetchLeaveTypes() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/type-leave/list');
        this.leaveTypes = response.data.data;
        this.stats.leaveType.title = this.leaveTypes.length;
      } catch (error) {
        console.error('Error fetching type of leave:', error);
      }
    },
    async fetchLeaveRequest() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/leaves/list');
        this.leaves = response.data.data;

        // Update requested leave count
        this.stats.requested.title = this.leaves.length;

        // Count and update approved and rejected leave counts
        const approvedCount = this.leaves.filter(leave => leave.status === 'approved').length;
        const rejectedCount = this.leaves.filter(leave => leave.status === 'rejected').length;

        this.stats.approved.title = approvedCount;
        this.stats.rejected.title = rejectedCount;
      } catch (error) {
        console.error('Error fetching leaves:', error);
      }
    },
  },
};
</script>
