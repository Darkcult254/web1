// Function to preview uploaded media (image or video)
        function previewMedia(input) {
            var mediaPreview = document.getElementById('mediaPreview');

            if (input.files && input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
                    var file = input.files[i];
                    var mediaContainer = document.createElement('div');
                    mediaContainer.className = 'media-container';

                    if (file.type.startsWith('image')) {
                        var img = new Image();
                        img.className = 'uploaded-media';
                        img.src = URL.createObjectURL(file);
                        mediaContainer.appendChild(img);
                    } else if (file.type.startsWith('video')) {
                        var video = document.createElement('video');
                        video.className = 'uploaded-media';
                        video.controls = true;
                        video.type = file.type; // Set the type for proper rendering
                        var source = document.createElement('source');
                        source.src = URL.createObjectURL(file);
                        source.type = file.type;
                        video.appendChild(source);
                        mediaContainer.appendChild(video);
                    }

                    // Add a delete button to each media element
                    var deleteButton = document.createElement('button');
                    deleteButton.innerText = 'Delete';
                    deleteButton.className = 'delete-button';
                    deleteButton.addEventListener('click', function (e) {
                        e.preventDefault();
                        mediaPreview.removeChild(mediaContainer);
                    });

                    mediaContainer.appendChild(deleteButton);
                    mediaPreview.appendChild(mediaContainer);
                }
            }
        }
  
