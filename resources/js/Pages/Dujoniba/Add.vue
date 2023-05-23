<template>
    <Head>
        <title>ББШБ+ Дуҷониба</title>
    </Head>
    <div class="flex-1 h-full">
        <h1 class="font-bold text-2xl text-blue-400 text-blue-700 text-center pb-4 pt-1">Иловаи шартномаи дуҷониба</h1>
        <form class="p-4" @submit.prevent="formValues.post(route('du.store'))">
            <!-- Section One -->
            <div class="grid gap-6 mb-6 md:grid-cols-2 items-center">
                <div class="nomi-shartnoma">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Номи пурраи шартнома</label>
                    <input type="text"
                           id="name"
                           name="name"
                           v-model="formValues.name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Шартнома дар самти..." required>
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
                        id="formFile" required/>
                </div>
                <div class="jonibho">
                    <div class="jonibi-tj">
                        <label for="jonibi-tj" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Аз ҷониби ҶТ</label>
                        <input type="text"
                               id="jonibi-tj"
                               name="jonibi_tj"
                               v-model="formValues.jonibi_tj"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Тарафҳои шартнома..." required>
                    </div>
                    <div class="jonibi-digar mt-4">
                        <label for="jonibi_digar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Аз ҷониби дигар</label>
                        <input type="text"
                               id="jonibi_digar"
                               name="jonibi_digar"
                               v-model="formValues.jonibi_digar"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Тарафҳои шартнома..." required>
                    </div>
                </div>
                <div class="namud-tartib">
                    <div class="namudi-shartnoma ">
                        <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Намуди шартнома</h3>
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="horizontal-list-radio-davlati"
                                           type="radio"
                                           value= 1
                                           name="list-radio"
                                           v-model="formValues.namud"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-davlati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Байнидавлатӣ </label>
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
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-hukumati" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Байниҳукуматӣ</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-idoravi"
                                        type="radio"
                                        value= 3
                                        name="list-radio"
                                        v-model="formValues.namud"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-idoravi" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Байниидоравӣ</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tartibi-etibor mt-4 ">
                        <label for="qarorho" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Тартиби пайдо намудани эътибор</label>
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
                </div>
                <!-- Bandi 6 Calendar default is hide -->
                <div class="">
                    <label for="sanai_qabul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate">Санаи пайдо кардани эътибор</label>
                    <input type="date"
                           id="sanai_qabul"
                           name="sanai_etibor"
                           v-model="formValues.sanai_etibor"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                </div>
                <!-- Banhoi 1 2 3 az bandi 6 default is hide -->
                <div class="w-full truncate" v-show="showPartSix">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white truncate" for="files_scan">Файли сканшудаи марбут ба расмиёти дохилидавлатӣ</label>
                    <input
                        id="files_scan"
                        type="file" multiple
                        name="files_scan"
                        @input="formValues.files_scan = $event.target.files"
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" >
                </div>
                <!-- Bandi 5 default is hide -->
                <div class="w-full" v-show="PartSixDigar">
                    <label for="bandi-shash" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дигар</label>
                    <input type="text"
                           id="bandi-shash"
                           name="etibor_digar"
                           v-model="formValues.etibor_digar"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Вориди матн">
                </div>
            </div>
            <!-- Muhlati Etibor -->
            <div class="mb-4 border-t-4 border-blue-300 border-b-4 pb-6">
                <h1 class="text-base text-blue-600 text-sm font-medium text-start mt-4">Муҳлати эътибор</h1>
                <div class="flex justify-between justify-items-center items-center	space-x-4">
                    <div class="w-full mt-7">
                        <ul class="items-center w-full text-sm font-medium text-gray-900  border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-muhlat"
                                        @click="disabled = false"
                                        type="radio" value="1"
                                        name="list-radio-muhlat"
                                        v-model="formValues.muhlat"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-muhlat" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Муҳлатнок</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input
                                        id="horizontal-list-radio-bemuhlat"
                                        @click="disableInput"
                                        v-model="formValues.muhlat"
                                        type="radio"
                                        value="2"
                                        name="list-radio-muhlat"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-bemuhlat" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Бемуҳлат</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full">
                        <label for="etibor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Санаи қатъи эътибор</label>
                        <input
                            type="date"
                            :disabled="disabled"
                            id="etibor"
                            name="qati_etibor"
                            v-model="formValues.muhlatEnd"
                            class="disabled:opacity-75 disabled:bg-gray-300 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                    </div>

                </div>
            </div>
            <!-- Imzokunandagon -->
            <h1 class="text-base text-blue-600 font-medium text-start mt-2">Имзокунандагон</h1>
            <div class="flex justify-between flex-wrap md:flex-nowrap items-center mt-2 space-x-4 py-4">
                <div class="w-full">
                    <label for="tj-imzo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ҷониби ҶТ</label>
                    <input
                        type="text"
                        id="tj-imzo"
                        name="imzo_tj"
                        v-model="formValues.imzo_tj"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Номи ва вазифаи имзокунанда">
                </div>
                <div class="w-full">
                    <label for="digar-imzo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ҷониби дигар</label>
                    <input type="text"
                           id="digar-imzo"
                           name="imzo_digar"
                           v-model="formValues.imzo_digar"
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
                <div class="w-full">
                    <label for="ezoh" class="block mb-2 ml-2 text-sm font-medium text-gray-900 dark:text-white">Эзоҳ</label>
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
                        href="/dash"
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
                    class=" ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Сабт</button>
            </div>

        </form>
    </div>
</template>
<script>
import Dashboard from "../Dashboard";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
export default {
    name: "Add",
    layout: Dashboard,
    components:{Link},
    data(){
        return{
            showPartSix: false,
            PartSixDigar: false,
            selected: '',
            disabled: false

        };
    },
    setup(){
        const formValues= useForm({
            name: null,
            shartnoma_file: null,
            jonibi_tj: null,
            jonibi_digar: null,
            sanai_etibor: null,
            files_scan: [],
            etibor_digar:null,
            namud: null,
            tartib:'',
            muhlat: null,
            muhlatEnd: null,
            imzo_tj: null,
            imzo_digar: null,
            vakolat: [],
            ezoh: null
        });
        return {formValues};
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
    }
}
</script>
