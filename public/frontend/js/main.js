let items = document.querySelectorAll('.carousel .carousel-item')

items.forEach((el) => {
	const minPerSlide = 4
	let next = el.nextElementSibling
	for (var i = 1; i < minPerSlide; i++) {
		if (!next) {
			next = items[0]
		}
		let cloneChild = next.cloneNode(true)
		el.appendChild(cloneChild.children[0])
		next = next.nextElementSibling
	}
})


function incInputNumber(input, step) {
	if (!input.disabled) {
		let val = +input.value;
		if (isNaN(val)) val = 0
		val += +step;

		if (input.min && val < input.min) {
			val = input.min;
		} else if (val < 0) {
			val = 0;
		}

		input.value = val;
		input.setAttribute("value", val);
	}
}

