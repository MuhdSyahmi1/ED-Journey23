<x-layout title="EduJourney - Home">
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --accent-color: #ea4335;
            --warning-color: #fbbc04;
            --purple-color: #9c27b0;
            --blue-color: #5DADE2; /* New blue color from your image */
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #5DADE2 0%, #3498DB 100%); /* Changed to blue gradient */
            color: white;
            padding: 100px 0;
            text-align: center;
            margin-top: -80px;
            padding-top: 180px;
        }

        /* School Section */
        .school-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .school-card {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            height: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .school-card:hover {
            transform: translateY(-10px);
        }

        .school-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
        }

        .school-card.business::before { background: var(--secondary-color); }
        .school-card.health::before { background: var(--accent-color); }
        .school-card.ict::before { background: var(--blue-color); } /* Changed from purple to blue */
        .school-card.engineering::before { background: var(--primary-color); }
        .school-card.petrochemical::before { background: var(--warning-color); }

        .school-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .school-icon.business { color: var(--secondary-color); }
        .school-icon.health { color: var(--accent-color); }
        .school-icon.ict { color: var(--blue-color); } /* Changed from purple to blue */
        .school-icon.engineering { color: var(--primary-color); }
        .school-icon.petrochemical { color: var(--warning-color); }

        .carousel-control-prev, .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        /* News Section */
        .news-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #E8F4FD 0%, #D6EAF8 100%); /* Changed to light blue gradient that complements footer */
        }

        .news-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 300px;
            position: relative;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 30px 20px 20px;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 50px 0 30px;
        }

        .footer h5 {
            color: #5DADE2; /* Changed footer accent color to match the blue theme */
            margin-bottom: 20px;
        }

        .footer a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #5DADE2; /* Changed hover color to blue */
        }
    </style>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Welcome to EduJourney!</h1>
            <p class="lead mb-4">Your guide to choosing the right course at Polytechnic Brunei</p>
            <a href="#schools" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Schools Section -->
    <section id="schools" class="school-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 mb-3">Our Schools</h2>
                <p class="lead">Choose a school to explore available programmes</p>
            </div>

            <div id="schoolCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- School of Business -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="school-card business text-center">
                                    <div class="school-icon business">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <h3 class="mb-3">School of Business</h3>
                                    <p class="mb-4">The programme prepares students with the knowledge and practical skills needed for success in the business world. Offering programs in areas such as accounting, finance, marketing, and entrepreneurship.</p>
                                    <div class="text-start">
                                        <strong>Programs Available:</strong>
                                        <ul class="mt-2">
                                            <li>Business Accounting & Finance</li>
                                            <li>Hospitality Management & Operations</li>
                                            <li>Human Capital Management</li>
                                            <li>Entrepreneurship & Marketing Strategies</li>
                                        </ul>
                                    </div>
                                    <span class="badge bg-success">4 Programmes Available</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School of Health Sciences -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="school-card health text-center">
                                    <div class="school-icon health">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <h3 class="mb-3">School of Health Sciences</h3>
                                    <p class="mb-4">Dedicated to training the next generation of healthcare professionals with comprehensive programs that combine theoretical knowledge with practical clinical experience.</p>
                                    <div class="text-start">
                                        <strong>Programs Available:</strong>
                                        <ul class="mt-2">
                                            <li>Midwifery</li>
                                            <li>Cardiovascular Technology</li>
                                            <li>Paramedic</li>
                                            <li>Nursing</li>
                                            <li>Public Health</li>
                                            <li>Dental Hygiene & Therapy</li>
                                        </ul>
                                    </div>
                                    <span class="badge bg-danger">6 Programmes Available</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School of ICT -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="school-card ict text-center">
                                    <div class="school-icon ict">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <h3 class="mb-3">School of Information & Communication Technology</h3>
                                    <p class="mb-4">Preparing students for the digital future with cutting-edge technology programs that focus on practical skills and industry-relevant knowledge.</p>
                                    <div class="text-start">
                                        <strong>Programs Available:</strong>
                                        <ul class="mt-2">
                                            <li>Application Development</li>
                                            <li>Web Technology</li>
                                            <li>Digital Arts & Media</li>
                                            <li>Cloud Networking</li>
                                            <li>Data Analytics</li>
                                        </ul>
                                    </div>
                                    <span class="badge" style="background-color: #5DADE2; color: white;">5 Programmes Available</span> <!-- Changed badge color -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School of Science & Engineering -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="school-card engineering text-center">
                                    <div class="school-icon engineering">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <h3 class="mb-3">School of Science & Engineering</h3>
                                    <p class="mb-4">Building tomorrow's innovators through comprehensive engineering and science programs that emphasize hands-on learning and problem-solving skills.</p>
                                    <div class="text-start">
                                        <strong>Programs Available:</strong>
                                        <ul class="mt-2">
                                            <li>Architecture & Interior Design</li>
                                            <li>Civil Engineering</li>
                                            <li>Electrical Engineering</li>
                                            <li>Mechanical Engineering</li>
                                            <li>Electronic & Communication Engineering</li>
                                        </ul>
                                    </div>
                                    <span class="badge bg-primary">5 Programmes Available</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School of Petrochemical -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="school-card petrochemical text-center">
                                    <div class="school-icon petrochemical">
                                        <i class="fas fa-industry"></i>
                                    </div>
                                    <h3 class="mb-3">School of Process & Chemical</h3>
                                    <p class="mb-4">Specialized programs focusing on chemical processes and applied scientific principles, preparing students for careers in the petrochemical and process industries.</p>
                                    <div class="text-start">
                                        <strong>Programs Available:</strong>
                                        <ul class="mt-2">
                                            <li>Applied Science Technology</li>
                                            <li>Chemical Process Engineering</li>
                                            <li>Process Safety Management</li>
                                            <li>Industrial Chemistry</li>
                                        </ul>
                                    </div>
                                    <span class="badge bg-warning">4 Programmes Available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#schoolCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#schoolCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section id="news" class="news-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 mb-3">News & Events</h2>
                <p class="lead">Stay updated with the latest happenings at our institution</p>
            </div>

            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/bmc.png" alt="BMC hosts PB">
                                    <div class="news-overlay">
                                        <h5>Brunei Methanol meets Politeknik Brunei</h5>
                                        <p class="mb-0">Students were welcomed by Brunei Methanol Company for educational visit</p>
                                        <small>23/07/2025</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/iip.png" alt="International Internship Programme">
                                    <div class="news-overlay">
                                        <h5>Bon voyage our dear students!</h5>
                                        <p class="mb-0">Polikteknik Brunei wishes the best of luck to 3 Students on their journey for International Internship Programme</p>
                                        <small>28/07/2025</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/khatam.png" alt="Politeknik Brunei Khatam Al-Quran">
                                    <div class="news-overlay">
                                        <h5>Politeknik Brunei Khatam Al-Quran ceremony</h5>
                                        <p class="mb-0">Ceremony was held for Politeknik Brunei Intake 14 students, held on Jame' Asr Hassanil Bolkiah, Kampong Kiarong</p>
                                        <small>15/03/2025</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/studentcouncil.png" alt="student council">
                                    <div class="news-overlay">
                                        <h5>Student Representative Council Handover Ceremony</h5>
                                        <p class="mb-0">The signing ceremony was graced by the presence of the Guest of Honour, 
                                            Rahima binti Haji Mohiddin, Acting Assistant Director, who officially witnessed the handover</p>
                                        <small>25/09/2024</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/thermal.png" alt="Diploma in Thermal Power Plant Technology">
                                    <div class="news-overlay">
                                        <h5>Well Done to the students of Diploma in Thermal Power Plant Technology</h5>
                                        <p class="mb-0">They did well in the presentation, and wish them all the best in completing the IBL</p>
                                        <small>12/06/2025</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="news-card">
                                    <img src="images/hengyi.png" alt="Open Day">
                                    <div class="news-overlay">
                                        <h5>Bound for China!</h5>
                                        <p class="mb-0">Politeknik Brunei's Diploma in Chemical Engineering students are ready to take on an incredible learning experience!</p>
                                        <small>25/02/2025</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Welcome to EduJourney, your guide to choosing the right course at Polytechnic Brunei. Our platform provides personalized course recommendations based on your O Level, A Level or HND/Tec results, as well as your interests and career goals.</p>
                    <p>Explore programs in business, engineering, IT, healthcare and sciences, with up-to-date information to help you make informed decisions. Let us help you take the next step toward a successful future at Polytechnic Brunei!</p>
                </div>
                <div class="col-md-4">
                    <h5>Schools</h5>
                    <ul class="list-unstyled">
                        <li><a href="#schools">School of Business (SBS)</a></li>
                        <li><a href="#schools">School of Information and Communication Technology (SICT)</a></li>
                        <li><a href="#schools">School of Health Sciences (SHS)</a></li>
                        <li><a href="#schools">School of Science and Engineering (SSE)</a></li>
                        <li><a href="#schools">School of Petrochemical (SPC)</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p><i class="fas fa-phone me-2"></i> +673 1234567</p>
                    <p><i class="fas fa-envelope me-2"></i> edujourney@gmail.com</p>
                    <div class="mt-3">
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2024 EduJourney - Polytechnic Brunei. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Auto-advance carousels
        setInterval(() => {
            const schoolCarousel = new bootstrap.Carousel(document.getElementById('schoolCarousel'));
            schoolCarousel.next();
        }, 8000);

        setInterval(() => {
            const newsCarousel = new bootstrap.Carousel(document.getElementById('newsCarousel'));
            newsCarousel.next();
        }, 6000);
    </script>
</x-layout>