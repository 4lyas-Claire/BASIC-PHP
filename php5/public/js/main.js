$('#frmInsert').submit((e) => {
    e.preventDefault();
    let data = $('#frmInsert').serializeArray();

    $.ajax({
        url : 'index.php?action=register',
        type : 'POST',
        data : {
            data : data
        },
        cache : false,
        success : (response) => {
            Swal.fire(
                'Success!',
                 response,
                'success'
            );
            console.log(response);
            setTimeout( () => {
                window.location.href = 'index.php?action=display'
            }, 1000);
        },
        error : (x, stat, err) => {
            console.log(x);
            console.log(stat);
            console.log(err);
        }
    });
});

$('#frmEdit').submit((e) => {
    e.preventDefault();
    let data = $('#frmEdit').serializeArray();
    $('#exampleModal').modal('hide');

    $.ajax({
        url : 'index.php?action=edit',
        type : 'POST',
        data : {
            data : data
        },
        success : (response) => {
            Swal.fire(
                'Success!',
                 response,
                'success'
            );
          
            setTimeout( () => {
                window.location.href = 'index.php?action=display'
            }, 1000);
        },
        error : (x, stat, err) => {
            console.log(x);
            console.log(stat);
            console.log(err);
        }
    });
});

function edit(id) {
    $.ajax({
        url : 'index.php?action=getFacultyData',
        type : 'POST',
        data : {
            id : id
        },
        dataType : 'JSON',
        success : (response) => {
            $('#faculty_id').val(response.faculty_id);
            $('#faculty_fname').val(decode(response.faculty_fname));
            $('#faculty_mname').val(decode(response.faculty_mname));
            $('#faculty_lname').val(decode(response.faculty_lname));
            $('#faculty_age').val(response.faculty_age);
            $('#faculty_gender').val(response.faculty_gender);
            $('#faculty_address').val(decode(response.faculty_address));
            $('#faculty_position').val(decode(response.faculty_position));
            $('#faculty_salary').val(response.faculty_salary);
            $('#exampleModal').modal('show');
        },
        error : (x, stat, err) => {
            console.log(x);
            console.log(stat);
            console.log(err);
        }
    });
}

function del(id) {
    $.ajax({
        url : 'index.php?action=delete',
        type : 'POST',
        data : {
            id : id
        },
        success : (response) => {
            Swal.fire(
                'Success',
                response,
                'success'
            );

            setTimeout(() => {
                window.location.href = "index.php?action=display"
            }, 1000);

            console.log(response);
        },
        error : (x, stat, err) => {
            console.log(x);
            console.log(stat);
            console.log(err);
        }
    });
}

// to parse or decode html special characters
function decode(str) {
    let txt = new DOMParser().parseFromString(str, "text/html");
    return txt.documentElement.textContent;
}
