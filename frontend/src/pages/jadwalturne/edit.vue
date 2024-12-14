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
                                    Edit Jadwal Turne
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
                                                    Lokasi *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrllokasi" v-model.trim="formData.lokasi"  label="Lokasi" type="text" placeholder="Enter Lokasi"      
                                                    class=" w-full" :class="getErrorClass('lokasi')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('lokasi')" class="p-error">{{ getFieldError('lokasi') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Tanggal 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <Calendar  :showButtonBar="true" class="w-full" :class="getErrorClass('tanggal')" dateFormat="yy-mm-dd" v-model="formData.tanggal" :showIcon="true"     mask="YYYY-MM-DD"      />
                                                    <small v-if="isFieldValid('tanggal')" class="p-error">{{ getFieldError('tanggal') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Hari *
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <InputText  ref="ctrlhari" v-model.trim="formData.hari"  label="Hari" type="text" placeholder="Enter Hari"      
                                                    class=" w-full" :class="getErrorClass('hari')">
                                                    </InputText>
                                                    <small v-if="isFieldValid('hari')" class="p-error">{{ getFieldError('hari') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Jam Mulai 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <Calendar  :showButtonBar="true" class="w-full" :class="getErrorClass('jam_mulai')" v-model="formData.jam_mulai"     :showTime="true" :timeOnly="true"      />
                                                    <small v-if="isFieldValid('jam_mulai')" class="p-error">{{ getFieldError('jam_mulai') }}</small> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formgrid grid">
                                                <div class="col-12 md:col-3">
                                                    Jam Selesai 
                                                </div>
                                                <div class="col-12 md:col-9">
                                                    <Calendar  :showButtonBar="true" class="w-full" :class="getErrorClass('jam_selesai')" v-model="formData.jam_selesai"     :showTime="true" :timeOnly="true"      />
                                                    <small v-if="isFieldValid('jam_selesai')" class="p-error">{{ getFieldError('jam_selesai') }}</small> 
                                                </div>
                                            </div>
                                        </div>
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
			default: 'JADWALTURNE',
		},
		pageName: {
			type: String,
			default: 'jadwalturne',
		},
		routeName: {
			type: String,
			default: 'jadwalturneedit',
		},
		pagePath: {
			type : String,
			default : 'jadwalturne/edit',
		},
		apiPath: {
			type: String,
			default: 'jadwalturne/edit',
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
		lokasi: "", tanggal: new Date(), hari: "", jam_mulai: new Date(), jam_selesai: new Date(), 
	}, props.pageData);
	
	const formData = reactive({ ...formDefaultValues });
	
	function afterSubmit(response) {
		app.flashMsg(props.msgTitle, props.msgAfterSave);
		if(app.isDialogOpen()){
			app.closeDialogs(); // if page is open as dialog, close dialog
		}
		else if(props.redirect) {
			app.navigateTo(`/jadwalturne`);
		}
	}
	
	// form validation rules
	const rules = computed(() => {
		return {
			lokasi: { required },
			tanggal: {  },
			hari: { required },
			jam_mulai: {  },
			jam_selesai: {  }
		}
	});
	
	const page = useEditPage({store, props, formData, rules, afterSubmit });
	
	const {  currentRecord: editRecord } = toRefs(store.state);
	const {  pageReady, saving, loading, } = toRefs(page.state);
	
	const { apiUrl } = page.computedProps;
	
	const { load, submitForm, getErrorClass, getFieldError, isFieldValid,  } = page.methods;
	
	onMounted(()=>{
		const pageTitle = "Edit Jadwal Turne";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
</script>
<style scoped>
</style>
