<template>
    <Head>
        <title>Тағйири шартнома</title>
    </Head>
    <div class="flex-1 h-full">
        <h1 class="font-bold text-2xl text-blue-400 text-blue-700 text-center pb-4 pt-1">Тағйири шартнома</h1>
        <form class="p-4" @submit.prevent="submit">
            <!-- Section One -->
            <div class="grid gap-6 mb-6 md:grid-cols-2 items-start">
                <div class="nomi-shartnoma">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Номи пурраи шартнома</label>
                    <input type="text"
                           id="name"
                           name="name"
                           v-model="formValues.name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Шартнома дар самти...">
                    <div v-if="errors.name" class="text-red-600">{{errors.name}}</div>
                </div>
                <div class="shartnomfa-file">
                    <label
                        for="formFile"
                        class="mb-2 inline-block text-sm font-medium text-gray-900"
                    >Файли сканшудаи шартнома PDF</label
                    >
                    <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                        type="file"
                        name="shartnoma_file[]"
                        @change="selectFile"
                        @input="formValues.shartnoma_file = $event.target.files[0]"
                        id="formFile"/>
                    <div class="flex">
                        <a
                            class="hover:text-green-400 text-blue-500 text-sm"
                            :href="'/uploads/shartnoma/'+dujoniba.file_shartnoma.name" target="_blank">
                            {{dujoniba.file_shartnoma.name}}
                        </a>
                    </div>
                    <div v-if="errors.shartnoma_file" class="text-red-600">{{errors.shartnoma_file}}</div>
                </div>
                <div class="jonibho">
                    <div class="jonibi-tj">
                        <label for="jonibi-tj" class="block mb-2 text-sm font-medium text-gray-900">Аз ҷониби ҶТ</label>
                        <input type="text"
                               id="jonibi-tj"
                               name="jonibi_tj"
                               v-model="formValues.jonibi_tj"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Тарафҳои шартнома...">
                        <div v-if="errors.jonibi_tj" class="text-red-600">{{errors.jonibi_tj}}</div>
                    </div>
                    <div class="jonibi-digar mt-4">
                        <label for="jonibi_digar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Аз ҷониби дигар</label>
                        <input type="text"
                               id="jonibi_digar"
                               name="jonibi_digar"
                               v-model="formValues.jonibi_digar"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Тарафҳои шартнома...">
                        <div v-if="errors.jonibi_digar" class="text-red-600">{{errors.jonibi_digar}}</div>
                    </div>
                </div>
                <div class="namud-tartib">
                    <div class="namudi-shartnoma ">
                        <h3 class="mb-2 text-sm font-medium text-gray-900">Намуди шартнома</h3>
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input id="horizontal-list-radio-davlati"
                                           type="radio"
                                           value= 1
                                           name="list-radio"
                                           v-model="formValues.namud"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="horizontal-list-radio-davlati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Байнидавлатӣ </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-hukumati"
                                        type="radio"
                                        value= 2
                                        name="list-radio"
                                        v-model="formValues.namud"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="horizontal-list-radio-hukumati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Байниҳукуматӣ</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-idoravi"
                                        type="radio"
                                        value= 3
                                        name="list-radio"
                                        v-model="formValues.namud"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="horizontal-list-radio-idoravi" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Байниидоравӣ</label>
                                </div>
                            </li>
                        </ul>
                        <div v-if="errors.namud" class="text-red-600">{{errors.namud}}</div>
                    </div>
                    <div class="tartibi-etibor mt-4 ">
                        <label for="qarorho" class="block mb-2 text-sm font-medium text-gray-900">Тартиби пайдо намудани эътибор</label>
                        <select
                            id="qarorho"
                            @change="PartSix($event)"
                            v-model="formValues.tartib"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option  value="">Интихоб</option>
                            <option value="1" >Қарори Ҳукумати ҶТ</option>
                            <option value="2" >Фармони Президенти ҶТ</option>
                            <option value="3" >Қарори Маҷлиси намояндагони Маҷлиси Олии ҶТ</option>
                            <option value="4">Аз лаҳзаи имзо</option>
                            <option value="5">Дигар</option>
                        </select>
                    </div>
                    <div v-if="errors.tartib" class="text-red-600">{{errors.tartib}}</div>
                </div>
                <!-- Bandi 6 Calendar default is hide -->
                <div class="">
                    <p class="block mb-2 text-sm font-medium text-gray-900 truncate">Санаи пайдо кардани эътибор</p>
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
                </div>
                <!-- Banhoi 1 2 3 az bandi 6 default is hide -->
                <div class="w-full truncate" v-show="sixShow && showPartSix">
                    <label class="block mb-2 text-sm font-medium text-gray-900 truncate" for="files_scan">Файли сканшудаи марбут ба расмиёти дохилидавлатӣ</label>
                    <input
                        id="files_scan"
                        type="file"
                        multiple
                        @change="selectFile"
                        @input="formValues.files_scan = $event.target.files"
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <!-- Lists of files bandi 6 -->
                    <div
                        v-for="files in dujoniba.file_dujoniba"
                        :key="files.id"
                        class="flex">
                        <Link
                            method="delete" as="button" type="button"
                            :href="route('del.qaror', files.id)">
                            <svg
                                class="w-5 h-5 mr-1.5 text-red-500"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </Link>
                        <a
                            class="hover:text-green-400 text-blue-500 text-sm"
                            :href="'/uploads/files/'+files.name" target="_blank">
                            {{files.name}}
                        </a>

                    </div>
                    <div v-if="errors.files_scan" class="text-red-600">{{errors.files_scan}}</div>
                </div>
                <!-- Bandi 5 default is hide -->
                <div class="w-full" v-show="sixShow && PartSixDigar">
                    <label for="bandi-shash" class="block mb-2 text-sm font-medium text-gray-900">Дигар</label>
                    <input type="text"
                           id="bandi-shash"
                           name="etibor_digar"
                           v-model="formValues.etibor_digar"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Вориди матн">
                </div>
            </div>
            <!-- Muhlati Etibor -->
            <div class="mb-4 border-t-4 border-blue-300 border-b-4 pb-6">
                <h1 class="text-base text-blue-600 text-sm font-medium text-start mt-4">Муҳлати эътибор</h1>
                <div class="flex justify-between justify-items-center items-center	space-x-4">
                    <div class="w-full mt-7">
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-muhlat"
                                        @click="disabled =false; vshowEnd=true"
                                        type="radio" value="1"
                                        name="list-radio-muhlat"
                                        v-model="formValues.muhlat"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="horizontal-list-radio-muhlat" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Муҳлатнок</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-bemuhlat"
                                        @click="disableInput"
                                        v-model="formValues.muhlat"
                                        type="radio"
                                        value="2"
                                        name="list-radio-muhlat"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="horizontal-list-radio-bemuhlat" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Бемуҳлат</label>
                                </div>
                            </li>
                        </ul>
                        <div v-if="errors.muhlat" class="text-red-600">{{errors.muhlat}}</div>
                    </div>
                    <div class="w-full">
                        <p class="block mb-2 text-sm font-medium text-gray-900">Санаи қатъи эътибор</p>
                        <vue-tailwind-datepicker
                            as-single
                            v-show="vshowEnd"
                            :disabled="disableField && disabled"
                            weekdays-size="min"
                            :formatter="formatter"
                            placeholder="қатъи эътибор"
                            i18n="ru"
                            v-model="formValues.muhlatEnd"
                            input-classes="block text-sm"
                            :class="disabled ? 'text-white' : '' "
                            class="disabled:opacity-75 disabled:bg-gray-300 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                        />
                    </div>
                </div>
            </div>
            <!-- Imzokunandagon -->
            <h1 class="text-base text-blue-600 font-medium text-start mt-2">Имзокунандагон</h1>
            <div class="flex justify-between items-start flex-wrap md:flex-nowrap mt-2 space-x-4 py-4">
                <div class="w-full">
                    <label for="tj-imzo" class="block mb-2 text-sm font-medium text-gray-900">Ҷониби ҶТ</label>
                    <input
                        type="text"
                        id="tj-imzo"
                        name="imzo_tj"
                        v-model="formValues.imzo_tj"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Номи ва вазифаи имзокунанда">
                </div>
                <div class="w-full">
                    <label for="digar-imzo" class="block mb-2 text-sm font-medium text-gray-900">Ҷониби дигар</label>
                    <input type="text"
                           id="digar-imzo"
                           name="imzo_digar"
                           v-model="formValues.imzo_digar"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Номи ва вазифаи имзокунанда">
                </div>
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate" for="vakolad_file">Файли сканшудаи қарори Ҳукумати ҶТ ё Ваколатнома</label>
                    <input
                        id="vakolad_file"
                        type="file"
                        name="vakolat"
                        @change="selectFile"
                        @input="formValues.vakolat = $event.target.files"
                        multiple
                        class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
                    <!-- Lists of files vakolat -->
                    <div
                        v-for="files in dujoniba.file_dujoniba"
                        :key="files.id"
                        class="flex">
                        <Link
                            method="delete" as="button" type="button"
                            :href="route('del.vakolat', files.id)">
                            <svg
                                class="w-5 h-5 mr-1.5 text-red-500"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </Link>
                        <a
                            class="hover:text-green-400 text-blue-500 text-sm"
                            :href="'/uploads/vakolat/'+files.name" target="_blank">
                            {{files.name}}
                        </a>

                    </div>
                </div>
                <div class="w-full">
                    <label for="ezoh" class="block mb-2 ml-2 text-sm font-medium text-gray-900">Эзоҳ</label>
                    <input type="text"
                           id="ezoh"
                           name="ezoh"
                           v-model="formValues.ezoh"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Матн">
                </div>
            </div>

            <!-- Save buttons -->
            <div class="flex justify-end items-center text-center mt-[40px]">
                <div class="back-buuton  mt-1">
                    <Link
                        class="inline-block rounded-full border border-indigo-600 bg-indigo-600 p-3 text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                        :href="route('do.index')"
                    >
                        <span class="sr-only">HOME</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="w-4 h-4">
                            <path
                                stroke-linecap="round"
                                stroke-width="2"
                                stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </Link>
                </div>
                <button
                    type="submit"
                    :disabled="formValues.processing"
                    class=" ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Сабт</button>
            </div>

        </form>
    </div>
