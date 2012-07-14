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