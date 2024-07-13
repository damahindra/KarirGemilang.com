<template>
    <NavbarComponent />
    <div class="container mt-4">

        <h2>Explore Jobs</h2>
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
    import NavbarComponent from '@/views/auth/NavbarComponent.vue';
    
    export default {
        components: {
            NavbarComponent
        },
        setup() {
            //reactive state
            let jobs = ref([])
            //mounted
            onMounted(() => {
                //get API from Laravel Backend
                axios.get('http://127.0.0.1:8000/jobs')
                .then(response => {           
                    //assign state posts with response data
                    console.log(response)
                    jobs.value = response.data.Jobs
                }).catch(error => {
                    console.log(error.response)
                })
            })
            //return
            return {
                jobs
            }
        }
    }
    </script>
    <style>
    </style>
    