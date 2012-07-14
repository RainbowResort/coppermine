$(document).ready(function() {
    var alertTimerId = 0;
    $('#livesearch_input').keyup(function() {
        $('#livesearch_input').addClass('blue');
        clearTimeout(alertTimerId);
        alertTimerId = setTimeout(function () {
            $.post('index.php?file=annotate/reqserver', {livesearch:'1',q:$('#livesearch_input').val()}, function(data) { 
                $('#livesearch_output').html(data); 
                $('#livesearch_input').removeClass('blue');
            });
        }, 250);
    });
});

var loaded = false;
function load_annotation_list() {
    if (loaded == false) {
        $('#livesearch_output').hide();
        $('#livesearch_output_loading').show();
        $.post('index.php?file=annotate/reqserver', {livesearch:'1',q:$('#livesearch_input').val()}, function(data) {
            $('#livesearch_output_loading').hide();
            $('#livesearch_output').html(data).show().expand(); 
        });
        loaded = true;
    }
}