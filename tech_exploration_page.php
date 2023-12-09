<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IGULT TECH</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...your-sha512-here..." crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="blogs.css">
</head>

<body>
<header>
<?php
include_once ('header.php');
  ?>
</header>
<h3 style="text-align: center; margin-top: 150px;">IGULT TECH</h3>

<main class="container">
            <section class="blog-content">
                <!-- Latest Articles Section -->
                <div class="featured-articles-card">
                    <div class="featured-articles-box">
                        <h3 class="box-title">Featured Articles</h3>
                        <ul class="article-list" id="article-list">
						<?php
    include('display_tech.php');
    ?> 
                        </ul>
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
                <ul class="latest-articles-list">
                    <?php
                    include('tech_latest.php');
                    ?>
                </ul>
            </aside>
        </main>

		<footer>
		<?php
include ('footer.php');
?>
		</footer>
</body>
</html>


