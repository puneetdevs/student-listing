User
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>

    <Head title="Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="p-6 text-gray-900"><b>Student Add</b></div>
                    <Link :href="addStudentLink" :class="classes"><i class="fa fa-plus"></i></Link>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <form @submit.prevent="submitForm">
                        <div class="form-group mb-2">
                            <label for="username">UserName</label>
                            <input v-model.trim="username" type="text" class="form-control" id="username"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email-address">Email address</label>
                            <input v-model.trim="email" type="email" class="form-control" id="email-address"
                                placeholder="Enter email">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { toast } from 'vue3-toastify';
import axios from 'axios';

export default {
    props: {
        addRoute: {
            type: String
        }
    },
    data() {
        return {
            email: '',
            username: '',
            submissionError: '',
        };
    },
    methods: {
        async submitForm() {
            this.submissionError = '';

            try {
                const response = await axios.post(this.addRoute, {
                    email: this.email,
                    username: this.username
                });

                let data = response.data;

                this.email = '';
                this.username = '';
                toast.success(data.message, {
                    autoClose: 1000,
                    onClose: () => {
                        if (data.redirect) {
                            this.$router.push({ path: data.redirect });
                          //  window.location.href = data.redirect;
                        }
                    }
                });
                
            } catch (error) {
                if (error.response) {
                    
                    toast.error(error.response.data.message, {
                        autoClose: 1000,
                    }); 

                    this.submissionError = error.response.data.message; 
                } else if (error.request) {
                    this.submissionError = 'No response received from the server.';
                } else {
                    this.submissionError = 'Error occurred while making the request.';
                }
            }
        },
       
    }
};
</script>

<style>
.error {
    color: red;
}
</style>