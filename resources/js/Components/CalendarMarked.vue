<template>
<div>

{{ test }}

<v-calendar :from-page="format" :attributes="attrs" style="border:none;" is-expanded title-position="left"  :min-date="response.appointment.date" :max-date="response.appointment.end_date"/>
</div>
</template>
<script>
export default {
props:{
response:{},

},
data() {
return {
test:null,

attrs: [
{
highlight: {
start: { fillMode: 'solid',color:'green' },
base: { fillMode: 'light' },
end: { fillMode: 'solid' ,color:'green'},

},
dates: { start: null, end: null },
},
],

format:{
month:null,
year:null
}

};
},


methods:{
format_date(){
const s=this.$page.props.response.appointment.date;
const m=s.split('-').reverse();
const get_month=m[1]<10?m[1].substring(1):m[1];
const sd=m[0]<10?m[0].substring(1):m[0];
this.attrs[0].dates.start=new Date(m[2], 1, sd);

//
const end_date=this.$page.props.response.appointment.end_date.split('-').reverse();
const ed=end_date[0]<10?end_date[0].substring(1):end_date[0];
const em=end_date[1]<10?end_date[1].substring(1):end_date[1];

//

this.format.month=get_month;
this.format.year=m[2];

//
let cal_month=null;
if(em>get_month){
cal_month=em-get_month+1;
}else{
cal_month=1;
}
this.test=cal_month+1;
this.attrs[0].dates.end=new Date(end_date[2], cal_month, ed);
}

},



mounted(){
this.format_date();
},

computed:{
format_start_date(){
const s=this.response.appointment.date;
const m=s.split('-').reverse();
const get_month=m[1]<10?m[1].substring(1):m[1];
return {month: get_month,year: m[2]};
}


}



};
</script>
