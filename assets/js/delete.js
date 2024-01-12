function confirmDelete(Id, tableName) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to delete.php with parameters
            window.location.href = 'delete.php?id=' + Id + '&table=' + tableName;
        }
    })
}
