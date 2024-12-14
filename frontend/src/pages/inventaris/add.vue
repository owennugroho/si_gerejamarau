<template>
    <main class="main-page"  id="">
        <template v-if="pageReady">
            <template v-if="showHeader">
                <section class="page-section mb-3" >
                    <div class="container">
                        <div class="grid justify-content-between align-items-center">
                            <div  v-if="!isSubPage"  class="col-fixed " >
                                <Button @click="$router.go(-1)" label=""  class="p-button p-button-text " icon="pi pi-arrow-left"  />
                            </div>
                            <div  class="col " >
                                <div class=" text-2xl text-primary font-bold" >
                                    Add New Inventari
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>
            </template>
            <section class="page-section " >
                <div class="container">
                    <div class="grid ">
                        <div  class="md:col-9 sm:col-12 comp-grid" >
                            <div >
                                <form ref="observer" tag="form" @submit.prevent="submitForm()" :class="{ 'card ': !isSubPage }" class=" ">
                                    <div class="grid">
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Nama Barang *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlnama_barang" v-model.trim="formData.nama_barang"  label="Nama Barang" type="text" placeholder="Enter Nama Barang"      
                                                    class=" w-full" :class="getErrorClass('nama_barang')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('nama_barang')" class="p-error">{{ getFieldError('nama_barang') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Lokasi Barang *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrllokasi_barang" v-model.trim="formData.lokasi_barang"  label="Lokasi Barang" type="text" placeholder="Enter Lokasi Barang"      
                                                    class=" w-full" :class="getErrorClass('lokasi_barang')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('lokasi_barang')" class="p-error">{{ getFieldError('lokasi_barang') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Kode Barang *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlkode_barang" v-model.trim="formData.kode_barang"  label="Kode Barang" type="text" placeholder="Enter Kode Barang"      
                                                    class=" w-full" :class="getErrorClass('kode_barang')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('kode_barang')" class="p-error">{{ getFieldError('kode_barang') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Kategori Barang *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlkategori_barang" v-model.trim="formData.kategori_barang"  label="Kategori Barang" type="text" placeholder="Enter Kategori Barang"      
                                                    class=" w-full" :class="getErrorClass('kategori_barang')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('kategori_barang')" class="p-error">{{ getFieldError('kategori_barang') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Tanggal Memperoleh *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <Calendar  :showButtonBar="true" class="w-full" :class="getErrorClass('tanggal_memperoleh')" dateFormat="yy-mm-dd" v-model="formData.tanggal_memperoleh" :showIcon="true"     mask="YYYY-MM-DD"      />
                                                    <small v-if="isFieldValid('tanggal_memperoleh')" class="p-error">{{ getFieldError('tanggal_memperoleh') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <input name="ctrltanggal_input"  ref="ctrltanggal_input" v-model="formData.tanggal_input" type="hidden" />
                                    </div>
                                    <div v-if="showSubmitButton" class="text-center my-3">
                                        <Button class="p-button-primary" type="submit" label="Submit" icon="pi pi-send" :loading="saving" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </main>
</template>
<script setup>
	import {  computed,  reactive, toRefs, onMounted } from 'vue';
	import { required } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useAddPage } from 'src/composables/addpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		pageStoreKey: {
			type: String,
			default: 'INVENTARIS',
		},
		pageName : {
			type : String,
			default : 'inventaris',
		},
		routeName : {
			type : String,
			default : 'inventarisadd',
		},
		apiPath : {
			type : String,
			default : 'inventaris/add',
		},
		submitButtonLabel: {
			type: String,
			default: "Submit",
		},
		formValidationError: {
			type: String,
			default: "Form is invalid",
		},
		formValidationMsg: {
			type: String,
			default: "Please complete the form",
		},
		msgTitle: {
			type: String,
			default: "Create Record",
		},
		msgAfterSave: {
			type: String,
			default: "Record added successfully",
		},
		msgBeforeSave: {
			type: String,
			default: "",
		},
		showHeader: {
			type: Boolean,
			default: true,
		},
		showSubmitButton: {
			type: Boolean,
			default: true,
		},
		redirect: {
			type : Boolean,
			default : true,
		},
		isSubPage: {
			type : Boolean,
			default : false,
		},
		pageData: { // use to set formData default values from another page
			type: Object,
			default: () => ({
				nama_barang: "", lokasi_barang: "", kode_barang: "", kategori_barang: "", tanggal_memperoleh: new Date(), tanggal_input: "", 
			})
		},
	});
	//lines
	const store = usePageStore(props.pageStoreKey);
	const app = useApp();
	
	const formData = reactive({ ...props.pageData });
	
	//vuelidate form validation rules
	const rules = computed(() => {
		return {
			nama_barang: { required },
			lokasi_barang: { required },
			kode_barang: { required },
			kategori_barang: { required },
			tanggal_memperoleh: { required },
			tanggal_input: { required }
		}
	});
	
	const page = useAddPage({ store, props, formData, rules, beforeSubmit, afterSubmit });
	
	// event raised before submit form
	function beforeSubmit(){
		return true;
	}
	
	// event raised after form submited
	function afterSubmit(response) { 
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		page.setFormDefaultValues(); //reset form data
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/inventaris`);
		}
	}
	
	const {  saving, pageReady, } = toRefs(page.state);
	
	const { submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Add New Inventari";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
	
	// expose page object for other components access
	defineExpose({
		page
	});
</script>
<style scoped>
</style>
