import './bootstrap';

// import.meta.glob([
//     '..images/**'
// ]);

document.getElementById('edit_button').addEventListener('click', function() {
    // Trigger click on the file input;
    document.getElementById('profile_image_input').click();
});

document.getElementById('profile_image_input').addEventListener('change', function(event, btn) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update the src attribute of the image preview
            document.getElementById('profile_image_preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

