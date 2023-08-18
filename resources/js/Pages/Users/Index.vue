<template>
    <Head>
        <title>Истифодабарандаҳо</title>
    </Head>
    <div class="mt-6">
        <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-2 text-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
            <Link :href="route('user.create')"
            >
                Иловаи истифодабаранда
            </Link>
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-1">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Ному Насаб
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Group
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="user in users"
                :key="user.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{user.name}} {{user.nasab}}
                </th>
                <td class="px-6 py-4">
                    {{user.email}}
                </td>
                <td class="px-6 py-4">
                    <p v-if="user.is_admin==1">Administrator</p>
                    <p v-else>Visitor</p>
                </td>
                <td class="text-right flex justify-end py-4 px-4">
                    <Link
                        :href="route('user.edit', user.id)"
                        class="mr-4 font-medium text-blue-600 dark:text-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </Link>
                    <Link
                        onclick="return confirm('Шумо дар ҳақиқат мехоҳед истифодабарандаи зеринро нест намоед?')"
                        :href="route('user.delete', user.id)"
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

    </div>
</template>

<script>
import Dashboard from "../Dashboard";
import {Link, Head} from "@inertiajs/inertia-vue3";
export default {
    name: "Index",
    layout: Dashboard,
    components:{Dashboard,Link,Head},
    props:{
        users: Array,
        userName: String
    },
    computed:{

    }
}
</script>
