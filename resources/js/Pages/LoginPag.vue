<template>
    <div class="content flex">
        <div class="flex flex-col justify-center items-center w-1/2 ">

            <div class="flex flex-col justify-center items-center w-full h-full  ">
                <img
                        class="w-[150px] h-[110px] mb-8"
                        src="../img/Vector.png" alt="">
                <div class="font-bold sm:text-sm lg:text-lg text-center">
                        <p>Барномаи Бақайдгирии</p>
                        <p>Шартномаҳои Байналмилалӣ</p>
                    </div>
                <div v-if="$page.props.flash.message" class="text-red-500 text-center">
                        {{$page.props.flash.message}}
                    </div>
                <form @submit.prevent="form.post(route('login.auth'))" class="w-2/5 mt-[80px]">
                        <div class="relative z-0 pb-2">
                            <input type="email"
                                   id="floating_standard"
                                   v-model="form.email"
                                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder="" />
                            <label for="floating_standard" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1.5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Почтаи электронӣ
                            </label>
                            <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1" stroke="currentColor" class="w-4 h-4">
                                    <path strokeLinecap="round" d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative z-0 mt-6">
                            <input type="password"
                                   id="floating_password"
                                   v-model="form.password"
                                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder="" />
                            <label for="floating_password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Рамз</label>
                            <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1" stroke="currentColor" class="w-4 h-4">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full mt-[40px] text-white bg-primary-900 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                            Даромад
                        </button>
                    </form>
            </div>


            <div class="text-center text-gray-400 text-sm pb-2">
                <p>&copy; {{ currYear }} ББШБ+</p>
                <p>Все права защищены</p>
            </div>
        </div>

        <div class="image-section w-1/2">
            <img class="w-screen max-h-screen " src="../img/Login-screen.png" alt="">
        </div>

    </div>
</template>

<script>
import {Link,useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "LoginPag",
    components: {Link},
    data (){
        return {
            currYear: new Date().getFullYear(),
        }
    },
    setup(){
        const form = useForm ({
            email: null,
            password: null,
            _method: "POST"
        });

        return {form}
    }
}
</script>
