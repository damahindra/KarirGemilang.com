<template>
    <div class="splash-screen">
      <NavbarComponent />
      <div class="container">
        <h1>Selamat datang di platform lowongan kerja nomor #1 di Indonesia</h1>
        <p>Buat akun sebagai <i>job seeker</i> untuk melamar kerja, atau sebagai <i>employer</i> untuk membagikan lowongan kerja.</p>
        <div class="cards">
          <div class="card">
            <img src="./assets/job-seeker.png" alt="Job Seeker" />
            <h2>Job-Seeker</h2>
            <ul>
              <li>lorem ipsum</li>
              <li>lorem ipsum</li>
            </ul>
            <button>Sign up as Job-Seeker with email</button>
          </div>
          <div class="card">
            <img src="./assets/employer.png" alt="Employer" />
            <h2>Employer</h2>
            <ul>
              <li>lorem ipsum</li>
              <li>lorem ipsum</li>
            </ul>
            <button>Sign up as employer with email</button>
          </div>
        </div>
        <a href="#" class="back-link">Kembali</a>
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
  .splash-screen {
    text-align: center;
    padding: 20px;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
  }
  
  h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }
  
  p {
    font-size: 1.2rem;
    margin-bottom: 40px;
  }
  
  .cards {
    display: flex;
    justify-content: center;
    gap: 20px;
  }
  
  .card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    text-align: center;
  }
  
  .card img {
    width: 100px;
    height: 100px;
    margin-bottom: 20px;
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
    padding: 10px 20px;
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
    color: #ff00ff;
    text-decoration: none;
    font-weight: bold;
  }
  </style>
  