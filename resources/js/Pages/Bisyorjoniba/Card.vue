<template>
    <div class="flex justify-center">
        <div class="p-8 w-3/4">
            <article
                class="animate-background rounded-xl bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-[length:400%_400%] p-0.5 shadow-xl transition [animation-duration:_6s] hover:shadow-sm"
            >
                <div class="rounded-[10px] bg-white p-4 !pt-10 sm:p-6">
                    <div class="pb-2 border-b">
                        <span class="block text-lg font-medium">{{card.name}}</span>
                    </div>

                    <div class="flex  items-start mt-8">
                        <div class="flex flex-col mb-2 mr-20">
                            <span class="text-sm font-medium pb-2">Таърих</span>
                            <span class="text-sm font-medium pb-2">№ қайд</span>
                            <span class="text-sm font-medium pb-2">Файли сканшудаи шартнома</span>
                            <span class="text-sm font-medium pb-2">Намуди шартнома</span>
                            <span class="text-sm font-medium pb-2">Минтақаҳо</span>
                            <span class="text-sm font-medium pb-2">Санаи пайдо намудани эътибор</span>
                            <span class="text-sm font-medium pb-2">Тартиби пайдо намудани эътибор</span>
                            <span class="text-sm font-medium pb-2">Файли сканшуда марбут ба расмиёт</span>
                            <span class="text-sm font-medium pb-2">Муҳлати эътибор</span>
                            <span class="text-sm font-medium pb-2">Санаи қатъи эътибор</span>
                            <span class="text-sm font-medium pb-2">Мақомоти масъул вобаста ба расмиёт</span>
                            <span class="text-sm font-medium pb-2">Эзоҳ</span>
                        </div>
                        <div class="flex flex-col  mb-2">
                            <span class="text-sm text-gray-700 pb-2">{{formated(card.created_at)}}</span>
                            <span class="text-sm text-gray-700 pb-2">{{card.nomer_b.id}}</span>
                            <span class="text-sm text-blue-600 pb-2"><a :href="'/uploads/shartnoma/'+card.fileshartnoma_b.name" target="_blank">{{card.fileshartnoma_b.name}}</a></span>
                            <span class="text-sm text-gray-700 pb-2">{{card.namud_b.name}}</span>
                            <div
                                v-if="card.mintaqaho.length>0"
                                class="flex">
                                    <span
                                        v-for="mintaqa in card.mintaqaho"
                                        :key="mintaqa.id"
                                        class="text-sm text-gray-700 pb-2 pr-2"
                                    >{{mintaqa.name}},</span>
                            </div>
                            <div v-else>
                                <span class="text-sm text-gray-700 pb-2">----</span>
                            </div>
                            <span class="text-sm text-gray-700 pb-1.5" v-if="card.sanai_etibor!=null">{{formated(card.sanai_etibor)}}</span>
                            <span class="text-sm text-gray-700 pb-1.5" v-else>-----</span>
                            <span class="text-sm text-gray-700 pb-2">{{card.tartibi_etibor_b.name}}</span>
                            <div class="flex">
                                    <span
                                        v-for="file in card.file_bisyor"
                                        :key="file.id"
                                        class="text-sm text-blue-600 pb-2.5 pr-2"
                                    ><a :href="'/uploads/files/'+file.name" target="_blank">{{file.name}},</a></span>
                            </div>
                            <span class="text-sm text-gray-700 pb-2">{{card.muhlati_etibor_b.name}}</span>
                            <span class="text-sm text-gray-700 pb-1.5" v-if="card.qati_etibor!=null">{{formated(card.qati_etibor)}}</span>
                            <span class="text-sm text-gray-700 pb-1.5" v-else>-----</span>
                            <span class="text-sm text-gray-700 pb-2">{{card.maqomot}}</span>
                            <span class="text-sm text-gray-700 pb-2">{{card.ezoh}}</span>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-1">
                            <span
                                class="whitespace-nowrap rounded-full bg-purple-100 px-2.5 py-0.5 text-xs text-purple-600"
                            >
                                Snippet
                            </span>
                        <span
                            class="whitespace-nowrap rounded-full bg-purple-100 px-2.5 py-0.5 text-xs text-purple-600"
                        >
                                JavaScript
                            </span>
                    </div>
                    <!-- Button back -->
                    <div class="flex justify-end">
                        <div>
                            <Link
                                class="group relative inline-flex items-center overflow-hidden rounded border border-current px-6 py-2 text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                                :href="route('bi.index')"
                            >
                              <span class="absolute -start-full transition-all group-hover:start-4">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                    </svg>
                                </span>
                                <span class="text-sm font-medium transition-all group-hover:ms-4">
                                        Ба ақиб
                                    </span>
                            </Link>
                        </div>
                    </div>

                </div>
            </article>
        </div>
    </div>
</template>

<script>
import Dashboard from "../Dashboard";
import {Link, Head} from "@inertiajs/inertia-vue3";
import moment from "moment";
export default {
    name: "Card",
    layout: Dashboard,
    components:{Link, Head},
    props: {
        card: Object,
    },
    methods:{
        formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        }
    }
}
</script>
