<template>
    <div class="table-responsive">
        <table class="table table-vcenter text-nowrap mb-0">
        <thead>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Telephone</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th></th>
      
        </tr>
        </thead>
        <tbody v-if="users.length>0">
        <tr v-for="(u,key) in users" :key="key">
        <td>
        <Inertia-link class="text-muted" :href="route('admins.show',{id:u.id})"><em class="icon ni ni-user-alt-fill"></em>
         {{ u.firstname }}
        </Inertia-link>
        </td>
        <td>
        <Inertia-link class="text-muted" :href="route('admins.show',{id:u.id})">{{ u.lastname }}</Inertia-link>
        </td>
        <td class="text-muted">
        {{ u.gender }}
        </td>
        <td class="text-muted">{{ u.tel }} </td>
        <td style="text-transform:lowercase;" class="text-muted">{{ u.email }} </td>
        <td class="text-muted">{{ u.role }}</td>
        <td><label class="tag tag-success">{{ u.status }}</label></td>

        </tr>

        </tbody>
        </table>
        </div>
</template>
<script>
export default {
    props:{
    users:{},

    }
}
</script>
