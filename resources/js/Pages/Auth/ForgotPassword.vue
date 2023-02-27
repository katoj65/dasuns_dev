<template>

<LayoutUnAuth>

<div>

<div class="nk-content nk-content-lg nk-content-fluid">
<div class="container-xl wide-lg">
<div class="nk-content-inner">
<div class="nk-content-body" style="min-height:600px;">

<div class="row mt-10">
<div class="col-12 col-md-4"></div>
<div class="col-12 col-md-4">


<h1 class="pt-4 pb-4" style="font-size:25px;text-align:center;">Forgot password</h1>
<!-- <div class="mb-4 text-sm text-gray-600">
Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
</div> -->

<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
{{ status }}
</div>

<jet-validation-errors class="mb-4" />
<form @submit.prevent="submit" class="card">
<div class="card-title">
  <div class="card-header  bg-white"></div>

</div>
<div class="p-3">


<div>
<input type="email" v-model="form.email" placeholder="Enter email address" class="mt-1 block w-full form-control" required autofocus/>
</div>
<div>
<div class="pt-5" style="text-align:center;">
<input type="submit" value="Submit" class="button" style="padding-left:20px;padding-right:20px;"/>
</div>
</div>

</div>


</form>
</div>
<div class="col-12 col-md-4"></div>

</div>



</div>
</div>
</div>
</div>






















</div>

</LayoutUnAuth>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import LayoutUnAuth from '@/Layouts/LayoutUnAuth';

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
            LayoutUnAuth,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
