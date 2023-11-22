<footer class="text-center text-lg-start bg-black text-white">
    {{-- <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
    </section> --}}
    <section class="p-2">
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>TRUE CAR
            </h6>
            <p>
              Mong muốn lớn nhất của chúng tôi là mang lại những giá trị lớn lao nhất có thể
            </p>
          </div>
          <div class="col-md-8 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i>Địa chỉ: Phường Hưng Phú, Quận Cái Răng, Thành phố Cần Thơ</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              truecar@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> 18000000</p>
          </div>
        </div>
      </div>
    </section>
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 TrueCar
    </div>
</footer>
<!-- Contact Buttons -->
<div class="contact-buttons d-flex d-md-block flex-row-reverse">
  <a href="{{ "https://www.facebook.com/" }}" class="contact-button" target="_blank" aria-label="facebook">
      <div class="contact-button-circle"></div>
      <div class="contact-button-fill"></div>
      <div class="contact-button-image bg-white rounded-circle border border-white">
          <img src="{{ asset('images/fb-messenger.png') }}" alt="" width="30" height="30">
      </div>
  </a>
  <a href="tel:{{ "0123321123" }}" target="_blank" class="contact-button" aria-label="phone">
      <div class="contact-button-circle phone"></div>
      <div class="contact-button-fill phone"></div>
      <div class="contact-button-image bg-danger rounded-circle border border-2 border-white">
          <img src="{{ asset('images/phone.png') }}" class="d-flex justify-content-center align-items-center" alt="" width="30" height="30">
      </div>
  </a>
</div>