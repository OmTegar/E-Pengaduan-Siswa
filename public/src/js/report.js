document.addEventListener('DOMContentLoaded', function() {
    var checkAllCheckbox = document.getElementById('check_all');
    var guruCheckboxes = document.querySelectorAll('input[name="recipient[]"]');

    checkAllCheckbox.addEventListener('change', function() {
        // Perbarui status checkbox guru berdasarkan status checkbox "Check All"
        guruCheckboxes.forEach(function(checkbox) {
            checkbox.checked = checkAllCheckbox.checked;
        });
    });

    guruCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Periksa apakah setiap checkbox guru telah dicentang atau tidak
            var allChecked = true;
            guruCheckboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            // Perbarui status checkbox "Check All" berdasarkan status checkbox guru
            checkAllCheckbox.checked = allChecked;
        });
    });
});

function previewFiles() {
    var preview = document.getElementById('show_name_file');
    var files = document.getElementById('attachment').files;
    var fileNames = [];
    for (var i = 0; i < files.length; i++) {
        fileNames.push(files[i].name);
    }
    preview.classList.remove('hidden');
    preview.innerHTML =  fileNames.join('<br>');
}