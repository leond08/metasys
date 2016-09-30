function triggerUpload(event,elem){
			event.preventDefault();
			document.getElementById(elem).click();
		}
		
		function previewFile(input) {
					  var preview = document.getElementById('img');
					  var file    = input.files[0];
					  var reader  = new FileReader();

						reader.onloadend = function () {
						preview.src = reader.result;
					  }

					  if (file) {
						reader.readAsDataURL(file);
					  } else {
						preview.src = "";
					  }
}