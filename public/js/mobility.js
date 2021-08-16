var meta = $("meta[name='csrf-token']").attr("content");

$('.costo').on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.
  
    // get input value
    var input_val = input.val();
  
    // don't validate empty input
    if (input_val === "") { return; }
    
    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");
        
    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
        right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
        input_val += ".00";
        }
    }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}


$('.conveyances').on('change', function(){
    $('.idTypeTransportation').empty();
    if($(this).val() > 0){
        var urlHost = window.location.protocol + '//' + window.location.host + '/dashboard/typeTransportation/getTypeTransportation';
        
        $.ajax({
            url: urlHost,
            type: 'POST',
            data: {
                '_token': meta,
                'data' : $(this).val(),
            },
            success: function (results) {
                $('.idTypeTransportation').prop("disabled", false);
                for (var i = 0; i < results.length; i++){
                    $('.idTypeTransportation').append(`<option value="${results[i].id}">${results[i].descripcion}</option>`)
                }
            },
            cache: false
        });
    } else {
        $('.idTypeTransportation').prop("disabled", true);
    }
    
})