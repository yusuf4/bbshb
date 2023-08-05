<template>
    <Head>
        <title>Шартномаҳо</title>
    </Head>
    <div class="relative  shadow-md sm:rounded-lg">
        <div v-if="$page.props.flash.message" class="text-blue-500 text-center bg-blue-50">
            {{$page.props.flash.message}}
        </div>
        <div class="flex items-center justify-between pb-1">
            <div>
                <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                    <Link :href="route('duinput.create')"
                    >
                        Иловаи шартнома
                    </Link>
                </button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input
                        type="text"
                        v-model="search"
                        name="search"
                        id="table-search"
                        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ҷӯстуҷӯи шартномаҳо">
                    <div
                        @click="FilterToggle"
                        class="mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-6 h-6 text-blue-600">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </div>
            </div>
        </div>
        <div class="my-2" v-show="datefilter">
            <div class="flex justify-end items-center" >

                <div class="flex justify-end w-full">
                    <div class="flex items-center mr-4">
                        <input
                            v-model="ijronashuda"
                            checked id="red-checkbox"
                            type="checkbox" value=""
                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                        <label for="red-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Шартномаҳои иҷронашуда</label>
                    </div>
                    <div class="w-1/6 mr-2">
                        <select
                            v-model="searchnamud"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="">Намуди шартнома</option>
                            <option value="1">Байнидавлатӣ</option>
                            <option value="2">Байниҳукуматӣ</option>
                            <option value="3">Байниидоравӣ</option>
                        </select>
                    </div>
                    <div class="w-1/6">
                        <vue-tailwind-datepicker
                            as-single
                            weekdays-size="min"
                            :formatter="formatter"
                            placeholder="Ҷустуҷу аз санаи"
                            i18n="ru"
                            v-model="formValues.datefrom"
                            input-classes="block text-sm bg-gray-50 border border-gray-300"
                            class=" text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                        />
                    </div>
                    <div class="w-1/6 mx-2 ">
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
                <div class="mr-2">
                    <Link
                        :href="route('do.index')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor"
                             class="w-6 h-6 text-red-600">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 bg-blue-300">
            <tr>
                <th scope="row" class="px-2 py-3 font-medium text-gray-900">
                    №
                </th>
                <th scope="col" class="px-2 py-3 whitespace-nowrap">
                    Санаи қайд
                </th>
                <th scope="col" class="px-2 py-3">
                    Санаи эътибор
                </th>
                <th scope="col" class="px-6 py-3">
                    Номи шартнома
                </th>
                <th scope="col" class="px-3 py-3">
                    Намуди шартнома
                </th>
                <th scope="col" class="px-5 py-3">
                    Муҳлати шартнома
                </th>
                <th scope="col" class="py-3 px-2">
                    <span class="sr-only">View Edit Download Remove</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="item in dujoniba.data"
                :key="item.id"
                :class="item.sanai_etibor!=null && 'text-blue-600'"
                class="bg-white border-b hover:bg-gray-100 align-top">
                <th scope="row" class="px-2 py-4 font-medium text-gray-900">
                    {{item.nomer_d.id}}
                </th>
                <td class="px-2 py-4 place-content-start">
                    {{formated(item.created_at)}}
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <span v-if="item.sanai_etibor==null" class="cursor-help inline-flex items-center bg-gray-200 text-red-700 text-xs font-medium mr-2 pl-2 pr-3 pb-0.5 rounded-full">
                        <span class="animate-ping w-2 h-2 mr-1.5 mt-0.5 bg-red-700 rounded-full"></span>
                        қатъи дасти
                    </span>
                    <span v-else>{{formated(item.sanai_etibor)}}</span>
                </td>
                <td class="flex-wrap px-5 py-4">
                    {{item.name}}
                </td>
                <td class="px-3 py-4">
                    {{item.namudi_shartnoma.name}}
                </td>
                <td
                    v-show="item.muhlati_etibor.id===1"
                    class="px-5 py-4">
                    {{formated(item.qati_etibor)}}
                </td>
                <td
                    v-show="item.muhlati_etibor.id===2"
                    class="px-5 py-4">
                    {{item.muhlati_etibor.name}}
                </td>
                <td class="text-right flex justify-end py-4 px-2">
                    <Link
                        :href="route('do.card', item.id)"
                        class="mr-2 font-medium text-blue-600 dark:text-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </Link>
                    <Link
                        :href="route('du.edit', item.id)"
                       class="mr-2 font-medium text-cyan-700 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                    </Link>
                    <a
                        :href="route('du.download', item.file_shartnoma_id)"
                       class="mr-2 font-medium text-green-800 dark:text-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                    <Link
                        onclick="return confirm('Шумо дар ҳақиқат мехоҳед шартномаро нест намоед?')"
                        :href="`/delete/${item.id}`"
                        method="delete"
                        as="button"
                        type="button"
                        class="font-medium text-red-600 dark:text-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Pagination-->
        <div class="flex justify-center my-4">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in dujoniba.links"
                :href="link.url"
                v-html="link.label"
                class="relative block rounded bg-transparent px-2 py-1.5 text-sm transition-all duration-300 dark:text-neutral-400"
                :class="{'text-gray-500': ! link.url, 'text-blue-600 font-medium': link.active }"
            />
        </div>

     </div>

 </template>
<script>
 import Dashboard from "../Dashboard";
 import { Link, Head, useForm } from '@inertiajs/inertia-vue3'
 import {ref} from "vue";
 import {Inertia} from "@inertiajs/inertia";
 import Pagination from "../Pagination";
 import moment from "moment";
 export default {
     name: "Index",
     layout: Dashboard,
     components:{Pagination, Link, Head},
     data(){
         return {
             formatter: ref({
                 date:'DD.MM.YYYY',
                 month: 'MMM',
             }),
             showMenu: false,
             search: ref(this.searchlist.search),
             searchnamud: '',
             ijronashuda: false,
             datefilter: false,
             formValues:{
                 datefrom: '',
                 dateto: ''
             }
         }
     },
     props:{
         dujoniba:Object,
         searchlist: Object,
     },
     methods: {
         formated(value) {
             return  moment(value).format('DD.MM.YYYY');
         },
         FilterToggle(){
             this.datefilter=!this.datefilter;
         }
     },
     watch:{
         search(value){
             Inertia.get('/doindex', {search: value}, {
                 preserveState: true
             });
         },
         searchnamud(value){
             Inertia.get('/doindex',{searchnamud:value},{
                 preserveState: true
             });
         },
         formValues: {
             handler(newvalue){
                 //const formatSD = moment(newvalue.datefrom).format('YYYY-MM-DD')
                 //const formatED = moment(newvalue.dateto).format('YYYY-MM-DD')
                 //const sddd = moment(newdatef).format('YYYY-MM-DD')
                 Inertia.get('/doindex',{formValues:newvalue},{
                     preserveState: true
                 });
                 console.log(`Calling API with ${newvalue.datefrom} and ${newvalue.dateto}`)
             },
             deep:true
         },
         ijronashuda(value){
             Inertia.get('/doindex', {ijronashuda: value}, {
                 preserveState: true
             });
         }
     },
 }
 </script>
