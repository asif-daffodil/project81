<footer class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start">
                <div class="information">
                    <h6 class="footer-heading text-uppercase text-white fw-bold">Information</h6>
                    <ul class="list-unstyled footer-link mt-4">
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Events</a></li>
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Our Team</a></li>
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Upcoming Sale</a></li>
                        <li class=""><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">New Launches</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-3 text-center text-sm-start">
                <div class="resources">
                    <h6 class="footer-heading text-uppercase text-white fw-bold">Resources</h6>
                    <ul class="list-unstyled footer-link mt-4">
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">API</a></li>
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Website Tutorials</a></li>
                        <li class="mb-1"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Third Party</a></li>
                        <li class=""><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white text-decoration-none fw-semibold">Video Lectures</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-4 col-lg-2 text-center text-sm-start">
              <div class="social">
                  <h6 class="footer-heading text-uppercase text-white fw-bold">Social</h6>
                  <ul class="list-inline my-4">
                    <li class="list-inline-item"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white btn-sm btn btn-primary mb-2"><i class="bi bi-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-danger btn-sm btn btn-light mb-2"><i class="bi bi-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white btn-sm btn btn-primary mb-2"><i class="bi bi-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://codepen.io/Gaurav-Rana-the-reactor" class="text-white btn-sm btn btn-success mb-2"><i class="bi bi-whatsapp"></i></a></li>
                </ul>
              </div>
          </div>
            <div class="col-sm-6 col-md-6 mt-4 col-lg-4 text-center text-sm-start">
              <div class="contact">
                  <h6 class="footer-heading text-uppercase text-white fw-bold">Contact Us</h6>
                  <address class="mt-4 m-0 text-white mb-1"><i class="bi bi-pin-map fw-semibold"></i> New South Block , Phase 8B , 160055</address>
                  <a href="tel:+" class="text-white mb-1 text-decoration-none d-block fw-semibold"><i class="bi bi-telephone"></i>  909090XXXX</a>
                  <a href="mailto:" class="text-white mb-1 text-decoration-none d-block fw-semibold"><i class="bi bi-envelope"></i> xyzdemomail@gmail.com</a>
                  <a href="" class="text-white text-decoration-none fw-semibold"><i class="bi bi-skype"></i> xyzdemomail</a>
              </div>
            </div>
        </div>
    </div>
    <div class="text-center bg-dark text-white mt-4 p-1">
        <p class="mb-0 fw-bold">2023 © Gaurav Rana, All Rights Reserved</p>
    </div>
  </footer>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./node_modules/wow.js/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        const updateShortCart = () => {
            if(Cookies.get('cart')){
                const cart = JSON.parse(Cookies.get('cart'));
                let total = 0;
                for (const key in cart) {
                    total += cart[key];
                }
                $('#shortCart').text(total);
            }
        }
        updateShortCart();
        let myCart = {};
        $('.addToCart').click(function() {
            const id = $(this).data('id');
            if (Cookies.get('cart')) {
                myCart = JSON.parse(Cookies.get('cart'));
            }
            if (myCart[id]) {
                myCart[id] = myCart[id] + 1;
            } else {
                myCart[id] = 1;
            }
            Cookies.set('cart', JSON.stringify(myCart));
            updateShortCart();
            toastr.success('Product Added to Cart');
        })
    })
</script>
</body>

</html>