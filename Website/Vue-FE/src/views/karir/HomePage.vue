<template>
    <NavbarComponent />
    <BackgroundComponent />
    <div class="container mt-4">

        <h2 class="mb-3">Explore Jobs</h2>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="What are you looking for?" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
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
                        <p class="card-text">{{ job.company_name }}</p>
                        <!-- Tambahkan info lowongan lainnya -->
                    </div>
                    <div class="card-footer text-muted text-center">
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
    import axios from 'axios'
    import { onMounted, ref } from 'vue'
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
            //mounted
            onMounted(() => {
                //get API from Laravel Backend
                axios.get('http://127.0.0.1:8000/jobs')
                .then(response => {           
                    //assign state posts with response data
                    console.log(response)
                    jobs.value = response.data.Jobs
                    loading.value = false;
                }).catch(error => {
                    console.log(error.response)
                    loading.value = false;
                })
            })
            //return
            return {
                jobs,
                loading
            }
        }
    }
    </script>
    <style>
    </style>
    