<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delicato Artesanal</title>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/templatemo.css">
  <link rel="stylesheet" href="assets/css/custom.css">

  <!-- Load fonts style after rendering the layout styles -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/tiendastyle.css">

</head>

<body class="font-custom">
  <!-- Green Nav -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-green">
      <div class="container">
        <a class="navbar-brand me-5" class="delicato-mask"> <img src="images/DelicatoMask.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-0 mb-lg-0">
            <li class="nav-item me-5">
              <a class="nav-link" href="index.php">Inicio</a>
            </li>

            <li class="nav-item me-5">
              <a class="nav-link active" aria-current="page" href="tienda.php">Tienda</a>
            </li>

            <li class="nav-item me-5">
              <a class="nav-link" href="nosotros.php">Nosotros</a>
            </li>
          </ul>

          <div class="navbar-nav d-flex">
            <li class="nav-item me-5">
              <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" class="nav-link">Acceder</a>
            </li>

            <li class="nav-item me-5">
              <a class="nav-link" href="carrito.php">Mi Carrito <span
                  class="position-absolute top-5 start-98 translate-middle badge rounded-pill bg-transparent"
                  id="badgeProduct"></span></a>
            </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- Green Nav -->

  <main>
    <!-- Displaying Products Start -->
    <div class="container">
      <div id="message"></div>
      <div class="row mt-4">
        <?php
  			include 'database.php';
  			$stmt = $conn->prepare('SELECT * FROM product');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
        <div class="col-sm-8 col-md-4 col-lg-3 mb-2">
          <div class="card-deck">
            <div class="card shadow">
              <img src="<?= $row['product_image'] ?>" class="card-img-top">
              <div class="card-body p-1">
                <h4 class="card-title text-center mt-2"><?= $row['product_name'] ?></h4>
                <p class="card-title text-center">&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?></p>

              </div>
              <div class="card-footer p-1">
                <form action="" class="form-submit">
                  <div class="row p-2">
                    <div class="col-md-6 py-1 pl-4">
                      <b>Cantidad: </b>
                    </div>
                    <div class="col-md-6">
                      <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                    </div>
                  </div>
                  <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                  <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                  <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                  <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                  <button class="btn btn-info btn-block addItemBtn btn-custom-green"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Añadir</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
    <!-- Displaying Products End -->
  </main>


  <footer>
    <div class="py-6 bg-gray-custom text-white">
      <div class="container pt-4">
        <div class="row">
          <div class="col-lg-3 mb-5 mb-lg-0">
            <h6 class="text-uppercase text-white mb-3">Contáctenos</h6>
            <ul class="list-unstyled">
              <li><a class="text-white-thin" href="https://instagram.com/delicatodr?utm_medium=copy_link">Búscanos en
                  Instagram</a></li>
              <li><a class=text-white-custom></a> </li>
              <li><a class="text-white-thin" href="https://api.whatsapp.com/message/JL4EPYA3QMYIO1">Escríbenos por
                  WhatsApp</a></li>
              <li><a class=text-white-custom></a> </li>
              <li><a class="text-white-thin">Llámanos por teléfono</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <h6 class="text-uppercase text-white mb-3">Horario</h6>
            <ul class="list-unstyled">
              <li><a>Lunes - Sábado</a></li>
              <li>
                <p>8:00 am - 5:00 pm</p>
              </li>
              <li>
                <p></p>
              </li>
              <li><a>Domingo</a></li>
              <li>
                <p>Cerrado</p>
              </li>
            </ul>
          </div>

          <div class="col-lg-4">
            <h6 class="text-uppercase text-white mb-3">Suscríbete</h6>
            <p class="mb-3">Únase a nosotros para recibir notificaciones al instante sobre nuestras ofertas o cualquier
              noticia</p>
            <form action="#" id="newsletter-form">
              <div class="input-group mb-3">
                <input class="form-control bg-white border-dark end-0" type="email"
                  placeholder="Introduce tu correo electrónico" aria-label="Your Email Address"> <button type="button"
                  class="btn btn-custom-green">Suscríbete</button>
              </div>
            </form>
          </div>

          <div class="footer-bar">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="copyright">
                    <br>
                    <br>
                    <p>© 2021 UAA, All Rights Reserved. Design by Eric Lorenzo A.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Javascript, Pooper.js & Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
  </script>

  <script src="admin/js/delicato.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function () {

      // Send product details in the server
      $(".addItemBtn").click(function (e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pimage = $form.find(".pimage").val();
        var pcode = $form.find(".pcode").val();

        var pqty = $form.find(".pqty").val();

        $.ajax({
          url: 'action.php',
          method: 'post',
          data: {
            pid: pid,
            pname: pname,
            pprice: pprice,
            pqty: pqty,
            pimage: pimage,
            pcode: pcode
          },
          success: function (response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
            load_cart_item_number();
          }
        });
      });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function (response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>