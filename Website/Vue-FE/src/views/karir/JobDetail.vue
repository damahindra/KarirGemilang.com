<template>
  <div>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-5">
        <!-- Kolom 1 -->
          <div class="card same-height mb-3">
            <div class="card-body">
              <div class="text-center mt-2">
                <h4 class="card-text">{{ job.job_title }}</h4>
              </div>
              <div class="text-center mt-2">
                <p class="card-text text-danger">{{ company.company_name }}</p>
              </div>
              <div class="text-center ms-5 justify-content-center">
                <div class="row mt-4 mb-4 justify-content-center">
                    <div class="col ms-5">
                        <div class="d-flex flex-row">
                            <img class="mb-3 me-2 ms-5" src="@/assets/case.svg" alt="case">
                            <p>{{ job.exp_level }}</p>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-row">
                            <img class="mb-3 me-2 ms-3" src="@/assets/location.svg" alt="case">
                            <p>{{ job.location_type }}</p>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-row">
                            <img class="mb-3 me-2 ms-3" src="@/assets/money.svg" alt="case">
                            <p>Negotiable</p>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-row">
                            <img class="mb-3 me-2 ms-3" src="@/assets/city.svg" alt="case">
                            <p v-if="job.job_location !== ''">{{ job.job_location }}</p>
                            <p v-else>-</p>
                        </div>
                    </div>
                </div>
              </div>
              <div class="text-center">
                <router-link v-if="user && user.user_id" class="btn btn-primary mb-5" :to="{ name: 'karir.apply', params: { id: job.job_id } }">Apply</router-link>
                <router-link v-else-if="user && user.employer_id" class="btn btn-primary mb-5" :to="{ name: 'karir.roles'}">Update Job Details</router-link>
              </div>
              <div>
                <h5>About us</h5>
                <div v-html="company.company_description"></div>
              </div>
            </div>
          </div>
        
        <!-- Kolom 2 -->
          <div class="card same-height mb-3">
            <div class="container text-start card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title">Deskripsi Pekerjaan</h5>
                  <div v-html="job.job_description"></div>
                </div>
                <div class="col">
                  <h5 class="card-title ">Pre Requisites</h5>
                  <div v-html="job.prerequisites"></div>
                </div>
              </div>
            </div>
          </div>
        
        
        <!-- Kolom 3 -->

          <div class="card same-height mb-3">
            <div class="card-body">
              <h5 class="card-title mb-4">Benefit Perusahaan</h5>
              <div class="d-flex flex-row text-center">
                <div class="d-flex flex-column" v-for="benefit in benefits" :key="benefit">
                  <div class="btn btn-warning me-3 benefit text-light">{{ benefit }}</div>
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
    let user = ref(null)
    let benefits = ref([])

    onMounted(() => {
      const userData = localStorage.getItem('user');
      user.value = JSON.parse(userData);
      axios.get(`http://localhost:8000/job/${props.id}`)
        .then(response => {
          job.value = response.data.Job;
          job.value.exp_level = job.value.exp_level.replace("['", "").replace("']", ""); // Sesuaikan dengan struktur data API
          job.value.prerequisites = job.value.prerequisites.replace("<p>", "").replace("</p>", "").replace("<div>", "").replace("</div>").replace("<br>", ""); // Sesuaikan dengan struktur data API
          company.value = response.data.Company; // Sesuaikan dengan struktur data API
          benefits.value = company.value.company_benefits.split(",");
        })
        .catch(error => {
          console.error('Error fetching job:', error);
        });
    });

    return {
      job,
      company,
      user,
      benefits
    };
  }
};
</script>

<style scoped>
/* Tambahkan styling tambahan sesuai kebutuhan */
.same-height {
  height: auto;
}

.btn-primary {
  color: #000;
  background-color: #FFE767;
  border-color: #FFE767;
  border-radius: 20px;
  width:1000px;
}

.benefit {
  border-radius: 20px;
  width: 150px;
}
</style>