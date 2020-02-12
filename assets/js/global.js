function error(text, href) {
	setTimeout( function() {
		Swal.fire({
		  type: 'error',
		  title: 'Oh no!',
		  html: text,
		}).then(function() {
			window.location = href;
		})
	}, 100)
}
function success(text, href) {
	setTimeout( function() {
		Swal.fire({
		  type: 'success',
		  title: 'Success!',
		  html: text,
		}).then(function() {
			window.location = href;
		})
	}, 100)
}
$('.select2').select2({
  theme: 'bootstrap4'
})