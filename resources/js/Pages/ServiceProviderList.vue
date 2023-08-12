    <template>
    <app-layout>
    <div class="nk-block">
    <div class="row p-3">






    <div class="card">
    <div class="card-header">
    <h3 class="card-title text-transform bold">Service Providers</h3>
    </div>

    <div class="card-body">
    <div class="table-responsive">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="DataTables_Table_0_length"></div></div>
    </div><div class="row"><div class="col-sm-12">


    <table class="table table-hover js-basic-example dataTable table_custom border-style spacing5" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">




    <thead style="border:none">
    <tr style="border:none">
    <th style="border:none">Names</th>
    <th style="border:none">GENDER</th>
    <th style="border:none">TELEPHONE</th>
    <th style="border:none">EMAIL</th>
    </tr>
    </thead>

    <tbody v-if="pssp.length>0">


    <tr role="row" v-for="(p,key) in pssp" :key="key">
    <td class="sorting_1">
    <Inertia-link :href="route('profile.pssp',{id:p.id})" class="text-black text-transform">
    {{ p.firstname }} {{ p.lastname }}</Inertia-link>
    </td>
    <td class="text-transform">{{ p.gender }} </td>
    <td>{{ p.tel }} </td>
    <td>{{p.email}} </td>
    </tr>

    </tbody>
    <tbody v-else>
    <tr><td colspan="4">No content</td></tr>
    </tbody>

    </table>

    </div></div></div>
    </div>
    </div>


    </div>
















    </div>
    </div>
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
    response:{}
    },


    computed:{
    pssp(){
    return this.response.service_providers;
    }
    }






    }
    </script>

    <style scoped>
    .page-title{
    font-family: 'Roboto', sans-serif;





    }
    </style>
