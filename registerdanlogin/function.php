<!-- koneksi -->
<?php
$conn = mysqli_connect("localhost","root","","registerdanlogin");

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username apakah sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM login_user WHERE username ='$username'");
    
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('Gagal melakukan Register, coba username lain!')</script>";
        return false;
    }

    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert('Ulangi Password yang sama!');
                </script>";
                return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password); die;

    mysqli_query($conn, "INSERT INTO login_user VALUES('$username','$password','$password2')");
    return mysqli_affected_rows($conn);


}
?>