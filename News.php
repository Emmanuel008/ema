<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>iBUA Innovation Hub - Updates</title>

        
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="css/slick.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/base.css"/>

        <link href="css/tooplate-little-fashion.css" rel="stylesheet">

      
        <style>
            



.custom-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            
        }
        .custom-card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            color: #666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        </style>
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
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="News.php">News</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="faq.php">FAQs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <header class="site-header section-padding d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-10 col-12">
                            <h1>
                                <span class="d-block text-primary">Latest</span>
                                <span class="d-block text-dark">Updates</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>

            <section class="s-services" id="services">
            <div class="row">
				<div class="clients-carousel owl-carousel">
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


                $sql = "SELECT * FROM `news` ORDER BY `id` DESC";

                $result = $conn->query($sql);

                $activeClass = 'active';


                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {?>
                        <div class="card custom-card">
                        <img src="./images/<?php echo $row['photo'];?>" class="d-block w-100" alt="">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $row['title'];?></h5>
                            
                            <p class="card-text">" <?php echo $row['content'];?></p>
                            <a href="<?php echo $row['link'];?>" class="btn btn-primary">Read more</a>
                            
                        </div>
                        <div class="card-footer text-muted text-center">
                        <p>Published on July 4, 2024</p>
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

</section>


            <!-- <section class="products section-padding">
                <div class="col-lg-10 col-12">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="images/COSTECH-14 - Copy.jpg" class="img-fluid mh-100" alt="">
                                </div>

                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3">iBUA <span>Hub</span> <br>Stakeholder <span>training</span> Support</h4>

                                        <p>
                                            Stakeholder engagement at iBUA Hub involves actively involving and collaborating with various individuals, organizations, and entities that have a vested interest in the success and growth of the innovation ecosystem in Zanziba</p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="about.html" class="custom-link mb-2">
                                                Read more 
                                                <i class="bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
            </section>

            <section class="products section-padding">
                <div class="col-lg-10 col-12">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <img src="images/COSTECH-1 - Copy - Copy.jpg" class="img-fluid mh-100" alt="">
                                </div>

                                <div class="col-lg-5 col-12">
                                    <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                        <h4 class="mb-3">iBUA <span>Hub</span> <br>Management <span>training</span> Support</h4>

                                        <p>Aims to equip entrepreneurs, innovators, and business leaders with the skills, knowledge, and tools necessary to effectively manage and grow their ventures.</p>
                                        <div class="mt-2 mt-lg-auto">
                                            <a href="about.html" class="custom-link mb-2">
                                                Read more 
                                                <i class="bi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
            </section> -->


            
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
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>

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

     
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        </script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
        </script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
        </script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
               $('.clients-carousel').owlCarousel({
                   loop: true,
                   nav: false,
                   autoplay: true,
                   autoplayTimeout: 5000,
                   animateOut: 'fadeOut',
                   animateIn: 'fadeIn',
                   smartSpeed: 450,
                   margin: 30,
                   responsive: {
                       0: {
                           items: 1
                       },
                       768: {
                           items: 2
                       },
                       991: {
                           items: 3
                       },
                       1200: {
                           items: 3
                       },
                       1920: {
                           items: 3
                       }
                   }
               });
        </script>
        <script>
        if ('loading' in HTMLImageElement.prototype) {
                const images = document.querySelectorAll('img[loading="lazy"]');
                images.forEach(img => {
                    img.src = img.dataset.src;
                });
            } else {
                // Dynamically import the LazySizes library
                const script = document.createElement('script');
                script.src = '/js/lazysizes.min.js';
                document.body.appendChild(script);
            }



        </script>
        
    </body>
</html>
