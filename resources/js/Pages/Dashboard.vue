<template>
  <div class="flex w-screen h-screen no-scrollbar ">
      <!-- Side bar menu-->
      <div class="w-[380px] h-full bg-gray-200 text-white text-center relative" v-if="showSide">
          <!-- LOGO -->
        <div class="logo-nane h-[50px] bg-gray-900 flex justify-center items-center">
            <div class="px-[20px] cursor-default">
                <h3 class="font-bold text-xl">ББШБ+</h3>

            </div>
        </div>
          <!-- MENU -->
        <div class="h-[calc(100vh-50px)] bg-gray-800 py-[20px] ">
            <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px] ">
                <div class=" flex flex-col justify-between space-y-[10px]">
                    <div class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-blue-800  transition duration-400 ease-in-out">
                        <Link
                            :class="$page.component==='Dash/DashItems' && 'text-green-400'"
                            :href="route('dash.index')"
                            class="flex justify-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="mr-2 w-5 h-5 opacity-100">
                                aria-hidden="true"
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            Асоси
                        </Link>
                    </div>

                    <details class="group [&_summary::-webkit-details-marker]:hidden" :open="$page.component==='Dujoniba/Add'||$page.component==='Dujoniba/Index'||$page.component==='Dujoniba/Edit'||$page.component==='Dujoniba/Card'">
                        <summary
                            class="flex cursor-pointer hover:text-gray-800 items-center justify-between rounded-lg px-2 py-2 text-white hover:bg-gray-100 hover:text-gray-700"
                        >
                            <div class="flex items-center gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5 opacity-100">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>

                                <span class="text-sm font-medium"> Шартномаҳои дуҷониба </span>
                            </div>

                            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                 <svg
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     viewBox="0 0 20 20"
                                     fill="currentColor"
                                 >
                                  <path
                                      fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"
                                  />
                            </svg>
                            </span>
                        </summary>

                        <nav aria-label="Teams Nav" class="mt-2 flex flex-col px-4">
                            <Link
                                :href="route('duinput.create')"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-blue-700 "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-5 w-5 opacity-120">
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>

                                <span class="text-sm font-medium" :class="$page.component==='Dujoniba/Add' && 'text-green-400'"> Иловаи Шартнома </span>
                            </Link>

                            <Link
                                :href="route('do.index')"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-blue-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                </svg>
                                <span class="text-sm font-medium" :class="$page.component==='Dujoniba/Index' || $page.component==='Dujoniba/Edit' || $page.component==='Dujoniba/Card' ? 'text-green-400' : ''"> Шартномаҳо </span>
                            </Link>
                        </nav>
                    </details>

                    <details class="group [&_summary::-webkit-details-marker]:hidden" :open="$page.component==='Bisyorjoniba/Add'||$page.component==='Bisyorjoniba/Index'||$page.component==='Bisyorjoniba/Edit' || $page.component==='Bisyorjoniba/Card'">
                        <summary
                            class="flex cursor-pointer hover:text-gray-800 items-center justify-between rounded-lg px-2 py-2 text-white hover:bg-gray-100 hover:text-gray-700"
                        >
                            <div class="flex items-center gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor"
                                    class="w-5 h-5 opacity-100">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                                </svg>

                                <span class="text-sm font-medium"> Шартномаҳои бисёрҷониба </span>
                            </div>
                            <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                 <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                  <path
                                      fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"
                                  />
                            </svg>
                            </span>
                        </summary>
                        <nav aria-label="Teams Nav" class="mt-2 flex flex-col px-4">
                            <Link
                                :href="route('bi.create')"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-blue-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-5 w-5 opacity-120">
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                <span class="text-sm font-medium" :class="$page.component==='Bisyorjoniba/Add' && 'text-green-400'"> Иловаи Шартнома </span>
                            </Link>

                            <Link
                                :href="route('bi.index')"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-white hover:bg-gray-100 hover:text-blue-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                </svg>
                                <span class="text-sm font-medium" :class="$page.component==='Bisyorjoniba/Index' || $page.component==='Bisyorjoniba/Edit' || $page.component==='Bisyorjoniba/Card' ? 'text-green-400' : ''"> Шартномаҳо </span>
                            </Link>
                        </nav>
                    </details>

                    <div class="inline-flex relative items-center px-2 py-2 w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-blue-800  transition duration-400 ease-in-out">
                        <Link
                            :href="route('ijd.index')"
                            :class="$page.component==='Shartnoma/IjronashudaD' || $page.component==='Shartnoma/IjronashudaB' ? 'text-green-400' : ''"
                            class="flex cursor-default">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5 mr-2 opacity-100">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                            </svg>
                            Шартномаҳои иҷронашуда
                        </Link>
                    </div>

                    <div class="inline-flex relative items-center px-2 py-2 w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-blue-800  transition duration-400 ease-in-out ">
                        <Link
                            :href="route('files.index')"
                            :class="$page.component==='Shartnoma/DujonibaFile' || $page.component==='Shartnoma/BisyorjonibaFile' ? 'text-green-400' : ''"
                            class="flex cursor-default">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="mr-2 w-5 h-5 opacity-100">
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                            </svg>
                            Шартномаҳо PDF
                    </Link>
                    </div>
                    <div class="inline-flex relative items-center px-2 py-2 w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-blue-800  transition duration-400 ease-in-out ">
                        <Link :href="route('users.index')"
                           :class="$page.component==='Users/Index' && 'text-green-400'"
                           class="flex cursor-pointer">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="mr-2 w-5 h-5 opacity-100">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Истифодабарандаҳо
                        </Link>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- End Side bar menu -->

      <!-- Header menu and main content -->
      <div class="w-full h-full bg-gray-400">
          <!-- Header menu -->
          <div class="h-[50px] bg-gray-200 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b text-white">
              <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class=" w-[25px] h-[25px]">
                      <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                  </svg>
              </div>
              <div class="w-[calc(100%-30px)] flex pb-2 justify-between ">
                  <!-- Logo section -->
                  <div class="header-search w-[calc(100%-200px)] flex justify-center items-center ">
                      <img src="../img/corona.png" class="h-8 w-10 mr-4 rounded-full" v-if="$page.component==='Dash/DashItems'">
                      <div class="flex flex-col text-center" v-show="$page.component==='Dash/DashItems'">
                          <span class="pt-1 text-lg text-blue-700 font-medium">Вазорати корҳои хориҷии Ҷумҳурии Тоҷикистон</span>
                          <span class="text-sm text-blue-700 font-medium">Барномаи бақайдгирии шартномаҳои байналмилалӣ</span>
                      </div>
                      <div class="flex text-center" v-show="$page.component==='Dujoniba/Index'">
                          <span class="pt-1 text-lg text-blue-700 font-medium">Шартномаҳои дуҷониба</span>
                      </div>
                      <div class="flex text-center" v-show="$page.component==='Bisyorjoniba/Index'">
                          <span class="pt-1 text-lg text-blue-700 font-medium">Шартномаҳои бисёрҷониба</span>
                      </div>
                      <div class="flex text-center" v-show="$page.component==='Users/Index'">
                          <span class="pt-1 text-lg text-blue-700 font-medium">Истифодабарандаҳо</span>
                      </div>
                  </div>
                  <!-- User login -->
                  <div class="w-[200px] mt-2 pl-20">
                      <div class="flex items-center  justify-start space-x-4 cursor-pointer" @click="toggleDrop">
                          <img class="w-10 h-10 rounded-full border-2 border-gray-50" src="../img/25.jpg" alt="">
                          <div class="font-semibold text-left">
                              <div class="text-black">{{$page.props.userName}}</div>
                              <div class="text-xs text-gray-500">Admin</div>
                          </div>
                      </div>
                      <!-- Drop down -->
                      <div v-show="showDropDown" class="absolute right-[10px] z-10 mt-2 w-44 origin-top-right rounded-md bg-white shadow-lg  ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                          <div class="py-1 text-left " role="none">
                              <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                              <form method="POST" @submit.prevent="submit" role="none">
                                  <button type="submit" class="cursor-default text-gray-700 block hover:bg-gray-200 hover:text-blue-700 w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">Баромад</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Main content -->
          <div class="h-[calc(100vh-50px)] bg-gray-50 p-2 relative overflow-auto">
              <div class="border border-gray-300 rounded-md p-2 ">
                  <slot></slot>
              </div>
          </div>
      </div>
      <!-- Main -->
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "Dashboard",
    components: { Link },
    data(){
        return{
            showDropDown: false,
            showSide: true,
        };
    },
    props:{
      userName: String,
      userProfile: Array,
    },
    methods:{
        // hide show side bar
        toggleSideBar() {
            this.showSide = !this.showSide

        },
        // toggle user
        toggleDrop() {
            this.showDropDown = !this.showDropDown

        },
        hideMenu(){
            this.showSide = false; // Hide nav menu when viewing table item
        }
    },
    setup(){
        function submit() {
            Inertia.post(route('logoute'));
        }
        return {submit};
    }

}
</script>

