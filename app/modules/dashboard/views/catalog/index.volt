{% include "layouts/dashboardHeader.volt" %}

<div id="page-wrapper" style="min-height: 322px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Catálogo</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categorias
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" id="categories">
                        <button class="break-text btn btn-sq btn-default esse" id="newCategory" data-toggle="modal" data-target="#createCategoryModal">
                            <i class="middle-text fa fa-plus fa-4x"></i><br/>
                        </button>
                        
                        <button class="break-text btn btn-sq btn-default esse" data-id="9" data-name="Saladas   ">
                            <h5 class="middle-text"><strong>Saladas de Frutas Vermelhas</strong></h5>
                        </button>
                        
                        <button class="break-text btn btn-sq btn-default esse" data-id="9" data-name="Massas">
                            <h5 class="middle-text"><strong>Massas</strong></h5>
                        </button>
                        
                        <button class="break-text btn btn-sq btn-default esse" data-id="9" data-name="Bebidas">
                            <h5 class="middle-text"><strong>Bebidas</strong></h5>
                        </button>
                        
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Produtos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="items">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nome</th>
                                    <th>Preço Unitário</th>
                                    <th>Quantidade Disponível</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    
    <!-- Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Cadastro de Categoria</h4>
                </div>
                <div class="modal-body">
                <form role="form" id="createCategoryForm">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="categoryName">Nome da Categoria</label>
                                <input type="text" class="form-control" id="categoryName" name="name" placeholder="Informe o nome da categoria" required>
                            </div>

                            <div class="form-group">
                                <label for="categoryDescription">Descrição</label>
                                <textarea class="form-control" rows="3" id="categoryDescription" name="description" placeholder="Fale um pouco sobre a categoria..."></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                        </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="hidden" id="itemsOptionsTemplates">
        <button class="btn btn-primary btn-circle edit-item" data-container="body" data-toggle="tooltip" data-html="true" data-placement="top" title="Editar">
            <i class="fa fa-pencil"></i>
        </button>

        <button class="btn btn-danger btn-circle delete-item" data-container="body" data-toggle="tooltip" data-html="true" data-placement="top" title="Remover">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</div>

{% include "layouts/dashboardScripts.volt" %}

<!-- DataTables JavaScript -->
{{ javascript_include('plugins/datatables/js/jquery.dataTables.min.js') }}
{{ javascript_include('plugins/datatables-plugins/dataTables.bootstrap.min.js') }}
{{ javascript_include('plugins/datatables-responsive/dataTables.responsive.js') }}

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            oLanguage: {
                "sProcessing": "Aguarde enquanto os dados são carregados ...",
                "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                "sInfoEmpty": "Exibindo 0 a 0 de 0 registros",
                "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                "sInfoFiltered": "",
                "sSearch": '',
                "sSearchPlaceholder": "Pesquisar",
                "oPaginate": {
                   "sFirst":    "Primeiro",
                   "sPrevious": "Anterior",
                   "sNext":     "Próximo",
                   "sLast":     "Último"
                }
            }
        });
    });
</script>

{% include "layouts/dashboardFooter.volt" %}