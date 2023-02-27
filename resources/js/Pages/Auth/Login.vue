<template>
<LayoutUnAuth>
<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body" style="min-height:600px;">

<div class="row mt-10">
<div class="col-12 col-md-4"></div>



<div class="col-12 col-md-4">
<h1 style="text-align:center;font-weight:bolder;font-size:20px;word-spacing:5px;line-height:50px;font-family: Arial, Helvetica, sans-serif;color:#0B5345;">
Login you Account
</h1>

<p style="padding:10px;font-size:16px;text-align:center;color:#AAB7B8;">
Dasuns helps you to find Profession support service providers around the world.
</p>

<div class="pt-10">




        <jet-validation-errors class="mb-4"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">

<!--
            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div> -->


<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="email" class="form-control" id="default-01" placeholder="Enter email address" v-model="form.email">
</div>
</div>


<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<input type="password" class="form-control" id="default-01" placeholder="Enter password" v-model="form.password">
</div>
</div>








                <!-- <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </jet-button> -->



<div class="flex items-center mt-4">
<inertia-link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600" style="color:#45B39D;
font-size:17px;font-weight:bold;">
Forgot your password?
</inertia-link>

</div>





<div class="form-group pt-10" style="text-align:center;">
<button type="submit" class="btn button" style="padding:15px;padding-left:60px;padding-right:60px;font-size:18px;">Login</button>
</div>







<div style="text-align:center;" class="pt-10 mb-20">
<inertia-link :href="route('register')" class="" style="font-size:17px;">
Don't have an account? <strong style="margin-left:10px;">Create New</strong>
</inertia-link>
</div>











        </form>













</div>







</div>
<div class="col-12 col-md-4"></div>


</div>



</div>
</div>
</div>
</div>
</LayoutUnAuth>
</template>

<script>
    import LayoutUnAuth from '@/Layouts/LayoutUnAuth';
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            LayoutUnAuth,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
