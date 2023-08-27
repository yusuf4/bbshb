<template>
    <Head>
        <title>Файл</title>
    </Head>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex justify-between mr-0.5 pb-4">
            <div class="inline-flex rounded-md shadow-sm pl-2 pt-2" role="group">
                <Link
                    :href="route('files.index')"
                    :class="$page.component==='Shartnoma/DujonibaFile' ? 'text-green-600' : ''"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>

                    Дуҷониба
                </Link>

                <Link
                    :href="route('filesB.index')"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 "
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </svg>


                    Бисёрҷониба
                </Link>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input
                    v-model="search"
                    type="text"
                    id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Ҷустуҷуи шартнома...">
            </div>

            <!--<Link
                :href="route('file.zip', zip)" method="post" as="button" type="button"

                class="mt-1 text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-2">Download selected</Link>-->
        </div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-sm text-gray-700  bg-blue-200">
            <tr>
                <!--<th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-one-search" disabled type="checkbox" class="w-4 h-4 text-blue-600 bg-blue-100 border-gray-100 rounded focus:ring-blue-500  focus:ring-2">
                        <label for="checkbox-one-search" class="sr-only">checkbox</label>
                    </div>
                </th>-->
                <th scope="col" class="px-6 py-3">
                    Номи шартнома
                </th>
                <th scope="col" class="px-6 py-3">
                    Санаи қайд
                </th>
                <th scope="col" class="px-6 py-3 items-end">
                    Замима
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="item in files.data"
                :key="item.id"
                class="bg-white border-b hover:bg-gray-50">
                <!--<td class="w-4 p-4">а
                    <div class="flex items-center">
                        <input
                            v-model="zip"
                            :value="file.id"
                            id="checkbox-table-search-1"
                            type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td> -->
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ item.name }}
                </th>
                <td class="px-6 py-4">
                    {{formated(item.created_at)}}
                </td>
                <td class="px-6 py-4"

                >
                    <div
                        v-for="file in item.shartnoma_file"
                        :key="file.id"
                        class="flex justify-items-center pb-2"
                    >
                        <span>
                            <a
                                class="hover:text-blue-500"
                                :href="'uploads/shartnoma/'+file.name" target="_blank"
                            >
                                {{file.name}}
                            </a>

                        </span>
                        <a
                            :href="route('file.download', file.id)"
                            class=" font-medium text-blue-600 hover:underline">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="ml-4 w-4 h-4">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </a>
                    </div>

                </td>
            </tr>
            </tbody>
        </table>
        <!-- Pagination-->
        <div class="flex justify-center my-4">
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in files.links"
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
import {Link, Head} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import moment from "moment";
export default {
    name: "DujonibaFile",
    layout: Dashboard,
    components:{Link, Head},
    data(){
        return {
            search: ref(this.searchlist.search),
        }
    },
    props:{
        files: Object,
        searchlist: Object,
        userName: String,
    },
    methods:{
        formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        },
    },
    watch:{
        search(value){
            Inertia.get('/files', {search: value}, {
                preserveState: true
            });
        }
    }
}
</script>
