<template>
    <main class="main-page" id="">
        <section class="page-section q-pa-md" >
            <div class="container-fluid">
                <div class="grid ">
                    <div  class="col comp-grid" >
                        <div class=" text-lg font-bold text-primary" >
                            Home
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section mb-3" >
            <div class="container">
                <div class="grid ">
                    <div  class="md:col-9 comp-grid" >
                        <div :class="{ 'card ': !isSubPage }" class="">
                            <div class="q-pa-md">
                                <div class="font-bold text-lg">Pertumbuhan Stasi</div>
                                <div class="text-500"></div>
                                <hr />
                                <div class="row q-col-gutter-sm">
                                    <div class="col">
                                        <api-data-source :enable-cache="false"   api-path="components_data/linechart_pertumbuhanstasi" >
                                            <template v-slot="req">
                                                <div style="position:relative;text-align:center">
                                                    <div class="text-center p-3" v-if="req.loading">
                                                        <ProgressSpinner style="width:50px;height:50px" />
                                                    </div>
                                                    <vue-chart :chart-data="req.response" chart-type="line" ></vue-chart>
                                                </div>
                                            </template>
                                        </api-data-source>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="md:col-9 comp-grid" >
                        <div :class="{ 'card ': !isSubPage }" class="">
                            <div class="q-pa-md">
                                <div class="font-bold text-lg">Total Umat</div>
                                <div class="text-500"></div>
                                <hr />
                                <div class="row q-col-gutter-sm">
                                    <div class="col">
                                        <api-data-source :enable-cache="false"   api-path="components_data/barchart_totalumat" >
                                            <template v-slot="req">
                                                <div style="position:relative;text-align:center">
                                                    <div class="text-center p-3" v-if="req.loading">
                                                        <ProgressSpinner style="width:50px;height:50px" />
                                                    </div>
                                                    <vue-chart :chart-data="req.response" chart-type="bar" ></vue-chart>
                                                </div>
                                            </template>
                                        </api-data-source>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</template>
<script setup>
	import {  ref } from 'vue';
	
	
	import { useApp } from 'src/composables/app.js';
	
	
	import VueChart from 'src/components/VueCharts.vue';
	
	const props = defineProps({
		pageName: {
			type: String,
			default: 'home',
		},
		routeName: {
			type: String,
			default: 'home',
		},
		isSubPage: {
			type : Boolean,
			default : false,
		},
	});
	const app = useApp();
	
	const pageReady = ref(true);
	
</script>
<style scoped>
</style>
