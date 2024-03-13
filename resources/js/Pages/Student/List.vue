<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student</h2>
            </template>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="p-6 text-gray-900"><b>Student Listing</b></div>
                            </div>
                            <div class="col-6 text-right">
                                <Link class="p-6  btn btn-info" :href="addStudentLink" :class="classes">+</Link>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table id="tableComponent" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th v-for="field in fields" :key="field">
                                        {{ field }} <i class="bi bi-sort-alpha-down" aria-label="Sort Icon"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :id="'student-id-' + item.id" v-for="item in users" :key="item.id">
                                    <template v-for="(field, index) in fields" :key="index">
                                        <template v-if="field !== 'Action'">
                                            <td>{{ item[field] }}</td>
                                        </template>
                                        <template v-else>
                                            <td>
                                                <button class="btn btn-danger"
                                                    @click="deleteStudent(item.id)">Delete</button>
                                            </td>
                                        </template>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';

export default {
    props: {
        users: {
            type: Array,
            required: true
        },
        fields: {
            type: Array
        },
        addStudentLink: {
            type: String
        },
        classes: {
            type: String
        }
    },
    methods: {
        async deleteStudent(studentId) {
            try {
                const response = await axios.delete(`/student/${studentId}`);
                const data = response.data;

                const index = this.users.findIndex(user => user.id === studentId);
                if (index !== -1) {
                    this.users.splice(index, 1);
                }
                toast.success(data.message, {
                    autoClose: 1000,
                });
            } catch (error) {
                if (error.response) {
                    toast.error(error.response.data.message, {
                        autoClose: 1000
                    });
                } else if (error.request) {
                    console.error('No response received from the server:', error.request);
                } else {
                    console.error('Error occurred while making the request:', error.message);
                }
            }
        }
    }
}
</script>

<style scoped>
.error {
    color: red;
}
</style>