$(document).ready(function(){
    build_link_url();
    $(".custom-control-input").change(function(){
        build_link_url();
    });
});

function build_link_url(){
    var id_string = '';
    $(".custom-control-input").each(function(){
        if($(this).prop('checked') && $(this).val() != 'on'){
            id_string = id_string + $(this).val() + '+';
        }
    });
    id_string = id_string.replace(/\++$/, ''); 
    $(".checkbox-print-ids").each(function(){
        var href = $(this).attr('href');
        href = href.replace(/\/[^/]*$/, '/' + id_string);
        $(this).attr('href', href);
    });

}