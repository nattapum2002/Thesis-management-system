<div>
    <!-- slider -->
    <section id="sliders">
        <div id="slider" class="carousel slide slider-wrapper" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slide3 min-vh-100 bg-cover d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-white text-uppercase">เทคโนโลยีคอมพิวเตอร์</h6>
                                    <h1 class="display-2 text-white my-3 text-uppercase">ยินดีต้อนรับ</h1>
                                    <a class="btn btn-brand" href="{{ route('login.member') }}">เข้าสู่ระบบ</a>
                                    <a class="btn btn-outline-light ms-md-3"
                                        href="{{ route('register') }}">สมัครสมาชิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide2 min-vh-100 bg-cover d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h6 class="text-white text-uppercase">เทคโนโลยีคอมพิวเตอร์</h6>
                                    <h1 class="display-2 text-white my-3 text-uppercase">ยินดีต้อนรับ</h1>
                                    <a class="btn btn-brand" href="{{ route('login.member') }}">เข้าสู่ระบบ</a>
                                    <a class="btn btn-outline-light ms-md-3"
                                        href="{{ route('register') }}">สมัครสมาชิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide1 min-vh-100 bg-cover d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-white text-uppercase">เทคโนโลยีคอมพิวเตอร์</h6>
                                    <h1 class="display-2 text-white my-3 text-uppercase">ยินดีต้อนรับ</h1>
                                    <a class="btn btn-brand" href="{{ route('login.member') }}">เข้าสู่ระบบ</a>
                                    <a class="btn btn-outline-light ms-md-3"
                                        href="{{ route('register') }}">สมัครสมาชิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end slider -->

    <!-- about -->
    <section id="about">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-12 about-info">
                            <i class='bx bx-news'></i>
                            <div>
                                <h3>ข่าวสาร</h3>
                                <p>รู้ข่าวสารและความเคลื่อนไหวได้ทุกเวลา</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 about-info mt-4">
                            <i class='bx bxs-edit-location'></i>
                            <div>
                                <h3>ยืดหยุ่นครบจบในที่เดียว</h3>
                                <p>ตอบโจทย์ทุกข้อมูลและใช้งานได้ทุกที่</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 about-info mt-4">
                            <i class='bx bx-timer'></i>
                            <div>
                                <h3>เร็วกว่า</h3>
                                <p>เหมาะสมและประหยัดเวลากว่าเมื่อเทียบกับระบบเดิม</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-12 about-img">
                            <img
                                src="https://fastly.picsum.photos/id/7/4728/3168.jpg?hmac=c5B5tfYFM9blHHMhuu4UKmhnbZoJqrzNOP9xjkV4w3o">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about -->

    <!-- milestone -->
    <section id="milestone" class="bg-cover">
        <div class="container">
            <div class="row gy-4 text-center justify-content-center">
                <div class="col-lg-2 col-sm-6 item">
                    <div class="display-4">{{ $projects->count() }}</div>
                    <p class="mb-0">โปรเจคทั้งหมด</p>
                </div>
                <div class="col-lg-2 col-sm-6 item">
                    <div class="display-4">{{ $members->count() }}</div>
                    <p class="mb-0">ผู้เข้าใช้งานทั้งหมด</p>
                </div>
                <div class="col-lg-2 col-sm-6 item">
                    <div class="display-4">24 / 7</div>
                    <p class="mb-0">การให้บริการ</p>
                </div>
                <div class="col-lg-2 col-sm-6 item">
                    <div class="display-4">4.5/5</div>
                    <p class="mb-0">ความพึงพอใจ</p>
                </div>
            </div>
    </section>
    <!-- end milestone -->

    <!-- team -->
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12 intro text-center">
                    <h6>สมาชิกกลุ่มเรา</h6>
                    <h1>พบกับสมาชิกผู้พัฒนา</h1>
                    <p>สมาชิกที่ช่วยพัฒนาระบบจัดการปริญญานิพนธ์ สาขาเทคโนโลยีคอมพิวเตอร์</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="img-wrapper">
                            <img src="{{ asset('Asset/main/img/team-member/member-1.jpg') }}" alt="member-1">
                            <div class="overlay"></div>
                            <div class="social-links">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-linkedin'></i></a>
                            </div>
                        </div>
                        <div>
                            <h3>นายณัฐภูมิ ขำศรี</h3>
                            <p>นักศึกษาปี 4 วิทยาการคอมพิวเตอร์</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="img-wrapper">
                            <img src="{{ asset('Asset/main/img/team-member/member-2.jpg') }}" alt="member-1">
                            <div class="overlay"></div>
                            <div class="social-links">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-linkedin'></i></a>
                            </div>
                        </div>
                        <div>
                            <h3>นายสุภชัย ทองนับ</h3>
                            <p>นักศึกษาปี 4 วิทยาการคอมพิวเตอร์</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <div class="img-wrapper">
                            <img src="{{ asset('Asset/main/img/team-member/member-3.jpg') }}" alt="member-1">
                            <div class="overlay"></div>
                            <div class="social-links">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-linkedin'></i></a>
                            </div>
                        </div>
                        <div>
                            <h3>นายอภิเทพ เอียมสะอาด</h3>
                            <p>นักศึกษาปี 4 วิทยาการคอมพิวเตอร์</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end team -->
</div>
