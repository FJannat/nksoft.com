window.addEvent('load', function(){
	var firstP = $('newsLetterForm').getFirst('p');
	if($('newsLetterForm').getFirst('p')) {
		firstP.destroy();
		$('newsLetterForm').setStyles({'height':'121px','width':'255px','margin-bottom':'16px','padding':'23px 30px 70px 30px							'});
	}
});
