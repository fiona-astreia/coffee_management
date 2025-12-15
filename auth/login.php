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

                

                

                

                

            </form>

            

        </div>
    </div>

</body>

</html>