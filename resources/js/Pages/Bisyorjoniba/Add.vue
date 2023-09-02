<template>
    <Head>
        <title>ББШБ+ Бисёрҷониба</title>
    </Head>
    <div class="content h-full">
        <form class="p-4"  @submit.prevent="formValues.post(route('bi.store'))">
            <!-- Section One -->
            <div class="grid gap-6 mb-4 md:grid-cols-2 items-center">
                <div class="nomi-shartnoma">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номи пурраи шартнома</label>
                    <input type="text"
                           id="name"
                           v-model.trim.lazy="formValues.name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Шартнома дар самти...">
                    <div v-if="errors.name" class="ml-1 mt-0.5 text-red-600">{{errors.name}}</div>
                </div>
                <div class="shartnomfa-file">
                    <label
                        for="formFile"
                        class="mb-2 inline-block text-neutral-700"
                    >Файли сканшудаи шартнома PDF</label
                    >
                    <input
                        class="block mb-1 w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        type="file"
                        multiple
                        @input="formValues.shartnoma_file = $event.target.files"
                        id="formFile"/>
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
                                    @click="MintaqaviOn"
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
                <div class="tartibi-etibor ">
                    <label for="qarorho" class="block mb-2 text-sm font-medium text-gray-900">Тартиби пайдо намудани эътибор</label>
                    <select
                        id="qarorho"
                        @change="PartSix($event)"
                        v-model="formValues.tartib"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option value="">Интихоб</option>
                        <option value="1" >Қарори Ҳукумати ҶТ</option>
                        <option value="2" >Фармони Президенти ҶТ</option>
                        <option value="3" >Қарори Маҷлиси намояндагони Маҷлиси Олии ҶТ</option>
                        <option value="4">Аз лаҳзаи имзо</option>
                        <option value="5">Дигар</option>
                    </select>
                    <div v-if="errors.tartib" class="ml-1 mt-0.5 text-red-600">{{errors.tartib}}</div>
                </div>

                <!-- Bandi 6 Calendar default is hide -->
                <div class="">
                    <div class="calendar mt-2">
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
                <!-- Banhoi 1 2 3 az bandi 6 default is hide -->
                <div class="sm:truncate " v-show="showPartSix">
                    <label class="block mb-2 text-sm font-medium text-gray-900 truncate" for="small_size">Файли сканшудаи марбут ба расмиёти дохилидавлатӣ</label>
                    <input
                        id="small_size"
                        type="file"
                        multiple
                        @input="formValues.files_scan = $event.target.files"
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
                <!-- Bandi 5 default is hide -->
                <div v-show="PartSixDigar">
                    <label for="bandi-shash" class="block mb-2 text-sm font-medium text-gray-900">Дигар</label>
                    <input
                        type="text"
                        id="bandi-shash"
                        v-model.trim.lazy="formValues.etibor_digar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Вориди матн">
                </div>
            </div>
            <!-- Multiselect inputs -->
            <div v-show="mintaqavi" class="flex mb-2 text-sm font-medium text-gray-900">
                <div class="w-1/2 mr-4">
                    <div class="flex justify-between items-center mb-2">
                        <label for="country_id">Минтақаҳо</label>
                        <div class="flex items-center ml-2">
                            <input
                                checked id="green-checkbox"
                                type="checkbox"
                                value=""
                                v-model="checkbox"
                                @click="mintaqaCheck"
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
                <!-- Input for multiple select
                <div class="nomi-davlat w-1/2" v-show="mintaqaInput">
                    <label for="davlat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номи минтақа</label>
                    <input type="text"
                           id="davlat"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Иловаи номи давлат...">
                </div> -->
                <!-- Dynamyc input for multiple select -->
                <div class="w-1/2" v-if="dynamychide">
                    <div
                            v-for="(country, index) in formValues.davlatho"
                            :key="index"
                            class="flex items-center">
                            <div class="input w-full mr-2.5">
                                <label for="mintaqahoD" class="block mb-2 text-sm font-medium text-gray-900">Минтақаҳо {{index+1}}</label>
                                <input
                                    v-model="country.davlat"
                                    type="text"
                                    id="mintaqahoD"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Номи давлаҳо...">
                            </div>
                            <!-- Add input field -->
                            <div @click="addField" class="add-button mt-6">
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
                            <div @click="removeField" class="remove-button mt-6">
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
                                        @click="disabled = false" type="radio"
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

            <!-- Maqomoti masul -->
            <h1 class="text-base text-blue-600 font-medium text-start mt-2">Мақомоти масъул вобаста ба расмиёти дохилидавлатӣ ва татбиқи шартнома</h1>
            <div class="flex justify-between items-start mt-2 space-x-4 ">
                <div class="w-full mt-4">
                    <label for="nomi_maqomot" class="block mb-2 text-sm font-medium text-gray-900">Номи мақомот</label>
                    <input
                        type="text"
                        id="nomi_maqomot"
                        v-model.trim.lazy="formValues.maqomot"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="матн">
                </div>
                <!-- Ezoh block with dynamic inpits -->
                <div class=" flex w-full mt-4">
                    <div class="w-1/2 mr-4">
                        <div class="flex justify-between items-center mb-1">
                            <label for="ezoh_id">Эзоҳ</label>
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
                            id="ezoh_id"
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
import {ref} from "vue";
import VueMultiselect from 'vue-multiselect';

