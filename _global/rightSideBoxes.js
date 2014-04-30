// JavaScript Document
window.addEvent('load', function(){
$$('.rightSideBox').each(function(i,inx){
		if(i.get('HTML')=="") {
			i.destroy();
		}
	});
})