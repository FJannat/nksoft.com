// JavaScript Document
var sf; // this will be a reference to the sucker fish functions - object literal
sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);


/*
Write email addresses with javascript

write_email("name", "domain.com"); 
	writes "<a href='mailto:name@domain.com'>name@domain.com</a>

write_email("name", "domain.com", "Email Me"); 
	writes "<a href='mailto:name@domain.com'>Email Me</a>

write_email("name", "domain.com", "Email Me", "EmailClass"); 
	writes "<a class="EmailClass" href='mailto:name@domain.com'>Email Me</a>
	
	*/

function write_email(prefix, suffix, alt, classname){

 if(alt){
  	var address_hold ="<a href='mailto:" + prefix + "@" + suffix +"' target='_blank' class='"+ classname +"' >"+ alt +"</a>";
 		}else{
 
		var address_hold ="<a href='mailto:" + prefix + "@" + suffix +"' target='_blank' class='"+ classname +"' >" + prefix + "@" + suffix +"</a>";
 	}
	address=document.write(address_hold);
 return address;
 
}


Banner = {
		t_spd : 600,
		lock : false,
		current_id : 0,
		timer: 4500,
		curr_p : $('#banner_controls .dept:eq(' + this.current_id + ') p'),
		timer_int : '',
		init : function(){
			// turn down opacity on all banner headlines
			$('#banner_controls h1').css('opacity', 0.5)
			// hide all banner text
			$('#banner_controls p').hide();
			$('#banners .home_slide').hide();
			
			// show first banner text and full opacity on headline
			$('#banner_controls .dept:nth-child(1) h1').css('opacity', 1).addClass('current')
			$('#banner_controls .dept:nth-child(1) p').show();
			$('#banners .home_slide:nth-child(1)').show();
			
			$('#banners .home_slide').each(function(i){
				$(this).attr('id', 'slide_' + i)
			})
			
			$('#banner_controls h1').each(function(i){
				$(this).attr('ctrl', i) 
				$(this).click(function(){
					if(! $(this).hasClass('current')){
						clearTimeout(Banner.timer_int)
						Banner.curr_p = $(this).parent().find('p')
						Banner.current_id = $(this).attr('ctrl')
						Banner.transition()
					}
				});
			
			});
			
			Banner.setTimer();
			
		}, // ent init
		
		transition: function(){
			if(! Banner.lock){
							Banner.lock = true;
							var prev_p = $('#banner_controls .current').parent().find('p')
							$(Banner.curr_p).stop(true, true).slideDown(Banner.t_spd);
							$(prev_p).stop(true, true).slideUp(Banner.t_spd);
							
							var curr_slide = $('.home_slide:visible')
							$('.home_slide').css('z-index', 30)
							$('#slide_' + Banner.current_id).css('z-index', 40).fadeIn(Banner.t_spd, function(){
								$(curr_slide).hide()
								Banner.lock = false;
								Banner.setTimer();
							});
							$('#banner_controls .current').removeClass('current').css('opacity', 0.5)
							$('#banner_controls h1[ctrl="'+ Banner.current_id +'"]').addClass('current').animate({'opacity': 1}, Banner.t_spd)
							
			}	
		},
		
		setTimer : function(){
			if(Banner.current_id < 3){
				Banner.current_id ++
			} else {
				Banner.current_id = 0;
			}
			
			Banner.curr_p = $('#banner_controls .dept:eq(' + Banner.current_id + ') p')
			
			Banner.timer_int = setTimeout('Banner.transition()', Banner.timer)
		}
		
	} // end Banner Object
	
	
	
	
	
	








$(document).ready(function() {

		// add captions to images with the correct classes
	if($("img.image_right_with_caption").length != 0){
	//alert('there is a caption on this page')	;
		$("img.image_right_with_caption").each(function(){
			var caption = $(this).attr('alt')	
			var width = $(this).width();
			
			$(this).wrap('<div style="float:right; display:inline;" class="imgwrapper" />');
			$(this).parent().append('<div class="caption r_cap" style="width:'+ width +'px"><em>'+ caption +'</em></span>')
			//$(this).parent().append('<div class="caption r_cap" style="width:'+ width +'px"><em>'+ caption +'</em></span>')
		});
	}
	
	if($("img.image_left_with_caption").length != 0){
	//alert('there is a caption on this page')	;
		$("img.image_left_with_caption").each(function(){
			var caption = $(this).attr('alt')					  
			var width = $(this).width();
			$(this).wrap('<div style="float:left; display:inline;" class="imgwrapper" />');
			$(this).parent().append('<div class="caption l_cap" style="width:'+ width +'px"><em>'+ caption +'</em></span>')
		});
	}
	
	
	
});