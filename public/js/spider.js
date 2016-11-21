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
        
        $(document).on("click", ".btn-sq", function(){
            if ($(this).attr("id") != "newCategory") {
                $(".btn-sq").removeClass("btn-success").addClass("btn-default");
                $(this).removeClass("btn-default").addClass("btn-success");
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
    });
    
})(jQuery, $.AdminLTE);