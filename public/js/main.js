$(document).ready(function() {	

});

$('.btn').click(function(event)
{
    event.preventDefault();
    var target = $(this).data('target');
	// console.log('#'+target);
	$('#click-alert').html('data-target= ' + target).fadeIn(50).delay(3000).fadeOut(1000);
	
});

// Filter CCosto/Provider
$.fn.enterKey = function (fnc)
{
  return this.each(function () {
      $(this).keypress(function (ev) {
          var keycode = (ev.keyCode ? ev.keyCode : ev.which);
          if (keycode == '13') {
              fnc.call(this, ev);
          }
      })
  })
}
$("#filter_ccosto").enterKey(function ()
{
  if($(this).val() != ''){
    var mes = $('#filter_month').val();
    document.location = '/home/month/' + mes + '/ccosto/' + $(this).val();
  }
  else{
    document.location = '/home';
  }
});
$("#filter_summary_ccosto").enterKey(function ()
{
  if($(this).val() != ''){
    var mes = $('#filter_summary_month').val();
    document.location = '/summary/month/' + mes + '/ccosto/' + $(this).val();
  }
  else{
    document.location = '/summary';
  }
});
$('#filter_provider').on('change',function(e)
{
  if($(this).val() != ''){
    var mes = $('#filter_providers_month').val();
    document.location = '/providers/month/' + mes + '/code/' + $(this).val();
  }
  else{
    document.location = '/providers';
  }
});

// Filter Month
$('#filter_month').on('change',function(e)
{
  if($('#filter_ccosto').val() != ''){
    var ccosto = $('#filter_ccosto').val();
    document.location = '/home/month/' + $(this).val() + '/ccosto/' + ccosto;
  }
  else{
    document.location = '/home/month/' + $(this).val();
  }
});
$('#filter_summary_month').on('change',function(e)
{
  if($('#filter_summary_ccosto').val() != ''){
    var ccosto = $('#filter_summary_ccosto').val();
    document.location = '/summary/month/' + $(this).val() + '/ccosto/' + ccosto;
  }
  else{
    document.location = '/summary/month/' + $(this).val();
  }
});
$('#filter_providers_month').on('change',function(e)
{
  if($('#filter_provider').val() != ''){
    var ccosto = $('#filter_provider').val();
    document.location = '/providers/month/' + $(this).val() + '/code/' + ccosto;
  }
  else{
    document.location = '/providers/month/' + $(this).val();
  }
});

// Print
$(document).on('click', '#summary_print', function()
{
  $('#form-summary-print').submit();
});
$(document).on('click', '#providers_print', function()
{
  $('#form-providers-print').submit();
});

// Delete Facture
$(document).on('click', '#fact_del', function()
{
  var id  = $(this).data('id'),
      url = $(this).data('url');
  $.ajax({
    type: 'POST',
    url: '/destroy',
    data: {
        '_token': $('input[name=_token]').val(),
        'id': id
    },
    success: function(response)
    {
      document.location = url;
    }
  });
});

// Multi-Step Form
arr_rows = [];
arr_workers = [];
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

$('#scanfacture').on('change',function(e){
  //get the file name
  var fileName = e.target.files[0].name;
  //replace the "Choose a file" label
  $(this).next('.custom-file-label').html(fileName);
});

