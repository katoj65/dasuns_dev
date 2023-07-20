class Notification{
//alert
alert(type,message){
if(type=='success'){
this.$notify({
title:'Successful',
message:message,
position:'bottom-right',
type:'success'
});
}else if(type='error'){
this.$notify({
title:'Error',
message:message,
position:'bottom-right',
type:'danger'
});
}

}

















}
