<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Raleway', sans-serif !important;
            
        }
        .site-footer {
            background-color: white !important;
            color: #f5f5f5!important;
            position: relative;
        }

        .nav-link:hover {
            color: blue;
            text-decoration: underline; /* Adds an underline on hover */
            font-weight: bold; /* Increases font weight on hover */
            transition: color 0.4s ease-in-out; /* Adds a smooth transition effect */
            /* Add any other styles as needed */
        }

        .footer-section, .nav-link {
            position: relative;
            z-index: 2;
        }

        .nav-link {
            color: black !important;
        }
        
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link rel="stylesheet" href="footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <footer class="footer site-footer">
        <div class="cut-line"></div>
        <div class="container">
            <div class="footer-links">
                <div class="footer-section">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about_page.php">About Us</a></li>
                        <li><a href="about_page.php">Contact Us</a></li>
                        <li><a href="terms_conditions_page.php">Privacy Policy</a></li>
                        <li><a href="terms_conditions_page.php">Terms of Service</a></li>
                        <li><a href="terms_conditions_page.php">Partners</a></li>
                        <li><a href="terms_conditions_page.php">Portfolio</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <ul>
                        <li><a href="tel:+254714051155" style="color: blue;"><i class="fas fa-phone"></i></a></li>
                        <li><a href="https://wa.me/254714051155" style="color: green;"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/antipas-henry-91408324b" style="color: blue;"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.facebook.com/inform.globals/" style="color: blue;"><i class="fab fa-facebook"></i></a></li>
                        <a href="https://www.youtube.com/channel/UCJCeOl1-1J5O8jp8Cyx8PLQ" style="color: red;"><i class="fab fa-youtube"></i></a>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Newsletter</h4>
                    <p>Stay updated with our latest articles and news. Subscribe now!</p>
                    <form action="process_subscribe.php" method="post">
                        <input type="text" placeholder="Your Name">
                        <input type="email" placeholder="Your Email">
                        <button type="submit" style="display: block;">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023-2040 IGULT</p>
            </div>
        </div>
    </footer>
</body>
</html>
