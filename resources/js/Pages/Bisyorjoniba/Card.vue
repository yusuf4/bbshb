<template>
    <div class="flex justify-center">
        <div class="p-8 w-3/4">
            <article
                class="animate-background rounded-xl bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-[length:400%_400%] p-0.5 shadow-xl transition [animation-duration:_6s] hover:shadow-sm"
            >
                <div class="rounded-[10px] bg-white p-4 !pt-10 sm:p-6">
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             stroke="currentColor"
                             class="w-6 h-6 text-green-600 cursor-pointer transition ease-in-out delay-150  hover:-translate-y-1.5 duration-300"
                             @click="printPDF"
                        >

                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>

                    </div>
                    <div ref="pdfContent">
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
                                    v-if="card.countries_b.length>0"
                                    class="flex">
                                    <span
                                        v-for="mintaqa in card.countries_b"
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
                                <span class="text-sm text-gray-700 pb-2" v-if="card.file_bisyor<=0">----</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.muhlati_etibor_b.name}}</span>
                                <span class="text-sm text-gray-700 pb-1.5" v-if="card.qati_etibor!=null">{{formated(card.qati_etibor)}}</span>
                                <span class="text-sm text-gray-700 pb-1.5" v-else>-----</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.maqomot}}</span>
                                <span class="text-sm text-gray-700 pb-2">{{card.ezoh}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-1" v-if="card.sanai_etibor==null">
                        <form @submit.prevent="formValues.post(route('bi.qatidast', card.id))">
                            <div>
                                <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate">Санаи пайдо кардани эътибор</p>
                                <div class="flex justify-between">
                                    <vue-tailwind-datepicker
                                        as-single
                                        weekdays-size="min"
                                        :formatter="formatter"
                                        placeholder="Санаи қабул"
                                        i18n="ru"
                                        v-model="formValues.sanai_etibor"
                                        input-classes="block text-sm"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                                    />

                                    <div class="ml-4">
                                        <button
                                            type="submit"
                                            :disabled="formValues.processing"
                                            class="group relative inline-flex items-center overflow-hidden rounded border border-current px-6 py-2 text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                                        >
                                              <span class="absolute -end-full transition-all group-hover:end-4">
                                                <svg
                                                    class="h-5 w-5 rtl:rotate-180"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                  <path
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M17 8l4 4m0 0l-4 4m4-4H3"
                                                  />
                                                </svg>
                                              </span>

                                            <span class="text-sm font-medium transition-all group-hover:me-4">
                                                    Сабт
                                                </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import moment from "moment";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";
import {ref} from "vue";
export default {
    name: "Card",
    layout: Dashboard,
    components:{Link, Head},
    data(){
        return{
            formatter: ref({
                date:'DD.MM.YYYY',
                month: 'MMM',
            })
        }
    },
    props: {
        card: Object,
    },
    setup(){
        const formValues= useForm({
            sanai_etibor: '',
        });
        return {formValues};
    },
    methods:{
        formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        },
        printPDF() {
            const doc = new jsPDF({
                orientation: 'l',
                unit: 'px',
                format: 'a4',
                hotfixes: ['px_scaling'],
            });
            html2canvas(this.$refs.pdfContent, {
                width: doc.internal.pageSize.getWidth(),
                height: doc.internal.pageSize.getHeight()
            }).then((canvas) => {
                const img = canvas.toDataURL("image/png");

                doc.addImage(img, "PNG", 140, 10, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());
                doc.save("bisyorjoniba.pdf");
            })

        },
    }
}
</script>
