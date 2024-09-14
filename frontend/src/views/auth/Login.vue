<template>
  <div class="container mx-auto px-4 mt-32">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
          <div class="btn-wrapper text-center flex align-items-center justify-center mt-5">
            <img width="200" height="150" src="../../assets/img/logo6.png" alt="logo">
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form @submit.prevent="submitLogin">
              <div class="relative w-full mb-3 mt-5">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="email">Email</label>
                <input type="email" v-model="form.email" id="email"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Email" />
                <!-- Display email error if it exists -->
                <p v-if="emailError" class="text-red-500">{{ emailError }}</p>
              </div>

              <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="password">Password</label>
                <input type="password" v-model="form.password" id="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password" />
                <!-- Display password error if it exists -->
                <p v-if="passwordError" class="text-red-500">{{ passwordError }}</p>
              </div>
              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input id="customCheckLogin" type="checkbox"
                    class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150" />
                  <span class="ml-2 text-sm font-semibold text-blueGray-600">Remember me</span>
                </label>
              </div>
              <div class="text-center mt-6">
                <button
                  class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="submit">Login</button>
              </div>
            </form>
          </div>
        </div>
        <div class="flex flex-wrap mt-6 relative">
          <div class="w-1/2">
            <a href="javascript:void(0)" class="text-blueGray-200"><small>Forgot password?</small></a>
          </div>
          <div class="w-1/2 text-right">
            <router-link to="/auth/register" class="text-blueGray-200"><small>Create new account</small></router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth-store'; // Adjust the path if necessary

export default {
  setup() {
    const router = useRouter();
    const authStore = useAuthStore(); // Access the auth store

    const emailError = ref('');
    const passwordError = ref('');
    const form = ref({
      email: '',
      password: '',
    });

    const submitLogin = async () => {
      emailError.value = ''; // Reset errors
      passwordError.value = '';

      try {
        // Call the login action from the auth store
        await authStore.login({
          email: form.value.email,
          password: form.value.password,
        });

        // Redirect based on roles or authentication
        if (authStore.user && authStore.user.roles.includes('Staff')) {
          router.push('/admin/leaves');
        } else {
          router.push('/');
        }
      } catch (error) {
        // Handle specific error messages
        if (error.response && error.response.status === 401) {
          const message = error.response.data.message || '';
          if (message.includes('User not found')) {
            emailError.value = 'User not found';
          } else if (message.includes('Incorrect password')) {
            passwordError.value = 'Password is not correct';
          } else {
            console.warn('Error:', error);
          }
        } else {
          console.warn('Error:', error);
        }
      }
    };

    return {
      form,
      submitLogin,
      emailError,
      passwordError,
    };
  }
};
</script>
