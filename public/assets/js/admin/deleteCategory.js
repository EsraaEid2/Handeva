function deleteCategory(categoryId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Get CSRF Token from meta tag
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Create a form for deletion request
            let form = document.createElement('form');
            form.action = '/admin/delete-category/' + categoryId;
            form.method = 'POST';
            form.innerHTML = `
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value="${csrfToken}">
`;
            document.body.appendChild(form);
            form.submit(); // Submit the form
        }
    });
}