export default {
    name: "Add",
    layout: Dashboard,
    components:{Link,VueMultiselect},
    data(){
        return{
            formatter: ref({
                date:'DD.MM.YYYY',
                month: 'MMM',
            }),

        }
    },
    props:{
        errors: Object,
        countries: {
            type: Array,
            default: () => []
        },
        ezohs: {
            type: Array,
            default: () => []
        },
    },

    setup(){
        const formValues= useForm({
            name: null,
            shartnoma_file: null,
            namud: null,
            intixobB: null,
            sanai_etibor: '',
            etibor_digar:null,
            files_scan: [],
            davlatho:[{davlat: ''}],
            ezohlist:[{ezohs: ''}],
            tartib:'',
            muhlat: null,
            muhlatEnd: null,
            maqomot: null,
            ezohintixob: null
        });
        const showPartSix = ref(false);
        const PartSixDigar =ref (false);
        const selected = ref ('');
        const disabled = false;
        const mintaqavi = false;
        const checkbox = ref(false);
        const checkezoh = ref(false);
        const dynamychide=false;
        const ezohblock = ref(false);
        const davlatho = ref([{davlat:''},]);
        const ezohlist = ref([{ezohs: ''},]);
        function PartSix(event){
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
        };
        function MintaqaviOn(){
            this.mintaqavi=true;
        };
        function MintaqaviOf(){
            this.mintaqavi=false;
            formValues.davlatho=[{davlat:''},];
        };
        function mintaqaCheck(){
            if (this.checkbox===false){
                this.dynamychide=true;
            }else{
                formValues.davlatho.splice(1);
                this.dynamychide=false;
                formValues.davlatho=[{davlat: ''}];
            }
        }
        function ezohCheck(){
            if (this.checkezoh===false){
                this.ezohblock=true;
            }else{
                formValues.ezohlist.splice(1);
                this.ezohblock=false;
                formValues.ezohlist=[{ezohs: ''}];
            }
        };
        function addField(){
            formValues.davlatho.push({davlat: ''});
        };
        function removeField(index){
            if(formValues.davlatho.length > 1){
                formValues.davlatho.splice(index,1)
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
        function disableInput(){
            this.disabled = true;
            this.formValues.muhlatEnd = "";
        };
        return {
            formValues,
            showPartSix,
            PartSixDigar,
            selected,
            disabled,
            mintaqavi,
            checkbox,
            dynamychide,
            davlatho,
            checkezoh,
            ezohblock,
            ezohlist,
            ezohCheck,
            addFieldEzoh,
            removeFieldEzoh,
            PartSix,
            MintaqaviOn,
            MintaqaviOf,
            addField,
            removeField,
            disableInput,mintaqaCheck
        };
    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
