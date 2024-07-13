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
            <ul class="navbar-nav me-4">
              <!-- Link home -->
              <li class="nav-item ms-4">
                <router-link class="nav-link" :to="{ name: 'karir.splash'}">Home</router-link>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="/home">About</a>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="/home">Jobs</a>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="/home">Contact Us</a>
              </li>
            </ul>
          
              <!-- Tombol login dan signup -->
              <div class="d-flex">
                <a class="btn btn-outline-primary me-2" href="#">Login</a>
                <router-link class="btn btn-primary" :to="{ name: 'karir.roles'}">Signup</router-link>
              </div>
          </div>
      </div>
    </div>
    </nav>
  </template>
  
  <script>
  export default {
    
  }
  </script>
  
  <style scoped>

  </style>
  