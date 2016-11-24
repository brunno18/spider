(function($, AdminLTE){
    
    "use strict";
    
    var Spider = {};
    
    Spider.Catalog = {
        selectedCategory: null,
        
        oTable: null,
        
        init: function() {
            this.attachEvents();
        },
        
        attachEvents: function() {
            $("table").on('click', '.edit-item', function(){
                Spider.Catalog.showEditItemModal($(this).attr("data-id"));
            });
            
            $("table").on('click', '.delete-item', function(){
                Spider.Catalog.showDeleteItemModal($(this).attr("data-id"), $(this).attr("data-name"));
            });
        },
    
        showEditItemModal: function(id) {
            $.ajax({
                url     :   url + "/dashboard/item/edit/" + id,
                type    :   'GET',
                success :   function( data ) {
                                var item = data.item;
                    
                                $('#editItemModalTitle').find("span").text(item.name);
                                
                                $("#editItemId").val(item.id);
                                $("#editItemName").val(item.name);
                                $("#editItemPrice").val(item.price);
                                $("#editItemAmount").val(item.amount);
                                $("#editItemDescription").val(item.description);
                                
                                $('#editItemModal').modal('show');
                            },
                error   :   function( xhr, err ) {
                                console.log(err);
                            }
            });
        },
        
        showDeleteItemModal: function(id, name) {
                $('#deleteItemModalTitle').find("span").text(name);
                $("#deleteItemId").val(id);
                $('#deleteItemModal').modal('show');
        },
    }
    
    $(document).ready(function() {
        Spider.Catalog.init();
        
        $.ajax({
            url     :   url + "/dashboard/category/search",
            type    :   'GET',
            success :   function( data ) {
                            var categories = data.categories;
                                categories.forEach(function(category, index) {
                                var category = '    <button class="break-text btn btn-sq btn-default esse" ' + 'id="category-' + category.id + 
                                                '" data-id=' + category.id + ' data-name=' + category.name + '>' +
                                                '<h5 class="middle-text"><strong>' + category.name + "<strong>" +
                                                '</button>';
                                    
                                $("#categories").append(category);
                            });
                        },
            error   :   function( xhr, err ) {
                            console.log(err);
                        }
        });
        
        loadInitialState();
        
        $(document).on("click", ".btn-sq", function(){
            if ($(this).attr("id") != "newCategory") {
                $(".btn-sq").removeClass("btn-success").addClass("btn-default");
                $(this).removeClass("btn-default").addClass("btn-success");
                
                Spider.Catalog.selectedCategory = $(this);
                
                loadItems(Spider.Catalog.selectedCategory.attr('data-id'));
            }
        });
        
        $("#createCategoryForm").submit(function(e){
            e.preventDefault();
            
            $.post(
                url + '/dashboard/category/create', 
                $('#createCategoryForm').serialize()
            )
            .done(function(data) {
                $('#createCategoryModal').modal('hide');
                
                var category = '    <button class="break-text btn btn-sq btn-default esse" ' + 'id="category-' + data.category.id + 
                           '" data-id=' + data.category.id + ' data-name=' + data.category.name + '>' +
                           '<h5 class="middle-text"><strong>' + data.category.name + "<strong>" +
                           '</button>';
                
                $("#categories").append(category);
                
                $('#createCategoryModal').modal('hide');
                
                new PNotify({
                    title: "Sucesso",
                    text: "Categoria <strong>" + data.category.name + "</strong> cadastrada.",
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3'
                });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: "Opss",
                    text: jqXHR.responseJSON.error.message,
                    type: 'error',
                    hide: true,
                    styling: 'bootstrap3'
                });
            });
        });
        
        $("#createItemForm").submit(function(e){
            e.preventDefault();
            
            $.post(
                url + '/dashboard/item/create/' + Spider.Catalog.selectedCategory.attr('data-id'), 
                $('#createItemForm').serialize()
            )
            .done(function(data) {
                $('#createItemModal').modal('hide');
                
                loadItems(Spider.Catalog.selectedCategory.attr('data-id'));
                
                new PNotify({
                    title: "Sucesso",
                    text: "Produto <strong>" + data.item.name + "</strong> cadastrado.",
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3'
                });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: "Opss",
                    text: jqXHR.responseJSON.error.message,
                    type: 'error',
                    hide: true,
                    styling: 'bootstrap3'
                });
            });
        });
        
        $("#editItemForm").submit(function(e){
            e.preventDefault();
            
            $.post(
                url + '/dashboard/item/save/', 
                $('#editItemForm').serialize()
            )
            .done(function(data) {
                $('#editItemModal').modal('hide');
                
                loadItems(Spider.Catalog.selectedCategory.attr('data-id'));
                
                new PNotify({
                    title: "Sucesso",
                    text: "Produto <strong>" + data.item.name + "</strong> alterado.",
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3'
                });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: "Opss",
                    text: jqXHR.responseJSON.error.message,
                    type: 'error',
                    hide: true,
                    styling: 'bootstrap3'
                });
            });
        });
        
        $("#deleteItemForm").submit(function(e){
            e.preventDefault();    
            
            var id = $("#deleteItemId").val();
            
            $.get(
                url + '/dashboard/item/delete/' + id
            )
            .done(function(data) {
                $('#deleteItemModal').modal('hide');
                
                new PNotify({
                    title: "Sucesso",
                    text: "Produto <strong>" + data.item.name + "</strong> removido.",
                    type: 'success',
                    hide: true,
                    styling: 'bootstrap3'
                });
                
                loadItems(Spider.Catalog.selectedCategory.attr("data-id"));
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('#deleteItemModal').modal('hide');
                
                new PNotify({
                    title: "Opss",
                    text: jqXHR.responseJSON.error.message,
                    type: 'error',
                    hide: true,
                    styling: 'bootstrap3'
                });
            });
        });
        
        function loadItems (categoryId) {
            
            Spider.Catalog.oTable.fnDestroy();
            
            Spider.Catalog.oTable = $('#items').dataTable( {
                "drawCallback": function( settings ) {
                    $('[data-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    });
                },
                "bAutoWidth": false,
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": url + "/dashboard/item/search/" + categoryId,
                "columns": [
                    {
                        "data": "id",
                        "bVisible": false
                    },
                    { 
                        "data": "name" 
                    },
                    { 
                        "data": "amount",
                        "mRender": function ( data, type, full ) {
                            return data + " unidades";
                        }
                    },
                    { 
                        "data": "price",
                        "mRender": function ( data, type, full ) {
                            return "R$ " + data;
                        }
                    },
                    { 
                        "data": "acoes", 
                        "bSortable": false,
                        "sDefaultContent": "",
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            var options = $("#itemsOptionsTemplates").clone().children();
                            
                            $(options[0]).attr({
                                "id": "item-" + oData.id,
                                "data-id": oData.id,
                                "data-name": oData.name
                            });
                            $(nTd).append($(options[0]).wrap("<div/>").parent().html());
                            
                            $(options[1]).attr({
                                "id": oData.id,
                                "data-id": oData.id,
                                "data-name": oData.name
                            });
                            $(nTd).append("     " + $(options[1]).wrap("<div/>").parent().html());
                        }
                    }
                ],
                 "oLanguage": {
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
                    },
                }
            });
        }
        
        function loadInitialState() {
            if (Spider.Catalog.oTable) {
                Spider.Catalog.oTable.fnDestroy();
            }
            
            Spider.Catalog.oTable = $('#items').dataTable( {
                "drawCallback": function( settings ) {
                    $('[data-toggle="tooltip"]').tooltip();
                },
                "columns": [
                    {
                        "data": "id",
                        "bVisible": false,
                        "sDefaultContent": "",
                    },
                    { 
                        "data": "name",
                        "sDefaultContent": "",
                    },
                    { 
                        "data": "amount",
                        "sDefaultContent": "",
                    },
                    { 
                        "data": "price",
                        "sDefaultContent": "",
                    },
                    { 
                        "data": "acoes", 
                        "bSortable": false,
                        "sDefaultContent": "",
                    }
                ],
                 "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                    "sZeroRecords": "Selecione Uma Categoria",
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
                    },
                }
            });
        }
    });
    
})(jQuery, $.AdminLTE);