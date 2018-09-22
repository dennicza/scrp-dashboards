<?php
    if ( $_FILES['file']['name'] === 'bindings.xls') {
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'];
        }
        else {
            echo move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
        }
    } else {
        echo 'Error: file mismatch';
    }
?>