// Rows button click
$(document).on('click', '#add-btn-row', function()
{
    var add_row = $('#add-row').val(),
        add_cup,
        add_cuc;
    
    if($('#add-cup').val() != '' && $('#add-cup').val() > 0) { 
      add_cup = parseFloat($('#add-cup').val()) 
    }else{ add_cup = 0; }

    if($('#add-cuc').val() != '' && $('#add-cuc').val() > 0) { 
      add_cuc = parseFloat($('#add-cuc').val())
    }else{ add_cuc = 0; }

    var total   = add_cup + add_cuc;

    if ($('#totalcup').val() != '' && $('#totalcup').val() > 0) { var totalcup = parseFloat($('#totalcup').val()) }
    else{ var totalcup = 0; }
    if ($('#totalcuc').val() != '' && $('#totalcuc').val() > 0) { var totalcuc = parseFloat($('#totalcuc').val()) }
    else{ var totalcuc = 0; }

    if (add_row == null || add_row == '') {
      alert('Debe seleccionar un Elemento de Gasto. Por favor, revise antes de continuar.');
      return false;
    }
    if (totalcup == 0 && add_cup > 0) {
      alert('El Elemento de Gasto No tiene Importe en CUP. Por favor, revise antes de continuar.');
      return false;
    }
    if (totalcuc == 0 && add_cuc > 0) {
      alert('El Elemento de Gasto No tiene Importe en CUC. Por favor, revise antes de continuar.');
      return false;
    }
    if (total == 0) {
      alert('El Elemento de Gasto debe tener al menos un importe. Por favor, revise antes de continuar.');
      return false;
    }

    // Add item to array
    arr_rows.push(add_row + '*' + add_cup + '*' + add_cuc + '*' + total);
    $('#add_rows').val(arr_rows);
    var item = arr_rows.indexOf(add_row + '*' + add_cup + '*' + add_cuc + '*' + total);
    // Clear fields
    $('#add-row').val('');
    $('#add-cup').val('');
    $('#add-cuc').val('');
    // Add row to table
    $('#add-table-rows').append(
      '<tr class="add-rows-' + item.toString() + '">' +
        '<td class="pr-0"><a class="add-row-del" data-id="'+item.toString()+'" style="cursor:pointer" title="Eliminar"><i class="fas fa-trash text-danger"></i></a></td>'+
        '<td>' + add_row + '</td>'+
        '<td style="text-align: right">' + add_cup + '</td>' +
        '<td style="text-align: right">' + add_cuc + '</td>' +
        '<td style="text-align: right">' + total + '</td>' +
      '</tr>');
    
    $('#add-row').focus();
});

// Workers button click
$(document).on('click', '#add-btn-workers', function()
{
    var add_ccoste = $('#add-ccoste').val(),
        add_numberw;

    if($('#add_numberw').val() != '' && $('#add_numberw').val() > 0) { 
      add_numberw = parseFloat($('#add_numberw').val());
    }else{
      add_numberw = 1;
    }
    // Add item to array
    arr_workers.push(add_ccoste + '*' + add_numberw);
    $('#add_workers').val(arr_workers);
    var item = arr_workers.indexOf(add_ccoste + '*' + add_numberw);
    // Clear fields
    $('#add-ccoste').val('');
    $('#add-numberw').val(null);
    // Add row to table
    $('#add-table-workers').append(
      '<tr class="add-workers-' + item.toString() + '">' +
        '<td class="pr-0"><a class="add-worker-del" data-id="'+item.toString()+'" style="cursor:pointer" title="Eliminar"><i class="fas fa-trash text-danger"></i></a></td>'+
        '<td>' + add_ccoste + '</td>'+
        '<td style="text-align: center">' + add_numberw + '</td>' +
      '</tr>');
    
    $('#add-ccoste').focus();
});

// Row Delete link click
$(document).on('click', '.add-row-del', function()
{
  var item = $(this).data('id');
  delete arr_rows[item];
  $('.add-rows-' + item).remove();
  return
});

// Row Delete link click
$(document).on('click', '.add-worker-del', function()
{
  var item = $(this).data('id');
  delete arr_workers[item];
  $('.add-workers-' + item).remove();
  return
});

