<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="py-12">
            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
    <div class="navbar bg-base-100">
      <div class="flex-none">
        <div class="menu menu-horizontal px-1 p-2">
          <input
            type="text"
            v-model="search"
            placeholder="Search by name or type"
            class="input input-bordered"
          />
        </div>
      </div>
    </div>
  </div> -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="navbar bg-base-100">
                    <div class="flex-1">
                        <a class="btn btn-ghost text-xl">List of Schedule</a>
                    </div>
                    <div class="flex-none">
                        <div class="menu menu-horizontal px-1 p-2">

                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table">
                        <thead class="text-xs text-white uppercase bg-blue-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type of Concern
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Schedule Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="schedule in filteredSchedules" :key="schedule.schdeules_id">
                                <th scope="row">
                                    {{ schedule.customer_firstname }} {{ schedule.customer_lastname }}
                                </th>
                                <th scope="row">
                                    {{ schedule.type }}
                                </th>
                                <th scope="row">
                                    {{ $moment(schedule.schedule_date).format('llll') }}
                                </th>
                               
                                <td class="px-6 py-4">
                                    <div class="badge badge-success" v-if="schedule.status === 'Completed'">
                                        {{ schedule.status }}
                                    </div>
                                    <div class="badge badge-accent" v-if="schedule.status !== 'Completed'">
                                        {{ schedule.status }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="tooltip" data-tip="edit schedule">
                                        <i class="fa-regular fa-pen-to-square fa-xl mr-2"
                                            @click="showModal(schedule)"></i>
                                    </div>
                                    <div class="tooltip" data-tip="remove concern">
                                        <i class="fa-solid fa-heart-crack fa-xl mr-2"
                                            @click="declinedConcern(schedule.concern_id)"></i>
                                    </div>

                                    <div class="tooltip" data-tip="change status"
                                        v-if="schedule.status === 'Completed'">
                                        <i class="fa-solid fa-file-circle-xmark fa-xl"
                                            @click="changeStatus(schedule.concern_id)"></i>
                                    </div>

                                    <div class="tooltip" data-tip="change status to complete"
                                        v-if="schedule.status !== 'Completed'">
                                        <i class="fa-solid fa-file-circle-check fa-xl"
                                            @click="completeConcern(schedule.concern_id)"></i>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <dialog id="my_modal_1" class="modal">
                <div class="modal-box w-11/12">
                    <form @submit.prevent="changeSchedule">
                        <h3 class="font-bold text-lg">Change Schedule!</h3>
                        <div class="flex">
                            <div class="self-center w-full">
                                <VDatePicker v-model="schedule_date" mode="dateTime" :time-accuracy="timeAccuracy"
                                    expanded />
                            </div>
                        </div>
                        <div class="modal-action">
                            <button type="submit" class="btn">Update Schedule</button>
                            <button type="button" @click="closeModal" class="btn btn-error">Close</button>
                        </div>
                    </form>
                </div>
            </dialog>
        </div>
    </AuthenticatedLayout>

</template>
<script>
    import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue"
    import Swal from 'sweetalert2';
    import moment from 'moment';

    export default {
        components: {
            AuthenticatedLayout,
        },

        props: {
            schedules: Array,
        },

        data() {
            return {
                schedule: null,
                schedule_date: null,
                search: "",
            }
        },

        methods: {

            async declinedConcern(concern_id) {
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Take it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true, // Reverses the order of the buttons (default is false)
                });
                if (confirmResult.isConfirmed) {
                    try {

                        await axios.put(`/concern/declined/${concern_id}`);

                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Declined Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Declineding Concern',
                            text: `Error Declineding Concern : ${error.message}`
                        });
                    }
                }
            },

            async completeConcern(concern_id) {
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Take it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true, // Reverses the order of the buttons (default is false)
                });
                if (confirmResult.isConfirmed) {
                    try {

                        await axios.put(`/concern/completed/${concern_id}`);

                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Completed Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Change Status',
                            text: `Error Change Status of the Concern : ${error.message}`
                        });
                    }
                }
            },

            async showModal(schedule) {
                document.getElementById('my_modal_1').showModal();

                this.schedule = schedule
            },

            async changeSchedule() {
                document.getElementById('my_modal_1').close();
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Take it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true, // Reverses the order of the buttons (default is false)
                });
                if (confirmResult.isConfirmed) {
                    try {

                        axios.put(`/schedules/${this.schedule.schedule_id}`, {
                            schedule_date : moment(this.schedule_date).format("YYYY-MM-DD HH:mm:ss")
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Completed Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Change Status',
                            text: `Error Change Status of the Concern : ${error.message}`
                        });
                    }
                }
            },

            async changeStatus(concern_id) {
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Take it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true, // Reverses the order of the buttons (default is false)
                });
                if (confirmResult.isConfirmed) {
                    try {

                        await axios.put(`/concern/approved/${concern_id}`);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Change Successfully',
                        }).then(() => {
                            window.location.reload();
                            closeModal();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Change Concern',
                            text: `Error Change Concern : ${error.message}`,
                        });
                    }
                }
            },

            closeModal() {
                document.getElementById('my_modal_1').close();
            },

        },

        computed: {
            filteredSchedules() {
                // Use the search property to filter schedules
                const lowerSearch = this.search.toLowerCase();
                return this.schedules.filter((schedule) =>
                    schedule.customer_firstname.toLowerCase().includes(lowerSearch) ||
                    schedule.customer_lastname.toLowerCase().includes(lowerSearch) ||
                    schedule.type.toLowerCase().includes(lowerSearch)
                );
            },
        }
    };
</script>

