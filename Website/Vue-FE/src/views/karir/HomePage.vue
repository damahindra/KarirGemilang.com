<template>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-4">
        <h2 class="mb-3">Explore Jobs</h2>
        <div class="input-group mb-3">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="What are you looking for?" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button @click="searchJobs" class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
        </div>
        <div v-if="loading" class="text-center">
            <div class="spinner-border text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
            <div class="col-md-4" v-for="job in jobs" :key="job.job_id">
                <router-link class="text-decoration-none" :to="{ name: 'karir.job', params: { id: job.job_id } }">
                    <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ job.job_title }}</h5>
                        <p class="card-text text-danger">{{ job.company_name }}</p>
                        <div class="d-flex flex-row mt-4">
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
                    </div>
                    <div class="card-footer text-muted text-center text-secondary fs-6" >
                        Apply before {{ job.apply_before }}
                    </div>
                    </div>
                </router-link>
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
        setup() {
            //reactive state
            let jobs = ref([]);
            let loading = ref(true);
            let searchQuery = ref('');
            //mounted
            onMounted(() => {
                //get API from Laravel Backend
                axios.get('http://127.0.0.1:8000/jobs')
                .then(response => {           
                    //assign state posts with response data
                    console.log(response)
                    jobs.value = response.data.Jobs.map(job => {
                        job.exp_level = job.exp_level.replace("['", "").replace("']", "");
                        return job;
                    })
                    loading.value = false;
                }).catch(error => {
                    console.log(error.response)
                    loading.value = false;
                })
            })

            // Method for searching jobs
            const searchJobs = () => {
                // Filter jobs based on searchQuery
                if (searchQuery.value.trim() !== '') {
                    jobs.value = jobs.value.filter(job =>
                        job.job_title.toLowerCase().includes(searchQuery.value.trim().toLowerCase())
                    );
                } else {
                // Reset jobs to original list if searchQuery is empty
                axios.get('http://127.0.0.1:8000/jobs')
                    .then(response => {
                        jobs.value = response.data.Jobs.map(job => {
                            job.exp_level = job.exp_level.replace("['", "").replace("']", "");
                            return job;
                        });
                        loading.value = false;
                    }).catch(error => {
                        console.log(error.response)
                        loading.value = false;
                    });
            }
        };

            //return
            return {
                jobs,
                loading,
                searchQuery,
                searchJobs
            }
        }
    }
    </script>
    <style>
    </style>
    