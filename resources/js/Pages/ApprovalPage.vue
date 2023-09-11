<template>
<app-layout>
<div class="nk-block">
<div class="row p-3">

<div class="card">
<div class="card-header">
<h6 class="card-title bold">Approve Service Providers</h6>
</div>
<div class="card-body">


<div class="table-responsive">
<table class="table mb-0">
<thead>
<tr>
<th>NAMES</th>
<th>GENDER</th>
<th>SERVICE NO.</th>
<th>SERVICES</th>
<th>SECURITY DOCUMENTS</th>
<th>EDUCATION</th>
<th>EXPERIENCE</th>
<th>REFERENCES</th>
<th colspan="2">STATUS</th>
</tr>
</thead>
<tbody v-if="response.user.length>0">
<tr v-for="(u,key) in response.user" :key="key">
<td class="text-transform">
<Inertia-link :href="route('service_provider.profile',{id:u.id})" style="color:black;">{{ u.firstname }} {{ u.lastname }}</Inertia-link>
 </td>
<td class="text-transform">{{ u.gender }} </td>
<td>{{ u.number }} </td>
<td>{{ u.services }} </td>
<td>{{ u.documents }} </td>
<td>{{ u.education }} </td>
<td>{{ u.experience }} </td>
<td>{{ u.recommendation }} </td>
<td>{{ u.status }}</td>
<td>
<a href="javascript:void(0)" class="text-black" @click="show_form(u)"><em class="icon ni ni-edit"></em></a>
</td>
</tr>

</tbody>
<tbody v-else>
<tr>
<td colspan="4">No user</td>
</tr>
</tbody>
</table>
</div>







</div>
</div>
</div>
</div>




















<form class=""  v-if="show==true" style="position:fixed;width:100%;left:0;top:0;z-index:10000;height:100%;background-color: hsla(210, 29%, 18%, 0.3);" @submit.prevent="submit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background: #37BEA7;border:none;">
<h5 class="modal-title" style="color:white;">Approve Serive Provider</h5>
<a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="show=false">

</a>
</div>
<div class="modal-body" style="max-height:500px;overflow:auto">
<div class="form-group">
    <label class="form-label" for="default-01"></label>
    <div class="form-control-wrap">
        <input type="text" class="form-control text-transform" id="default-01" disabled v-model="form.names">
    </div>
</div>
<div class="form-group">
<label class="form-label" for="default-01"></label>
<div class="form-control-wrap">
<select class="form-control" id="default-01" @change="select_status($event)">
<option :value="form.status">{{ form.status }}</option>
<option v-for="(s,key) in select_status_item" :key="key" class="text-transform" :value="s.name">
{{ s.name }}
</option>
</select>
</div>
</div>








</div>
<div class="modal-footer bg-light">
<span class="sub-text">

<input type="submit" class="button" value="Save" style="border-radius:10px"/>

</span>
</div>
</div>
</div>
</form>
</app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
components:{
AppLayout

},

props:{
title:{},
response:{},
errors:{},
flash:{}
},

data(){return{
show:false,
form:this.$inertia.form({
status:null,
names:null,
id:null,
}),
status:[{name:'pending'},{name:'active'}]



}},

methods:{
select_status(event){
this.form.status=event.target.value;
},

show_form(row){
this.form.id=row.id;
this.show=true;
this.form.names=row.firstname+' '+row.lastname;
this.form.status=row.status;
}
,
submit(){
this.form.put(this.route('approval.status_approve'),{
onSuccess:()=>{
this.show=false;
this.$notify({
title:this.$page.props.flash.success!=null?'Successful':'Warning',
message:this.$page.props.flash.success!=null?this.$page.props.flash.success:this.$page.props.flash.warning,
position:'bottom-right',
type:this.$page.props.flash.success?'success':'warning'

});
}
});
}





},




computed:{
select_status_item(){
const data=[];
this.status.forEach(el=>{
if(this.form.status!=el.name){
data.push(el);
}
});


return data;
}




}






}
</script>

<style scoped>
.page-title{
font-family: 'Roboto', sans-serif;
}
table td{
text-transform: capitalize;
}
</style>
