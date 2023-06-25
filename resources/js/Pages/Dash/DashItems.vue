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
                        <span class="inline-block text-2xl font-bold">3m 45s</span>
                        <span class="inline-block text-xl text-gray-500 font-semibold">(-32%)</span>
                        <span class="block text-gray-500">Average Engagement Time</span>
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
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">Your insights will appear here soon.</div>
                    <div class="p-4 flex-grow">
                        <div class="flex items-center justify-center h-full px-4 py-16 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">Chart</div>
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
                        <span class="block text-gray-500">Lections left</span>
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
                        <span class="block text-gray-500">Hours spent on lections</span>
                    </div>
                </div>
                <div class="row-span-3 bg-white shadow rounded-lg">
                    <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
                        <span>Users By Country ID</span>
                        <button type="button" class="inline-flex justify-center rounded-md px-1 -mr-1 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-600" id="options-menu" aria-haspopup="true" aria-expanded="true">
                            USERS
                            <svg class="-mr-1 ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Refer here for full dropdown menu code: https://tailwindui.com/components/application-ui/elements/dropdowns -->
                    </div>
                    <div class="overflow-y-auto" style="max-height: 24rem;">
                        <ul class="p-6 space-y-6">
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Annette Watson profile picture">
                                </div>
                                <span class="text-gray-600">United States</span>
                                <span class="ml-auto font-semibold">9.3</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Calvin Steward profile picture">
                                </div>
                                <span class="text-gray-600">Spain</span>
                                <span class="ml-auto font-semibold">8.9</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Ralph Richards profile picture">
                                </div>
                                <span class="text-gray-600">United Kingdom</span>
                                <span class="ml-auto font-semibold">8.7</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Bernard Murphy profile picture">
                                </div>
                                <span class="text-gray-600">Malaysia</span>
                                <span class="ml-auto font-semibold">8.2</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Arlene Robertson profile picture">
                                </div>
                                <span class="text-gray-600">Russia</span>
                                <span class="ml-auto font-semibold">8.2</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Jane Lane profile picture">
                                </div>
                                <span class="text-gray-600">Canada</span>
                                <span class="ml-auto font-semibold">8.1</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Pat Mckinney profile picture">
                                </div>
                                <span class="text-gray-600">India</span>
                                <span class="ml-auto font-semibold">7.9</span>
                            </li>
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="Norman Walters profile picture">
                                </div>
                                <span class="text-gray-600">Australia</span>
                                <span class="ml-auto font-semibold">7.7</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col row-span-3 bg-white shadow rounded-lg">
                    <div class="px-6 py-5 font-semibold border-b border-gray-100">WHAT ARE YOUR TOP CAMPAIGNS?</div>
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
export default {
    name: "DashItems",
    layout: Dashboard,
    components:{Link, Head},
    props:{
        users: String,
        dujonibaCount: String,
        bisyorCount: String,
    }
}
</script>
