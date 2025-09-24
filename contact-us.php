<?php
// Include the contact form handler
include_once 'includes/contact_form_handler.php';

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
                        <a>Cambridge Office</a>
                        <p>Unit 1.31,<br>St John's Innovation Centre,<br>Cowley Road, Milton,<br>Cambridge,<br>CB4 0WS</p>
                        <h3>01223 37 57 72</h3>
                        <a href="#" class="btn">View More</a>
                    </div>
                </div>
                <div class="office-item">
                    <img src="img/contactus/wymondham.jpg" alt="Office 2">
                        <div class="office-item-text">
                        <a>Wymondham Office</a>
                        <p>Unit 15,<br>Penfold Drive,<br>Gateway 11 Business Park,<br>Wymondham, Norfolk,<br>NR18 0WZ</p>
                        <h3>01603 70 40 20</h3>
                        <a href="#" class="btn">View More</a>
                    </div>
                </div>
                <div class="office-item">
                    <img src="img/contactus/yarmouth-2.jpg" alt="Office 3">
                        <div class="office-item-text">
                            <a class="office-name">Great Yarmouth Office</a>
                        <p>Suite F23,<br>Beacon Innovation Centre,<br>Beacon Park, Gorleston,<br>Great Yarmouth, Norfolk,<br>NR31 7RA</p>
                        <h3>01493 60 32 04</h3>
                        <a href="#" class="btn">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-form">
                    <!-- Notification Container -->
                    <div id="form-notification" class="form-notification" style="display: none;">
                        <div class="notification-content">
                            <span id="notification-message"></span>
                            <button type="button" class="notification-close" onclick="closeNotification()">&times;</button>
                        </div>
                    </div>
                    
                    <form method="POST" action="contact-us.php" novalidate>
                        <!-- Row 1: First Name and Company Name side by side -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name" class="required">Your Name</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo getFormValue('first_name'); ?>" required>
                                <?php if (hasError('first_name', $response['errors'] ?? [])): ?>
                                    <span class="error"><?php echo getError('first_name', $response['errors']); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="company">Company Name</label>
                                <input type="text" id="company" name="company" value="<?php echo getFormValue('company'); ?>">
                            </div>
                        </div>
                        
                        <!-- Row 2: Email and Phone side by side -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email" class="required">Your Email</label>
                                <input type="email" id="email" name="email" value="<?php echo getFormValue('email'); ?>" required>
                                <?php if (hasError('email', $response['errors'] ?? [])): ?>
                                    <span class="error"><?php echo getError('email', $response['errors']); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="required">Your Telephone Number</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo getFormValue('phone'); ?>">
                            </div>
                        </div>
                        
                        <!-- Message - Full Width -->
                        <div class="form-full-width">
                            <label for="message" class="required">Message</label>
                            <textarea id="message" name="message" required><?php echo getFormValue('message'); ?></textarea>
                            <?php if (hasError('message', $response['errors'] ?? [])): ?>
                                <span class="error"><?php echo getError('message', $response['errors']); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Marketing Consent - Full Width -->
                        <div class="form-full-width form-checkbox">
                            <input type="checkbox" id="marketing_consent" name="marketing_consent" <?php echo isset($_POST['marketing_consent']) ? 'checked' : ''; ?>>
                            <label for="marketing_consent">
                                Please tick this box if you wish to receive marketing information from us. 
                                Please see our <a href="#">Privacy Policy</a> for more information on how we keep your data safe.
                            </label>
                        </div>
                        
                        <!-- Form Footer - Full Width -->
                        <div class="form-full-width">
                            <div class="form-footer">
                                <button type="submit">Send Enquiry</button>
                                <span>* Fields Required</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="contact-info">
                    <p>Email us on:</p>
                    <h3>sales@netmatters.com</h3>
                    
                    <strong>Speak to Sales on:</strong>
                    <h3>01603 515007</h3>

                    <strong>Business hours:</strong><br>
                    <strong>Monday - Friday 07:00 - 18:00</strong>
                    
                    <div class="accordion">
                        <p>Out of Hours IT Support</p>
                        <div class="accordion-content">
                            <p>Netmatters IT are offering an Out of Hours service for Emergency and Critical tasks.</p>
                            <div class="hours-highlight">
                                <strong>Monday - Friday 18:00 - 22:00 Saturday<br> 08:00 - 16:00<br>
                                Sunday 10:00 - 18:00</strong>
                            </div>
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