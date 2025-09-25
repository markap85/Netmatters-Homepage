<?php
// Include the header and sidebar
include_once 'includes/header.php';

// Include the navigation menu
include_once 'includes/navigation.php';

// Load environment variables
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch news items
try {
    $stmt = $pdo->prepare("SELECT * FROM news ORDER BY date_published DESC LIMIT 3");
    $stmt->execute();
    $news_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $news_items = [];
    error_log("News fetch error: " . $e->getMessage());
}
?>

<!-- =======================
BANNER SLIDESHOW SECTION - Now using Splide.js
======================= -->

<section class="splide banner-slideshow" aria-labelledby="hero-heading">
    <div class="splide__track">
        <ul class="splide__list">
            <!-- Slide 1 -->
            <li class="splide__slide" data-bg="01_Home.png">
                <div class="container">
                    <div class="banner-content">
                        <h1 id="hero-heading">The East Of England's Leading Technology Company</h1>
                        <p class="subtext">Performance-driven digital and technology services with complete transparency</p>
                        <a class="btn">Why Choose Us?</a>
                    </div>
                </div>
            </li>

            <!-- Slide 2 -->
            <li class="splide__slide" data-bg="02_Bespoke.jpg">
                <div class="container">
                    <div class="banner-content">
                        <h1>Bespoke Software</h1>
                        <p class="subtext">Delivering expert bespoke software <br>solutions across a range of industries</p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>

            <!-- Slide 3 -->
            <li class="splide__slide" data-bg="03_IT.png">
                <div class="container">
                    <div class="banner-content">
                        <h1>IT Support</h1>
                        <p class="subtext">Fast and cost-effective IT support services for your business.</p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>

            <!-- Slide 4 -->
            <li class="splide__slide" data-bg="04_Marketing.png">
                <div class="container">
                    <div class="banner-content">
                        <h1>Digital Marketing</h1>
                        <p class="subtext">Generating your new business through results-driven marketing activities. </p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>

            <!-- Slide 5 -->
            <li class="splide__slide" data-bg="05_Telecoms.png">
                <div class="container">
                    <div class="banner-content">
                        <h1>Telecoms Services</h1>
                        <p class="subtext">A new approach to connectivity, see how we can help your business.</p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>

            <!-- Slide 6 -->
            <li class="splide__slide" data-bg="06_WebDesign.jpg">
                <div class="container">
                    <div class="banner-content">
                        <h1>Web Design</h1>
                        <p class="subtext">For businesses looking to make a strong and effective first impression.</p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>

            <!-- Slide 7 -->
            <li class="splide__slide" data-bg="07_Security.png">
                <div class="container">
                    <div class="banner-content">
                        <h1>Cyber Security</h1>
                        <p class="subtext">Keeping business's and their customers sensitive information protected.</p>
                        <a class="btn">Find Out More</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="services" aria-labelledby="services-heading">
    <div class="container">
        <header class="services-title">
            <h2 id="services-heading">Our Services</h2>
            <a class="view-our-work">View Our Work <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </header>

        <div class="services-grid">
            <article class="service-item bespoke-hover">
                <span class="icon-laptop" aria-hidden="true"></span>
                <h3>Bespoke Software</h3>
                <p>Bespoke software solutions for all your business needs including integrations and reporting.</p>
                <a class="service-item__link service-item__link--bespoke">Read More</a>
            </article>
            <article class="service-item it-hover">
                <span class="icon-display" aria-hidden="true"></span>
                <h3>IT Support</h3>
                <p>Fully managed IT support and consultancy packages tailored to meet your exact business needs.</p>
                <a class="service-item__link service-item__link--it">Read More</a>
            </article>
            <article class="service-item digital-hover">
                <span class="icon-stats-bars" aria-hidden="true"></span>
                <h3>Digital Marketing</h3>
                <p>Driven brand awareness &amp; ROI through creative digital marketing campaigns.</p>
                <a class="service-item__link service-item__link--digital">Read More</a>
            </article>
        </div>

        <div class="services-grid-sub">
            <article class="service-item telecoms-hover">
                <span class="icon-phone_in_talk" aria-hidden="true"></span>
                <h3>Telecoms Services</h3>
                <p>Business telephony solutions including mobile &amp; connectivity solutions.</p>
                <a class="service-item__link service-item__link--telecoms">Read More</a>
            </article>
            <article class="service-item web-hover">
                <span class="icon-embed" aria-hidden="true"></span>
                <h3>Web Design</h3>
                <p>User-centric design for businesses looking to make a lasting impression.</p>
                <a class="service-item__link service-item__link--web">Read More</a>
            </article>
            <article class="service-item cyber-hover">
                <span class="icon-security" aria-hidden="true"></span>
                <h3>Cyber Security</h3>
                <p>Prevention, testing, consultancy &amp; breach management services.</p>
                <a class="service-item__link service-item__link--cyber">Read More</a>
            </article>
            <article class="service-item developer-hover">
                <span class="icon-school" aria-hidden="true"></span>
                <h3>Developer Training</h3>
                <p>Web design &amp; software training courses designed to secure a job in tech.</p>
                <a class="service-item__link service-item__link--developer">Read More</a>
            </article>
        </div>
    </div>
