<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div class="container shadow-lg rounded">
        <div class="row">
            <div class="col-7 login">
                <img src="img/logo text.png" alt="">
                <h4>Log in to your Account</h4>
                <p>Lorem ipsum dolor sit amet.</p>

                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" required>
                            <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        </div>
                        <div class="password-footer d-flex justify-content-between">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="show-password"> <!-- checkbox liat password -->
                                <label class="form-check-label" for="show-password">
                                    Show Password
                                </label>
                            </div>
                            <div class="mt-2">
                                <a href="" class="forget">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role" required>
                            <option selected disabled>Select Your Role</option>
                            <option value="Owner">Owner</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Gudang">Gudang</option>
                        </select>
                    </div> -->


                    <button type="submit" class="btn btn-success mt-3" name="submit">Login</button>

                </form>
            </div>
            <div class="col-5 contact rounded-end d-flex flex-column align-items-center justify-content-center text-center"><!-- flex column is arranges the children (image and heading) in a vertical column -->
                <img src="img/undraw_tasting_re_3k5a.svg" alt="" class="w-100">
                <h5 class="mt-5 text-center">Login to get to our services</h5>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
        </div>
    </div>
    
</body>

</html>