<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5">
        <!-- Kolom 1 -->
          <div class="card same-height mb-3">
            <div class="card-body">
              <h4 class="card-text">{{ job.job_title }}</h4>
              <p class="card-text text-danger">{{ company.company_name }}</p>
              <div class="d-flex flex-row mt-4 mb-4">
                <div class="d-flex flex-column ms-5">
                  <div class="d-flex flex-row">
                    <img class="mb-3 me-2" src="@/assets/case.svg" alt="case">
                    <p>{{ job.exp_level }}</p>
                  </div>
                  <div class="d-flex flex-row">
                    <img class="mb-3 me-2" src="@/assets/location.svg" alt="location">
                    <p>{{ job.location_type }}</p>
                  </div>
                </div>
                <div class="d-flex flex-column ms-5">
                  <div class="d-flex flex-row">
                    <img class="mb-3 me-2" src="@/assets/money.svg" alt="money">
                    <p>Negotiable</p>
                  </div>
                  <div class="d-flex flex-row">
                    <img class="mb-3 me-2" src="@/assets/city.svg" alt="city">
                    <p v-if="job.job_location !== ''">{{ job.job_location }}</p>
                    <p v-else>-</p>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <router-link v-if="user && user.user_id" class="btn btn-primary mb-5" :to="{ name: 'karir.roles'}">Apply</router-link>
                <router-link v-else-if="user && user.employer_id" class="btn btn-primary mb-5" :to="{ name: 'karir.roles'}">Update Job Details</router-link>
              </div>
              <div>
                <h5>About us</h5>
                <div v-html="company.company_description"></div>
              </div>
              <div class="mt-4">
                <h5>About Us</h5>
                <p>{{ company.about }}</p>
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
              <h5 class="mt-4">Kualifikasi</h5>
              <div v-html="job.job_qualification"></div>
            </div>
          </div>
        </div>

        <!-- Kolom 3 -->

          <div class="card same-height mb-3">
            <div class="card-body">
              <h4 class="card-title">Benefit Perusahaan</h4>
              <ul class="list-group list-group-flush">
                <li v-for="(benefit, index) in job.job_benefits" :key="index" class="list-group-item">
                  <span class="badge bg-warning text-dark">{{ benefit }}</span>
                </li>
              </ul>
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
    let user = ref(null)

    onMounted(() => {
      const userData = localStorage.getItem('user');
      user.value = JSON.parse(userData);
      axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          job.value = response.data.Job;
          job.value.exp_level = job.value.exp_level.replace("['", "").replace("']", ""); // Adjust according to the API structure
          company.value = response.data.Company; // Adjust according to the API structure
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });
    });

    return {
      job,
      company,
      user
    };
  }
};
</script>

<style scoped>
/* Additional styling as needed */
.same-height {
  height: 100%;
}

.btn-primary {
  color: #000;
  background-color: #FFE767;
  border-color: #FFE767;
  border-radius: 20px;
  width:1000px;
}

.list-group-item {
  border: none;
  padding: 0.5rem 0;
}

.list-group-item .badge {
  font-size: 1rem;
}
</style>
