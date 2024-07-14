<template>
    <div>
      <NavbarComponent />
      <BackgroundComponent />
      <div class="container mt-5">
        <div class="card">
          <div class="card-body" v-if="user">
            <h3>{{ user.fullname }}</h3>
            <button type="button" class="btn btn-danger" @click="logout">Logout</button>
            <!-- Tambahkan detail lowongan lainnya -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import NavbarComponent from '@/components/NavbarComponent.vue';
  import BackgroundComponent from '@/components/BackgroundComponent.vue';
  import { useRouter } from 'vue-router';
  
  export default {
    components: {
      NavbarComponent,
      BackgroundComponent
    },
    props: ['id'],
    setup(props) {
      let user = ref({});
      const router = useRouter();
  
      onMounted(() => {
        axios.get(`http://localhost:8000/employer/${props.id}`)
          .then(response => {
            user.value = response.data.Employer; // Sesuaikan dengan struktur data API
          })
          .catch(error => {
            console.error('Error fetching job:', error);
          });
      });
      
      const logout = () => {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            user.value = null;
            router.push({ name: 'karir.roles.login' });
        };

      return {
        user,
        logout
      };
    }
  };
  </script>
  
  <style scoped>
  /* Tambahkan styling tambahan sesuai kebutuhan */
  </style>
