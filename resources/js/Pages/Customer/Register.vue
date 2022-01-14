<template>
    <app-layout title="Customer">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-1 md:gap-6">
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="bg-white space-y-4 p-4 sm:px-8 sm:py-6 lg:p-4 xl:px-8 xl:py-6">
                                    <div class="flex items-center justify-between">
                                        <h2 class="font-semibold text-gray-900">New Customer</h2>
                                        <Link :href="route('customers.index')" class="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm">
                                            Back
                                        </Link>
                                    </div>
                                </div>

                                <form @submit.prevent="submit">
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6">
                                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                                    <input v-model="customer.name" type="text" name="name" id="name" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.name" class="text-red-600">{{ errors.name }}</div>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="document" class="block text-sm font-medium text-gray-700">Document</label>
                                                    <input v-model="customer.document" type="text" name="document" id="document" required minlength="6" maxlength="12" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    <div v-if="errors.document" class="text-red-600">{{ errors.document }}</div>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                                    <select v-model="customer.status" id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                        <option value="new">new</option>
                                                        <option value="active">active</option>
                                                        <option value="suspended">suspended</option>
                                                        <option value="cancelled">cancelled</option>
                                                    </select>
                                                    <div v-if="errors.status" class="text-red-600">{{ errors.status }}</div>
                                                </div>

                                                <div class="col-span-6">
                                                    Numbers

                                                    <button @click="add()" type="button" class="hover:bg-blue-400 group items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm">
                                                        ADD
                                                    </button>
                                                </div>

                                                <div v-for="number, index in customer.numbers" class="col-span-6">
                                                    <div class="grid grid-cols-6 gap-6">
                                                        <div class="col-span-3">
                                                            <label class="block text-sm font-medium text-gray-700">Number</label>
                                                            <input v-model="number.number" type="text" name="number" required minlength="8" maxlength="14" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-2">
                                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                                            <select v-model="number.status" name="status" required class="mt-1 block w-full  border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="active">active</option>
                                                                <option value="inactive">inactive</option>
                                                                <option value="cancelled">cancelled</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-span-1">
                                                            <button @click="deleteHandler(index)" type="button" class="hover:bg-red-400 group items-center rounded-md bg-red-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm" style="margin-top: 24px;">
                                                                DELETE
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div v-for="preference in number.preferences" class="grid grid-cols-6 gap-6">
                                                        <div class="col-span-2" />
                                                        <div class="col-span-2">
                                                            <input readonly v-model="preference.name" type="text" name="number" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>

                                                        <div class="col-span-2">
                                                            <select v-model="preference.value" name="status" required class="mt-1 block w-full  border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { reactive } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default defineComponent({
    components: {
        AppLayout,
        Link
    },
    props: {
        errors: Object,
        customer: Object,
    },
    setup (props) {
        const customer = reactive(props.customer)

        function submit() {
           Inertia.post(route("customers.store"), customer)
        }

        function add(){
            customer.numbers.push({
                number:null,
                status:'active',
                preferences:[
                    {
                        name: 'auto_attendant',
                        value: 1
                    },
                    {
                        name: 'voicemail_enabled',
                        value: 1
                    }
                ]
            });
        }

        function deleteHandler(index){
            customer.numbers.splice(index, 1)

            if(customer.numbers.length == 0)
                add()
        }

        return { customer, submit, add, deleteHandler }
    },
})
</script>
