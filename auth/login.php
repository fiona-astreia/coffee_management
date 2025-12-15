<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">

            

            <form action="validation.php" method="post">

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Registration successful!
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php
                        if ($_GET['error'] == 'invalid')
                            echo 'Invalid username or password!';
                        if ($_GET['error'] == 'nouser')
                            echo 'Account does not exist!';
                        ?>
                    </div>
                <?php endif; ?>

                

                

                

                <button type="submit" class="btn btn-auth mt-2">
                    LOGIN <i class="fas fa-arrow-right ml-2"></i>
                </button>

            </form>

            <div class="mt-4 text-muted" style="font-size: 0.9rem;">
                Don't have an account?
                <a href="register.php" class="auth-link ml-1">Register Here</a>
            </div>

        </div>
    </div>

</body>

</html>