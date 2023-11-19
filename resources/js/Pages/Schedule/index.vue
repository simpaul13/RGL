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

        }
    };
</script>