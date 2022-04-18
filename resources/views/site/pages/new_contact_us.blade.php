<x-new-site-master-layout>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Contact
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="row align-items-end mb-50 help-section">
                            <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                                <h4 class="mb-20 text-brand contact-heading">How can help you ?</h4>
                                <h1 class="mb-30">Let us know how we can help you</h1>

                            </div>

                        </section>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section class="mb-50">
                            <div class="row mb-60">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <h4 class="mb-15 text-brand">Office</h4>
                                    <br>
                                    {!! $setting->address !!}
                                    <abbr title="Phone">Phone:</abbr> {{ $setting->company_phone }}<br>
                                    <abbr title="Email">Email: </abbr><a href="/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        data-cfemail="2a4945445e4b495e6a6f5c4b584b04494547">{{ $setting->company_email }}</a><br>
                                    <a
                                        class="btn btn-sm map-btn font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i
                                            class="fi-rs-marker mr-5"></i>View map</a>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="contact-from-area padding-20-row-col">
                                        <h5 class="text-brand mb-10">Contact form</h5>
                                        <h2 class="mb-10">Drop Us a Line</h2>
                                        <p class="text-muted mb-30 font-sm">Your email address will not be published.
                                            Required fields are marked *</p>
                                        <form id="contactForm" action="{{ route('site.contact.store') }}"
                                            method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input type="text" name="name" id="name" class="form-control"
                                                            required data-error="Please enter your name"
                                                            placeholder="Name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" required
                                                            data-error="Please enter your email" placeholder="Email">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input type="text" name="number" id="number" required
                                                            data-error="Please enter your number" class="form-control"
                                                            placeholder="Phone">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="input-style mb-20">
                                                        <input type="text" name="subject" id="subject"
                                                            class="form-control" required
                                                            data-error="Please enter your subject"
                                                            placeholder="Subject">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="textarea-style mb-30">

                                                        <textarea name="usermessage" class="form-control" id="usermessage" required data-error="Write your message"
                                                            placeholder="Message"></textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <button id="msgSubmit" class="submit submit-auto-width"
                                                        type="submit">Send
                                                        message</button>
                                                </div>


                                            </div>
                                        </form>

                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 pl-50 d-lg-block d-none">
                                    <img class="border-radius-15 mt-50" src="assets\imgs\page\contact-2.png" alt="">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-new-site-master-layout>
