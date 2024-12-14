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
                                    Edit Inventari
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
                                <form ref="observer"  tag="form" @submit.prevent="submitForm()" :class="{ 'card ': !isSubPage }" class=" ">
                                    <!--[form-content-start]-->
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
                                    <!--[form-content-end]-->
                                    <div v-if="showSubmitButton" class="text-center my-3">
                                        <Button type="submit" label="Update" icon="pi pi-send" :loading="saving" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <template v-if="loading">
            <div style="min-height:200px" class="flex gap-3 justify-content-center align-items-center p-3">
                <div><ProgressSpinner style="width:50px;height:50px" /> </div>
                <div class="text-500">Loading... </div>
            </div>
        </template>
    </main>
</template>
<script setup>
	import {  computed,  reactive, toRefs, onMounted } from 'vue';
	import { required } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useEditPage } from 'src/composables/editpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		id: [String, Number],
		pageStoreKey: {
			type: String,
			default: 'INVENTARIS',
		},
		pageName: {
			type: String,
			default: 'inventaris',
		},
		routeName: {
			type: String,
			default: 'inventarisedit',
		},
		pagePath: {
			type : String,
			default : 'inventaris/edit',
		},
		apiPath: {
			type: String,
			default: 'inventaris/edit',
		},
		submitButtonLabel: {
			type: String,
			default: "Update",
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
			default: "Update Record",
		},
		msgBeforeSave: {
			type: String,
			default: "",
		},
		msgAfterSave: {
			type: String,
			default: "Record updated successfully",
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
	});
	
	const store = usePageStore(props.pageStoreKey);
	const app = useApp();
	
	const formDefaultValues = Object.assign({
		nama_barang: "", lokasi_barang: "", kode_barang: "", kategori_barang: "", tanggal_memperoleh: new Date(), tanggal_input: "", 
	}, props.pageData);
	
	const formData = reactive({ ...formDefaultValues });
	
	function afterSubmit(response) {
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/inventaris`);
		}
	}
	
	// form validation rules
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
	
	const page = useEditPage({store, props, formData, rules, afterSubmit });
	
	const {  currentRecord: editRecord } = toRefs(store.state);
	const {  pageReady, saving, loading, } = toRefs(page.state);
	
	const { apiUrl } = page.computedProps;
	
	const { load, submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Edit Inventari";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
</script>
<style scoped>
</style>
