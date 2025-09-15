$(function () {
  $(".btn-socio").on("click", function () {
    let form = $("#" + $(this).data("formulario"));
    if ($(this).data("tipo") == 'new') {
        ruta = "admin/guardarSocio";
    }else{
        ruta = "admin/actualizarSocio";
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
          $('.btn-socio').attr('disabled',true).text('Cargando...');
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
          tablaConcentrado();
          form.removeClass("was-validated");
          form[0].reset();
          $('#exampleModalToggle').modal('toggle');
          $('.btn-socio').attr('data-tipo','new');
          /* setTimeout(() => {
                        location.reload();
                    }, 2000); */
        },
        error: function (data) {
          console.log("Error ajax");
          console.log(data)
          /* console.log(data.log); */
        },
        complete: function () {
          $('.btn-socio').attr('disabled',false).text('Guardar');
        },
      });
    }
    form.addClass("was-validated");
  });
  async function tablaConcentrado() {
    try {
      let peticion = await fetch(servidor + `admin/getConcentrado/${ev}`);
      let response = await peticion.json();
      $("#container-concentrado").empty();
      if (response.length == 0) {
        jQuery(`<h2>Aún no hay boletos generados</h2>`)
          .appendTo("#container-concentrado")
          .addClass("text-center text-danger");
        return false;
      }
      jQuery(`<table class="table align-items-center mb-0 table table-striped table-bordered"  id="info-table-result">
            <thead><tr>
            <th class="text-uppercase">Nombre</th><th class="text-uppercase">Fecha registro</th><th class="text-uppercase">Boleto</th><th class="text-uppercase">Creado por</th><th class="text-uppercase">Estatus</th><th class="text-uppercase">Acciones</th>
            </tr></thead>
            </table>`)
        .appendTo("#container-concentrado")
        .removeClass("text-danger");

      $("#info-table-result").DataTable({
        drawCallback: function (settings) {
          $(".current")
            .addClass("btn bg-gradient-pink text-white btn-rounded")
            .removeClass("paginate_button");
          $(".paginate_button").addClass("btn").removeClass("paginate_button");
          $(".dataTables_length").addClass("m-4");
          $(".dataTables_info").addClass("mx-4");
          $(".dataTables_filter").addClass("m-4");
          $("input").addClass("form-control");
          $("select").addClass("form-control");
          $(".previous.disabled").addClass(
            "btn-outline-info opacity-5 btn-rounded mx-2"
          );
          $(".next.disabled").addClass(
            "btn-outline-info opacity-5 btn-rounded mx-2"
          );
          $(".previous").addClass("btn-outline-info btn-rounded mx-2");
          $(".next").addClass("btn-outline-info btn-rounded mx-2");
          $("a.btn").addClass("btn-rounded");
        },
        language: {
          url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
        },
        pageLength: 5,
        lengthMenu: [
          [5, 10, -1],
          [5, 10, "All"],
        ],
        data: response,
        columns: [
          {
            data: null,
            render: function (data) {
              resp = `<span class="font-weight-bold">${data.nombre_socio} ${data.apellidop_socio} ${data.apellidom_socio}</span>`;
              return resp;
            },
            className: "text-vertical text-center",
          },
          { data: "fecha_registro" },
          { data: "token_boleto" },
          { data: "nombre_usuario" },
          {
            data: null,
            render: function (data) {
              let estatus = (data.estatus_boleto == 1)?'<span class="font-weight-bold text-success">Activo</span>':'<span class="font-weight-bold text-danger">Inactivo</span>';
              return estatus;
            },
            className: "text-vertical text-center",
          },
          {
            data: null,
            render: function (data) {
              botones = `<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-between align-items-center" >
                                <a href="${servidor}${
                data.qr_validacion
              }" target="_blank" title="Descargar QR" class="btn btn-secondary" download><i class="fa-solid fa-qrcode"></i></a>
                                <a href="${servidor}${
                data.pdf_ruta
              }" target="_blank" title="Descargar PDF" class="btn btn-danger" download><i class="fa-solid fa-file-pdf"></i></a>
                                <button data-registro="${btoa(
                                  btoa(data.id_concentrado)
                                )}" data-bs-toggle="tooltip" title="Editar registro" type="button" class="btn btn-info edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                </div>`;
              return botones;
            },
            className: "text-vertical text-center",
          },
        ],
      });
    } catch (err) {
      console.log(err);
      if (err.name == "AbortError") {
      } else {
        throw err;
      }
    }
  }
  tablaConcentrado();
  $('.btn-new').click(function(){
    $('.btn-socio').attr('data-tipo','new');
    $('#nombre_socio').val("");
    $('#apellidop_socio').val("");
    $('#apellidom_socio').val("");
    $('#id_concentrado').val("");
    $('#exampleModalToggleLabel').text('Generar boleto');
  })
  $("#container-concentrado").on("click", ".edit", async function () {
    let peticion = await fetch(
      servidor + `admin/getRegistro/${$(this).data("registro")}`
    );
    let response = await peticion.json();
    $('#exampleModalToggleLabel').text('Actualizar información');
    $('#nombre_socio').val(response['nombre_socio']);
    $('#apellidop_socio').val(response['apellidop_socio']);
    $('#apellidom_socio').val(response['apellidom_socio']);
    $('#id_concentrado').val(btoa(btoa(response['id_concentrado'])));
    $('.btn-socio').attr('data-tipo','update');
    $('#exampleModalToggle').modal('show');
  });
});
