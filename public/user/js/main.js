let fileAvatar = document.querySelector("#file-avatar");
let imgShowAvatar = document.querySelector(".img-show-avatar");

const reader = new FileReader();
fileAvatar.addEventListener("change", (event) => {
	const files  = event.target.files;
	
	reader.readAsDataURL(files[0])
	
	reader.addEventListener("load", (event) => {
		const img = event.target.result;
		
        imgShowAvatar.src=img
    })
})
