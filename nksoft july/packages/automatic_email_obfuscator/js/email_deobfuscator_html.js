(function($){

$(document).ready(function() {
	$("a.obfuscated_link").deobfuscateEmailLink();
	$("span.obfuscated_link_text").deobfuscateEmailLink();
});
$.fn.deobfuscateEmailLink = function() {
	$(this).each(function() {
		if ($(this).hasClass("obfuscated_link")) {
			var href = $(this).attr("href");
			$(this).attr("href", href.replace("#MAIL:", "mailto:").replace("(at)", "@"));
		} else {
			$(this).html($(this).html().replace("(at)", "@"));
		}
	});
};

})(jQuery);