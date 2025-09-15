$(function () {
  $(".btn-evento").on("click", function () {
    let form = $("#" + $(this).data("formulario"));
    if ($(this).data("tipo") == "new") {
      ruta = "admin/guardarEvento";
    } else {
      ruta = "admin/actualizarEvento";
    }
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      $.ajax({
        type: "POST",
        url: servidor + ruta,
        dataType: "json",
        data: new FormData(form.get(0)),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // setting a timeout
          $("#loading").addClass("loading");
          $('.btn-evento').attr('disabled',true).text('Cargando...');
        },
        success: function (data) {
          Swal.fire({
            position: "top-end",
            icon: data.estatus,
            title: data.titulo,
            text: data.respuesta,
            showConfirmButton: false,
            timer: 2000,
          });
          setTimeout(() => {
            location.reload();
          }, 2000);
          form.removeClass("was-validated");
          form[0].reset();
          $("#exampleModalToggle").modal("toggle");
          $(".btn-socio").attr("data-tipo", "new");
        },
        error: function (data) {
          console.log("Error ajax");
          console.log(data)
          /* console.log(data.log); */
        },
        complete: function () {
          $("#loading").removeClass("loading");
          $('.btn-evento').attr('disabled',false).text('Guardar');
        },
      });
    }
    form.addClass("was-validated");
  });
  async function cardsEventos() {
    try {
      let peticion = await fetch(servidor + `admin/getEventos`);
      let response = await peticion.json();
      $("#container-clientes").empty();
      if (response.length == 0) {
        jQuery(
          `<h3 class="mt-4 text-center text-uppercase">Sin eventos creados</h3>`
        )
          .appendTo("#container-clientes")
          .addClass("text-danger");
        return false;
      }
      response.forEach((item, index) => {
        jQuery(`
                    <div href="${servidor}admin/documentos/${btoa(
          btoa(item.id_revista)
        )}" class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                        <div class="h-100 card card-profile card-plain move-on-hover border border-dark">
                            <div class="card-body text-center bg-white shadow border-radius-lg p-3">
                                    <img class="w-100 border-radius-md" src="${servidor}${
          item.ruta_boleto
        }">
                                <h5 class="mt-3 mb-1 d-md-block ">${
                                  item.nombre_evento
                                }</h5>
                                <p class="mb-0 text-xs font-weight-bolder text-primary text-gradient text-uppercase">${
                                  item.lugar_evento
                                }</p>
                                <p class="mb-0 text-xs font-weight-bolder text-uppercase">Disponibles: <span class="h3 text-${(item.disponibles == 0)?'danger':'success'}">${
                                    item.disponibles
                                  }</span></p>
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <button data-id="${
                                          item.id_evento
                                        }" class="btn btn-info form-control edit">Editar</i></a>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <a href="${servidor}admin/concentrado/${btoa(
          btoa(item.id_evento)
        )}" id="${
          item.id_evento
        }" class="btn btn-dark form-control">Administrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `).appendTo("#container-clientes");
      });
    } catch (error) {
      if (error.name == "AbortError") {
      } else {
        throw error;
      }
    }
  }
  cardsEventos();
  $('.btn-new').click(function(){
    $('.btn-evento').attr('data-tipo','new');
    $('#nombre_evento').val("");
    $('#fecha_inicial_evento').val("");
    $('#fecha_final_evento').val("");
    $('#nombre_lugar').val("");
    $('#url_lugar').val("");
    $('#limite_boletos').val("");
    $('#img_boleto').val("").attr('required',true);;
    $('#img_boleto_ant').val("");
    $('#img_logo').val("").attr('required',true);;
    $('#img_logo_ant').val("");
    $('#evento').val("");
    $('#token_ev').val("");
    $('#exampleModalToggleLabel').text('Crear evento');
  })
  $("#container-clientes").on("click", ".edit", async function () {
    let peticion = await fetch(
      servidor + `admin/getEvento/${btoa(btoa($(this).data("id")))}`
    );
    let response = await peticion.json();
    $('#exampleModalToggleLabel').text('Actualizar información');
    $('#nombre_evento').val(response['nombre_evento']);
    $('#fecha_inicial_evento').val(response['fecha_inicial_evento']);
    $('#fecha_final_evento').val(response['fecha_final_evento']);
    $('#nombre_lugar').val(response['lugar_evento']);
    $('#url_lugar').val(response['url_lugar_evento']);
    $('#limite_boletos').val(response['limite_boletos']);
    $('#img_boleto').val("").attr('required',false);
    $('#img_boleto_ant').val(response['ruta_boleto']);
    $('#img_logo').val("").attr('required',false);
    $('#img_logo_ant').val(response['ruta_logo']);
    $('#evento').val(btoa(btoa(response['id_evento'])));
    $('#token_ev').val(response['token_evento']);
    $('.btn-evento').attr('data-tipo','update');
    $('#exampleModalToggle').modal('show');
  });
});
