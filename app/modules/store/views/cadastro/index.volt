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


    <div class="registration-form-section">
        <form method="post" action="{{ baseurl }}cadastro/cadastrar">
            <div class="section-title reg-header animated fadeInDown" data-animation="fadeInDown">
                <h3>Cadastre-se aqui </h3>
            </div>

            <div class="clearfix">
                <div class="col-sm-6 registration-left-section   animated fadeInUp" data-animation="fadeInUp">
                    <div class="reg-content">
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-user icon-color"></i></span>
                                {#<input type="text" class="form-control" name="nome" placeholder="Nome">#}
                                {{ form.render("nome") }}
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-user icon-color"></i></span>
                                {#<input type="text" class="form-control" name="cpf_cnpj" placeholder="CPF ou CNPJ">#}
                                {{ form.render("cpf_cnpj") }}
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-envelope icon-color"></i></span>
                                {#<input type="email" class="form-control" name="email" placeholder="Email">#}
                                {{ form.render("email") }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 registration-right-section  animated fadeInUp" data-animation="fadeInUp">
                    <div class="reg-content">

                        <div class="textbox-wrap" style="padding-bottom: 19px;">
                        </div>

                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-key icon-color"></i></span>
                                {#<input type="password" class="form-control" name="senha" placeholder="Senha">#}
                                {{ form.render("senha") }}
                            </div>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="icon-key icon-color"></i></span>
                                {#<input type="password" class="form-control" name="csenha" placeholder="Confirme sua senha">#}
                                {{ form.render("csenha") }}
                            </div>
                        </div>

                        <div class="textbox-wrap" style="padding-bottom: 19px;">
                        </div>


                    </div>
                </div>
                <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                       value="<?php echo $this->security->getToken() ?>"/>
            </div>
            <div class="registration-form-action clearfix  animated fadeInUp" data-animation="fadeInUp" data-animation-delay=".15s" style="animation-delay: 0.15s;">
                <a href="{{ baseurl }}session" class="btn btn-success pull-left blue-btn ">
                    <i class="icon-chevron-left"></i>&nbsp; &nbsp;Voltar Para o Login
                </a>
                <button type="submit" class="btn btn-success pull-right green-btn ">Cadastrar Agora &nbsp; <i class="icon-chevron-right"></i></button>

            </div>
        </form>
    </div>

</div>
