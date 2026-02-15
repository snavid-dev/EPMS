function xhrSubmit(from_id, action, classname = null, modalClass = 'onboardingWideFormModal', extraFunction= '', reload = false, btnAction = '.none', timeOut = 1000) {
  var formData = new FormData($("#" + from_id)[0]);
  $(btnAction).attr("disabled", true);
  $.ajax({
    url: action,
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).then(function (data) {
    var field = JSON.parse(data);
    if (field['type'] == 'success') {
      $(btnAction).attr("disabled", false);
      init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
      if (reload) {
        setTimeout(() => {
          window.location.reload();
        }, timeOut);
      }
      $('#' + from_id).trigger("reset");
      let num = Number($(`table.${classname} tbody tr:last td:first`).html());
      let tds = ``;
      var table = $('#dataTable1').DataTable();

      if (isNaN(num)) {
      field['tr'].unshift(1);
      }else{
        field['tr'].unshift(num + 1);
      }

      var rows = table.row.add(field['tr']).node();
      rows.id = field['id'];
      if (typeof field['class'] !== 'undefined') {
        $(rows).addClass(field['class']);
      }
      table.draw(false);
      extraFunction;
      $(`#${modalClass}`).modal('hide');
     
    }else if(field['type'] == 'error'){
      init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
    } else {
      $(btnAction).attr("disabled", false);
      if (field['type'] == "form_error") {
        for (let step = 0; step < field['messages'].length; step++) {

          init_PNotify('خطا', field['messages'][step], 'error');
        }
      }
    }
  });
}

function xhrUpdate(from_id, action, modalClass = 'editModal', reload = false, btnAction = '.none', timeOut = 1000) {
  var formData = new FormData($("#" + from_id)[0]);
  $(btnAction).attr("disabled", true);
  $.ajax({
    url: action,
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).then(function (data) {
    var field = JSON.parse(data);
    if (field['type'] == 'success') {
      $(btnAction).attr("disabled", false);
      init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
      $('#' + from_id).trigger("reset");
      let num = Number($(`tr#${field['id']} td:first`).html());
      var table = $('#dataTable1').DataTable();

      field['tr'].unshift(num);

      table.row(`#${field['id']}`).data(field['tr']).data();

      $(`#${modalClass}`).modal('hide');
      if (reload) {
        setTimeout(() => {
          window.location.reload();
        }, timeOut);
      }
    } else {
      $(btnAction).attr("disabled", false);
      if (field['type'] == "form_error") {
        for (let step = 0; step < field['messages'].length; step++) {

          init_PNotify('خطا', field['messages'][step], 'error');
        }
      }
    }
  });
}


function xhrDelete(record, action, reload = false, btnAction = '.none', timeOut = 1000) {
  var formData = new FormData();
  formData.set('record', record);
  $(btnAction).attr("disabled", true);
  $.ajax({
    url: action,
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).then(function (data) {
    var field = JSON.parse(data);
    if (field['type'] == 'success') {
      $(btnAction).attr("disabled", false);
      init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
      if (field['alert']['type'] == 'success') {
        var table = $('#dataTable1').DataTable();
        table.row(`#${record}`).remove().draw();
      }
      if (reload) {
        setTimeout(() => {
          window.location.reload();
        }, timeOut);
      }
    } else {
      $(btnAction).attr("disabled", false);
      if (field['type'] == "form_error") {
        for (let step = 0; step < field['messages'].length; step++) {

          init_PNotify('خطا', field['messages'][step], 'error');
        }
      }
    }
  });
}



function change_status(record, action, reload = false, btnAction = '.none', timeOut = 1000) {
  var formData = new FormData();
  formData.set('record', record);
  $(btnAction).attr("disabled", true);
  $.ajax({
    url: action,
    type: 'POST',
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  }).then(function (data) {
    var field = JSON.parse(data);
    if (field['type'] == 'success') {
      $(btnAction).attr("disabled", false);
      init_PNotify(field['alert']['title'], field['alert']['text'], field['alert']['type']);
      if (field['alert']['type'] == 'success') {
        var table = $('#dataTable1').DataTable();
      let num = Number($(`tr#${field['id']} td:first`).html());
      field['tr'].unshift(num);
        table.row(`#${field['id']}`).data(field['tr']).data();
      }
      if (reload) {
        setTimeout(() => {
          window.location.reload();
        }, timeOut);
      }
    } else {
      $(btnAction).attr("disabled", false);
      if (field['type'] == "form_error") {
        for (let step = 0; step < field['messages'].length; step++) {

          init_PNotify('خطا', field['messages'][step], 'error');
        }
      }
    }
  });
}