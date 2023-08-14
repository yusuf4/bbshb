<template>
    <Head>
        <title>ББШБ+ Дуҷониба</title>
    </Head>
    <div class="flex-1 h-full">
        <h1 class="font-bold text-2xl text-blue-400 text-blue-700 text-center pb-4 pt-1">Иловаи шартномаи дуҷониба</h1>
        <form class="p-4" @submit.prevent="formValues.post(route('du.store'))">
            <!-- Section One -->
            <div class="grid gap-6 mb-2.5 md:grid-cols-2 items-center">
                <div class="nomi-shartnoma">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номи пурраи шартнома</label>
                    <input type="text"
                           id="name"
                           name="name"
                           v-model.trim.lazy="formValues.name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Шартнома дар самти...">
                    <div v-if="errors.name" class="text-red-600">{{errors.name}}</div>
                </div>
                <div class="shartnomfa-file">
                    <label
                        for="formFile"
                        class="mb-2 inline-block text-sm font-medium text-gray-900 dark:text-neutral-200"
                    >Файли сканшудаи шартнома PDF</label
                    >
                    <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        type="file"
                        name="shartnoma_file[]"
                        @input="formValues.shartnoma_file = $event.target.files[0]"
                        id="formFile"/>
                    <div v-if="errors.shartnoma_file" class="text-red-600">{{errors.shartnoma_file}}</div>
                </div>
                <div class="jonibho">
                    <div class="jonibi-tj">
                        <label for="jonibi-tj" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Аз ҷониби ҶТ</label>
                        <input type="text"
                               id="jonibi-tj"
                               name="jonibi_tj"
                               v-model.trim.lazy="formValues.jonibi_tj"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Тарафҳои шартнома...">
                        <div v-if="errors.jonibi_tj" class="text-red-600">{{errors.jonibi_tj}}</div>
                    </div>
                    <div class="jonibi-digar mt-4">
                        <label for="jonibi_digar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Аз ҷониби дигар</label>
                        <input type="text"
                               id="jonibi_digar"
                               name="jonibi_digar"
                               v-model.trim.lazy="formValues.jonibi_digar"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Тарафҳои шартнома...">
                        <div v-if="errors.jonibi_digar" class="text-red-600">{{errors.jonibi_digar}}</div>
                    </div>
                </div>
                <div class="namud-tartib">
                    <div class="namudi-shartnoma ">
                        <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Намуди шартнома</h3>
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input id="horizontal-list-radio-davlati"
                                           type="radio"
                                           value= 1
                                           name="list-radio"
                                           v-model="formValues.namud"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                    <label for="horizontal-list-radio-davlati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Байнидавлатӣ </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input
                                           id="horizontal-list-radio-hukumati"
                                           type="radio"
                                           value= 2
                                           name="list-radio"
                                           v-model="formValues.namud"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                    <label for="horizontal-list-radio-hukumati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 ">Байниҳукуматӣ</label>
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate">Санаи пайдо кардани эътибор</p>
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
                <div class="w-full truncate" v-show="showPartSix">
                    <label class="block mb-2 text-sm font-medium text-gray-900 truncate" for="files_scan">Файли сканшудаи марбут ба расмиёти дохилидавлатӣ</label>
                    <input
                        id="files_scan"
                        type="file"
                        multiple
                        @input="formValues.files_scan = $event.target.files"
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
                    <div v-if="errors.files_scan" class="text-red-600">{{errors.files_scan}}</div>
                </div>
                <!-- Bandi 5 default is hide -->
                <div class="w-full" v-show="PartSixDigar">
                    <label for="bandi-shash" class="block mb-2 text-sm font-medium text-gray-900">Дигар</label>
                    <input type="text"
                           id="bandi-shash"
                           name="etibor_digar"
                           v-model.trim.lazy="formValues.etibor_digar"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Вориди матн">
                </div>
            </div>
            <!-- Muhlati Etibor -->
            <div class="mb-4 border-t-4 border-blue-300 border-b-4 pb-4">
                <h1 class="text-base text-blue-600 text-sm font-medium text-start mt-4">Муҳлати эътибор</h1>
                <div class="flex justify-between justify-items-center items-center	space-x-4">
                    <div class="w-full mt-7">
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-muhlat"
                                        @click="disabled = false"
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
                             :disabled="disabled"
                             weekdays-size="min"
                             :formatter="formatter"
                             placeholder="қатъи эътибор"
                             i18n="ru"
                             v-model="formValues.muhlatEnd"
                             input-classes="block text-sm"
                             class="disabled:opacity-75 disabled:bg-gray-300 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                         />
                    </div>

                </div>
            </div>
            <!-- Imzokunandagon -->
            <h1 class="text-base text-blue-600 font-medium text-start mt-1">Имзокунандагон</h1>
            <div class="flex justify-between flex-wrap md:flex-nowrap items-center space-x-4 py-2">
                <div class="w-full">
                    <label for="tj-imzo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ҷониби ҶТ</label>
                    <input
                        type="text"
                        id="tj-imzo"
                        name="imzo_tj"
                        v-model.trim.lazy="formValues.imzo_tj"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Номи ва вазифаи имзокунанда">
                </div>
                <div class="w-full">
                    <label for="digar-imzo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ҷониби дигар</label>
                    <input type="text"
                           id="digar-imzo"
                           name="imzo_digar"
                           v-model.trim.lazy="formValues.imzo_digar"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Номи ва вазифаи имзокунанда">
                </div>
                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate" for="vakolad_file">Файли сканшудаи қарори Ҳукумати ҶТ ё Ваколатнома</label>
                    <input
                        id="vakolad_file"
                        type="file"
                        name="vakolat"
                        @input="formValues.vakolat = $event.target.files"
                        multiple
                        class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                </div>
            </div>
            <!-- Ezoh section -->
            <div class=" flex w-full">
                <div class="w-1/2 mr-4">
                    <div class="flex justify-between items-center mb-1">
                        <label for="ezohD_id">Эзоҳ</label>
                        <div class="flex items-center ml-2">
                            <input
                                checked id="green-checkboxB"
                                type="checkbox"
                                value=""
                                v-model="checkezoh"
                                @click="ezohCheck"
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                            <label for="green-checkboxB" class="ml-2 text-sm font-medium text-gray-900">Иловаи дасти</label>
                        </div>
                    </div>
                    <VueMultiselect
                        id="ezohD_id"
                        v-model="formValues.ezohintixob"
                        :options="ezohs"
                        label="name"
                        track-by="id"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :multiple="true"
                        placeholder="Интихоб...">
                        <template slot="selection" slot-scope="{ values, search, isOpen }">
                            <span class="multiselect__input"><span class="text-lg font-semibold">options selected</span></span>
                        </template>
                    </VueMultiselect>
                </div>
                <!-- Dynamyc input for multiple select -->
                <div class="w-1/2" v-if="ezohblock">
                    <div
                        v-for="(country, index) in formValues.ezohlist"
                        :key="index"
                        class="flex items-center">
                        <div class="input w-full mr-2.5">
                            <label for="ezohB" class="block mb-2 text-sm font-medium text-gray-900">Эзоҳ {{index+1}}</label>
                            <input
                                v-model="country.ezohs"
                                type="text"
                                id="ezohB"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Номи давлаҳо...">
                        </div>
                        <!-- Add input field -->
                        <div @click="addFieldEzoh" class="add-button mt-6">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-8 h-8 text-green-600">
                                <path strokeLinecap="round"
                                      strokeLinejoin="round"
                                      d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <!-- Remove input field -->
                        <div @click="removeFieldEzoh" class="remove-button mt-6">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-8 h-8 text-red-700">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Save buttons -->
            <div class="flex justify-end items-center text-center mt-[30px]">
                <!-- Button back -->
                <div class="mr-6">
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
                <div>
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
        </form>
    </div>
