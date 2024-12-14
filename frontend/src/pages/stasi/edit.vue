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
                                    Edit Stasi
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
                                                        <Uploader :class="getErrorClass('foto_gereja')" :auto="true" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" style="width:100%" label="Choose files or drop files here" upload-path="fileuploader/upload/foto_gereja" v-model="formData.foto_gereja"></Uploader>
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
                                                        <Uploader :class="getErrorClass('foto_tanah')" :auto="true" :fileLimit="1" :maxFileSize="3000000" accept=".jpg,.png,.gif,.jpeg" :multiple="false" style="width:100%" label="Choose files or drop files here" upload-path="fileuploader/upload/foto_tanah" v-model="formData.foto_tanah"></Uploader>
                                                    </div>
                                                    <small v-if="isFieldValid('foto_tanah')" class="p-error">{{ getFieldError('foto_tanah') }}</small> 
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
	import { required, numeric, } from 'src/services/validators';
	import { useApp } from 'src/composables/app.js';
	import { useEditPage } from 'src/composables/editpage.js';
	import { usePageStore } from 'src/store/page';
	const props = defineProps({
		id: [String, Number],
		pageStoreKey: {
			type: String,
			default: 'STASI',
		},
		pageName: {
			type: String,
			default: 'stasi',
		},
		routeName: {
			type: String,
			default: 'stasiedit',
		},
		pagePath: {
			type : String,
			default : 'stasi/edit',
		},
		apiPath: {
			type: String,
			default: 'stasi/edit',
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
		nama_stasi: "", desa: "", alamat: "", deskripsi: "", umat_laki: "", umat_perempuan: "", total_umat: "", foto_gereja: "", foto_tanah: "", tanggal_input: "", 
	}, props.pageData);
	
	const formData = reactive({ ...formDefaultValues });
	
	function afterSubmit(response) {
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/stasi`);
		}
	}
	
	// form validation rules
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
	
	const page = useEditPage({store, props, formData, rules, afterSubmit });
	
	const {  currentRecord: editRecord } = toRefs(store.state);
	const {  pageReady, saving, loading, } = toRefs(page.state);
	
	const { apiUrl } = page.computedProps;
	
	const { load, submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Edit Stasi";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
</script>
<style scoped>
</style>
