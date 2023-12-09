<!DOCTYPE html>
<html lang="en">
<head>
<style>
    
    html, body {
    margin: 0 !important;
    padding: 0;
}
* {
    box-sizing: border-box;
}
/* Styling for the topbar */
#topbar {
    background-color: white!important; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    position: fixed;
    top: 0;
    width: 100% !important;
    z-index: 1000 !important;
}

#logo {
    margin-left: 20px;
}

#logo a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 20px;
    display: flex;
    align-items: center;
}

#contact-icons {
    margin-right: 20px;
}

#contact-icons a {
    font-size: 18px;
    text-decoration: none;
    margin-right: 10px;
}

/* Styling for the header */
#header {
    background: white!important;
    padding: 10px 0;
    position: fixed;
    top: 50px; /* Adjusted top position to create space below the topbar */
    width: 100%;
    z-index: 999; /* Adjusted z-index to make it appear below topbar */
}

#nav ul {
    background: white!important;
    display: flex;
    justify-content: center;
    gap: 50px;
    padding: 10px 0;
    list-style: none;
    margin: 0;
    flex-wrap: wrap;
}

#nav ul li {
    margin: 0 5px;
}

#nav ul li a {
    text-decoration: none;
    color: black;
    font-family: Raleway, sans-serif;
    font-weight: 500;
    transition: color 0.3s, box-shadow 0.3s;
    font-size: 14px;
}

#nav ul li a:hover {
    color: blue;
    text-decoration: underline; /* Adds an underline on hover */
    font-weight: bold; /* Increases font weight on hover */
    transition: color 0.4s ease-in-out; /* Adds a smooth transition effect */
    /* Add any other styles as needed */
}


/* Responsive adjustments */
@media (max-width: 768px) {
    #topbar {
        padding: 10px 0;
    }
    #contact-icons {
        margin-right: 10px;
    }
    #nav ul {
        gap: 20px;
    }
    #nav ul li {
        margin: 0;
    }
}
#nav-container {
        border-top: 1px solid #000; /* Adjust the color and thickness as needed */
        border-bottom: 1px solid #000; /* Adjust the color and thickness as needed */
        padding: 10px 0; /* Add padding for separation */
    }
    .active {
      color: blue;
      text-decoration: underline; /* Adds an underline on hover */
      font-weight: bold; /* Increases font weight on hover */
      /* Add any other styles as needed */
    }
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>IGULT</title>
    
</head>
<body>

<div id="topbar">
    <div id="logo">
        <a href="about_page.php">
            <i class="fas fa-globe"></i>IGULT
        </a>
       
    </div>
   
    <?php //include 'search.php'; ?>
  
    <div id="contact-icons">
    <a href="tel:+254714051155" style="color: blue;" target="_blank"><i class="fas fa-phone"></i></a>
    <a href="https://wa.me/254714051155" style="color: green;" target="_blank"><i class="fab fa-whatsapp"></i></a>
    <a href="https://www.linkedin.com/in/antipas-henry-91408324b" style="color: blue;" target="_blank"><i class="fab fa-linkedin"></i></a>
    <a href="https://www.facebook.com/inform.globals/" style="color: blue;" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="https://www.youtube.com/channel/UCJCeOl1-1J5O8jp8Cyx8PLQ" style="color: red;" target="_blank"><i class="fab fa-youtube"></i></a>
</div>

</div>
</div>

<header id="header">
<div id="nav-container">
    <nav id="nav">
        <ul>
            <li>
                <a href="index.php">HOME</a>
            </li>
            <li>
                <a href="about_page.php">ABOUT</a>
            </li>
            <li>
                <a href="news_page.php">NEWS</a>
            </li>
            
            <li>
            <a href="codebin_page.php">ENTERTAINMENT</a>
            </li>
            <li>
                <a href="sports_page.php">SPORTS</a>
            </li>
            <li>
                <a href="blog_page.php">BLOG</a>
            </li>
            <li>
                <a href="tech_exploration_page.php">TECH</a>
            </li>
            <li>
                <a href="business_page.php">BUSINESS</a>
            </li>
            <li>
                <a href="academia_page.php">ACADEMIA</a>
            </li>
            <li>
                <a href="codebin_page.php">CODEBIN</a>
            </li>
            <li>
                <a href="terms_conditions_page.php">TERMS OF USE</a>
            </li>
            
            
        </ul>
    </nav>
</div>
</header>


</body>
</html>
