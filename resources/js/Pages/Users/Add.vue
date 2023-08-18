<template>
    <Head>
        <title>Илова</title>
    </Head>
    <div class="font-sans antialiased bg-gray-100 rounded">
        <!-- Content -->
        <div class="w-full bg-gray-100">
            <div class="container mx-auto py-8">
                <div class="w-5/6 lg:w-1/2 mx-auto bg-white rounded-2xl shadow">
                    <div class="py-4 px-8 text-blue-700 font-semibold text-xl text-center border-b border-grey-lighter">Иловаи истифодабаранда</div>
                    <form @submit.prevent="form.post(route('user.store'))">
                        <div class="py-4 px-8">
                        <div class="flex mb-4">
                            <div class="relative w-2/4 mr-2">
                                <input
                                    type="text"
                                    id="name"
                                    v-model.trim.lazy="form.name"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Ном</label>
                                <div v-if="errors.name" class="text-red-600">{{errors.name}}</div>
                            </div>
                            <div class="relative w-2/4">
                                <input
                                    type="text"
                                    id="nasab"
                                    v-model.trim.lazy="form.nasab"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="nasab" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Насаб</label>
                                <div v-if="errors.nasab" class="text-red-600">{{errors.nasab}}</div>
                            </div>
                        </div>
                        <div class="py-2">
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input
                                            id="horizontal-list-radio-license"
                                            type="radio"
                                            value="1"
                                            name="list-radio"
                                            v-model="form.is_admin"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="horizontal-list-radio-license" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Administrator</label>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input
                                            id="horizontal-list-radio-id"
                                            type="radio"
                                            value="0"
                                            v-model="form.is_admin"
                                            name="list-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="horizontal-list-radio-id" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Visitor</label>
                                    </div>
                                </li>
                            </ul>
                            <div v-if="errors.is_admin" class="text-red-600">{{errors.is_admin}}</div>
                        </div>
                        <div class="relative z-0 my-4">
                            <input
                                type="text"
                                id="email"
                                v-model.trim.lazy="form.email"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Почтаи электронӣ</label>
                            <div v-if="errors.email" class="text-red-600">{{errors.email}}</div>
                        </div>
                        <div class="flex py-4">
                            <div class="relative z-0 w-2/4 mr-2">
                                <input
                                    type="password"
                                    id="password"
                                    v-model.lazy="form.password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                <div v-if="errors.password" class="text-red-600">{{errors.password}}</div>
                            </div>
                            <div class="relative z-0 w-2/4">
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    v-model.lazy="form.confirm_password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="confirm_password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
                                <div v-if="errors.confirm_password" class="text-red-600">{{errors.confirm_password}}</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center mt-6">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-2/4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">
                                Create an account
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Dashboard from "../Dashboard";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "Add",
    layout: Dashboard,
    components:{Dashboard, Link, Head},
    props:{
        errors:Object,
        userName: String
    },
    setup(){
        const form = useForm({
            name: null,
            nasab: null,
            is_admin: null,
            email: null,
            password:null,
            confirm_password: null,
        })
        return {form};
    }
}
</script>
