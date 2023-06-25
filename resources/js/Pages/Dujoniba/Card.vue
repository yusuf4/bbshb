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

                        <div class="flex justify-start items-center mt-8">
                            <div class="flex flex-col mb-2 mr-20">
                                <span class="text-sm font-medium pb-2">Таърих</span>
                                <span class="text-sm font-medium pb-2">№ қайд</span>
                                <span class="text-sm font-medium pb-2">Файли сканшудаи шартнома</span>
                                <span class="text-sm font-medium pb-2">Намуди шартнома</span>
                                <span class="text-sm font-medium pb-2">Тарафҳои шартнома</span>
                                <span class="text-sm font-medium pb-2">Санаи пайдо намудани эътибор</span>
                                <span class="text-sm font-medium pb-2">Тартиби пайдо намудани эътибор</span>
                                <span class="text-sm font-medium pb-2">Файли сканшуда марбут ба расмиёт</span>
                                <span class="text-sm font-medium pb-2">Муҳлати эътибор</span>
                                <span class="text-sm font-medium pb-2">Санаи қатъи эътибор</span>
                                <span class="text-sm font-medium pb-2">Имзокунандагон</span>
                                <span class="text-sm font-medium pb-2">Файли қарори Ҳукумати ҶТ ё Ваколатнома</span>
                                <span class="text-sm font-medium pb-2">Эзоҳ</span>
                            </div>
                            <div class="flex flex-col  mb-2">
                                <span class="text-sm text-gray-700 pb-2">{{formated(card.created_at)}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.nomer_d.id}}</span>
                                <span class="text-sm text-blue-600 pb-2"><a :href="'/uploads/shartnoma/'+card.file_shartnoma.name" target="_blank">{{card.file_shartnoma.name}}</a></span>
                                <span class="text-sm text-gray-700 pb-2">{{card.namudi_shartnoma.name}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.jonibi_tj}}, {{card.jonibi_digar}}</span>
                                <span class="text-sm text-gray-700 pb-2" v-if="card.sanai_etibor!=null">{{formated(card.sanai_etibor)}}</span>
                                <span class="text-sm text-gray-700 pb-2" v-else>----</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.tartibi_etibor.name}}</span>
                                <div class="flex">
                                    <span
                                        v-for="file in files"
                                        :key="file.id"
                                        class="text-sm text-blue-600 pb-2.5 pr-2"
                                    ><a :href="'/uploads/files/'+file.name" target="_blank">{{file.name}},</a></span>
                                </div>
                                <span class="text-sm text-gray-700 pb-2">{{card.muhlati_etibor.name}}</span>
                                <span class="text-sm text-gray-700 pb-1.5" v-if="card.qati_etibor!=null">{{formated(card.qati_etibor)}}</span>
                                <span class="text-sm text-gray-700 pb-1.5" v-else>----</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.imzo_tj}}, {{card.imzo_digar}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.imzo_tj}}, {{card.imzo_digar}}</span>
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
                                    :href="route('do.index')"
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
    components:{Link,Head},
    data(){
        return{

        }
    },
    props: {
        card: Object,
        files: Array,
    },
    methods:{
        formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        }
    }
}
</script>

