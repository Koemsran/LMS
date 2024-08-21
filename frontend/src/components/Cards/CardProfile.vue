<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16"
  >
    <div class="px-6">
      <div class="flex flex-wrap justify-center">
        <div class="w-full px-4 flex justify-center">
          <div class="relative">
            <img
              alt="..."
              src="../../assets/img/me.jpg"
              class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
            />
          </div>
        </div>
        <div class="w-full px-4 text-center mt-20">
          
        </div>
      </div>
      <div class="text-center mt-5">
        <h3
          class="text-xl font-semibold leading-normal text-blueGray-700 mb-2"
        >
          Koemsran Phon
        </h3>
        <div
          class="text-sm leading-normal mt-0 text-blueGray-400 font-bold uppercase"
        >
          <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400  mb-2"></i>
          KPC
        </div>
        <div class=" text-blueGray-600 mt-5">
          <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400  mb-2"></i>
          Web Developer
        </div>
        <div class="mb-2 text-blueGray-600">
          <i class="fas fa-university mr-2 text-lg text-blueGray-400  mb-2"></i>
          Passerellesnumeriques of Cambodia
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import team2 from "@/assets/img/team-2-800x800.jpg";

export default {
  data() {
    return {
      team2,
    };
  },
};
</script>