</section>

<!-- =======================
ACCREDITATION SECTION
This section showcases the partners and certifications of Netmatters.
======================= -->

<div class="accreditation-carousel">
    <div class="accreditation-carousel-track">
        <!-- Repeat logos to ensure smooth loop -->
        <img src="./img/PartnerLogos/Partner_Logo_1.jpeg" alt="Client 1">
        <img src="./img/PartnerLogos/Partner_Logo_2.png" alt="Client 2">
        <img src="./img/PartnerLogos/Partner_Logo_3.png" alt="Client 3">
        <img src="./img/PartnerLogos/Partner_Logo_4.jpg" alt="Client 4">
        <img src="./img/PartnerLogos/Partner_Logo_5.png" alt="Client 5">
    </div>
</div>

<!-- =======================
WELCOME SECTION
This section showcases the partners and certifications of Netmatters.
======================= -->

<div class="welcome-section" aria-labelledby="welcome-heading">
    <div class="container">
        <div class="welcome-grid">
            <article class="welcome-grid-item">
                <h2 id="welcome-heading">Welcome To Netmatters</h2>
                <p class="bold">Netmatters is a leading Bespoke Software, IT Support, and Digital Marketing company based in the East of England with offices in Cambridge, Wymondham, and Great Yarmouth.</p>
                <p>We aren't tied into contracts with third-party providers, so you know that our recommendations for your business are based purely with one benefit in mind: to help improve your business with the most appropriate solutions.</p>
                <p>We pride ourselves on being an ethical business and have a unique business offering and cost model that ensures you get the most from our relationship in an upfront manner.</p>
                <div class="welcome-links">
                    <a class="btn btn--primary">Why Choose Us?<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <a class="btn btn--primary">Our Culture<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>
            <article class="welcome-grid-item">
                <h2>What Our Clients Think</h2>
                <div class="stars-bar" role="img" aria-label="5 out of 6 stars rating">
                    <span class="icon-star-full" aria-hidden="true"></span>
                    <span class="icon-star-full" aria-hidden="true"></span>
                    <span class="icon-star-full" aria-hidden="true"></span>
                    <span class="icon-star-full" aria-hidden="true"></span>
                    <span class="icon-star-full" aria-hidden="true"></span>
                    <span class="icon-star-empty" aria-hidden="true"></span>
                </div>
                <blockquote>
                    <p class="bold">Netmatters stood out from the start. Great guys and very easy to work with. Both the build and digital marketing teams are clearly skilled -they know their stuff! They delivered a website to our (high!) expectations and went over and above to ensure we were satisfied clients - and we are!</p>
                    <cite>Eleanor Bishop, Head of Marketing - <span class="bold">Ashcroft Partnership LLP</span></cite>
                </blockquote>
                <div class="review-links">
                    <a class="btn btn--google">Google Reviews<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    <a class="btn btn--trustpilot">Trustpilot Reviews<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>
        </div>
    </div>
</div>

<!-- =======================
PARTNERS SECTION
This section showcases the partners and certifications of Netmatters.
======================= -->

