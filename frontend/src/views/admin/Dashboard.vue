<template>
  <div>
    <div class="flex flex-wrap">
      <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
        <card-line-chart />
      </div>
      <div class="w-full xl:w-4/12 px-4">
        <card-bar-chart />
      </div>
    </div>
    <div class="flex flex-wrap mt-4">
      <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
        <card-page-visits />
      </div>
      <div class="w-full xl:w-4/12 px-4">
        <card-social-traffic />
      </div>
    </div>
  </div>
</template>
<script>
import CardLineChart from "@/components/Cards/CardLineChart.vue";
import CardBarChart from "@/components/Cards/CardBarChart.vue";
import CardPageVisits from "@/components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/components/Cards/CardSocialTraffic.vue";
import {ref, onMounted} from 'vue'
import axios from "axios";
export default {
  name: "dashboard-page",
  components: {
    CardLineChart,
    CardBarChart,
    CardPageVisits,
    CardSocialTraffic,
  },
  setup() {
    const user =ref()
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
        // Log the response data
        user.value = response.data.data
        localStorage.setItem('userAuth',response.data.data);
      } catch (error) {
        // Handle any errors that occur during the request
        console.error('Error fetching data:', error);
      }
    });
    return {
      user,
      
    }
  }
};
</script>
