<template>
    <Head>
        <title>Тағйири шартнома</title>
    </Head>
    <div class="content h-full">
        <h1 class="font-bold text-2xl text-blue-400 text-blue-700 text-center pb-4 pt-1">Тағйири шартномаи бисёрҷониба</h1>
        <form class="p-4"  @submit.prevent="submit">
            <!-- Section One -->
            <div class="grid gap-6 mb-2 md:grid-cols-2 items-start">
                <div class="nomi-shartnoma">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номи пурраи шартнома</label>
                    <input type="text"
                           id="name"
                           v-model="formValues.name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Шартнома дар самти...">
                    <div v-if="errors.name" class="ml-1 mt-0.5 text-red-600">{{errors.name}}</div>
                </div>
                <div class="shartnomfa-file">
                    <label
                        for="formFile"
                        class=" inline-block text-neutral-700"
                    >Файли сканшудаи шартнома PDF</label
                    >
                    <input
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        type="file"
                        @input="formValues.shartnoma_file = $event.target.files[0]"
                        id="formFile"/>
                    <div class="flex">
                        <a
                            class="hover:text-green-400 text-blue-500 text-sm"
                            :href="'/uploads/shartnoma/'+bisyorjoniba.fileshartnoma_b.name" target="_blank">
                            {{bisyorjoniba.fileshartnoma_b.name}}
                        </a>
                    </div>
                    <div v-if="errors.shartnoma_file" class="ml-1 mt-0.5 text-red-600">{{errors.shartnoma_file}}</div>
                </div>
                <div class="namudi-shartnoma">
                    <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">Намуди шартнома</h3>
                    <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center pl-3">
                                <input
                                    @click="MintaqaviOf"
                                    id="universali"
                                    type="radio"
                                    value="4"
                                    v-model="formValues.namud"
                                    name="list-radio-mintaqavi"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="universali" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Универсалӣ</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center pl-3">
                                <input
                                    id="mintaqavi"
                                    type="radio"
                                    value="5"
                                    name="list-radio-mintaqavi"
                                    v-model="formValues.namud"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="mintaqavi" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Минтақавӣ</label>
                            </div>
                        </li>
                    </ul>
                    <div v-if="errors.namud" class="ml-1 mt-0.5 text-red-600">{{errors.namud}}</div>
                </div>
                <div class="tartibi-etibor">
                    <label for="qarorho" class="block mb-2 text-sm font-medium text-gray-900">Тартиби пайдо намудани эътибор</label>
                    <select
                        id="qarorho"
                        @change="PartSix($event)"
                        v-model="formValues.tartib"
                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option value="">Интихоб</option>
                        <option value="1" >Қарори Ҳукумати ҶТ</option>
                        <option value="2" >Фармони Президенти ҶТ</option>
                        <option value="3" >Қарори Маҷлиси намояндагони Маҷлиси Олии ҶТ</option>
                        <option value="4">Аз лаҳзаи имзо</option>
                        <option value="5">Дигар</option>
                    </select>
                    <div v-if="errors.tartib" class="ml-1 mt-0.5 text-red-600">{{errors.tartib}}</div>
                </div>
                <!-- Denamyc inputs lists -->
                <div class="dynamic-input border-2 rounded-lg p-2 ">
                    <div>
                        <div class="flex  items-center mb-2">
                            <h2 class="pr-6 text-lg font-semibold text-gray-900">Минтақаҳо:</h2>
                            <!-- Add mintaqa checkbox button -->
                            <div class="flex items-center pt-1" v-show="bisyorjoniba.namudi_shartnoma_id==5 || formValues.namud==5">
                                <input
                                    id="default-checkbox"
                                    :disabled="formValues.namud==4"
                                    type="checkbox"
                                    v-model="checkbox"
                                    @click="mintaqaCheck"
                                    value=""
                                    class="w-4 h-4 cursor-pointer text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="default-checkbox" class="ml-1 text-sm font-medium text-gray-900">Иловаи минтақа</label>
                            </div>
                        </div>
                        <!-- List of countries -->
                        <div
                            v-if="bisyorjoniba.countries_b.length>0"
                            v-for="(mintaqa, item) in bisyorjoniba.countries_b"
                            :key="mintaqa.id"
                            class="inline-flex items-center mb-2">
                            <Link
                                onclick="return confirm('Шумо дар ҳақиқат мехоҳед минтақаи зеринро нест намоед?')"
                                :href="route('del.mintaqa', {id: bisyorjoniba.id, country:mintaqa.id})"
                                method="delete"
                                as="button"
                                type="button">
                                <svg
                                    class="w-5 h-5 mr-1.5 text-red-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </Link>
                            <span class="mr-4 text-lg font-normal text-gray-900">{{ mintaqa.name }}</span>
                        </div>
                    </div>
                </div>
                <!-- Banhoi 1 2 3 az bandi 6 default is hide -->
                <div class="sm:truncate" v-show="bandSix && showPartSix">
                    <label class="block mb-2 text-sm font-medium text-gray-900 truncate" for="small_size">Файли сканшудаи марбут ба расмиёти дохилидавлатӣ</label>
                    <input
                        id="small_size"
                        type="file"
                        multiple
                        @input="formValues.files_scan = $event.target.files"
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <div
                        v-for="files in bisyorjoniba.file_bisyor"
                        :key="files.id"
                        class="flex">
                        <Link
                            onclick="return confirm('Шумо дар ҳақиқат мехоҳед файли зеринро нест намоед?')"
                            method="delete" as="button" type="button"
                            :href="route('del.files', files.id)">
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
                </div>
                <!-- Bandi 5 default is hide -->
                <div v-show="bandSix && PartSixDigar">
                    <label for="bandi-shash" class="block mb-2 text-sm font-medium text-gray-900">Дигар</label>
                    <input
                        type="text"
                        id="bandi-shash"
                        v-model="formValues.etibor_digar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Вориди матн">
                </div>
            </div>
            <!-- Denamyc inputs and bahdhoi 6 -->
            <div class="flex w-full mb-2">
                <!-- Bandi 6 -->
                <div class="w-1/2 mr-4">
                    <div class="calendar">
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
                </div>
                <!-- Denamyc inputs -->
                <div class="dynamic-input flex items-start w-1/2" v-show="mintaqavi">
                    <div class="w-1/2 mr-4">
                        <div class="flex justify-between items-center">
                            <label for="country_id">Минтақаҳо</label>
                            <div class="flex items-center">
                                <input
                                    checked id="green-checkbox"
                                    type="checkbox"
                                    value=""
                                    v-model="addCountry"
                                    @click="countrySelector"
                                    class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                <label for="green-checkbox" class="ml-2 text-sm font-medium text-gray-900">Иловаи дасти</label>
                            </div>
                        </div>
                        <VueMultiselect
                            id="country_id"
                            v-model="formValues.intixobB"
                            :options="countries"
                            label="name"
                            track-by="id"
                            :close-on-select="false"
                            :clear-on-select="false"
                            :multiple="true"
                            placeholder="Интихоби давлатҳо">
                            <template slot="selection" slot-scope="{ values, search, isOpen }">
                                <span class="multiselect__input"><span class="text-lg font-semibold">options selected</span></span>
                            </template>
                        </VueMultiselect>
                    </div>
                    <!-- Denamyc inputs -->
                    <div class="flex flex-col w-1/2" v-show="countryBlock">
                        <div
                            v-for="(country, index) in formValues.davlatho"
                            :key="index"
                            class="flex">
                            <div class="input mr-4 w-full">
                                <label for="mintaqaho" class="block mb-2 text-sm font-medium text-gray-900">Минтақаҳо {{index+1}}</label>
                                <input
                                    v-model.trim.lazy="country.davlat"
                                    type="text"
                                    id="mintaqaho"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Номи давлаҳо...">
                            </div>
                            <!-- Add input field -->
                            <div @click="addField" class="add-button mt-7">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    strokeWidth={1.5}
                                    stroke="currentColor"
                                    class="w-8 h-8 text-green-600">
                                    <path strokeLinecap="round"
                                          strokeLinejoin="round"
                                          d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <!-- Remove input field -->
                            <div @click="removeField" class="remove-button mt-7">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24"
                                    strokeWidth={1.5}
                                    stroke="currentColor"
                                    class="w-8 h-8 text-red-700">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Muhlati Etibor -->
            <div class="mb-4 border-t-4 border-blue-300 border-b-4 pb-6">
                <h1 class="text-base text-blue-600 text-sm font-medium text-start mt-4">Муҳлати эътибор</h1>

                <div class="flex justify-between justify-items-center items-start space-x-4">
                    <div class="w-full mt-7">
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-muhlat"
                                        @click="disabled = false; vshowEnd=true" type="radio"
                                        value="1"
                                        name="list-radio"
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
                                        type="radio"
                                        value="2"
                                        name="list-radio"
                                        v-model="formValues.muhlat"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                    <label for="horizontal-list-radio-bemuhlat" class="w-full py-2 ml-2 text-sm font-medium text-gray-900">Бемуҳлат</label>
                                </div>
                            </li>
                        </ul>
                        <div v-if="errors.muhlat" class="ml-1 text-red-600">{{errors.muhlat}}</div>
                    </div>
                    <div class="w-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Санаи қатъи эътибор</label>
                        <vue-tailwind-datepicker
                            as-single
                            :disabled="disableField && disabled"
                            weekdays-size="min"
                            :formatter="formatter"
                            placeholder="қатъи эътибор"
                            i18n="ru"
                            v-model="formValues.muhlatEnd"
                            input-classes="block text-sm"
                            class="disabled:opacity-75 disabled:bg-gray-300 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                        />
                        <span v-if="formValues.muhlat==1 && formValues.muhlatEnd==''" class="text-sm text-red-600">Санаро аз нав тасдиқ намоед</span>
                    </div>
                </div>
            </div>

            <!-- Maqomoti masul -->
            <h1 class="text-base text-blue-600 font-medium text-start mt-2">Мақомоти масъул вобаста ба расмиёти дохилидавлатӣ ва татбиқи шартнома</h1>
            <div class="flex justify-between items-center mt-2 space-x-4 ">
                <div class="w-full mt-4">
                    <label for="nomi_maqomot" class="block mb-2 text-sm font-medium text-gray-900">Номи мақомот</label>
                    <input
                        type="text"
                        id="nomi_maqomot"
                        v-model="formValues.maqomot"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="матн">
                </div>
                <div class="w-full mt-4">
                    <label for="ezoh" class="block mb-2 text-sm font-medium text-gray-900">Эзоҳ</label>
                    <input
                        type="text"
                        id="ezoh"
                        v-model="formValues.ezoh"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="матн эзоҳ">
                </div>
            </div>

            <!-- Save buttons -->
            <div class="flex justify-end items-center text-center mt-[40px]">
                <!-- Button back -->
                <div class="mr-6">
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
import {computed, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import VueMultiselect from 'vue-multiselect';
import moment from "moment";
export default {
    name: "Edit",
    layout: Dashboard,
    components:{Link,Head,VueMultiselect},
    data(){
        return{
            disabled: false,
            showPartSix: false,
            PartSixDigar: false,
            vshowEnd: true,
            formatter: ref({
                date:'DD.MM.YYYY',
                month: 'MMM',
            })
        }
    },
    props:{
        bisyorjoniba: Object,
        errors: Object,
        countries: {
            type: Array,
            default: () => []
        }
    },
    methods:{
        disableInput(){
            this.disabled = true;
            this.formValues.muhlatEnd = ref("");
        },
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
        }
    },
    computed:{
        disableField(){
            if (this.bisyorjoniba.muhlati_etibor_id==2){
                return this.disabled=true;
            }
        },
        bandSix(){
            if (this.bisyorjoniba.tartibi_etibor_id==1 || this.bisyorjoniba.tartibi_etibor_id==2 || this.bisyorjoniba.tartibi_etibor_id==3){
                return this.showPartSix=true;
            }else if(this.bisyorjoniba.tartibi_etibor_id==5){
                return this.PartSixDigar=true;
            }
        }

    },
    setup(props){
        const formValues= useForm({
            id: props.bisyorjoniba.id,
            name: props.bisyorjoniba.name,
            shartnoma_file: null,
            namud: props.bisyorjoniba.namudi_shartnoma_id,
            intixobB: null,
            sanai_etibor: props.bisyorjoniba.sanai_etibor!=null ? formated(props.bisyorjoniba.sanai_etibor) : '',
            etibor_digar:props.bisyorjoniba.etibor_digar,
            files_scan: [],
            davlatho:[{davlat: ''}],
            tartib: props.bisyorjoniba.tartibi_etibor_id,
            muhlat: props.bisyorjoniba.muhlati_etibor_id,
            muhlatEnd: props.bisyorjoniba.qati_etibor!=null ? formated(props.bisyorjoniba.qati_etibor) : '',
            maqomot: props.bisyorjoniba.maqomot,
            ezoh: props.bisyorjoniba.ezoh,
            _method: "PUT"
        });
        const selected = ref ('');
        const mintaqavi = ref(false);
        const checkbox = ref(false);
        const addCountry = ref(false);
        const countryBlock= ref(false);
        const davlatho = [{davlat:''},];
        function MintaqaviOf(){
            this.mintaqavi=false;
            this.checkbox=false;
            formValues.davlatho.splice(1);
        };
        function MintaqaviOn(){
            this.mintaqavi=true;
        };
        function addField(){
            formValues.davlatho.push({davlat: ''});
        };
        function removeField(index){
            if(formValues.davlatho.length > 1){
                formValues.davlatho.splice(index,1)
            }
        };
        function countrySelector(){
            if (this.addCountry===false){
                this.countryBlock=true;
            }else{
                formValues.davlatho.splice(1);
                this.countryBlock=false;
                formValues.davlatho=[{davlat: ''}];
            }
        };
        function mintaqaCheck(){
            if (this.checkbox===false){
                this.mintaqavi=true;
            }else{
                formValues.davlatho.splice(1);
                this.mintaqavi=false;
                formValues.davlatho=[{davlat: ''}];
            }
        };
        function formated(value) {
            return  moment(value).format('DD.MM.YYYY');
        }
        function submit(){
            Inertia.post(route('bi.update', props.bisyorjoniba.id), formValues, {
                forceFormData: true
            });
        };
        function selectFile($event) {
            formValues.image = $event.target.files[0];
        }
        return{
            formValues,
            checkbox,
            selected,
            mintaqavi,
            davlatho,
            addCountry,
            countryBlock,
            countrySelector,
            MintaqaviOf,
            MintaqaviOn,
            addField,
            removeField,
            submit,
            selectFile,
            mintaqaCheck
        };
    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
