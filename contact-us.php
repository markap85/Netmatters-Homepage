<?php
// Include the header and sidebar
include_once 'includes/header.php';

// Include the navigation menu
include_once 'includes/navigation.php';
?>

<!-- =======================
CONTACT US PAGE CONTENT
======================= -->

<main>
    <div class="breadcrumb">
        <div class="container">
            <a href="index.php">Home</a> &gt; Our Offices
        </div>
    </div>

    <div class="title-section">
        <div class="container">
            <h1>Our Offices</h1>
        </div>
    </div>

    <div class="offices-section">
        <div class="container">
            <div class="offices-grid">
                <div class="office-item">
                    <img src="img/contactus/cambridge.jpg" alt="Office 1">
                    <div class="office-item-text">
                        <h3>Cambridge Office</h3>
                        <p>Unit 1.31,<br>St John's Innovation Centre,<br>Cowley Road, Milton,<br>Cambridge,<br>CB4 0WS</p>
                        <p>01223 37 57 72</p>
                        <button>View More</button>
                    </div>
                </div>
                <div class="office-item">
                    <img src="img/contactus/wymondham.jpg" alt="Office 2">
                        <div class="office-item-text">
                        <h3>Wymondham Office</h3>
                        <p>Unit 15,<br>Penfold Drive,<br>Gateway 11 Business Park,<br>Wymondham, Norfolk,<br>NR18 0WZ</p>
                        <p>01603 70 40 20</p>
                        <button>View More</button>
                    </div>
                </div>
                <div class="office-item">
                    <img src="img/contactus/yarmouth-2.jpg" alt="Office 3">
                        <div class="office-item-text">
                            <h3>Great Yarmouth Office</h3>
                        <p>Suite F23,<br>Beacon Innovation Centre,<br>Beacon Park, Gorleston,<br>Great Yarmouth, Norfolk,<br>NR31 7RA</p>
                        <p>01493 60 32 04</p>
                        <button>View More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-form">
                    <form>
                        <div>
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div>
                            <label for="company">Company Name</label>
                            <input type="text" id="company" name="company">
                        </div>
                        <div>
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div>
                            <label for="telephone">Your Telephone Number</label>
                            <input type="tel" id="telephone" name="telephone">
                        </div>
                        <div>
                            <label for="message">Message</label>
                            <textarea id="message" name="message"></textarea>
                        </div>
                        <div>
                            <input type="checkbox" id="marketing" name="marketing">
                            <label for="marketing">Please tick this if you want marketing</label>
                        </div>
                        <div class="form-footer">
                            <button type="submit">Send Enquiry</button>
                            <span>* Fields Required</span>
                        </div>
                    </form>
                </div>
                <div class="contact-info">
                    <h3>Email us on:</h3>
                    <p>sales@netmatters.com</p>
                    
                    <h3>Speak to Sales on:</h3>
                    <p>01603 515007</p>
                    
                    <h3>Business hours:</h3>
                    <p>Monday - Friday 07:00 - 18:00</p>
                    
                    <div class="accordion">
                        <h3>Out of Hours IT Support</h3>
                        <div class="accordion-content">
                            <p>Netmatters IT are offering an Out of Hours service for Emergency and Critical tasks.</p>
                            <p>Monday - Friday 18:00 - 22:00 Saturday 08:00 - 16:00<br>
                            Sunday 10:00 - 18:00</p>
                            <p>To log a critical task, you will need to call our main line number and select Option 2 to leave an Out of Hours voicemail. A technician will contact you on the number provided within 45 minutes of your call.</p>
                        </div>
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