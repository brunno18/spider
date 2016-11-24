{% if loginErro is defined %}
    <div id="signupalert" class="alert alert-danger">
        <strong>Erro!</strong>
        <span>{{mensagem}}</span>
    </div>
{% endif %}

{% if loginAviso is defined %}
    <div id="signupalert" class="alert alert-warning">
        <strong>Aviso!</strong>
        <span>{{mensagem}}</span>
    </div>
{% endif %}

<div class="eternity-form container" style="margin-top: 27px;margin-bottom:27px;">
    <div class="login-form-section col-lg-6 col-lg-offset-3">
        <div class="login-content  animated bounceIn" data-animation="bounceIn">
            <form method="post" action="{{ baseurl }}session/start">
                <div class="section-title" style="text-align: center">
                    <h3>Acesse sua conta</h3>
                </div>

                <div class="textbox-wrap">
                    <div class="input-group">
                        <span class="input-group-addon "><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input type="text" required="required" name="email" class="form-control" placeholder="E-mail">
                    </div>
                </div>
                <div class="textbox-wrap">
                    <div class="input-group">
                        <span class="input-group-addon "><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password" required="required" name="senha" class="form-control " placeholder="Senha">
                    </div>
                </div>
                <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                       value="<?php echo $this->security->getToken() ?>"/>

                <div class="col-lg-offset-5" style="padding-top: 5px;">
                    <button type="submit" class="btn btn-success green-btn">Login &nbsp; <i class="icon-chevron-right"></i></button>
                </div>
            </form>
        </div>
        <br>
        <div class="login-form-links link1  animated fadeInLeftBig" data-animation="fadeInLeftBig" data-animation-delay=".2s" style="animation-delay: 0.2s;">
            <h4 class="blue">Não tem uma Conta?</h4>
            <span>Não se preocupe</span>
            <a href="{{ baseurl }}store/cadastro" class="blue">Clique Aqui</a>
            <span>para se Cadastrar</span>
        </div>
        <br>
        <div class="login-form-links link2  animated fadeInRightBig" data-animation="fadeInRightBig" data-animation-delay=".4s" style="animation-delay: 0.4s;">
            <h4 class="green">Esqueceu sua senha?</h4>
            <span>Não se preocupe</span>
            <a href="#recuperar-senha" class="green">Clique Aqui</a>
            <span>para Recuperá-la</span>
        </div>
    </div>
</div>