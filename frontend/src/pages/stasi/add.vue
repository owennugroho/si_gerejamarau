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
                                    Add New Stasi
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
                                                    Nama Stasi *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlnama_stasi" v-model.trim="formData.nama_stasi"  label="Nama Stasi" type="text" placeholder="Enter Nama Stasi"      
                                                    class=" w-full" :class="getErrorClass('nama_stasi')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('nama_stasi')" class="p-error">{{ getFieldError('nama_stasi') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Desa *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrldesa" v-model.trim="formData.desa"  label="Desa" type="text" placeholder="Enter Desa"      
                                                    class=" w-full" :class="getErrorClass('desa')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('desa')" class="p-error">{{ getFieldError('desa') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Alamat *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlalamat" v-model.trim="formData.alamat"  label="Alamat" type="text" placeholder="Enter Alamat"      
                                                    class=" w-full" :class="getErrorClass('alamat')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('alamat')" class="p-error">{{ getFieldError('alamat') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Deskripsi *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrldeskripsi" v-model.trim="formData.deskripsi"  label="Deskripsi" type="text" placeholder="Enter Deskripsi"      
                                                    class=" w-full" :class="getErrorClass('deskripsi')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('deskripsi')" class="p-error">{{ getFieldError('deskripsi') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Umat Laki *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlumat_laki" v-model.trim="formData.umat_laki"  label="Umat Laki" type="number" placeholder="Enter Umat Laki"   step="any"    
                                                    class=" w-full" :class="getErrorClass('umat_laki')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('umat_laki')" class="p-error">{{ getFieldError('umat_laki') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Umat Perempuan *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlumat_perempuan" v-model.trim="formData.umat_perempuan"  label="Umat Perempuan" type="number" placeholder="Enter Umat Perempuan"   step="any"    
                                                    class=" w-full" :class="getErrorClass('umat_perempuan')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('umat_perempuan')" class="p-error">{{ getFieldError('umat_perempuan') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Total Umat *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrltotal_umat" v-model.trim="formData.total_umat"  label="Total Umat" type="number" placeholder="Enter Total Umat"   step="any"    
                                                    class=" w-full" :class="getErrorClass('total_umat')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('total_umat')" class="p-error">{{ getFieldError('total_umat') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Foto Gereja 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <div class="mb-3">
                                                        <Uploader @uploadError="(msg)=>app.flashMsg('File Upload', msg, 'error')" :class="getErrorClass('foto_gereja')" upload-path="fileuploader/upload/foto_gereja" v-model="formData.foto_gereja" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" label="Choose files or drop files here" />
                                                    </div>
                                                    <small v-if="isFieldValid('foto_gereja')" class="p-error">{{ getFieldError('foto_gereja') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Foto Tanah 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <div class="mb-3">
                                                        <Uploader @uploadError="(msg)=>app.flashMsg('File Upload', msg, 'error')" :class="getErrorClass('foto_tanah')" upload-path="fileuploader/upload/foto_tanah" v-model="formData.foto_tanah" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" label="Choose files or drop files here" />
                                                    </div>
                                                    <small v-if="isFieldValid('foto_tanah')" class="p-error">{{ getFieldError('foto_tanah') }}</small> 
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
	import { required, numeric, } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useAddPage } from 'src/composables/addpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		pageStoreKey: {
			type: String,
			default: 'STASI',
		},
		pageName : {
			type : String,
			default : 'stasi',
		},
		routeName : {
			type : String,
			default : 'stasiadd',
		},
		apiPath : {
			type : String,
			default : 'stasi/add',
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
				nama_stasi: "", desa: "", alamat: "", deskripsi: "", umat_laki: "", umat_perempuan: "", total_umat: "", foto_gereja: "", foto_tanah: "", tanggal_input: "", 
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
			nama_stasi: { required },
			desa: { required },
			alamat: { required },
			deskripsi: { required },
			umat_laki: { required, numeric },
			umat_perempuan: { required, numeric },
			total_umat: { required, numeric },
			foto_gereja: {  },
			foto_tanah: {  },
			tanggal_input: {  }
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
			app.navigateTo(`/stasi`);
		}
	}
	
	const {  saving, pageReady, } = toRefs(page.state);
	
	const { submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Add New Stasi";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
	
	// expose page object for other components access
	defineExpose({
		page
	});
</script>
<style scoped>
</style>
