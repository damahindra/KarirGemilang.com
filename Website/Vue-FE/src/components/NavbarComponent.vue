<!-- Navbar.vue -->
<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-secondary sticky-top">
      <div class="container-fluid mt-2 mb-2">
        <!-- Logo -->
        <router-link class="ms-4" :to="{ name: 'karir.splash' }">
          <img src="@/assets/karirgemilang-logo.svg" height="32" alt="Logo">
        </router-link>
        
        <div class="d-flex me-4">
          <!-- Navbar items -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Links -->
            <ul class="navbar-nav">
              <!-- Link home -->
              <li class="nav-item ms-4">
                <router-link v-if="user && user.user_id" class="nav-link" :to="{ name: 'karir.home'}">Explore Jobs</router-link>
                <router-link v-if="user && user.employer_id" class="nav-link" :to="{ name: 'employer.home'}">Your Jobs</router-link>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="/about">About</a>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="/contact">Contact Us</a>
              </li>
              <li class="nav-item ms-4" v-if="user && user.user_id">
                <router-link class="text-decoration-none nav-link" :to="{ name: 'karir.user', params: { id: user.user_id } }">Hi, {{ user.fullname }}</router-link>
              </li>
              <li class="nav-item ms-4" v-else-if="user && user.employer_id">
                <router-link class="text-decoration-none nav-link" :to="{ name: 'karir.employer', params: { id: user.employer_id } }">Hi, {{ user.fullname }}</router-link>
              </li>
            </ul>
            <!-- Tombol login dan signup -->
            <div class="d-flex ms-4" v-if="!user">
              <router-link class="btn btn-outline-primary me-2" :to="{ name: 'karir.roles.login' }">Sign In</router-link>
              <router-link class="btn btn-primary" :to="{ name: 'karir.roles'}">Signup</router-link>
            </div>
          
          </div>
      </div>
    </div>
    </nav>
  </template>
  
  <script>
  import { onMounted, ref } from 'vue';
  export default {
    setup() {
      const user = ref(null);
      
      onMounted(() => {
      const userData = localStorage.getItem('user');
      if (userData) {
        user.value = JSON.parse(userData); // Parse JSON string to object
      }
    });
      //return
      return {
          user,
      }
    }
  }
  </script>
  
  <style scoped>
.btn-outline-primary {
  color: #000;
  border-color: #FFE767;
  background-color: transparent;
}

.btn-primary {
  color: #000;
  background-color: #FFE767;
  border-color: #FFE767;
}
  </style>
  