<section class="news" aria-labelledby="news-heading">
    <div class="container">
        <header class="services-title">
            <h2 id="news-heading">Latest News</h2>
            <a class="view-our-work">View All <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </header>
        <div class="news-grid">
            <?php if (!empty($news_items)): ?>
                <?php foreach ($news_items as $news): ?>
                    <article class="news-item">
                        <span class="tag <?php echo htmlspecialchars($news['tag_class']); ?>"><?php echo htmlspecialchars($news['tag_text']); ?></span>
                        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['image_alt']); ?>" loading="lazy">
                        <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                        <p><?php echo htmlspecialchars($news['excerpt']); ?></p>
                        <a class="btn <?php echo htmlspecialchars($news['btn_class']); ?>"><?php echo htmlspecialchars($news['btn_text']); ?></a>
                        <footer class="news-meta">
                            <img src="img/logos/NetmattersSmallLogoM.webp" alt="Netmatters logo" class="news-logo">
                            <div class="news-meta-text">
                                <strong>Posted By <?php echo htmlspecialchars($news['author']); ?></strong>
                                <time datetime="<?php echo htmlspecialchars($news['date_published']); ?>"><?php echo date('jS F Y', strtotime($news['date_published'])); ?></time>
                            </div>
                        </footer>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- =======================
CLIENTS SECTION
This section showcases the partners and certifications of Netmatters.
======================= -->            
<div class="tooltip-carousel">
<div class="carousel-viewport">
    <div class="carousel-track">
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/ashcroft_logo.png" alt="Ashcroft Partnership LLP client logo">
            <div class="tooltip">
                <h2>Ashcroft Partnership LLP</h2>
                <p>Originally founded in 2006 as Ashcroft Anthony, they became Ashcroft Partnership LLP in 2020 and are one of the top chartered accountancy firms in Cambridge, advising entrepreneurs and families.</p>
                <a href="/support" class="btn">View our Case Study</a>                </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/black_swan_logo.png" alt="Black Swan Care Group client logo">
            <div class="tooltip">
                <h2>Black Swan Care Group</h2>
                <p>Black Swan Care Group own and manage 21 high-quality care and residential homes with a focus on putting the needs of their residents first.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/busseys_logo.png" alt="Busseys client logo">
            <div class="tooltip">
                <h2>Busseys</h2>
                <p>One of the UK's leading Ford dealerships.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/crane_garden_buildings_logo.png" alt="Crane Garden Buildings client logo">
            <div class="tooltip">
                <h2>Crane Garden Buildings</h2>
                <p>Leading manufacturer and supplier of high-end garden rooms, summerhouses, workshops and sheds in the UK.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/girl_guiding_anglia_logo.png" alt="Girl Guiding Anglia client logo">
            <div class="tooltip">
                <h2>Girl Guiding Anglia</h2>
                <p>Girl Guiding Anglia is part of Girlguiding, the UK's leading charity for girls and young women in the UK.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/gdst_logo.png" alt="GDST client logo">
            <div class="tooltip">
                <h2>GDST</h2>
                <p>The Girls' Day School Trust (GDST) is the UK's leading family of 25 independent girls' schools.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/howespercivallogo.png" alt="Howes Percival client logo">
            <div class="tooltip">
                <h2>Howes Percival</h2>
                <p>Howes Percival is a leading law firm in the UK, providing a full range of legal services to businesses and individuals.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/onetravellerlogo_white_figuire.png" alt="One Traveller client logo">
            <div class="tooltip">
                <h2>One Traveller</h2>
                <p>One Traveller, founded in 2007, is a leading provider of solo holidays for over 50s.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/sweetzy_logo.png" alt="Sweetzy client logo">
            <div class="tooltip">
                <h2>Sweetzy</h2>
                <p>Sweetzy is an online retailer specializing in pick and mix sweets delivered directly to your door.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
        <div class="tooltip-wrapper">
            <img src="./img/ClientLogos/xupes_logo.png" alt="Xupes client logo">
            <div class="tooltip">
                <h2>Xupes</h2>
                <p>Xupes is a leading retailer of pre-owned luxury watches, handbags, and jewelry.</p>
                <a href="/support" class="btn">View our Case Study</a>
            </div>
        </div>
    </div>
</div>
</div>
</main>

<?php
// Include the footer
include_once 'includes/footer.php';
?>