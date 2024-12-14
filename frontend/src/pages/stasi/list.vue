<template>
    <main class="main-page"  id="">
        <template v-if="showHeader">
            <section class="page-section mb-3" >
                <div class="container-fluid">
                    <div class="grid justify-content-between align-items-center">
                        <div  class="col " >
                            <div class=" text-2xl text-primary font-bold" >
                                Stasi
                            </div>
                        </div>
                        <div  class="col-fixed " >
                            <router-link :to="`/stasi/add`">
                                <Button label="Add New Stasi" icon="pi pi-plus" type="button" class="p-button w-full bg-primary "  />
                            </router-link>
                        </div>
                        <div  class="col-12 md:col-3 " >
                            <span class="p-input-icon-left w-full">
                            <i class="pi pi-search" />
                            <InputText  placeholder="Search" class="w-full" :value="filters.search.value" @input="debounce(() => { filters.search.value = $event.target.value })"  />
                            </span>
                        </div>
                        
                    </div>
                </div>
            </section>
        </template>
        <section class="page-section " >
            <div class="container-fluid">
                <div class="grid ">
                    <div  class="col comp-grid" >
                        <div class="flex align-items-center">
                            <filter-tags :controller="page.filterController" />
                        </div>
                        <div >
                            <template v-if="showBreadcrumbs && $route.query.tag && !isSubPage">
                                <Breadcrumb :home="{icon: 'pi pi-home', to: '/stasi'}" :model="pageBreadCrumb" />
                            </template>
                            <!-- page records template -->
                            <div class="page-records"  >
                                <DataTable :lazy="true"   :loading="loading"    v-model:selection="selectedItems"
                                     :value="records" dataKey="id_stasi" @sort="onSort($event)" class=" p-datatable-sm" :stripedRows ="true" :showGridlines="false" :rowHover="true" responsiveLayout="stack">
                                    <Column selectionMode="multiple" headerStyle="width: 2rem" />
                                        <Column  field="nama_stasi" header="Nama Stasi" >
                                            <template #body="{ data, index }">
                                                {{ data.nama_stasi }}
                                            </template>
                                        </Column>
                                        <Column  field="desa" header="Desa" >
                                            <template #body="{ data, index }">
                                                {{ data.desa }}
                                            </template>
                                        </Column>
                                        <Column  field="alamat" header="Alamat" >
                                            <template #body="{ data, index }">
                                                {{ data.alamat }}
                                            </template>
                                        </Column>
                                        <Column  field="deskripsi" header="Deskripsi" >
                                            <template #body="{ data, index }">
                                                {{ data.deskripsi }}
                                            </template>
                                        </Column>
                                        <Column  field="umat_laki" header="Umat Laki" >
                                            <template #body="{ data, index }">
                                                {{ data.umat_laki }}
                                            </template>
                                        </Column>
                                        <Column  field="umat_perempuan" header="Umat Perempuan" >
                                            <template #body="{ data, index }">
                                                {{ data.umat_perempuan }}
                                            </template>
                                        </Column>
                                        <Column  field="total_umat" header="Total Umat" >
                                            <template #body="{ data, index }">
                                                {{ data.total_umat }}
                                            </template>
                                        </Column>
                                        <Column  field="foto_gereja" header="Foto Gereja" >
                                            <template #body="{ data, index }">
                                                <image-viewer image-size="small" image-preview-size="" :src="data.foto_gereja" width="50px" height="50px" class="img-fluid" :num-display="1">
                                                </image-viewer>
                                            </template>
                                        </Column>
                                        <Column  field="foto_tanah" header="Foto Tanah" >
                                            <template #body="{ data, index }">
                                                <image-viewer image-size="small" image-preview-size="" :src="data.foto_tanah" width="50px" height="50px" class="img-fluid" :num-display="1">
                                                </image-viewer>
                                            </template>
                                        </Column>
                                        <Column  field="tanggal_input" header="Tanggal Input" >
                                            <template #body="{ data, index }">
                                                {{ data.tanggal_input }}
                                            </template>
                                        </Column>
                                        <Column  headerStyle="width: 2rem" headerClass="text-center">
                                            <template #body="{ data, index }">
                                                <div class="flex justify-content-end">
                                                    <SplitButton dropdownIcon="pi pi-bars" class="p-button dropdown-only p-button-text p-button-plain" :model="getActionMenuModel(data)">
                                                        <i></i>
                                                    </SplitButton>
                                                </div>
                                            </template>
                                        </Column>
                                    </DataTable>
                                </div>
                                <!-- Empty record -->
                                <template v-if="pageReady && !records.length">
                                    <div class="p-3 my-3 text-500 text-lg font-medium text-center">
                                        No record found
                                    </div>
                                </template>
                                <!-- end of empty record-->
                                <!-- pagination component-->
                                <template v-if="showFooter && pageReady">
                                    <div class="grid justify-content-between align-items-center">
                                        <div class="flex gap-2 flex-grow-0">
                                            <div v-if="selectedItems.length" class="m-2">
                                                <Button @click="deleteItem(selectedItems)" icon="pi pi-trash" class="p-button-danger" title="Delete Selected" />
                                            </div>
                                            <div class="m-2" v-if="exportButton && records.length">
                                                <Button @click="(event)=> $refs.exportMenu.toggle(event)" label="Print"  title="Export" icon="pi pi-print" />
                                                <Menu ref="exportMenu" popup :model="pageExportFormats" />
                                            </div>
                                        </div>
                                        <div v-if="paginate && totalPages > 1" class="flex-grow-1">
                                            <Paginator class="paginator-flat my-3" :first="recordsPosition - 1" @page="(event)=>{pagination.page = event.page + 1}" :rows="pagination.limit" :totalRecords="totalRecords">
                                                <template #start>
                                                    <span class="px-2">
                                                    Records <b>{{ recordsPosition }} of {{ totalRecords }}</b>
                                                    </span>
                                                </template>
                                                <template #end>
                                                </template>
                                            </Paginator>
                                        </div>
                                    </div>
                                </template>
                                <!-- end of pagination component-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
