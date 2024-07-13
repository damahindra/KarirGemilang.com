<template>
  <NavbarComponent />
  <!-- Konten lainnya -->
  <div class="container">
    <h1 class="mt-4">Splash Screen Content</h1>
    <!-- Isi konten splash screen lainnya -->
    <div class="splash-image">
      <img src="../assets/orang.png" alt="Splash Screen Image">
    </div>
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
.splash-image {
  text-align: center;
  margin-top: 20px;
}

.splash-image img {
  max-width: 100%;
  height: auto;
}
</style>
