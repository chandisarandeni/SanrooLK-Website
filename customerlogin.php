<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="animation.css">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <section class="vh-100 login-section">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xl-10">
                            <div class="card login-form-area" style="border-radius: 1rem;">
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                                        <img src="images/login-img.jpg" alt="login form" 
                                             class="img-fluid h-100 w-100" style="border-radius: 1rem 1rem 1rem 1rem;" />
                                    </div>
                                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                        <div class="card-body p-4 p-lg-5 text-black">
                                            <form action="login.php" method="POST">
                                                <div class="d-flex mb-3 pb-1 login-logo align-items-start">
                                                    <span class="h1 fw-bold mb-0">
                                                        <img src="images/SanrooLogo.png" alt="">
                                                    </span>
                                                </div>
                                                
                                                <h5 class="fw-normal mb-3 pb-3 text-start" style="letter-spacing: 1px;">
                                                    Sign into your account
                                                </h5>
            
                                                <div class="form-outline mb-4">
                                                    <input type="email" id="form2Example17" name="email" class="form-control form-control-lg transparent-input" placeholder="Email address" required>
                                                </div>
                                                
                                                <div class="form-outline mb-4">
                                                    <input type="password" id="form2Example27" name="password" class="form-control form-control-lg transparent-input" placeholder="Password" required>
                                                </div>
            
                                                <div class="pt-1 mb-4">
                                                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                                </div>
            
                                                <a class="small text-muted" href="#">Forgot password?</a>
                                                <p class="mb-5 pb-lg-2" style="color: #393f81;">
                                                    Don't have an account? <a href="registration.php" style="color: #393f81;">Register here</a>
                                                </p>
                                                <a href="#" class="small text-muted">Terms of use.</a>
                                                <a href="#" class="small text-muted">Privacy policy</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                        </div>  
                    </div>
                </div>
            </section>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
