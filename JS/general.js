function centerModal() {
	$(this).css('display', 'block');
	var $dialog = $(this).find(".modal-dialog");
	var offset = ($(window).height() - $dialog.height()) / 2;
	// Center modal vertically in window
	$dialog.css("margin-top", offset);
}
$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function() {
	$('.modal:visible').each(centerModal);
});

$('.modal').on('hidden.bs.modal', function() {
	$(this).find('form')[0].reset();
});

/**
 * this method sends a post or get request using JS
 * @returns void
 * @param path
 * @param params
 * @param method
 */
function post(path, params, method) {
    method = method || "post"; 
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }
    document.body.appendChild(form);
    form.submit();
}
