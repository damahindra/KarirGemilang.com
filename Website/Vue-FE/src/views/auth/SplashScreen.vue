<!-- SplashScreen.vue -->
<template>
      <NavbarComponent />
      <!-- Konten lainnya -->
      <div class="container">
        <h1 class="mt-4">Splash Screen Content</h1>
        <!-- Isi konten splash screen lainnya -->
      </div>
  </template>
  
  <script>
  import NavbarComponent from '@/views/auth/NavbarComponent.vue';
  
  export default {
    components: {
      NavbarComponent
    }
  }
  </script>
  
  <style scoped>
  /* Tambahkan styling tambahan untuk halaman splash screen */
  </style>
  