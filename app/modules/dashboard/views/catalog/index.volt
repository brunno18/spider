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
                        <h4>Categorias</h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" id="categories">
                        <button class="break-text btn btn-sq btn-default esse" id="newCategory" data-toggle="modal" data-target="#createCategoryModal">
                            <i class="middle-text fa fa-plus fa-4x"></i><br/>
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
                    <div class="panel-heading clearfix">
                        <div class="pull-left">
                            <h4>Produtos</h4>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#createItemModal">
                                <i class="glyphicon glyphicon-plus"></i> Novo Produto
                            </button>
                        </div>
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
    
    <!-- Create item modal form -->
    <div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="createItemModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Adicionar Item</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="createItemForm">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="itemName">Nome do Item</label>
                                <input type="text" class="form-control" name="name" id="itemName" placeholder="Informe o nome do item" required>
                            </div>
                            <div class="form-group">
                                <label for="itemPrice">Preço Unitário</label>
                                <input type="text" class="form-control" name="price" id="itemPrice" placeholder="Informe o preço do item">
                            </div>
                            <div class="form-group">
                                <label for="itemAmount">Quantidade Disponível</label>
                                <input type="text" class="form-control" name="amount" id="itemAmount" placeholder="Informe a quantidade disponível">
                            </div>
                            <div class="form-group">
                                <label for="itemDescription">Descrição</label>
                                <textarea class="form-control" rows="3" name="description" id="itemDescription" placeholder="Fale um pouco sobre o item..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="itemImage">Adicione uma imagem</label>
                                <input type="file" name="image" id="itemImage">

                                <p class="help-block">Tamanho max: 2MB</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Edit item modal form -->
    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="editItemModalTitle">Editar Item - <span> </span></h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="editItemForm">
                        <div class="box-body">
                            <input type="hidden" id="editItemId" name="id">

                            <div class="form-group">
                                <label for="editItemName">Nome do Item</label>
                                <input type="text" class="form-control" name="name" id="editItemName" placeholder="Informe o nome do item" required>
                            </div>
                            <div class="form-group">
                                <label for="editItemPrice">Preço Unitário</label>
                                <input type="text" class="form-control" name="price" id="editItemPrice" placeholder="Informe o preço do item">
                            </div>
                            <div class="form-group">
                                <label for="editItemAmount">Quantidade Disponível</label>
                                <input type="text" class="form-control" name="amount" id="editItemAmount" placeholder="Informe a quantidade disponível">
                            </div>
                            <div class="form-group">
                                <label for="editItemDescription">Descrição</label>
                                <textarea class="form-control" rows="3" name="description" id="editItemDescription" placeholder="Fale um pouco sobre o item..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editItemImage">Adicione uma imagem</label>
                                <input type="file" name="image" id="editItemImage">

                                <p class="help-block">Tamanho max: 2MB</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Delete item modal form -->
    <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="deleteItemModalTitle">Remover Item - <span> </span></h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <p>Tem certeza que deseja remover esse item?</p>
                    </div>
                    <!-- /.box-body -->

                    <form role="form" id="deleteItemForm">
                        <input type="hidden" id="deleteItemId" name="id">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Remover</button>
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

{{ javascript_include('js/catalog.js') }}

{% include "layouts/dashboardFooter.volt" %}