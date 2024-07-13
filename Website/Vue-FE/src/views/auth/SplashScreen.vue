<!-- SplashScreen.vue -->
<template>
      <NavbarComponent />
      <!-- Konten lainnya -->
      <div class="container">
      <div class="splash-content">
      <div class="text-content">
      <h1>Browse. Apply. <br/>Prepare Your Future</h1>
      <p>Cari pekerjaan impian dengan cepat dan mudah <br/>bersama Karir Gemilang!</p>
      <button class="cta-button">Cari kerja sekarang!</button> </div>
      <div class="splash-image">
      <img src="@/assets/orang.png" alt="Splash Screen Image">
      </div>
    </div>
      </div>
      <div class="background">
        <img src="@/assets/Vector.png" alt="background Image"> 
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

.container {
  align-items: center;
  margin-left: 20px;
  margin-right: 20px;
  justify-content: flex-end;
  margin-top: 150px;
  
}
.splash-content {
  align-items: center;
  width: 100%;
  display: flex;
  column-gap: 5px;
  
}

.text-content {
  text-align: left;
}

.text-content h1 {
  font-size: 64px;
  font-weight: bold;
  margin-bottom: 20px;
}

.text-content p {
  font-size: 24px;
  margin-bottom: 20px;
}

.cta-button {
  background-color: #FFD700; /* Adjust the color as needed */
  color: #000;
  padding: 10px 20px;
  font-size: 24px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.splash-image {
  flex-shrink: 0;
  position: relative;
  width: 500px;
  background-size: cover;
  z-index: 6;
  padding-left: 250px;
  padding-top: 50px;
}



.background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.background img {
  width: 100%;
  height: auto;
}
  </style>
  