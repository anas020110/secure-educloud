<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Sekolah Kebangsaan Binjai</title>
    <link rel="stylesheet" href="student_faq.css">
</head>
<body>

<!-- Video Background -->
<div class="video-container">
        <video autoplay muted loop id="bgVideo">
            <source src="bg1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="image/logo.png" alt="Logo" width="50">
        </div>
        <ul class="nav-links">
            <li><a href="student_home.php">Home</a></li>
            <li><a href="student_about.php">About Us</a></li>
            <li><a href="student_event.php">Event</a></li>
            <li><a href="student_chat.php">Chat</a></li>
            <li><a href="student_annount.php">Announcement</a></li>
            <li><a href="student_faq.php" class="active">FAQ</a></li>
            <li><a href="login.php">Log Out</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="faq-hero">
        <h1>Frequently Asked Questions</h1>
        <p>Your questions, answered.</p>
    </div>

    <!-- FAQ Section -->
    <div class="faq-container">

        <div class="faq-box">
            <button class="faq-question">How can I register my child at Sekolah Kebangsaan Binjai? <span>+</span></button>
            <div class="faq-answer">
                <p>You can register your child by visiting the school office and filling out the registration form. Required documents include a birth certificate, parents' IC, immunization record, and proof of residence. Online registration may also be available via the MOE website.</p>
            </div>
        </div>

        <div class="faq-box">
            <button class="faq-question">What are the school hours for Sekolah Kebangsaan Binjai? <span>+</span></button>
            <div class="faq-answer">
                <p>School hours are 7:30 AM – 1:30 PM (Mon–Thu) and 7:30 AM – 12:30 PM (Fri). Co-curricular activities may run from 2:30 PM – 4:30 PM on selected days.</p>
            </div>
        </div>

        <div class="faq-box">
            <button class="faq-question">What payment methods are accepted? <span>+</span></button>
            <div class="faq-answer">
                <p>We accept credit/debit cards, online banking, and e-wallet payments.</p>
            </div>
        </div>

        <div class="faq-box">
            <button class="faq-question">What facilities are available at Sekolah Kebangsaan Binjai? <span>+</span></button>
            <div class="faq-answer">
                <p>Our school features multimedia classrooms, labs, library, surau, canteen, sports field, and facilities for special needs education.</p>
            </div>
        </div>

    </div>

    <!-- FAQ Toggle Script -->
    <script>
        document.querySelectorAll(".faq-question").forEach(button => {
            button.addEventListener("click", () => {
                const answer = button.nextElementSibling;
                const isVisible = answer.style.display === "block";

                document.querySelectorAll(".faq-answer").forEach(a => a.style.display = "none");
                document.querySelectorAll(".faq-question span").forEach(s => s.textContent = "+");

                if (!isVisible) {
                    answer.style.display = "block";
                    button.querySelector("span").textContent = "-";
                }
            });
        });
    </script>

    <!-- Footer -->
    <footer>
        &copy; <?php echo date("Y"); ?> Sekolah Kebangsaan Binjai. All rights reserved.
    </footer>

</body>
</html>
