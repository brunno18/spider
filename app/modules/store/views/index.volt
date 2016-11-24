<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="{{baseurl}}css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="{{baseurl}}css/slider.css" rel="stylesheet" type="text/css" media="all"/>
        {#<link href="css/cadastro.css" rel="stylesheet" type="text/css" media="all"/>#}
        <script type="text/javascript" src="{{baseurl}}js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="{{baseurl}}js/move-top.js"></script>
        <script type="text/javascript" src="{{baseurl}}js/easing.js"></script>
        <script type="text/javascript" src="{{baseurl}}js/startstop-slider.js"></script>
        <title>Spider</title>
    </head>
    <body>
        <div class="wrap">
            <div class="header">
                <div class="headertop_desc">
                    <div class="call">
                        <p><span>Precisa de ajuda?</span> ligue <span class="number">+55 84 1234-5678</span></p>
                    </div>
                    <div class="account_desc">
                        <ul>
                            <li><a href="{{ baseurl }}store/cadastro">Registrar</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Minha conta</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="header_top">
                    <div class="logo">
                        <a href="index.html"><img src="images/logo.png" alt="" /></a>
                    </div>
                    <div class="cart">
                        <p>Bem vindo a nossa loja online! <span>Carrinho:</span><div id="dd" class="wrapper-dropdown-2"> 0 item(s) - $0.00
                            <ul class="dropdown">
                                <li>Você não tem itens no seu carrinho!</li>
                            </ul></div></p>
                    </div>
                    <script type="text/javascript">
                        function DropDown(el) {
                            this.dd = el;
                            this.initEvents();
                        }
                        DropDown.prototype = {
                            initEvents : function() {
                                var obj = this;

                                obj.dd.on('click', function(event){
                                    $(this).toggleClass('active');
                                    event.stopPropagation();
                                });
                            }
                        }

                        $(function() {

                            var dd = new DropDown( $('#dd') );

                            $(document).click(function() {
                                // all dropdowns
                                $('.wrapper-dropdown-2').removeClass('active');
                            });

                        });

                    </script>
                    <div class="clear"></div>
                </div>
                <div class="header_bottom">
                    <div class="menu">
                        <ul>
                            <li class="active"><a href="index.html">Inicio</a></li>
                            <li><a href="about.html">Sobre</a></li>
                            <li><a href="news.html">Novidades</a></li>
                            <li><a href="contact.html">Contato</a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="search_box">
                        <form>
                            <input type="text" value="Busca" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
                {{ content() }}
            </div>
            {{ partial('index/main') }}
            <div class="footer">
                <div class="wrap">
                    <div class="section group">
                        <div class="col_1_of_4 span_1_of_4">
                            <h4>Informação</h4>
                            <ul>
                                <li><a href="about.html">Sobre</a></li>
                                <li><a href="contact.html">Serviço ao consumidor</a></li>
                                <li><a href="#">Busca Avançada</a></li>
                                <li><a href="delivery.html">Pedidos e retornos</a></li>
                                <li><a href="contact.html">Contato</a></li>
                            </ul>
                        </div>
                        <div class="col_1_of_4 span_1_of_4">
                            <h4>Por que comprar aqui</h4>
                            <ul>
                                <li><a href="about.html">Sobre</a></li>
                                <li><a href="contact.html">Serviço ao consumidor</a></li>
                                <li><a href="#">Politica</a></li>
                                <li><a href="contact.html">Mapa do site</a></li>
                                <li><a href="#">Termos de busca</a></li>
                            </ul>
                        </div>
                        <div class="col_1_of_4 span_1_of_4">
                            <h4>Minha conta</h4>
                            <ul>
                                <li><a href="contact.html">Lgin</a></li>
                                <li><a href="index.html">Ver carrinho</a></li>
                                <li><a href="#">Minha lista de desejos</a></li>
                                <li><a href="#">Rastreamento</a></li>
                                <li><a href="contact.html">Ajuda</a></li>
                            </ul>
                        </div>
                        <div class="col_1_of_4 span_1_of_4">
                            <h4>Contato</h4>
                            <ul>
                                <li><span>+55 84 1234-5678</span></li>
                                <li><span>+55 84 1234-0000</span></li>
                            </ul>
                            <div class="social-icons">
                                <h4>Siga-nos</h4>
                                <ul>
                                    <li><a href="#" target="_blank"><img src="images/facebook.png" alt="" /></a></li>
                                    <li><a href="#" target="_blank"><img src="images/twitter.png" alt="" /></a></li>
                                    <li><a href="#" target="_blank"><img src="images/skype.png" alt="" /> </a></li>
                                    <li><a href="#" target="_blank"> <img src="images/dribbble.png" alt="" /></a></li>
                                    <li><a href="#" target="_blank"> <img src="images/linkedin.png" alt="" /></a></li>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copy_right">
                    <p>SpidisTeam © Todos os direitos reservado </p>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $().UItoTop({ easingType: 'easeOutQuart' });

                });
            </script>
            <a href="#" id="toTop"><span id="toTopHover"> </span></a>
        </div>
    </body>
</html>
