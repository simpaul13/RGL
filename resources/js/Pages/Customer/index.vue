<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>

        <div class="py-12">
           
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="navbar bg-base-100">
                    <div class="flex-1">
                        <a class="btn btn-ghost text-xl">List of Customers</a>
                    </div>
                    <div class="flex-none">
                        <div class="menu menu-horizontal px-1 p-2">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="navbar">
                                    <div class="flex-none">
                                        <div class="menu menu-horizontal px-1 p-2">
                                            <input type="text" v-model="search" placeholder="Search by name or type"
                                                class="input input-bordered bg-white" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu menu-horizontal px-1 p-2">
                            <button class="btn btn-active btn-primary" onclick="my_modal_1.showModal()">
                                Create Customer
                            </button>
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
                                    Contact Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="customer in filteredCustomers" :key="customer.id">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ customer.customer_firstname }} {{ customer.customer_lastname }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ customer.contact_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ customer.additional_information }} {{ customer.barangay }} {{ customer.city }} {{ customer.province }} {{ customer.zipcode }}
                                </td>
                                <td class="px-6 py-4">
                                    <a :href="'/customers/'+customer.customer_id">
                                        <i class="fa-regular fa-eye mr-2"></i>
                                    </a>

                                    <a 
                                        @click="deleteCustomer(customer.customer_id)"
                                        href="#" 
                                        class="tooltip mr-2"
                                        data-tip="Delete Customer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <dialog id="my_modal_1" class="modal">
        <div class="modal-box w-11/12">
          <h3 class="font-bold text-lg">Create Customer</h3>
          <div class="divider"></div>

           <!-- Form to add new customer -->
           <form @submit.prevent="createCustomer">
            <div class="form-control w-full max-w-xs mt-2">
                <div class="label">
                    <label class="label-text mb-2">First Name</label>
                </div>
                <input v-model="newCustomer.customer_firstname" type="text" class="input input-bordered w-full max-w-xs" />
                <!-- <div class="label">
                    <label class="label-text mb-2">First Name</label>
                </div> -->
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Last Name</label>
              <input v-model="newCustomer.customer_lastname" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Middle Name</label>
              <input v-model="newCustomer.customer_middlename" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Gender</label>
              <select v-model="newCustomer.customer_gender" class="select select-bordered w-full max-w-xs">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Email</label>
              <input v-model="newCustomer.email" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Company</label>
              <input v-model="newCustomer.company" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Contact Number</label>
              <input v-model="newCustomer.contact_number" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Country</label>
              <input v-model="newCustomer.country" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Province</label>
              <input v-model="newCustomer.province" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">City</label>
              <input v-model="newCustomer.city" type="text" class="input input-bordered w-full max-w-xs" />
            </div>

            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Barangay</label>
              <input v-model="newCustomer.barangay" type="text" class="input input-bordered w-full max-w-xs" />
            </div>


            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">zipcode</label>
              <input v-model="newCustomer.zipcode" type="text" class="input input-bordered w-full max-w-xs" />
            </div>


            <div class="form-control w-full max-w-xs mt-2">
              <label class="label-text mb-2">Additional Information</label>
              <input v-model="newCustomer.additional_information" type="text" class="input input-bordered w-full max-w-xs" />
            </div>


            <!-- ... add similar code for other customer details ... -->

            <div class="modal-action">
              <button type="submit" class="btn">Create Customer</button>
              <button type="button" @click="closeModal" class="btn btn-error">Close</button>
            </div>
          </form>
        </div>
      </dialog>
    </AuthenticatedLayout>

</template>
<script>
    import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue"
    import Swal from 'sweetalert2';
    import axios from 'axios';

    export default {
        components: {
            AuthenticatedLayout
        },

        props: {
            customers: Array,
        },

        data() {
            return {
                search: '',
                selectedCustomer: null,
                newCustomer: {
                    customer_firstname: '',
                    customer_lastname: '',
                    customer_middlename: '',
                    customer_gender: 'male',
                    email: '',
                    company: '',
                    contact_number: '',
                    country: '',
                    province: '',
                    city: '',
                    barangay: '',
                    zipcode: '',
                    additional_information: '',
                },
            };
        },

        methods: {

            async createCustomer() {
                try {

                    const response = await axios.post('/customers', this.newCustomer);
                    document.getElementById('my_modal_1').close();

                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Customer Created Successfully',
                        }).then(() => {
                            window.location.reload();
                            closeModal();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Create Customer',
                            text: response.data.message,
                        });
                    }
                } catch (error) {
                    document.getElementById('my_modal_1').close();

                    Swal.fire({
                        icon: 'error',
                        title: 'Error Creating Customer',
                        text: `Error creating customer: ${error.message}`,
                    });
                }
            },

            async deleteCustomer(customer_id) {
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

                        await axios.delete(`/customers/${customer_id}`);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Customer Deleted Successfully',
                        }).then(() => {
                            window.location.reload();
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Deleting Customer',
                            text: `Error deleting Customer : ${error.message}`
                        });
                    }
                }
            },

            closeModal() {
                // Close the modal
                document.getElementById('my_modal_1').close();

                newCustomer.customer_firstname = ''
                newCustomer.customer_lastname = ''
                newCustomer.customer_middlename = ''
                newCustomer.customer_gender = 'male'
                newCustomer.email = ''
                newCustomer.company = ''
                newCustomer.contact_number = ''
                newCustomer.country = ''
                newCustomer.province = ''
                newCustomer.city = ''
                newCustomer.barangay = ''
                newCustomer.zipcode = ''
                newCustomer.additional_information = ''
            },
        },
        
        computed: {
            filteredCustomers() {
                // Use the search property to filter customers
                const lowerSearch = this.search.toLowerCase();
                return this.customers.filter((customer) =>
                    customer.customer_firstname.toLowerCase().includes(lowerSearch) ||
                    customer.customer_lastname.toLowerCase().includes(lowerSearch) ||
                    customer.email.toLowerCase().includes(lowerSearch) ||
                    customer.company.toLowerCase().includes(lowerSearch) ||
                    customer.contact_number.toLowerCase().includes(lowerSearch) ||
                    customer.country.toLowerCase().includes(lowerSearch) ||
                    customer.province.toLowerCase().includes(lowerSearch) ||
                    customer.city.toLowerCase().includes(lowerSearch) ||
                    customer.barangay.toLowerCase().includes(lowerSearch) ||
                    customer.zipcode.toLowerCase().includes(lowerSearch) ||
                    customer.additional_information.toLowerCase().includes(lowerSearch) ||
                    customer.customer_gender.toLowerCase().includes(lowerSearch)
                );
            },
        }
    };
</script>

<style>
.my-swal-container {
  z-index: 99999; /* Set a high z-index to ensure it appears on top of the modal */
}
</style>