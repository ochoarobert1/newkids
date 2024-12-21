document.addEventListener('DOMContentLoaded', function() {
	let mainHeader = document.getElementById('masthead');
	if (mainHeader) {
		window.addEventListener('scroll', function() {
			if (window.scrollY > 200) {
				mainHeader.classList.add('header-scroll');
			} else {
				mainHeader.classList.remove('header-scroll');
			}
		});
	}
});