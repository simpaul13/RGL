<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center mb-5">
                    <div class="stats shadow-lg bg-white text-black">
                        <div class="stat w-48">
                            <div class="stat-figure text-secondary">
                                <i class="fa-solid fa-circle-exclamation fa-2xl" style="color: #33425c;"></i>
                            </div>
                            <div class="stat-title">Concerns</div>
                            <div class="stat-value">
                                {{ $page.props.concerns }}
                            </div>
                        </div>

                        <div class="stat w-48">
                            <div class="stat-figure text-secondary">
                                <i class="fa-solid fa-users-line fa-2xl" style="color: #33425c;"></i>
                            </div>
                            <div class="stat-title">Customers</div>
                            <div class="stat-value">
                                {{ $page.props.customers }}
                            </div>
                        </div>

                        <div class="stat w-48">
                            <div class="stat-figure text-secondary">
                                <i class="fa-regular fa-clipboard fa-2xl" style="color: #33425c;"></i>
                            </div>
                            <div class="stat-title">Schedules</div>
                            <div class="stat-value">
                                {{ $page.props.schedules }}
                            </div>
                        </div>

                        <div class="stat w-48">
                            <div class="stat-figure text-secondary">
                                <i class="fa-solid fa-user-tie fa-2xl" style="color: #33425c;"></i>
                            </div>
                            <div class="stat-title">Users</div>
                            <div class="stat-value">
                                {{ $page.props.users }}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card bg-white m-2 shadow-xl col-start-1 col-span-2">
                        <div class="card-body">
                            <h2 class="card-title">Your Schedule</h2>
                            <div class="overflow-x-auto">
                                <table class="table table-zebra">
                                    <!-- head -->
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th>#</th>
                                            <th>Concern</th>
                                            <th>Schedule Date</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <!-- row -->
                                    <tbody>
                                        <tr v-for="(schedule, index) in $page.props.user_schedules"
                                            :key="schedule.concern_id">
                                            <th>{{ index + 1}}</th>
                                            <td>{{ schedule.type }}</td>
                                            <td>{{ schedule.schedule_date }}</td>
                                            <td>
                                                <div class="badge badge-success">
                                                    {{ schedule.status }}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <div class="grid grid-cols-4">

                    <div class="card bg-white m-2 shadow-xl col-start-1 col-span-2">
                        <div class="card-body">
                            <h2 class="card-title">Lestat Concern</h2>
                            <div class="overflow-x-auto">
                                <table class="table table-zebra">
                                    <!-- head -->
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th>#</th>
                                            <th>Concern</th>
                                            <th>Type of Aircon</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <!-- row -->
                                    <tbody>
                                        <tr v-for="(concern, index) in $page.props.concern_tables"
                                            :key="concern.concern_id">
                                            <th>{{ index + 1}}</th>
                                            <td>{{ concern.type }}</td>
                                            <td>{{ concern.type_aircon }}</td>
                                            <td>
                                                <div v-if="concern.user_id !== null" class="badge badge-secondary">In
                                                    Progress</div>
                                                <div v-if="concern.user_id === null" class="badge badge-error">Pending
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-white m-2 shadow-xl col-start-3 col-span-4">
                        <div class="card-body">
                            <h2 class="card-title">Lestat Customer</h2>
                            <div class="overflow-x-auto">
                                <table class="table table-zebra">
                                    <!-- head -->
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- row -->
                                    <tbody>
                                        <tr v-for="(customer, index) in $page.props.customer_tables"
                                            :key="customer.customer_id">
                                            <th>{{ index + 1}}</th>
                                            <td>{{ customer.customer_firstname }} {{ customer.customer_lastname }}</td>
                                            <td>{{ customer.contact_number }}</td>
                                            <td>
                                                <a :href="'/customers/'+customer.customer_id">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            
            </div>
        </div>
    </AuthenticatedLayout>
</template>
