<template>
    <Head>
        <title>ББШБ+ Бисёрҷониба</title>
    </Head>
    <div class="content h-full">
        <h1 class="font-bold text-2xl text-blue-400 text-blue-700 text-center pb-4 pt-1">Иловаи шартномаи бисёрҷониба</h1>
        <form class="p-4"  @submit.prevent="formValues.post(route('bi.store'))">
            <!-- Section One -->
            <div class="grid gap-6 mb-6 md:grid-cols-2 items-center">
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
                        class="mb-2 inline-block text-neutral-700"
                    >Файли сканшудаи шартнома PDF</label
                    >
                    <input
                        class="block mb-1 w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        type="file"
                        @input="formValues.shartnoma_file = $event.target.files[0]"
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
                <!-- Denamyc inputs -->
                <div class="dynamic-input">
                    <div v-show="mintaqavi"
                         v-for="(country, index) in formValues.davlatho"
                         :key="index"
                         class="flex items-center">
                        <div class="input w-3/4 mr-8 mt-2">
                            <label for="mintaqaho" class="block mb-2 text-sm font-medium text-gray-900">Минтақаҳо {{index+1}}</label>
                            <input
                                v-model="country.davlat"
                                type="text"
                                id="mintaqaho"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Номи давлаҳо...">
                        </div>
                        <!-- Add input field -->
                        <div @click="addField" class="add-button mt-6">
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
                        <div @click="removeField" class="remove-button mt-6">
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
                <!-- Bandi 6 Calendar default is hide -->
                <div class="">
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
                            v-model="formValues.etibor_digar"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="Вориди матн">
                    </div>
                    <div class="calendar mt-2">
                        <label for="sanai-qabul" class="block mb-2 text-sm font-medium text-gray-900 truncate">Санаи пайдо кардани эътибор</label>
                        <input
                            type="date"
                            id="sanai-qabul"
                            v-model="formValues.sanai_etibor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full" placeholder="">
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
                        <label for="etibor" class="block mb-2 text-sm font-medium text-gray-900">Санаи қатъи эътибор</label>
                        <input type="date"
                               :disabled="disabled"
                               id="etibor"
                               v-model="formValues.muhlatEnd"
                               class="disabled:opacity-75 disabled:bg-gray-300 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
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
            <div class="flex justify-end items-center text-center mt-[60px]">
                <div class="back-buuton mt-1">
                    <Link
                        class="inline-block rounded-full border border-indigo-600 bg-indigo-600 p-3 text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                        href="/dash"
                    >
                        <span class="sr-only"> Download </span>
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
                    class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Сабт</button>
            </div>
        </form>
    </div>
</template>

<script>
import Dashboard from "../Dashboard";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
export default {
    name: "Add",
    layout: Dashboard,
    components:{Link},
    props:{
        errors: Object,
    },
    setup(){
        const formValues= useForm({
            name: null,
            shartnoma_file: null,
            namud: null,
            sanai_etibor: null,
            etibor_digar:null,
            files_scan: [],
            davlatho:[{davlat: ''}],
            tartib:'',
            muhlat: null,
            muhlatEnd: null,
            maqomot: null,
            ezoh: null
        });
        const showPartSix = ref(false);
        const PartSixDigar =ref (false);
        const selected = ref ('');
        const disabled = false;
        const mintaqavi = false;
        const davlatho = [{davlat:''},];
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
            formValues.davlatho.splice(1);
        };
        function addField(){
            formValues.davlatho.push({davlat: ''});
        };
        function removeField(index){
            if(formValues.davlatho.length > 1){
                formValues.davlatho.splice(index,1)
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
            davlatho,
            PartSix,
            MintaqaviOn,
            MintaqaviOf,
            addField,
            removeField,
            disableInput
        };
    },
}
</script>
