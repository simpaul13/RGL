<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="navbar bg-base-100">
                    <div class="flex-1">
                        <a class="btn btn-ghost text-xl">List of Employees</a>
                    </div>
                    <div class="flex-none">
                        <div class="menu menu-horizontal px-1 p-2">
                            <button class="btn btn-active btn-primary" onclick="my_modal_1.showModal()">Create Staff</button>

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
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Account Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="user in users" :key="user.id">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ user.name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ user.email }}
                                </td>
                                <td class="px-6 py-4">
                                    <div 
                                            class="tooltip"
                                            data-tip="Account Not Verified">
                                        <i 
                                            v-if="user.email_verified_at === null"
                                            class="fa-regular fa-circle-xmark fa-xl"></i>
                                    </div>
                                    <div 
                                        class="tooltip"
                                        data-tip="Account Verified">
                                        <i 
                                            v-if="user.email_verified_at !== null"
                                            class="fa-regular fa-circle-check fa-xl"></i>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a 
                                        @click="deleteUser(user.id)"
                                        href="#" 
                                        class="tooltip"
                                        data-tip="Delete Account">
                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                    </a>
                                    <a  
                                        v-if="user.email_verified_at === null"
                                        @click="approvedUser(user.id)"
                                        href="#"
                                        class="tooltip"
                                        data-tip="Verified User">
                                        <i class="fa-solid fa-user-check fa-lg ml-3"></i>
                                    </a>

                                    <a  
                                        v-if="user.email_verified_at !== null"
                                        @click="unverifiedUser(user.id)"
                                        href="#"
                                        class="tooltip"
                                        data-tip="Unverified User">
                                        <i class="fa-solid fa-user-xmark fa-lg ml-3"></i>
                                    </a>

                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Create Employe!</h3>
                <div class="divider"></div>
                <form @submit.prevent="createEmployee">
                    <div class="form-control w-full max-w-xs">
                        <span class="label-text mb-2">Name</span>
                        <input v-model="newEmployee.name" type="text" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs mt-2">
                        <span class="label-text mb-2">Email</span>
                        <input v-model="newEmployee.email" type="text" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs mt-2">
                        <span class="label-text mb-2">Password</span>
                        <input v-model="newEmployee.password" type="password"
                            class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs mt-2">
                        <span class="label-text mb-2">Confirm Password</span>
                        <input v-model="newEmployee.confirmPassword" type="password"
                            class="input input-bordered w-full max-w-xs" />
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn">Create Employee</button>
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
            AuthenticatedLayout,
        },
  
        props: {
            users: Array,
        },

        data() {
            return {
                newEmployee: {
                    name: '',
                    email: '',
                    password: '',
                    confirmPassword: '',
                },
            };
        },


        methods : {
            async createEmployee() {
                    try {
                        // Add validation for password matching if needed
                        if (this.newEmployee.password !== this.newEmployee.confirmPassword) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Password and Confirm Password do not match',
                                customClass: {
                                    container: 'my-swal-container', // Add a custom class for styling
                                },
                            });
                            return;
                        }

                        const response = await axios.post('/users', this.newEmployee);
                        document.getElementById('my_modal_1').close();
                        if (response.data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Employee Created Successfully',
                                customClass: {
                                    container: 'my-swal-container', // Add a custom class for styling
                                },
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Creating Employee',
                                text: response.data.message,
                                customClass: {
                                    container: 'my-swal-container', // Add a custom class for styling
                                },
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Creating Employee',
                            text: `Error creating employee: ${error.message}`,
                            customClass: {
                                container: 'my-swal-container', // Add a custom class for styling
                            },
                        });
                    }
                },

                closeModal() {
                    // Close the modal
                    document.getElementById('my_modal_1').close();
                },
            async unverifiedUser(user_id) {
                try {
                    const confirmResult = await Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, mark as unverified!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true,
                    });

                    if (confirmResult.isConfirmed) {
                        await axios.put(`/users/${user_id}`, {
                            verified: false
                        });

                        await Swal.fire({
                            icon: 'success',
                            title: 'User Marked as Unverified Successfully',
                            customClass: {
                                container: 'my-swal-container', // Add a custom class for styling
                            },
                        });

                        window.location.reload();
                    }
                } catch (error) {
                    // Handle errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Marking User as Unverified',
                        text: `Error marking user as unverified: ${error.message}`,
                        customClass: {
                            container: 'my-swal-container', // Add a custom class for styling
                        },
                    });
                }
            },

            async approvedUser(user_id) {
                try {
                    const confirmResult = await Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, approve it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true,
                    });

                    if (confirmResult.isConfirmed) {
                        await axios.put(`/users/${user_id}`);

                        await Swal.fire({
                            icon: 'success',
                            title: 'User Approved Successfully',
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                } catch (error) {
                    // Handle errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Approving User',
                        text: `Error approving user: ${error.message}`,
                        customClass: {
                            container: 'my-swal-container', // Add a custom class for styling
                        },
                    });
                }
            },

            

            async deleteUser(user_id) {
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

                        await axios.delete(`/users/${user_id}`);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'User Deleted Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Deleting User',
                            text: `Error deleting user : ${error.message}`,
                            customClass: {
                                container: 'my-swal-container', // Add a custom class for styling
                            },
                        });
                    }
                }
            }
        }
    };
</script>