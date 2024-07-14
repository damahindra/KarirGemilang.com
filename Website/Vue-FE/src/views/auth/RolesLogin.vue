<template>
    <div class="splash-screen">
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container fade-in">
        <h1>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</h1>
        <p>Buat akun sebagai <i>job seeker</i> untuk melamar kerja, atau sebagai <i>employer</i> untuk membagikan lowongan kerja.</p>
        <div class="cards">
          <div class="card">
            <div class="d-flex flex-row">
              <div class="text-center"><img src="@/assets/job-seeker.svg" alt="Job Seeker" /></div>
              <div class="d-flex flex-column ms-3">
                <h2 class="fs-2 text-start mt-4">Job-Seeker</h2>
                <ul class="text-start text-secondary">
                  <li>Cari pekerjaan cepat dan mudah!</li>
                  <li>Lebih dari 500+ perusahaan terpercaya</li>
                </ul>
              </div>
            </div>
            <div class="text-center"><router-link :to="{ name: 'karir.signin' }"><button>Login as Job-Seeker with email</button></router-link></div>
          </div>
          <div class="card">
            <div class="d-flex flex-row">
              <div class="text-center"><img src="@/assets/employer.svg" alt="Employer" /></div>
              <div class="d-flex flex-column ms-3">
                <h2 class="fs-2 text-start mt-4">Employer</h2>
                <ul class="text-start text-secondary">
                  <li>Rekrut talenta cepat dan mudah!</li>
                  <li>Kelola lowongan anda dengan efektif</li>
                </ul>
              </div>
            </div>
            <div class="text-center"><router-link :to="{ name: 'employer.signin' }"><button>Login as Employer with email</button></router-link></div>
          </div>
        </div>
        <a href="/" class="back-link">Kembali</a>
      </div>
    </div>
  </template>
  
  <script>
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    }
  }
  </script>
  
  <style scoped>
  .splash-screen {
    text-align: center;
  }

  .job-seeker {
    width: 100px;
  }
  
  .container {
    height:100%;
    width:100%;
  }
  
  h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    margin-top: 50px;
  }
  
  p {
    font-size: 1.2rem;
    margin-bottom: 40px;
  }
  
  .cards {
    display: flex;
    justify-content: center;
    gap: 50px;
  }
  
  .card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    width: 500px;
    height: 270px;
    text-align: center;
  }
  
  .card img {
    width: 150px;
    margin-bottom: 10px;
  }
  
  .card h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
  }
  
  .card ul {
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
  }
  
  .card ul li {
    margin: 5px 0;
  }
  
  .card button {
    background-color: #ffe667;
    border: none;
    padding: 10px 100px;
    margin-top: 10px;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
  }
  
  .card button:hover {
    background-color: #ffd700;
  }
  
  .back-link {
    display: block;
    margin-top: 20px;
    color: primary;
    font-weight: bold;
    padding : 20px;
  }
  @keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.fade-in {
  animation: fadeIn 1s ease-in-out;
}
  </style>
  