<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Coffee House</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            
            

            <form action="registration.php" method="post">
                
                <div class="form-group">
                    <input type="text" name="user" class="form-control rounded-pill" placeholder="Choose Username" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control rounded-pill" placeholder="Choose Password" required>
                </div>

                <button type="submit" class="btn btn-auth mt-3">
                    SIGN UP <i class="fas fa-user-check ml-2"></i>
                </button>

            </form>

            

        </div>
    </div>

</body>
</html>