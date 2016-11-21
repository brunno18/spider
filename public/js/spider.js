(function($, AdminLTE){
    
    "use strict";
    
    $(document).ready(function() {
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
        
        var oTable;
        
        loadInitialState();
        
        $(document).on("click", ".btn-sq", function(){
            if ($(this).attr("id") != "newCategory") {
                $(".btn-sq").removeClass("btn-success").addClass("btn-default");
                $(this).removeClass("btn-default").addClass("btn-success");
                
                loadItems($(this).attr('data-id'));
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
        
        function loadItems (categoryId) {
            
            oTable.fnDestroy();
            
            oTable = $('#items').dataTable( {
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
            if (oTable) {
                oTable.fnDestroy();
            }
            
            oTable = $('#items').dataTable( {
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