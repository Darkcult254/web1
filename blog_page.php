<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400,700&style=italic&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...your-sha512-here..." crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="blogs.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IGULT-BLOG</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    
</head>

<body>
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<h3 style="text-align: center; margin-top: 170px;">IGULT BLOG</h3>

<main class="container">
    <section class="blog-content">
        <!-- Latest Articles Section -->
        <div class="featured-articles-card">
            <div class="featured-articles-box">
                <h3 class="box-title">Featured Articles</h3>
                <ul class="article-list" id="article-list">
                    <?php
                    include ('display_blog.php');
                    ?>
                </ul>
            </div>
        </div>

        <!-- Subscribe Section -->
        <section class="subscribe-section">
            <h3>Subscribe to Our Newsletter</h3>
            <p>Stay updated with our latest articles and news. Subscribe now!</p>
            <form action="process_subscribe.php" method="post">
                <input type="text" placeholder="Your Name">
                <input type="email" placeholder="Your Email">
                <button type="submit">Subscribe</button>
            </form>
        </section>
    </section>

    <!-- Sidebar (Latest Articles List) -->
    <aside class="sidebar">
    <h4 style="text-align: center;">Latest Articles</h4>

    <ul class="latest-articles-list" id="latest-articles-list">
        <?php
        
        include('blog_latest.php');
        ?>
    </ul>
</aside>

</main>

<footer>
    <?php
    include ('footer.php');
    ?>
</footer>

<!-- Include JavaScript to fetch and display articles -->
<script src="blog-script.js"></script>
</body>
</html>

<style>
/* Apply styles to images */
img {
    max-width: 50%; /* Make images responsive */
    height: auto; /* Maintain image aspect ratio */
    border-radius: 10px; /* Add a rounded border */
    display: block; /* Remove default inline behavior */
    margin: 0 auto; /* Center images horizontally */
    
}

/* Apply styles to videos */
video {
    max-width: 70%; /* Make videos responsive */
    height: auto; /* Maintain video aspect ratio */
    border-radius: 5px; /* Add a rounded border */
    display: block; /* Remove default inline behavior */
    margin: 0 auto; /* Center videos horizontally */
}

/* Adjust the size of images and videos based on your needs */


</style>