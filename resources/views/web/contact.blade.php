@extends('layouts.web')
@section('title')
    <title>MultiShop | contact</title>
@endsection
@section('content')
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                  @include('web.alert-message')
                    <form method="POST" action="{{ route('enquiry.store') }}">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" />
                            <p class="help-block text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" />
                            <p class="help-block text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="phone" placeholder="Phone" />
                            <p class="help-block text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" name="message" placeholder="Message"></textarea>
                            <p class="help-block text-danger">
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Sardarshahar, India
                    </p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>jp@gamil.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+91 72320 26292</p>
                </div>
            </div>
        </div>
    </div>
@endsection
