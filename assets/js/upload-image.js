document.querySelectorAll('.uplfile').forEach(fileInput => 
    fileInput.addEventListener('change', function () {
        const formData = new FormData();
        formData.append('uplfile', this.files[0]);

        fetch('/ENSAH-service/inc/functions/upload-image.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(path => {
            path = path.trim();
            if (path !== '') {
                // Update the image preview
                const img = document.getElementById('avatar-preview');
                if (img) img.src = path;

                // Store in a hidden input for DB storage
                let inputHidden = document.getElementById('avatar-path');
                if (!inputHidden) {
                    inputHidden = document.createElement('input');
                    inputHidden.type = 'hidden';
                    inputHidden.name = 'avatar_path';
                    inputHidden.id = 'avatar-path';
                    document.querySelector('form').appendChild(inputHidden);
                }
                inputHidden.value = path;
            }
        })
        .catch(error => {
            console.error('Erreur d\'upload :', error);
        });
    })
);
