<template>
    <Head>
        <title>Шартнома</title>
    </Head>
    <div class="flex justify-center">
        <div class="p-8 w-2/4" >
            <article
                class="animate-background rounded-xl bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-[length:400%_400%] p-0.5 shadow-xl transition [animation-duration:_6s] hover:shadow-sm"
            >
                <div class="rounded-[10px] bg-white p-4 !pt-10 sm:p-6">
                <!-- Card info -->
                    <div ref="pdfContent">
                        <div class="pb-2 border-b">
                            <span class="block text-lg font-medium">{{cardD.name}}</span>
                        </div>
                        <div class="flex justify-start items-start mt-8">
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
                                <span class="text-sm text-gray-700 pb-2">{{formated(cardD.created_at)}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.nomer_d.id}}</span>
                                <div class="flex">
                                        <span
                                            v-for="fileS in cardD.shartnoma_file"
                                            :key="fileS.id"
                                            class="text-sm text-blue-600 pb-2 pr-2"
                                        ><a
                                            :href="'/uploads/shartnoma/'+fileS.name" target="_blank">{{fileS.name}},</a></span>
                                </div>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.namudi_shartnoma.name}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.jonibi_tj}}, {{cardD.jonibi_digar}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{formated(cardD.sanai_etibor)}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.tartibi_etibor.name}}</span>
                                <div class="flex">
                                        <span
                                            v-for="file in files"
                                            :key="file.id"
                                            class="text-sm text-blue-600 pb-2 pr-2"
                                        ><a
                                            v-show="file.namud===1"
                                            :href="'/uploads/files/'+file.name" target="_blank">{{file.name}},</a></span>
                                </div>
                                <span class="text-sm text-gray-700 pb-2" v-if="cardFileCount<=0">----</span>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.muhlati_etibor.name}}</span>
                                <span class="text-sm text-gray-700 pb-1.5" v-if="cardD.qati_etibor!=null">{{formated(cardD.qati_etibor)}}</span>
                                <span class="text-sm text-gray-700 p-1.5" v-else>----</span>
                                <span class="text-sm text-gray-700 pb-2">{{cardD.imzo_tj}}, {{cardD.imzo_digar}}</span>
                                <div class="flex">
                                        <span
                                            v-for="fileN in fileNamud"
                                            :key="fileN.id"
                                            class="text-sm text-blue-600 pb-2 pr-2"
                                        ><a
                                            :href="'/uploads/files/'+fileN.name" target="_blank">{{fileN.name}},</a></span>
                                </div>
                                <span class="text-sm text-gray-700 pb-2" v-if="fileNamud.length<=0">----</span>
                                <div
                                    v-if="cardD.ezoh_d.length>0"
                                    class="flex">
                                    <span
                                        v-for="ezoh in cardD.ezoh_d"
                                        :key="ezoh.id"
                                        class="text-sm text-gray-700 pb-2 pr-2"
                                    >{{ezoh.name}},</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button back -->
                    <div class="flex justify-end">
                        <div>
                            <Link
                                class="group relative inline-flex items-center overflow-hidden rounded border border-current px-6 py-2 text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                                :href="route('guest.index')"
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
import {ref} from "vue";
import {Link, Head,} from "@inertiajs/inertia-vue3";
import moment from "moment";
import NavGuest from "../NavGuest";
export default {
    name: "CardD",
    layout: NavGuest,
    components:{Link,Head},

    data(){
        return{

        }
    },
    props: {
        cardD: Object,
        files: Array,
    },
    methods:{
        formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        },
    },
    computed:{
        fileNamud(){
            return this.files.filter(function(el){
                return el.namud===0;
            })
        },
    }
}
</script>
