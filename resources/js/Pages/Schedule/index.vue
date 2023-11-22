<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="py-12">
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
                            <tr class="bg-white border-b" v-for="schedule in schedules" :key="schedule.schdeules_id">
                                <th scope="row">
                                    {{ schedule.schedule_date }}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="badge badge-success">
                                        {{ schedule.status }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="tooltip" data-tip="remove concern">
                                        <i class="fa-solid fa-heart-crack fa-2xl" @click="declinedConcern(schedule.concern_id)"></i>
                                    </div>

                                    <div class="tooltip" data-tip="change status to complete">
                                        <i class="fa-solid fa-check-to-slot fa-2xl" @click="completeConcern(schedule_concern_id)"></i>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
<script>
    import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue"
    import Swal from 'sweetalert2';

    export default {
        components: {
            AuthenticatedLayout,
        },
  
        props: {
            schedules: Array,
        },

        data() {

        },  

        methods : {

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

            closeModal() {
                document.getElementById('my_modal_1').close();
            },

        }
    };
</script>