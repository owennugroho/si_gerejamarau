
	
<template>
	<div class="grid">
		<div class="col-12 md:col-5">
		<Message @close="errorMsg=null" class="fadeinUp" v-if="errorMsg" severity="error" key="error">{{errorMsg}}</Message>
			<div class="text-2xl font-bold my-4">Change Password</div>
			<form ref="observer"  tag="form" @submit.prevent="submitForm()">
				<div class="field">
					<Password class="w-full" :class="getErrorClass('oldpassword')"  inputClass="w-full" :feedback="false" :toggleMask="true" label="Current Password"  placeholder="Current Password"  v-model="formData.oldpassword"  />
					<small v-if="isFieldValid('oldpassword')" class="p-error">{{ getFieldError('oldpassword') }}</small>
				</div>
				<div class="field">
					<Password class="w-full" :class="getErrorClass('newpassword')" inputClass="w-full" :toggleMask="true" label="New Password"  placeholder="New Password"  v-model="formData.newpassword" 	/>
					<small v-if="isFieldValid('newpassword')" class="p-error">{{ getFieldError('newpassword') }}</small>
				</div>
				<div class="field">
					<Password class="w-full" :class="getErrorClass('confirmpassword')" inputClass="w-full" :feedback="false" :toggleMask="true" label="Confirm new password"  placeholder="Confirm new password" v-model="formData.confirmpassword"  />
					<small v-if="isFieldValid('confirmpassword')" class="p-error">{{ getFieldError('confirmpassword') }}</small>
				</div>
				<div class="my-3 text-center">
					<Button type="submit" icon="pi pi-send" label="Change Password" :loading="saving" />
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import {  computed, reactive, ref, toRefs } from 'vue';
	import { required, sameAs } from '@vuelidate/validators';
	import { useApp } from 'src/composables/app';
	import { useForm } from 'src/composables/formpage';
	import { $t } from 'src/services/i18n';
	const props = defineProps({
		pageName : {
			type : String,
			default : 'changepassword',
		},
		apiPath: {
			type: String,
			default: 'account/changepassword'
		},
		formValidationError: {
			type: String,
			default: "Form is invalid",
		},
		formValidationMsg: {
			type: String,
			default: "Please complete the form",
		},
	});

	const app = useApp();
	
	const formData = reactive({
		oldpassword: '', 
		newpassword: '', 
		confirmpassword: '', 
	});

	function afterSubmit(response) {
		app.flashMsg("Password change completed");
		
		//reset form data
		Object.assign(formData, { oldpassword: "", newpassword: "", confirmpassword: "" });
	}
	
	const rules = computed(() => {
		return {
			oldpassword: { required },
			newpassword: { required },
			confirmpassword: { required,  sameAs: sameAs(formData.newpassword) }
		}
	});
	
	const page = useForm({ props, formData, rules, afterSubmit });

	const { saving, } = toRefs(page.state);
	const {submitForm, isFieldValid, getFieldError, getErrorClass, } = page;

</script>

