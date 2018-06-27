const students = document.getElementById('students');
if(students) {
    students.addEventListener('click', e => {
        if(e.target.className === "btn btn-secondary delete" || e.target.className === "fe fe-trash-2 delete") {
            if(confirm('Are you sure you want to delete this student?')) {
                const id = e.target.getAttribute('data-id');
                fetch('/students/delete/'+id, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}

