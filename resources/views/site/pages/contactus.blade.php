<x-site-master-layout>
    <div class="page-title-area page-title-img-three">
        <div class="container">
            <div class="page-title-item">
                <h2>Contact Us</h2>
                <ul>
                    <li>
                        <a href="{{  route('site.page')  }}">Home</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="contact-location-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="location-item">
                        <img src="{{ asset('site/img/home-one/service-shape.png') }}" alt="Location">
                        <i class='bx bxs-time-five'></i>
                        <ul>
                            <li>9:00 AM to 15:00 PM</li>
                            <li>(Saturday to Thursday)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="location-item active">
                        <img src="{{ asset('site/img/home-one/service-shape.png')}}" alt="Location">
                        <i class='bx bxs-location-plus'></i>
                        <ul>
                            <li>Shakhamul,  Kathmandu, Nepal</li>
                            <li>New Baneswor, Kathmandu, Nepal</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-3 offset-lg-0 col-lg-4">
                    <div class="location-item">
                        <img src="{{asset('site/img/home-one/service-shape.png')}}" alt="Location">
                        <i class='bx bxs-phone-call'></i>
                        <ul>
                            <li>
                                <a href="tel:+11234567890">(Branch 1) +1 123 456 7890</a>
                            </li>
                            <li>
                                <a href="tel:+23256594596">(Branch 2) +92 876 543 2100</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="contact-form-area ptb-100" 
    style="background-image: url({{ asset('site/img/contact-slider.jpg')}}" alt="Contact")>
    
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-item">
                        <form id="contactForm" action="{{ route('site.contact.store') }}"  method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required
                                            data-error="Please enter your name" placeholder="Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required
                                            data-error="Please enter your email" placeholder="Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="number" id="number" required
                                            data-error="Please enter your number" class="form-control"
                                            placeholder="Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" id="subject" class="form-control" required
                                            data-error="Please enter your subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea name="usermessage" class="form-control" id="usermessage" cols="30"
                                            rows="6" required data-error="Write your message"
                                            placeholder="Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <button type="submit" class="cmn-btn btn">
                                        Send Message
                                    </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                        <div class="contact-social">
                            <span>Follow Us on</span>
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-youtube'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="contact-img">
                        {{-- <img src="{{ asset('site/img/contact-slider.jpg')}}" alt="Contact"> --}}
                    </div>
                </div> 
            </div>
        </div>
    </div>




</x-site-master-layout>