</template>
<script setup>
	import {   toRefs, onMounted } from 'vue';
	import { usePageStore } from 'src/store/page';
	import { useApp } from 'src/composables/app.js';
	import { useListPage } from 'src/composables/listpage.js';
	
	const props = defineProps({
		primaryKey : {
			type : String,
			default : 'id_stasi',
		},
		pageStoreKey: {
			type: String,
			default: 'STASI',
		},
		pageName: {
			type: String,
			default : 'stasi',
		},
		routeName: {
			type: String,
			default: 'stasilist',
		},
		apiPath: {
			type: String,
			default: 'stasi/index',
		},
		autoLoad: {
			type: Boolean,
			default: true,
		},
		enableCache: {
			type: Boolean,
			default: false,
		},
		paginate: {
			type: Boolean,
			default: true,
		},
		showHeader: {
			type: Boolean,
			default: true,
		},
		showFooter: {
			type: Boolean,
			default: true,
		},
		showBreadcrumbs: {
			type: Boolean,
			default: true,
		},
		exportButton: {
			type: Boolean,
			default: true,
		},
		importButton: {
			type: Boolean,
			default: false,
		},
		multiCheckbox: {
			type: Boolean,
			default: true,
		},
		page: {
			type: Number,
			default: 1,
		},
		limit: {
			type: Number,
			default: 10,
		},
		mergeRecords: { // for infinite loading
			type: Boolean,
			default: false,
		},
		search: {
			type: String,
			default: '',
		},
		fieldName: null,
		fieldValue: null,
		queryParams: { 
			type: Object,
			default: () => ({})
		},
		sortBy: {
			type: String,
			default: '',
		},
		sortType: {
			type: String,
			default: 'desc', //desc or asc
		},
		isSubPage: {
			type: Boolean,
			default: false,
		},
		emptyRecordMsg: {
			type: String,
			default: "No record found",
		},
		titleBeforeDelete: {
			type: String,
			default: "Delete record",
		},
		msgBeforeDelete: {
			type: String,
			default: "Are you sure you want to delete this record?",
		},
		msgAfterDelete: {
			type: String,
			default: "Record deleted successfully",
		},
		filterTagClass: {
			type: String,
			default: 'surface-card p-2 text-500 flex-grow-1 text-center m-1 mb-3 flex-grow-1 text-center',
		}
	});
	
	const app = useApp();
	
	const defaultStoreState = {
		filters: {
			search: {
				tag: "Search",
				value: '',
				valueType: 'single',
				options: [],
			}
		},
		pagination: {
			page: props.page,
			limit: props.limit,
			sortBy: props.sortBy,
			sortType: props.sortType
		},
		primaryKey: props.primaryKey,
		enableCache: props.enableCache
	}
	const store = usePageStore(props.pageStoreKey,  defaultStoreState);
	
	// page hooks where logics resides
	const page = useListPage({ store, props });
	
	const {records, filters,  totalRecords,  selectedItems,  pagination,} = toRefs(store.state);
	const { pageReady, loading, } = toRefs(page.state);
	
	const {  pageBreadCrumb,   totalPages, recordsPosition, } = page.computedProps;
	
	const { load,    exportPage, debounce, onSort,  deleteItem,    } = page.methods;
	
	const pageExportFormats =  [
		{
			label: 'Print',
			icon: 'pi pi-print text-blue-500',
			command: () => { exportPage('print') }
		}
	];
	function getActionMenuModel(data){
		return [
		{
			label: "View",
			to: `/stasi/view/${data.id_stasi}`,
			icon: "pi pi-eye"
		},
		{
			label: "Edit",
			to: `/stasi/edit/${data.id_stasi}`,
			icon: "pi pi-pencil"
		},
		{
			label: "Delete",
			command: (event) => { deleteItem(data.id_stasi) },
			icon: "pi pi-trash"
		}
	]
	}
	
	onMounted(()=>{ 
		const pageTitle = "Stasi";
		app.setPageTitle(props.routeName, pageTitle);
	});
</script>
<style scoped>
</style>
