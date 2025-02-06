<?php
  session_start();
?>

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
    <link rel="stylesheet" href="css/homestyle.css">

</head>

<body class="font-custom">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-green">
            <div class="container">
                <a class="navbar-brand me-5" class="delicato-mask"> <img src="images/DelicatoMask.svg" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-0 mb-lg-0">
                        <li class="nav-item me-5">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>

                        <li class="nav-item me-5">
                            <a class="nav-link" href="tienda.php">Tienda</a>
                        </li>

                        <li class="nav-item me-5">
                            <a class="nav-link" href="nosotros.php">Nosotros</a>
                        </li>
                    </ul>

                    <div class="navbar-nav d-flex">
                        <li class="nav-item me-5">
                            <a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" class="nav-link">Acceder</a>
                        </li>

                        <li class="nav-item me-5">
                            <a class="nav-link active" href="carrito.php">Mi Carrito <span
                                    class="position-absolute top-5 start-98 translate-middle badge rounded-pill bg-transparent"
                                    id="badgeProduct"></span></a>
                        </li>
                    </div>
                </div>
        </nav>
    </header>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php if (isset($_SESSION['showAlert'])) {
        echo $_SESSION['showAlert'];
            } else {
        echo 'none';
              } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
            } unset($_SESSION['showAlert']); ?></strong>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center m-0 mt-4">Los productos del Carrito</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-1"
                                        onclick="return confirm('Are you sure want to clear your cart?');"><i
                                            class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                require 'database.php';
                $stmt = $conn->prepare('SELECT * FROM cart');
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                                <td><?= $row['product_name'] ?></td>
                                <td>
                                    <i
                                        class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                                </td>
                                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                <td>
                                    <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>"
                                        style="width:75px;">
                                </td>
                                <td><i
                                        class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?>
                                </td>
                                <td>
                                    <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead"
                                        onclick="return confirm('Are you sure want to remove this item?');"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $grand_total += $row['total_price']; ?>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="3">
                                    <a href="tienda.php" class="btn btn-custom-green"><i
                                            class="fas fa-cart-plus"></i>&nbsp;&nbsp;Seguir Comprando</a>
                                </td>
                                <td colspan="2"><b>Sub-Total</b></td>
                                <td><b>$&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                                <td>
                                    <a href="checkout.php"
                                        class="btn btn-warning <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i
                                            class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="py-6 bg-gray-custom text-white">
            <div class="container mt-5 pt-4">
                <div class="row">
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <h6 class="text-uppercase text-white mb-3">Contáctenos</h6>
                        <ul class="list-unstyled">
                            <li><a class="text-white-thin"
                                    href="https://instagram.com/delicatodr?utm_medium=copy_link">Búscanos en
                                    Instagram</a></li>
                            <li><a class=text-white-custom></a> </li>
                            <li><a class="text-white-thin"
                                    href="https://api.whatsapp.com/message/JL4EPYA3QMYIO1">Escríbenos
                                    por
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
                        <p class="mb-3">Únase a nosotros para recibir notificaciones al instante sobre nuestras ofertas
                            o
                            cualquier
                            noticia</p>
                        <form action="#" id="newsletter-form">
                            <div class="input-group mb-3">
                                <input class="form-control bg-white border-dark end-0" type="email"
                                    placeholder="Introduce tu correo electrónico" aria-label="Your Email Address">
                                <button type="button" class="btn btn-custom-green">Suscríbete</button>
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

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function () {

            // Change the item quantity
            $(".itemQty").on('change', function () {
                var $el = $(this).closest('tr');

                var pid = $el.find(".pid").val();
                var pprice = $el.find(".pprice").val();
                var qty = $el.find(".itemQty").val();
                location.reload(true);
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    cache: false,
                    data: {
                        qty: qty,
                        pid: pid,
                        pprice: pprice
                    },
                    success: function (response) {
                        console.log(response);
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