</template>
<script>
import Dashboard from "../Dashboard";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import { ref } from 'vue'
import VueMultiselect from 'vue-multiselect';

export default {
    name: "Add",
    layout: Dashboard,
    components:{Link, Head, VueMultiselect},
    data(){
        return{
            showPartSix: false,
            PartSixDigar: false,
            selected: '',
            disabled: false,
            formatter: ref({
                date:'DD.MM.YYYY',
                month: 'MMM',
            })
        };
    },
    props:{
      errors: Object,
        ezohs: {
            type: Array,
            default: () => []
        },
    },
    setup(){
        const formValues= useForm({
            name: null,
            shartnoma_file: null,
            jonibi_tj: null,
            jonibi_digar: null,
            sanai_etibor: '',
            files_scan: [],
            etibor_digar:null,
            ezohlist:[{ezohs: ''}],
            namud: null,
            tartib:'',
            muhlat: null,
            muhlatEnd: '',
            imzo_tj: null,
            imzo_digar: null,
            vakolat: [],
            ezohintixob: null
        });
        const checkezoh = ref(false);
        const ezohblock = ref(false);
        const ezohlist = ref([{ezohs: ''},]);
        function ezohCheck(){
            if (this.checkezoh===false){
                this.ezohblock=true;
            }else{
                formValues.ezohlist.splice(1);
                this.ezohblock=false;
                formValues.ezohlist=[{ezohs: ''}];
            }
        };
        function addFieldEzoh(){
            formValues.ezohlist.push({ezohs: ''});
        };
        function removeFieldEzoh(index){
            if(formValues.ezohlist.length > 1){
                formValues.ezohlist.splice(index,1)
            }
        };
        return{
            formValues,
            checkezoh,
            ezohblock,
            ezohlist,
            ezohCheck,
            addFieldEzoh,
            removeFieldEzoh,
        };
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
            this.formValues.muhlatEnd = '';
        },
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
