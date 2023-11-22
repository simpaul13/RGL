<template>

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Applicant Information</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details.
                            </p>
                        </div>
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ customer.customer_firstname }} {{ customer.customer_lastname }}
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ customer.email }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Contact Number</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ customer.contact_number }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ customer.additional_information }} {{ customer.barangay }} {{ customer.city }} {{ customer.province }} {{ customer.zipcode }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                    <div class="navbar bg-base-100">
                        <div class="flex-1">
                            <a class="btn btn-ghost text-xl">List of Concern</a>
                        </div>
                        <div class="flex-none">
                            <div class="menu menu-horizontal px-1 p-2">
                                <button class="btn btn-active btn-primary" onclick="my_modal_1.showModal()">Create Concern</button>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table">
                        <thead class="text-xs text-white uppercase bg-blue-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Concern
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type of Aircon
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
                            <tr class="bg-white border-b" v-for="concern in concerns" :key="concern.concern_id">
                                <th scope="row">
                                    {{ concern.type }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ concern.type_aircon }}
                                </td>
                                <td class="px-6 py-4">
                                    <div v-if="concern.user_id !== null && concern.status !== 'Completed'" class="badge badge-secondary">In Progress</div>
                                    <div v-if="concern.user_id !== null && concern.status === 'Completed'" class="badge badge-success">Completed</div>
                                    <div v-if="concern.user_id === null " class="badge badge-error">Pending</div>

                                </td>
                                <td class="px-6 py-4">
                                    <a 
                                        @click="deleteConcern(concern.concern_id)"
                                        href="#" 
                                        class="tooltip mr-2"
                                        data-tip="Delete Concern">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                    <div v-if="concern.user_id === null && concern.user_id !== $page.props.auth.user.id"
                                        class="tooltip" data-tip="take concern">
                                        <i class="fa-regular fa-heart" @click="approvedConcern(concern.concern_id)"></i>
                                    </div>
                                    <div v-if="concern.user_id === $page.props.auth.user.id && concern.status !== 'Completed'"
                                        class="tooltip" data-tip="remove concern">
                                        <i class="fa-solid fa-heart-crack" @click="declinedConcern(concern.concern_id)"></i>
                                    </div>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Create Concern!</h3>
                <div class="divider"></div>
                <form @submit.prevent="createConcern">
                    <div class="form-control w-full max-w-xs">
                        <span class="label-text mb-2">Type</span>
                        <input v-model="newConcern.type" type="text" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs mt-2">
                        <span class="label-text mb-2">Type Of Aircon</span>
                        <input v-model="newConcern.type_aircon" type="text" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs mt-2">
                        <span class="label-text mb-2">Horse Power</span>
                        <input v-model="newConcern.horset_power" type="text"
                            class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn">Create Concern</button>
                        <button type="button" @click="closeModal" class="btn btn-error">Close</button>
                    </div>
                </form>
            </div>
        </dialog>
    </AuthenticatedLayout>

</template>
<script>
    import axios from 'axios';
    import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue"
    import Swal from 'sweetalert2';

    export default {
        components: {
            AuthenticatedLayout
        },
        props: {
            customer: Array,
            concerns : Array,
        },

        data() {
            return {
                selectedCustomer : null,
                newConcern: {
                    type : '',
                    type_aircon : '',
                    horset_power : '',
                    customer_id : this.customer.customer_id,
                }
            }
        },  

        methods : {
            async createConcern() {
                try {
                    const response = await axios.post('/concerns', this.newConcern);
                    document.getElementById('my_modal_1').close();
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Created Successfully',
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Creating Concern',
                            text: response.data.message
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Creating Concern',
                        text: `Error creating Concern: ${error.message}`,
                    });
                }
            },

            async deleteConcern(concern_id) {
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true, // Reverses the order of the buttons (default is false)
                });
                if (confirmResult.isConfirmed) {
                    try {

                        await axios.delete(`/concerns/${concern_id}`);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Concern Deleted Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Deleting Concern',
                            text: `Error deleting Concern : ${error.message}`
                        });
                    }
                }
            },

            async approvedConcern(concern_id) {
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
                            title: 'Concern Taken Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Taking Concern',
                            text: `Error Taking Concern : ${error.message}`
                        });
                    }
                }
            },

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

            closeModal() {
                // Close the modal
                document.getElementById('my_modal_1').close();
            }
        }
    };
</script>