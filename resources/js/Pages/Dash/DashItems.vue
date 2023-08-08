<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <div class="p-4 sm:p-8 space-y-6">
            <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 truncate text-ellipsis">
                <div class="flex items-center p-6 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{dujonibaCount}}</span>
                        <Link
                            :href="route('do.index')">
                            <span class="block text-gray-500 truncate hover:text-blue-700">Дуҷониба</span>
                        </Link>
                    </div>
                </div>

                <div class="flex items-center p-6 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                        </svg>

                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{bisyorCount}}</span>
                        <Link
                            :href="route('bi.index')">
                            <span class="block text-gray-500 truncate hover:text-blue-700">Бисёрҷониба</span>
                        </Link>
                    </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                    </div>
                    <div class="text-ellipsis overflow-hidden ...">
                        <span class="inline-block text-2xl font-bold">{{ijronashuda}}</span>
                        <span class="block text-gray-500">Иҷронашуда</span>
                    </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{users}}</span>
                        <Link
                            :href="route('users.index')">
                            <span class="inline-flex text-gray-500 hover:text-blue-700">Истифодабарандаҳо</span>
                        </Link>
                    </div>
                </div>
            </section>
            <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">
                <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">Шумораи шартномаҳо вобаста ба санаи ворид гардида.</div>
                    <div class="p-4 flex-grow">

                        <div class="flex flex-col sm:justify-start h-full p-4  text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                            <div class="mb-4">
                                <h3 class="mb-2 font-semibold text-sm text-gray-900">Намуди шартнома</h3>
                                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                        <div class="flex items-center pl-3">
                                            <input
                                                v-model="formValues.namud"
                                                id="horizontal-list-radio-millitary" type="radio" value="1" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                            <label for="horizontal-list-radio-millitary" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Дуҷониба</label>
                                        </div>
                                    </li>
                                    <li class="w-full dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input
                                                v-model="formValues.namud"
                                                id="horizontal-list-radio-passport" type="radio" value="2" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 dark:bg-gray-600">
                                            <label for="horizontal-list-radio-passport" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Бисёрҷониба</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex">
                               <div class="w-full">
                                   <vue-tailwind-datepicker
                                       as-single
                                       weekdays-size="min"
                                       :formatter="formatter"
                                       placeholder="Ҷустуҷу аз санаи"
                                       i18n="ru"
                                       v-model="formValues.datefrom"
                                       input-classes="block text-sm bg-gray-50 border border-gray-300"
                                       class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                                   />
                               </div>
                               <div class="w-full mx-2 ">
                                   <vue-tailwind-datepicker
                                       as-single
                                       weekdays-size="min"
                                       :formatter="formatter"
                                       placeholder="То санаи"
                                       i18n="ru"
                                       v-model="formValues.dateto"
                                       input-classes="block text-sm bg-gray-50 border border-gray-300"
                                       class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                                   />
                               </div>
                           </div>
                            <div v-if="shumoraD>0">
                                <p class="text-blue-500 text-sm mt-2">Миқдори шартномаҳои дуҷониба дар давраи мазкур: <span class="text-base text-red-500 font-semibold">{{shumoraD}}</span> адад</p>
                            </div>
                            <div v-if="shumoraB>0">
                                <p class="text-blue-500 text-sm mt-2">Миқдори шартномаҳои бисёрҷониба дар давраи мазкур: <span class="text-base text-red-500 font-semibold">{{shumoraB}}</span> адад</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-yellow-600 bg-yellow-100 rounded-full mr-6">
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">25</span>
                        <span class="block text-gray-500">МАТН</span>
                    </div>
                </div>
                <div class="flex items-center p-8 bg-white shadow rounded-lg">
                    <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-teal-600 bg-teal-100 rounded-full mr-6">
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">139</span>
                        <span class="block text-gray-500">Иловаи матн</span>
                    </div>
                </div>
                <div class="row-span-3 bg-white shadow rounded-lg">
                    <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
                        <span>Шартномаҳо</span>
                        <button type="button" class="inline-flex justify-center rounded-md px-1 -mr-1 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-600" id="options-menu" aria-haspopup="true" aria-expanded="true">
                            Миқдор
                            <svg class="-mr-1 ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Refer here for full dropdown menu code: https://tailwindui.com/components/application-ui/elements/dropdowns -->
                    </div>
                    <div class="overflow-y-auto">
                        <ul
                            class="p-6 space-y-6">
                            <li class="flex items-center">
                                <div class="h-8 w-8 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor"
                                         class="w-8 h-8 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>
                                </div>
                                <span class="text-gray-600"></span>
                                <span class="ml-auto font-semibold">9</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col row-span-3 bg-white shadow rounded-lg">
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">МАТН</div>
                    <div class="p-4 flex-grow">
                        <div class="flex items-center justify-center h-full px-4 py-24 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">Chart</div>
                    </div>
                </div>
            </section>
        </div>
</template>
<script>
import Dashboard from "../Dashboard";
import {Link, Head} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "DashItems",
    layout: Dashboard,
    components:{Link, Head},
    data(){
      return{
          formatter: ref({
              date:'DD.MM.YYYY',
              month: 'MMM',
          }),
          formValues:{
              datefrom: '',
              dateto: '',
              namud: '',
          },
      }
    },
    props:{
        users: String,
        dujonibaCount: String,
        bisyorCount: String,
        ijronashuda: String,
        shumoraD: String,
        shumoraB: String,

    },
    watch:{
        formValues: {
            handler(newvalue){
                Inertia.get('/dashboard',{formValues:newvalue},{
                    preserveState: true
                });
            },
            deep:true
        },
    },
}
</script>
