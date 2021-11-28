<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../../css/home.css">
</head>
<body>
    <!-- Begin page one-->
    @section('header')
        <header>
            <a href="/" class="logo"><img src="../image/logo.jpg" alt=""></a>
            <ul>    
                @if (isset($data))
                    <li><a href="#">{{$data}}</a></li>
                    <li><a href="/admin" class="signup">Admin ></a></li>
                @else  
                    <li><a href="/entercode">Enter code</a></li>
                    <li><a href="/users/login" class="signup">Sign in ></a></li>
                @endif
            </ul>
        </header>
    @endsection

    @section('content')
        <div class="content">
            <div class="textBox">
                <h2>It's not just Question<br>It's <span>Feature</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, accusantium obcaecati repellendus porro ipsa unde. Atque blanditiis ipsum ea neque excepturi corporis.</p>
                <a href="#" class="a-black">Learn more</a><br>
                <a href="#">Get started ></a>
                <a href="#">Login ></a>
            </div>
            <div class="imgBox">
                <img src="../image/bg1.png" alt="#">
            </div>
        </div>
    @endsection

    @section('sci')
        <ul class="sci">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-tiktok"></i></a></li>
        </ul>
    @endsection
    <!-- End page one-->

    <!-- Begin page two-->
    @section('customer-say')
        <div class="header-text">
            <p>Loved by educators in over 50% of U.S. schools and 150 countries.</p>
            <p class="header-text-small">Here’s what they have to say...</p>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 5; $i++)
                    <div class="swiper-slide">
                        <div class="testimanialBox">
                            <img src="../image/right-quote.png" class="quote">
                            <div class="customer-say-content">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus, a optio possimus dicta suscipit dolore fugit aliquam inventore nam reprehenderit dignissimos molestiae temporibus ab. Ab harum accusantium enim. Veniam, vero?</p>
                                <div class="customer-say-details">
                                    <div class="customer-say-imgBx">
                                        <img src="https://i.pinimg.com/736x/4e/fe/9d/4efe9d5c92903a957dbbbb8e845c0bdd.jpg" alt="">
                                    </div>
                                    <h3>Someone Famous<br><span>Creative Designer</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
          </div>
    @endsection
    <!-- End page two-->

    <!-- Begin page three-->
    @section('product-demo-header')
        <div class="header-text">
            <p>They engage from any device.<br>You get instant feedback.</p>
            <p class="header-text-small">Participants see questions on their own devices and you get great data—no grading required.</p>
        </div>
        <div class="header-btn">
            <a href="#">Try it for free ></a>
        </div>
    @endsection

    @section('product-demo-video')
        <div class="product-demo-video-wrapper">
            <video autoplay='autoplay' muted='muted' playsinline="playsinline" loop="loop" src="../video/3-PRODUCT_IN_ACTION_1.mp4" poster="../image/3-PRODUCT_IN_ACTION-First_Frame.png"></video>
        </div>
    @endsection

    @section('product-demo-text-bottom')
        <div class="header-text">
            <p class="header-text-small">Participants see questions on their own devices and you get great data—no grading required.</p>
        </div>
    @endsection
    <!-- End page three-->

    <!-- Begin page four-->
    @section('review-three-tab-1')
        <div class="three-tab-content-left">
            <h3 id="tab-content-left-title">Gamified quizzes, polls, and lessons</h3>
            <ul>
                <li id="tab-content-left-l1">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
                <li  id="tab-content-left-l2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed porro recusandae doloremque.</li>
                <li  id="tab-content-left-l3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed porro.</li>
            </ul>
            <a href="#">Create your own ></a>
        </div>
        <div class="three-tab-content-right">
            <img src="../image/4-PRODUCT_OVERVIEW-1.jpg" alt="#" aria-hidden="true"  id="tab-content-left-img">
        </div>
    @endsection

    @section('review-three-tab')
        <div class="header-text">
            <p>Everything you need for mastery and engagement</p>
            <p class="header-text-small">Introduce concepts, check for understanding, get instant insights, and more.</p>
        </div>
        <div class="three-tab">
            <ul>
                <li onclick="changeThreeTabReview(event, 0)">
                    <div class="tab-content">
                        <i class="fas fa-chalkboard-teacher fa-2x tab-icon tab-content-i review-three-tab-active"></i>
                        <p class="tab-content-p review-three-tab-active">Live Engagement</p>
                    </div>
                </li>
                <li onclick="changeThreeTabReview(event, 1)">
                    <div class="tab-content">
                        <i class="fas fa-clock fa-2x tab-icon tab-content-i"></i>
                        <p class="tab-content-p">Asynchronous Learning</p>
                    </div>
                </li>
                <li onclick="changeThreeTabReview(event, 2)">
                    <div class="tab-content">
                        <i class="fas fa-chart-bar fa-3x tab-icon tab-content-i"></i>                
                        <p class="tab-content-p">Insights and Reporting</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="three-tab-content" id="three-tab-content">
            @yield('review-three-tab-1')
        </div>
    @endsection
    <!-- End page four-->

    <!-- Begin page five-->
    @section('ready-for-use')
        <div class="header-text">
            <p>Ready for meaningful engagement?</p>
        </div>
        <a href="#">Get started ></a>
    @endsection
    <!-- End page five-->

    <!-- Begin page six-->
    @section('getting-started')
        <div class="header-text">
            <p>Getting started is free and easy</p>
        </div>
        <div class="getting-started-content">
            <ul>
                <li>
                    <div class="step-item-num">1</div>
                    <div class="step-item-title">Add question and poll questions</div>
                    <div class="step-item-image">
                        <img src="../image/6-GETTING_STARTED-1.png" alt="">
                    </div>
                </li>
                <li>
                    <div class="step-item-num">2</div>
                    <div class="step-item-title">Participants engage from any device.</div>
                    <div class="step-item-image">
                        <img src="../image/6-GETTING_STARTED-2.png" alt="">
                    </div>
                </li>
                <li>
                    <div class="step-item-num">3</div>
                    <div class="step-item-title">Get instant<br>feedback.</div>
                    <div class="step-item-image">
                        <img src="../image/6-GETTING_STARTED-3.png" alt="">
                    </div>
                </li>
            </ul>
        </div>
    @endsection
    <!-- End page six-->

    <section class="d-flex">
        @yield('header')
        @yield('content')
        @yield('sci')
    </section>

    <section class="p-0">
        @yield('customer-say')
    </section>

    <section class="product-demo">
        @yield('product-demo-header')
        @yield('product-demo-video')
        @yield('product-demo-text-bottom')
    </section>

    <section class="review-three-tab">
        @yield('review-three-tab')
    </section>

    <section class="ready-for-use">
        @yield('ready-for-use')
    </section>

    <section class="getting-started-container">
        @yield('getting-started')
    </section>

    @include('foot')
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2,
            slideShadows: true,
          },
          loop: true
        });
    </script>
    <script>
        var title = ['Gamified quizzes, polls, and lessons', 'Learn anytime and anywhere', 'Instantly know what’s working and what isn’t'];
        var l1 = ['Choose between presenter-led and self-paced live learning experiences.', 'Set a deadline so your students can learn on their own time or create an evergreen link.', 'Instantly identify problem areas by participant, class, question, and more.']
        var l2 = ['Use friendly competition, replays, powerups, and more to keep every student engaged in mastery.', 'Share via messaging tools, email, or your LMS. Participants join from any device.', 'All reports are saved and can be accessed at any time.']
        var l3 = ['Remote friendly—no need for participants to juggle tabs. They see questions on their own device.', 'Retakes, flashcards and other tools enable independent study and promote mastery.', 'Share and export results.']
        var img = ['4-PRODUCT_OVERVIEW-1.jpg', '4-PRODUCT_OVERVIEW-2.jpg', '4-PRODUCT_OVERVIEW-3.jpg']

        function changeThreeTabReview(evt, number){
            document.getElementById('tab-content-left-title').innerHTML = title[number];
            document.getElementById('tab-content-left-l1').innerHTML = l1[number];
            document.getElementById('tab-content-left-l2').innerHTML = l2[number];
            document.getElementById('tab-content-left-l3').innerHTML = l3[number];
            document.getElementById('tab-content-left-img').src = '../image/'+img[number];
            
            var tablinks = document.getElementsByClassName("tab-content-p");
            console.log(tablinks);
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" review-three-tab-active", "");
            }
            tablinks[number].className += " review-three-tab-active";

            var tablinksI = document.getElementsByClassName("tab-content-i");
            console.log(tablinksI);
            for (i = 0; i < tablinksI.length; i++) {
                tablinksI[i].className = tablinksI[i].className.replace(" review-three-tab-active", "");
            }
            tablinksI[number].className += " review-three-tab-active";
        }
    </script>
</body>
</html>