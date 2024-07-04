<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>iBUA Innovation Hub - FAQs Page</title>
        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="css/slick.css"/>
        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
    </head>
    
    <body>
        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <strong><span>iBUA</span> Hub</strong>
                    </a>
                    <div class="d-lg-none">
                        <a href="sign-in.html" class="bi-person custom-icon me-3"></a>
                        <a href="product-detail.html" class="bi-bag custom-icon"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="News.php">News</a></li>
                            <li class="nav-item"><a class="nav-link active" href="faq.php">FAQs</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <header class="site-header section-padding d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-12">
                            <h1>
                                <span class="d-block text-primary">Your favorite questions</span>
                                <span class="d-block text-dark">and our answers to them</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>

            <section class="faq section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <h2>General Info.</h2>
                            <?php
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $db = "ibuahubdatastore";
                            $port = 3306;

                            // Create database connection
                            $conn = new mysqli($host, $username, $password, $db, $port);
                            if ($conn->connect_error) {
                                die("Connection failed: ". $conn->connect_error);
                            }

                            $sql = "SELECT * FROM `faq` ORDER BY `id` DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $uniqueId = 'accordionGeneral' . $row['id']; // Unique ID for each accordion item
                                    ?>
                                    <div class="accordion" id="accordionGeneral">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $uniqueId; ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $uniqueId; ?>" aria-expanded="true" aria-controls="<?php echo $uniqueId; ?>">
                                                    <?php echo $row['question']; ?>
                                                </button>
                                            </h2>
                                            <div id="<?php echo $uniqueId; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $uniqueId; ?>" data-bs-parent="#accordionGeneral">
                                                <div class="accordion-body">
                                                    <p class="large-paragraph"><?php echo $row['answer']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "NO ITEMS UPLOADED";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.html">iBUA</a> Hub</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2024 <strong></strong></p>
                        <br>
                        <p class="copyright-text"><a href="https://www.tooplate.com/" target="_blank"></a></p>
                    </div>
                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>
                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">About</a></li>
                            <li class="footer-menu-item"><a href="Updates.html" class="footer-menu-link">Updates</a></li>
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy policy</a></li>
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">FAQs</a></li>
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>
                        <ul class="social-icon">
                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>
                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
