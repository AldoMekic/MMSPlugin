/**
 * jQuery.ajax.
 *
 * @copyright  Copyright (c) 2023, Multimedijalni Sistemi
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

console.log('PHP variabla', php_vars);
const post_id = php_vars.post_id;
var submit_button = $(".btnSubmit"); 
$(submit_button).click(function(e){
    e.preventDefault();
    var broj = $( "#brojac" ).val();
    if (broj>0){
        broj=parseInt(broj);
        var aFormData = new FormData();
        aFormData.append("action", "add_update_metaKey"); 
        aFormData.append("brojac", broj);  
        aFormData.append("post_id", post_id);        
        jQuery.ajax({
            url : "/mss/wp-admin/admin-ajax.php",
            type : "post",
            processData: false,
            contentType: false,
            //dataType: "json",
            data :  aFormData  ,
                success : function( response ) {
                    $(".message-response").show().html(JSON.stringify(response));
                    console.log("success", response);
                },
                error: function(response) {
                    $(".message-response").show().html(JSON.stringify(response));
                    console.log("error", response);
                }
        });
        var value = $("#brojac").val();
        $( "#broj_text0" ).hide();
        $( "#broj_text" ).show();
        $( "#broj_text" ).text("Broj: "+ value ); 
    } else {
        $( "#broj_text" ).hide();
        $( "#broj_text0" ).show();
        $( "#broj_text0" ).text("Broj mora biti veci od 0");
    }
});