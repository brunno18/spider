{% if cadastroErro is defined %}
    <div id="signupalert" class="alert alert-danger">
        <strong>Erro!</strong>
        <span>{{mensagem}}</span>
    </div>
{% endif %}

{% if cadastroAviso is defined %}
    <div id="signupalert" class="alert alert-warning">
        <strong>Aviso!</strong>
        <span>{{mensagem}}</span>
    </div>
{% endif %}

<div class="eternity-form container" style="margin-top: 27px;margin-bottom:27px;">


    <div class="registration-form-section col-lg-12" style="margin: auto;text-align: center">
        <form method="post" action="{{ baseurl }}cadastro/cadastrar">
            <div class="section-title reg-header animated fadeInDown" data-animation="fadeInDown">
                <h3 style="font-weight: bold;font-size: large;padding-bottom: 5px;">Cadastre-se aqui </h3>
            </div>

            <div class="clearfix">
                <div class="col-lg-6 col-lg-offset-3 registration-left-section   animated fadeInUp" data-animation="fadeInUp">
                    <div class="reg-content">
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user" aria-hidden="true"></i></span>
                                {#<input type="text" class="form-control" name="nome" placeholder="Nome">#}
                                {{ form.render("nome") }}
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                                {#<input type="text" class="form-control" name="cpf_cnpj" placeholder="CPF ou CNPJ">#}
                                {{ form.render("cpf_cnpj") }}
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                {#<input type="email" class="form-control" name="email" placeholder="Email">#}
                                {{ form.render("email") }}
                            </div>
                        </div>

                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key" aria-hidden="true"></i></span>
                                {#<input type="password" class="form-control" name="senha" placeholder="Senha">#}
                                {{ form.render("senha") }}
                            </div>
                        </div>

                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key" aria-hidden="true"></i></span>
                                {#<input type="password" class="form-control" name="csenha" placeholder="Confirme sua senha">#}
                                {{ form.render("csenha") }}
                            </div>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                       value="<?php echo $this->security->getToken() ?>"/>
            </div>
            <br>
            <div class="registration-form-action col-lg-6 col-lg-offset-3 clearfix  animated fadeInUp" data-animation="fadeInUp" data-animation-delay=".15s" style="animation-delay: 0.15s;">
                <a href="{{ baseurl }}session" class="btn btn-success pull-left blue-btn ">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp; &nbsp;Voltar Para o Login
                </a>
                <button type="submit" class="btn btn-success pull-right green-btn ">Cadastrar Agora &nbsp; <i class="fa fa-chevron-right" aria-hidden="true"></i></button>

            </div>
        </form>
    </div>

</div>
