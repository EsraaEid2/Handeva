<!--== Bazaar Section Start ==-->
<section id="bazaar-area">
    <div class="handeva-container">
        <div class="bazaar-section-wrapper">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2>Upcoming Bazaar</h2>
                        <p>Stay Tuned!</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 m-auto text-center">
                    <div class="bazaar-details-wrapper">
                        <p class="bazaar-message">
                            We are excited to announce our first bazaar! Mark your calendar and join us for an amazing
                            experience!
                        </p>
                        <h3 class="bazaar-date">Date: 30-03-2025</h3>

                        <!-- Countdown Timer -->
                        <div id="bazaar-countdown" class="countdown-timer">
                            <div class="countdown-item">
                                <span id="days">00</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown-item">
                                <span id="hours">00</span>
                                <p>Hours</p>
                            </div>
                            <div class="countdown-item">
                                <span id="minutes">00</span>
                                <p>Minutes</p>
                            </div>
                            <div class="countdown-item">
                                <span id="seconds">00</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <!-- Countdown Timer End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== Bazaar Section End ==-->


<script>
// Countdown Timer Logic
const countdownDate = new Date("March 30, 2025 00:00:00").getTime();

const countdownInterval = setInterval(() => {
    const now = new Date().getTime();
    const distance = countdownDate - now;

    // Calculate time
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display countdown
    document.getElementById("days").textContent = days;
    document.getElementById("hours").textContent = hours;
    document.getElementById("minutes").textContent = minutes;
    document.getElementById("seconds").textContent = seconds;

    // If countdown is over
    if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById("bazaar-countdown").innerHTML = "<p>The bazaar has started!</p>";
    }
}, 1000);
</script>