// Submit Add form
function sendFacture(){
  
  // Validate form
  if (arr_rows.length == 0) {
    alert('No ha agregado ning\xfan Rengl\xf3n a la Factura. Por favor, revise antes de continuar.');
    return
  }
  var rows_cup = 0,
      rows_cuc = 0;
  arr_rows.forEach(element => {
    e = element.split('*');
    rows_cup = parseFloat(rows_cup) + parseFloat(e[1]);
    rows_cuc = parseFloat(rows_cuc) + parseFloat(e[2]);
  });

  if ($('#add_provider').val() == '') {
    alert('En los Datos Generales elija el Proveedor de la Factura. Por favor, revise antes de continuar.');
    return
  }
  if ($('#totalcup').val() != '' && $('#totalcup').val() > 0) { var totalcup = parseFloat($('#totalcup').val()) }
  else{ var totalcup = 0; }
  if ($('#totalcuc').val() != '' && $('#totalcuc').val() > 0) { var totalcuc = parseFloat($('#totalcuc').val()) }
  else{ var totalcuc = 0; }
  var total_facture = totalcup + totalcuc;

  if (totalcup == 0 && totalcuc == 0) {
    alert('La factura no puede tener Importe cero. Por favor, revise los importes totales CUP y CUC antes de continuar.');
    return
  }

  if (rows_cup !=  totalcup) {
    alert('El Importe total CUP de la Factura no coincide con el Importe total CUP de Renglones. Por favor, revise antes de continuar.');
    return
  }
  if (rows_cuc !=  totalcuc) {
    alert('El Importe total CUC de la Factura no coincide con el Importe total CUC de Renglones. Por favor, revise antes de continuar.');
    return
  }
  if (arr_workers.length == 0) {
    alert('No ha agregado Trabajadores a la Factura. Por favor, revise antes de continuar.');
    return
  }
  
  // Send Form
  var form = $('#add-form-facture'),
      loader = $('#add-form-loader');
  
  form.find('.help-block').remove();
  form.find('.form-group').removeClass('has-error');
  loader.html('<i class="fas fa-sync fa-spin text-secondary"></i>');

  var formData = new FormData($('#add-form-facture')[0]);

  $.ajax({
      type: 'POST',
      url: '/store',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response)
      {
        loader.html('');
        document.location = $('#currenturl').val();
      },
      error: function(xhr){
          var res = xhr.responseJSON;
          if($.isEmptyObject(res) == false){
              loader.html('');
              $.each(res.errors, function(key, value){
                  $('#'+key)
                  .closest('.form-group')
                  .addClass('has-error')
                  .append('<span class="col-sm-12 help-block"><strong>' + value + '</strong></span>')
              });
          }
      }
  });
};


function showTab(n) {
  if (document.getElementsByClassName("tab").length != 0) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "<i class='fas fa-save'></i> Guardar";
    } else {
      document.getElementById("nextBtn").innerHTML = "Siguiente <i class='fas fa-angle-double-right'></i>";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }
}

function addNextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    currentTab = currentTab - n;
    // Show the current tab:
    x[currentTab].style.display = "block";
    sendFacture();
    return false;
  }

  //console.log(currentTab);

  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    //console.log(y[i].id + ' - ' + y[i].required);
    // If a field is empty...
    if ((y[i].required == true) && (y[i].value == "")) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

// Contravalue Facture Submit
$(document).on('click', '#contrav_submit', function()
{
  // Validations
  if ($('#contrav_number').val() == '' || $('#contrav_number').val() == null) {
    alert('Debe introducir el N\xfamero de la Factura. Por favor, revise antes de continuar.');
    return
  }
  if ($('#contrav_provider').val() == '' || $('#contrav_provider').val() == null) {
    alert('Debe elejir el Proveedor de la Factura. Por favor, revise antes de continuar.');
    return
  }
  if ($('#contrav_date').val() == '' || $('#contrav_date').val() == null) {
    alert('Debe introducir la Fecha de la Factura, en el formato que se muestra. Por favor, revise antes de continuar.');
    return
  }
  if ($('#contrav_cup').val() == '' && $('#contrav_cuc').val() == '') {
    alert('Debe introducir al menos un Importe en la Factura. Por favor, revise antes de continuar.');
    return
  }
  if ($('#contrav_workers').val() == '' || parseFloat($('#contrav_workers').val()) < 1) {
    alert('Debe introducir la Cantidad de Trabajadores de la Factura. Por favor, revise antes de continuar.');
    return
  }

  // Send Form
  var form = $('#contrav-form-facture'),
      loader = $('#contrav-form-loader');
  
  form.find('.help-block').remove();
  form.find('.form-group').removeClass('has-error');
  loader.html('<i class="fas fa-sync fa-spin text-secondary"></i>');

  var formData = new FormData($('#contrav-form-facture')[0]);
  
  $.ajax({
    type: 'POST',
    url: '/storeContrav',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(response)
    {
      loader.html('');
      document.location = $('#contrav_currenturl').val();
    },
    error: function(xhr){
        var res = xhr.responseJSON;
        if($.isEmptyObject(res) == false){
            loader.html('');
            $.each(res.errors, function(key, value){
                $('#'+key)
                .closest('.form-group')
                .addClass('has-error')
                .append('<span class="col-sm-12 help-block"><strong>' + value + '</strong></span>')
            });
        }
    }
  });
});