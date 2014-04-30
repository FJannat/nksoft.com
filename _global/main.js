// JavaScript Document
window.addEvent('load', function(){
	$$('#menu-main-nav li').each(function(i,inx) {
		i.addEvent('mouseenter', openNav);
		i.addEvent('mouseleave', closeNav);
	})
	if($('blog').getFirst('p')) {
		$('blog').set('html', '<a href="http://www.tollgrade.com/blog/">Tollgrade’s Blog<br /><span>Join the Conversation</span></a>');
		$('blog').setStyles({'opacity':'100','visibility':'visible'});
	} else {
		$('blog').destroy();
	}
	$$('#submitBtn').each(function(i,inx){
		i.addEvent('mouseenter',function(){
			i.setStyles({'background-color':'#009DDC','cursor':'pointer'});
		})
		i.addEvent('mouseleave',function(){
			i.setStyle('background-color','#1ab7ea');
		})
	})
	$$('#searchsubmit').each(function(i,inx){
		i.addEvent('mouseenter',function(){
			i.setStyles({'background-color':'#009DDC','cursor':'pointer'});
		})
		i.addEvent('mouseleave',function(){
			i.setStyle('background-color','#1ab7ea');
		})
	})
	if($('thirdLevel')) {
		changeThirdNav();
	}
	$$('#masthead h1').each(function(i,inx) {
		if(i.getFirst('img')){
	 		setBackground();
		}
	})
	rollovers();
	checkHeights();
})
function openNav() {
	if(this.getFirst('ul')) {
		var firstA = this.getFirst('a');
		firstA.addClass('hover');
		var firstUL=this.getFirst('ul');
		firstUL.setStyles({'opacity':'100','visibility':'visible'})
	}
}
function closeNav() {
	if(this.getFirst('ul')) {
		var firstA = this.getFirst('a');
		firstA.removeClass('hover');
		var firstUL=this.getFirst('ul');
		firstUL.setStyles({'opacity':'0','visibility':'hidden'})
	}
}
function checkHeights() {
	lH=$('leftSide').getSize().y;
	rH=$('rightSide').getSize().y;
	if(lH>rH) {
		$('rightSide').setStyle('height',lH+"px");
	} else {
		$('leftSide').setStyle('height',rH+"px");
	}
}
function changeThirdNav() {
	var firstLI = $('thirdLevel').getFirst('li');
	var firstA =firstLI.getFirst('a');
	firstA.set('text', 'Overview');
}
function setBackground() {
	var getImg = $$('#masthead h1');
	getImg.each(function(i,inx) {
		var gI = i.getElement('img');
		gI.addClass('erase');
		var src = gI.getProperty('src');
		$$('#masthead h1').setStyles({'background-image':'url('+src+')', 'background-position':'0 0', 'background-repeat':'no-repeat'});
		$$('.erase').each(function(i,inx) {
			i.destroy();
		})
	})
}
function rollovers() {
	$$('.change').each(function(i,inx){
			i.addEvent('mouseenter', defualt);
			i.addEvent('mouseleave', change);
	});
	$$('.changeBlog').each(function(i,inx){
			i.addEvent('mouseenter', defualtBlog);
			i.addEvent('mouseleave', changeBlog);
	});
	$$('.changeHome').each(function(i,inx){
			i.addEvent('mouseenter', defualtHome);
			i.addEvent('mouseleave', changeHome);
	});
}

function defualt() {
	var href = this.getProperty('href');
	if(href=="http://www.tollgrade.com/broadband/broadband-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-broadband-hover.png)');
	}
	if(href=="http://www.tollgrade.com/smartgrid/smart-grid-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-smartgrid-hover.png)');
	}
}
function change() {
	var href = this.getProperty('href');
	if(href=="http://www.tollgrade.com/broadband/broadband-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-broadband.png)');
	}
	if(href=="http://www.tollgrade.com/smartgrid/smart-grid-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-smartgrid.png)');
	}
}
function defualtBlog() {
	this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-blogBtn-hover.png)');
}
function changeBlog() {
	this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-blogBtn.png)');
}
function defualtHome() {
	var href = this.getProperty('href');
	if(href=="http://www.tollgrade.com/broadband/broadband-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-broadbandHome-hover.png)');
	}
	if(href=="http://www.tollgrade.com/smartgrid/smart-grid-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-smartgridHome-hover.png)');
	}
}
function changeHome() {
	var href = this.getProperty('href');
	if(href=="http://www.tollgrade.com/broadband/broadband-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-broadbandHome.png)');
	}
	if(href=="http://www.tollgrade.com/smartgrid/smart-grid-solutions/overview/") {
		this.setStyle('background-image', 'url(http://www.tollgrade.com/gfx/bg-smartgridHome.png)');
	}
}