</template>

<script>
import Dashboard from "../Dashboard";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {ref} from "vue";
import moment from "moment";
export default {
    name: "Edit",
    layout: Dashboard,
    components: {Link, Head},
    data(){
        return{
            showPartSix: false,
            PartSixDigar: false,
            selected: '',
            disabled: false,
            vshowEnd: true,
            formatter: ref({
                date:'DD.MM.YYYY',
                month: 'MMM',
            })
        };
    },
    props:{
        dujoniba: Object,
        errors: Object,
    },
    setup(props){
        const formValues= useForm({
            id: props.dujoniba.id,
            name: props.dujoniba.name,
            shartnoma_file: null,
            jonibi_tj: props.dujoniba.jonibi_tj,
            jonibi_digar: props.dujoniba.jonibi_digar,
            sanai_etibor: props.dujoniba.sanai_etibor!=null ? formated(props.dujoniba.sanai_etibor) : '',
            files_scan: [],
            etibor_digar: props.dujoniba.etibor_digar,
            namud: props.dujoniba.namudi_shartnoma_id,
            tartib: props.dujoniba.tartibi_etibor_id,
            muhlat: props.dujoniba.muhlati_etibor_id,
            muhlatEnd: props.dujoniba.qati_etibor!=null ? formated(props.dujoniba.qati_etibor) : '',
            imzo_tj: props.dujoniba.imzo_tj,
            imzo_digar: props.dujoniba.imzo_digar,
            vakolat: [],
            ezoh: props.dujoniba.ezoh,
            _method: "PUT"
        });
        function submit(){
            Inertia.post(route('du.update', props.dujoniba.id), formValues, {
                forceFormData: true
            });
        }

        function selectFile($event) {
            form.image = $event.target.files[0];
        }
        function formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        }

        return {formValues, submit, selectFile,formated};
    },
    methods:{
        PartSix(event){
            this.selected = event.target.value;
            if(this.selected==="1" || this.selected==="2" || this.selected==="3" ){
                this.showPartSix = true;
                this.PartSixDigar=false;
            }else if(this.selected==="5"){
                this.PartSixDigar=true;
                this.showPartSix=false;
            }else {
                this.showPartSix=false;
                this.PartSixDigar=false;
            }
        },
        disableInput(){
            this.disabled = true;
            this.formValues.muhlatEnd = "";
        },
    },
    computed:{
        disableField(){
            if(this.dujoniba.muhlati_etibor_id==2){
                 return this.disabled = true;
            }
        },
        sixShow(){
            if (this.dujoniba.tartibi_etibor_id==1 || this.dujoniba.tartibi_etibor_id==2 || this.dujoniba.tartibi_etibor_id==3){
                return this.showPartSix=true;
            }else if(this.dujoniba.tartibi_etibor_id==5){
                return this.PartSixDigar=true;
            }
        }
    }
}
</script>
