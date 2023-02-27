class date_format{
constructor(date){
this.i=new Date(date);
this.y=this.i.getFullYear();
this.m=this.i.getMonth();
this.d=this.i.getDay();
this.h=this.i.getHours();
this.mi=this.i.getMinutes();
}
}
export default date_format;

