<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login</title>
	
	<!-- Bootstrap Core CSS -->
	{{ stylesheet_link('plugins/bootstrap/css/bootstrap.min.css') }}
    
	<!-- MetisMenu CSS -->
    {{ stylesheet_link('plugins/metisMenu/metisMenu.min.css') }}
    
	<!-- Custom CSS -->
    {{ stylesheet_link('css/sb-admin-2.min.css') }}
    
	<!-- Custom Fonts -->
    {{ stylesheet_link('plugins/fonts-awesome/css/fonts-awesome.min.css') }}

</head>

<body>
    {{ flashSession.output() }}
    
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Informe suas Credenciais</h3>
					</div>
					<div class="panel-body">
						<form role="form" method="POST">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Usuário" name="username" type="text" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Senha" name="password" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me"> Continuar conectado
									</label>
								</div>
								<input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
    {{ javascript_include('plugins/jquery/jquery.min.js') }}
    
	<!-- Bootstrap Core JavaScript -->
    {{ javascript_include('plugins/bootstrap/js/bootstrap.min.js') }}
    
	<!-- Metis Menu plugins JavaScript -->
    {{ javascript_include('plugins/metisMenu/metisMenu.min.js') }}
    
	<!-- Custom Theme JavaScript -->
    {{ javascript_include('js/sb-admin-2.min.js') }}


</body>
</html>

