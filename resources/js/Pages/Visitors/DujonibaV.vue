<template>
    <Head>
        <title>Дуҷониба</title>
    </Head>
    <div class="w-full p-2">
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
                class="bg-white border-b hover:bg-gray-100 align-top">
                <th scope="row" class="px-2 py-4 font-medium text-gray-900">
                    1
                </th>
                <td class="px-2 py-4 place-content-start">
                    Some text
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    Some text
                </td>
                <td class="flex-wrap px-5 py-4">
                    Some text
                </td>
                <td class="px-3 py-4">
                    Some text
                </td>
                <td

                    class="px-5 py-4">
                    Some text
                </td>
                <td class="text-right flex justify-end py-4 px-2">
                    <Link

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

                    <!-- <a
                        :href="route('du.download', item.id)"
                       class="mr-2 font-medium text-green-800 dark:text-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a> -->
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import NavGuest from "../NavGuest";
import {Head, Link} from "@inertiajs/inertia-vue3";
export default {
    name: "DujonibaV",
    layout: NavGuest,
    components:{Link, Head},
}
</script>

