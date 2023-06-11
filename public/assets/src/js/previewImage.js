document.querySelector('.imageInput').addEventListener('change', function(event) {
    let input = event.target;
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.addEventListener('load', function(e) {
        let imagePreview = document.getElementById('imagePreview');
        imagePreview.src = e.target.result;
      });

    reader.readAsDataURL(input.files[0]);
    }
  });