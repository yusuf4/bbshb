<template>
    <Head>
        <title>Иҷронашуда</title>
    </Head>
    <div class="main-content">
        <div class="flex justify-end items-center mb-2">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative flex items-center">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input
                    type="text"

                    name="search"
                    id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ҷӯстуҷӯ...">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 bg-blue-300">
            <tr>
                <th scope="col" class="px-2 py-3">
                    №
                </th>
                <th scope="col" class="px-2 py-3 whitespace-nowrap">
                    Санаи қайд
                </th>
                <th scope="col" class="px-2 py-3 whitespace-nowrap">
                    Санаи эътибор
                </th>
                <th scope="col" class="px-6 py-3">
                    Номи шартнома
                </th>
                <th scope="col" class="px-3 py-3">
                    Намуди шартнома
                </th>
                <th scope="col" class="px-6 py-3">
                    Муҳлати шартнома
                </th>
                <th scope="col" class="py-3 px-2">
                    <span class="sr-only">View Edit Download Remove</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr

                class="bg-white border-b hover:bg-gray-100 align-top">
                <th scope="row" class="px-2 py-4 font-medium text-gray-900">
                   Ҷҳӣу
                </th>
                <td class="px-2 py-4 whitespace-nowrap">
                   Some text
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                   dasti qad
                </td>
                <td class="px-5 py-4">
                    some text
                </td>
                <td class="px-3 py-4">
                    some text
                </td>
                <td
                   >
                    some text
                </td>

                <td class="text-right flex justify-end py-4 px-2">
                    <Link
                        class="mr-2 font-medium text-blue-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
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

                        class="mr-2 font-medium text-cyan-700 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                    </Link>
                    <Link
                        onclick="return confirm('Шумо дар ҳақиқат мехоҳед шартномаро нест намоед?')"

                        method="delete"
                        as="button"
                        type="button"
                        class="font-medium text-red-600 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
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
                v-for="link in ijronashuda.links"
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
export default {
    name: "ShartnomaIjronashuda",
    layout: Dashboard,
    components:{Link, Head},
    data(){
        return{

        }
    },
    props: {
        ijronashuda: Array
    },
    computed:{
        ijronUniq()
        {

        }
    }
}
</script>

