/**
 * Funciones auxiliares de javascripts
 */

function confirmarBorrarMascota(nombre, id_mascota) {
  if (confirm("¿Quieres eliminar la mascota:  " + nombre + "?")) {
    document.location.href = "?orden=BorrarMascota&id_mascota=" + id_mascota;
  }
}

function confirmarBorrarHistorial(id_historial) {
  if (confirm("¿Quieres eliminar el historial:  " + id_historial + "?")) {
    document.location.href = "?orden=BorrarHistorial&id_historial=" + id_historial;
  }
}

function confirmarBorrarCita(id_cita) {
  if (confirm("¿Quieres eliminar la cita:  " + id_cita + "?")) {
    document.location.href = "?orden=BorrarCita&id_cita=" + id_cita;
  }
}

function nif(dni) {
  var numero;
  var letr;
  var letra;
  var expresion_regular_dni;

  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

  if (expresion_regular_dni.test(dni) == true) {
    numero = dni.substr(0, dni.length - 1);
    letr = dni.substr(dni.length - 1, 1);
    numero = numero % 23;
    letra = "TRWAGMYFPDXBNJZSQVHLCKET";
    letra = letra.substring(numero, numero + 1);
    if (letra != letr.toUpperCase()) {
      alert("Dni erroneo, la letra del NIF no se corresponde");
    } else {
      return true;
    }
  } else {
    alert("Dni erroneo, formato no válido");
  }
}

function validar(evt) {
  let clave1 = "";
  let clave2 = "";

  if (document.datosUsuario.password && document.datosUsuario.password2) {
    clave1 = document.datosUsuario.password.value;
    clave2 = document.datosUsuario.password2.value;
  }
  dni = document.datosUsuario.dni.value;
  telefono = document.datosUsuario.telefono.value;

  if (clave1 != clave2) {
    alert("Las dos claves son distintas");
    evt.preventDefault();
  } else if (!nif(dni)) {
    evt.preventDefault();
  }
}
