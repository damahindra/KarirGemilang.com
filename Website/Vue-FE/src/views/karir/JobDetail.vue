<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5">
      <div class="row">
        <!-- Kolom 1 -->
        <div class="col-md-4 mb-4">
          <div class="card same-height">
            <div class="card-body">
              <h4 class="card-text">{{ job.job_title }}</h4>
              <p class="card-text text-danger">{{ company.company_name }}</p>
              <div class="d-flex flex-row mt-4 mb-4">
                  <div class="d-flex flex-column ms-5">
                      <div class="d-flex flex=row">
                          <img class="mb-3 me-2" src="@/assets/case.svg" alt="case">
                          <p>{{ job.exp_level }}</p>
                      </div>
                      <div class="d-flex flex=row">
                          <img class="mb-3 me-2" src="@/assets/location.svg" alt="case">
                          <p>{{ job.location_type }}</p>
                      </div>
                  </div>
                  <div class="d-flex flex-column ms-5">
                      <div class="d-flex flex=row">
                          <img class="mb-3 me-2" src="@/assets/money.svg" alt="case">
                          <p>Negotiable</p>
                      </div>
                      <div class="d-flex flex=row">
                          <img class="mb-3 me-2" src="@/assets/city.svg" alt="case">
                          <p v-if="job.job_location !== ''">{{ job.job_location }}</p>
                          <p v-else>-</p>
                      </div>
                  </div>
              </div>
              <div class="text-center">
                <router-link class="btn btn-primary" :to="{ name: 'karir.roles'}">Apply</router-link>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Kolom 2 -->
        <div class="col-md-4 mb-4">
          <div class="card same-height">
            <div class="card-body">
              <h4 class="card-title">Deskripsi Pekerjaan</h4>
              <div v-html="job.job_description"></div>
            </div>
          </div>
        </div>
        
        <!-- Kolom 3 -->
        <div class="col-md-4 mb-4">
          <div class="card same-height">
            <div class="card-body">
              <h4 class="card-title">Benefit Perusahaan</h4>
              <div v-html="job.job_description"></div>
            </div>
          </div>
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

export default {
  components: {
    NavbarComponent,
    BackgroundComponent
  },
  props: ['id'],
  setup(props) {
    let job = ref({});
    let company = ref({});

    onMounted(() => {
      axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          job.value = response.data.Job;
          job.value.exp_level = job.value.exp_level.replace("['", "").replace("']", ""); // Sesuaikan dengan struktur data API
          company.value = response.data.Company; // Sesuaikan dengan struktur data API
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });
    });

    return {
      job,
      company
    };
  }
};
</script>

<style scoped>
/* Tambahkan styling tambahan sesuai kebutuhan */
.same-height {
  height: 480px;
}

.btn-primary {
  color: #000;
  background-color: #FFE767;
  border-color: #FFE767;
  border-radius: 20px;
  width: 250px;
}
</style>
