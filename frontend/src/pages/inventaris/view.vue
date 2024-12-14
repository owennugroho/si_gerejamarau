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
                                    Inventari Details
                                </div>
                            </div> 
                        </div>
                    </div>
                </section>
            </template>
            <section class="page-section " >
                <div class="container">
                    <div class="grid ">
                        <div  class="col comp-grid" >
                            <div >
                                <div class="mb-3 grid ">
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Id Inventaris</div>
                                                <div class="font-bold">{{ item.id_inventaris }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Nama Barang</div>
                                                <div class="font-bold">{{ item.nama_barang }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Lokasi Barang</div>
                                                <div class="font-bold">{{ item.lokasi_barang }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Kode Barang</div>
                                                <div class="font-bold">{{ item.kode_barang }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Kategori Barang</div>
                                                <div class="font-bold">{{ item.kategori_barang }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Tanggal Memperoleh</div>
                                                <div class="font-bold">{{ item.tanggal_memperoleh }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 md:col-4">
                                        <div class="flex gap-2 align-items-center card shadow-none p-3 surface-100 ">
                                            <div class="">
                                                <div class="text-400 mb-1">Tanggal Input</div>
                                                <div class="font-bold">{{ item.tanggal_input }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- action buttons -->
                                <div  class=" flex gap-3 justify-content-start">
                                    <Menubar class="p-0 inline-menu" ref="actionMenu" :model="getActionMenuModel(item)" />
                                </div>
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
	import {   toRefs, onMounted } from 'vue';
	import { useApp } from 'src/composables/app.js';
	import { usePageStore } from 'src/store/page';
	import { useViewPage } from 'src/composables/viewpage.js';
	const props = defineProps({
		id: [String, Number],
		primaryKey: {
			type: String,
			default: 'id_inventaris',
		},
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
			default: 'inventarisview',
		},
		apiPath: {
			type: String,
			default: 'inventaris/view',
		},
		autoLoad: {
			type: Boolean,
			default: true,
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
		exportButton: {
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
		isSubPage: {
			type : Boolean,
			default : false,
		}
	});
	
	const store = usePageStore(props.pageStoreKey);
	const app = useApp(props);
	
	const page = useViewPage({ store, props }); // where page logics resides
	
	const {  currentRecord } = toRefs(store.state);
	const { loading, pageReady } = toRefs(page.state);
	const item = currentRecord;
	
	const  { load, deleteItem, exportPage,   } = page.methods;
	
	function getActionMenuModel(data){
		return [
		{
			label: "Edit",
			command: (event) => { app.openPageDialog({ page:'inventaris/edit', url: `/inventaris/edit/${data.id_inventaris}`, closeBtn: true }) },
			icon: "pi pi-pencil"
		},
		{
			label: "Delete",
			command: (event) => { deleteItem(data.id_inventaris) },
			icon: "pi pi-trash"
		}
	]
	}
	
	onMounted(()=>{ 
		const pageTitle = "Inventari Details";
		app.setPageTitle(props.routeName, pageTitle); // set browser page title
	});
	
</script>
<style scoped>
</style>
