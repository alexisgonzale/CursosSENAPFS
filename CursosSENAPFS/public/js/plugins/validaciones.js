///////Login///////////////////////////////
//-------------------------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com"
)
// --------------
$('#reUsers').validate({
rules: {

txtpassword: {
  required: true,
  minlength: 8,
  maxlength:15
},
txtcorreoPersona: {
  required:true,
  nValidacion:true,
  maxlength:50
},
agree: {
  required: true
}
},
messages: {
txtcorreoPersona:{
  required: 'Este campo es obligatorio.', 
  maxlength:'Por favor, no escribas más de 50 caracteres.'
},
txtpassword: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.',
  maxlength:'Por favor, no escribas más de 10 caracteres.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
  error.insertAfter(element.parent('label'));
} else {
  error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});


///////Reguistrar registrar user new///////////////////////////////
//-------------------------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Nada de caracteres especiales, por favor"
)
//---------------caracteres especiales-----------
  jQuery.validator.addMethod("nuestraValidacion",
       function(value, element) {
               return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
       },
    "Nada de caracteres especiales, por favor"
  );
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#reUser').validate({
rules: {
txttipoDocumento: {
  required: true
},
txtdocumentoPersona: {
  required: true,
  number: true,
  minlength:5,
  maxlength:15
},
txtnombrePersona: {
  required:true,
  maxlength: 33,
  nuestraValidacion:true
},
txtapellidoPersona: {
  required:true,
  maxlength: 33,
  nuestraValidacion:true
},
txtpassword: {
  required: true,
  minlength: 8
},
txtconfirm_password: {
  required:true,
  minlength: 8,
  equalTo: '#txtpassword'
},
txtcorreoPersona: {
  required:true,
  nValidacion:true
  // remote: '<?=URL?>/Personas/cargarlistar'
},
agree: {
  required: true
}
},
messages: {
txtdocumentoPersona:{
  requiered: 'Este campo es obligatorio.',
  number:'Sólo se permite el ingreso de números.',
  minlength:'Por favor, no escribas menos de 8 caracteres.',
  maxlength:'Por favor, no escribas más de 10 caracteres.'
},
txtnombrePersona: {
  required:'Este campo es obligatorio.',
  nuestraValidacion:'No se aceptan caracteres especiales.',
  maxlength:'Por favor, no escribas más de 33 caracteres.'
},
txtapellidoPersona: {
  required:'Este campo es obligatorio.',
  nuestraValidacion:'No se aceptan caracteres especiales.',
  maxlength:'Por favor, no escribas más de 33 caracteres.'
},
txtcorreoPersona:{
  required: 'Este campo es obligatorio.', 
  nValidacion: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com'
  // remote:'el correo electrónico ya existe.'
},
txtpassword: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.'
},
// eslint-disable-next-line camelcase
txtconfirm_password: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.',
  equalTo: 'Por favor, escribe la misma contraseña de nuevo.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
  error.insertAfter(element.parent('label'));
} else {
  error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});


///////Change password///////////////////////////////
//-------------------------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Nada de caracteres especiales, por favor"
)
//---------------caracteres especiales-----------
  jQuery.validator.addMethod("nuestraValidacion",
       function(value, element) {
               return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
       },
    "Nada de caracteres especiales, por favor"
  );
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#changePassword').validate({
rules: {
txtpassword2: {
    required: true,
    minlength: 8,
    maxlength: 15
  },
txtNewpasswor: {
  required: true,
  minlength: 8,
  maxlength: 15
},
txtConfirmNewpasswor: {
  required:true,
  minlength: 8,
  equalTo: '#txtNewpasswor'
},
agree: {
  required: true
}
},
messages: {
txtpassword2: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.',
  maxlength: 'Por favor, no escribas más de 15 caracteres.'
},
// eslint-disable-next-line camelcase
txtNewpasswor: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.'
},
txtConfirmNewpasswor: {
  required: 'Este campo es obligatorio.',
  minlength: 'Por favor, no escribas menos de 8 caracteres.',
  maxlength: 'Por favor, no escribas más de 15 caracteres.',
  equalTo: 'Por favor, escribe la misma contraseña de nuevo.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
  error.insertAfter(element.parent('label'));
} else {
  error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});



///////Reguistrar Personas Admin///////////////////////////////
//-------------------------------------------------------------
//-------------Correo vali----------
  jQuery.validator.addMethod("nValidacion",
  function(value, element) {
          return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
  },
  "Nada de caracteres especiales, por favor"
  )
//---------------caracteres especiales-----------
      jQuery.validator.addMethod("nuestraValidacion",
           function(value, element) {
                   return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
           },
        "Nada de caracteres especiales, por favor"
      );
// ------------------------------------
$.validator.setDefaults({
		// submitHandler: function() {
		// 	alert("submitted!");
		// }
	});
// --------------
$('#signupForm').validate({
  rules: {
    txttipoDocumento: {
      required: true
    },
    txtdocumentoPersona: {
      required: true,
      number: true,
      minlength:5,
      maxlength:15
    },
    txtnombrePersona: {
      required:true,
      maxlength: 45,
      nuestraValidacion:true
    },
    txtapellidoPersona: {
      required:true,
      maxlength: 45,
      nuestraValidacion:true
    },
    txttelefonoPersona: {
      required:true,
      number:true,
      minlength:7,
      maxlength:10
    },
    txtdireccionPersona: {
      required:true,
      maxlength: 50
    },
    txtpassword: {
      required: true,
      minlength: 8,
      maxlength: 15
    },
    txtconfirm_password: {
      required:true,
      minlength: 8,
      equalTo: '#txtpassword'
    },
    txtLugarProfesion:{
      required:true,
      maxlength: 45
    },
    txtcorreoPersona: {
      required:true,
      maxlength: 50,
      nValidacion:true
    },
    txtconfirm_email:{
      required:true,
      nValidacion:true,
      equalTo:'#txtcorreoPersona'
    }, 
    agree: {
      required: true
    }
  },
  messages: {
    txtdocumentoPersona:{
      requiered: 'Este campo es obligatorio.',
      number:'Sólo se permite el ingreso de números.',
      minlength:'Por favor, no escribas menos de 5 caracteres.',
      maxlength:'Por favor, no escribas más de 15 caracteres.'
    },
    txtnombrePersona: {
      required:'Este campo es obligatorio.',
      nuestraValidacion:'No se aceptan caracteres especiales.',
      maxlength:'Por favor, no escribas más de 45 caracteres.'
    },
    txtapellidoPersona: {
      required:'Este campo es obligatorio.',
      nuestraValidacion:'No se aceptan caracteres especiales.',
      maxlength:'Por favor, no escribas más de 45 caracteres.'
    },  
    txttelefonoPersona:{
      required:'Este campo es obligatorio.',
      number:'Sólo se permite el ingreso de números.',
      minlength:'Por favor, no escribas menos de 7 caracteres.',
      maxlength:'Por favor, no escribas más de 10 caracteres.'
    },
    txtcorreoPersona:{
      required: 'Este campo es obligatorio.', 
      nValidacion: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com'
    },
    txtconfirm_email:{
      required: 'Este campo es obligatorio.', 
      nValidacion: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com',
      equalTo: 'Por favor, escribe el mismo Correo de nuevo.'
    },
    txtdireccionPersona:{
      requiered: 'Este campo es obligatorio.',
      maxlength:'Por favor, no escribas más de 50 caracteres.'
    },
    txtpassword: {
      required: 'Este campo es obligatorio.',
      maxlength:'Por favor, no escribas más de 15 caracteres.',
      minlength: 'Por favor, no escribas menos de 8 caracteres.'
    },
    txtconfirm_password: {
      required: 'Este campo es obligatorio.',
      minlength: 'Por favor, no escribas menos de 8 caracteres.',
      equalTo: 'Por favor, escribe la misma contraseña de nuevo.'
    },
  },
  errorElement: 'em',
  errorPlacement: function errorPlacement(error, element) {
    error.addClass('invalid-feedback');

    if (element.prop('type') === 'checkbox') {
      error.insertAfter(element.parent('label'));
    } else {
      error.insertAfter(element);
    }
  },
  highlight: function highlight(element) {
    $(element).addClass('is-invalid').removeClass('is-valid');
  },
  unhighlight: function unhighlight(element) {
    $(element).addClass('is-valid').removeClass('is-invalid');
  }
});

///////sanciones
//--------------------------------------------
$('#sanciones').validate({
rules: {
txtmeses: {
required:true,
maxlength: 2,
minlength: 1
},
agree: {
required: true
}
},
messages: {
txtmeses: {
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 2 caracteres.',
minlength: 'Por favor, escribe un valor mayor o igual a 1.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
error.insertAfter(element.parent('label'));
} else {
error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});


///////modificar personas admin
//--------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Nada de caracteres especiales, por favor"
)
//---------------vali caracteres especiales modificar

jQuery.validator.addMethod("nuestraValidacion",
function(value, element) {
        return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
},
"Nada de caracteres especiales, por favor"
);
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#modificarp').validate({
rules: {

txtnombrePersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txtapellidoPersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txttelefonoPersona: {
required:true,
number:true,
minlength:7,
maxlength:10
},
txtdireccionPersona: {
required:true,
maxlength:50
},
txtcorreoPersona:{
required:true,
nValidacion:true
},
agree: {
required: true
}
},
messages: {
txtnombrePersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
txtdireccionPersona:{
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
txtapellidoPersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},  
txttelefonoPersona:{
required:'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
minlength:'Por favor, no escribas menos de 7 caracteres.',
maxlength:'Por favor, no escribas más de 10 caracteres.'
},
txtcorreoPersona:{
required: 'Este campo es obligatorio.', 
nValidacion: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com'
// remote:'el correo electrónico ya existe.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
error.insertAfter(element.parent('label'));
} else {
error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});


///////modificar personas usuario--admin
//--------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com"
)
//---------------vali caracteres especiales modificar

jQuery.validator.addMethod("nuestraValidacion",
function(value, element) {
        return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
},
"Nada de caracteres especiales, por favor"
);
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#modificarpu').validate({
rules: {

txtnombrePersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txtdireccionPersona: {
required:true,
maxlength:50
},
txtapellidoPersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txttelefonoPersona: {
required:true,
number:true,
minlength:7,
maxlength:10
},
txtLugarProfesion:{
required:true,
maxlength: 45
},
txtcorreoPersona: {
required:true,
nValidacion: true
},
txtdireccionPersona: {
required:true,
maxlength: 45
},
agree: {
required: true
}
},
messages: {
txtnombrePersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
txtapellidoPersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},  
txttelefonoPersona:{
required:'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
minlength:'Por favor, no escribas menos de 7 caracteres.',
maxlength:'Por favor, no escribas más de 10 caracteres.'
},
txtdireccionPersona:{
requiered: 'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 50 caracteres.'
},
txtLugarProfesion:{
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
error.insertAfter(element.parent('label'));
} else {
error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});

///////Reguistrar Personas Usuario-admi///////////////////////////////
//-------------------------------------------------------------
//-------------Correo vali----------
jQuery.validator.addMethod("nValidacion",
function(value, element) {
        return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
},
"Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: u@localhost.com"
)
//---------------caracteres especiales-----------
jQuery.validator.addMethod("nuestraValidacion",
function(value, element) {
        return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
},
"Nada de caracteres especiales, por favor"
);
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#signupForme').validate({
rules: {
txttipoDocumento: {
required: true
},
txtdocumentoPersona: {
required: true,
number: true,
minlength:5,
maxlength:15
},
txtnombrePersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txtapellidoPersona: {
required:true,
maxlength: 45,
nuestraValidacion:true
},
txttelefonoPersona: {
required:true,
number:true,
minlength:7,
maxlength:10
},
txtdireccionPersona: {
required:true,
maxlength:50
},
txtLugarProfesion:{
  required:true,
  maxlength: 45
},
txtcorreoPersona: {
  required:true,
  nValidacion: true
},
agree: {
required: true
}
},
messages: {
txtdireccionPersona:{
requiered: 'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 50 caracteres.'
},
txtdocumentoPersona:{
requiered: 'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
minlength:'Por favor, no escribas menos de 5 caracteres.',
maxlength:'Por favor, no escribas más de 15 caracteres.'
},
txtnombrePersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
txtapellidoPersona: {
required:'Este campo es obligatorio.',
nuestraValidacion:'No se aceptan caracteres especiales.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
},
txtLugarProfesion:{
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 45 caracteres.'
}, 
txttelefonoPersona:{
required:'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
minlength:'Por favor, no escribas menos de 7 caracteres.',
maxlength:'Por favor, no escribas más de 10 caracteres.'
},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
error.insertAfter(element.parent('label'));
} else {
error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});



///////Reguistrar cursos///////////////////////////////

//---------------caracteres especiales-----------
jQuery.validator.addMethod("nuestraValidacion",
function(value, element) {
        return /^[ A-Za-z\d=áéíóúñ]+$/.test(value);
},
"Nada de caracteres especiales, por favor"
);
// ------------------------------------
$.validator.setDefaults({
// submitHandler: function() {
// 	alert("submitted!");
// }
});
// --------------
$('#signupFormes').validate({
rules: {
allCategories: {
required: true
},
txtNameCourse: {
required:true,
maxlength:50,
nuestraValidacion:true
},
txtQHours: {
required:true,
number:true,
maxlength:5,
range : [0, 999999]
},
txtAttendant: {
required:true,
maxlength:45,
nuestraValidacion:true
},
txtCupos: {
required:true,
number:true,
maxlength:3,
range : [0, 999]
},
agree: {
required: true
}
},
messages: {
txtNameCourse: {
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 50 caracteres.',
nuestraValidacion:'No se aceptan caracteres especiales.'
}, 
txtQHours:{
required:'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
maxlength:'Por favor, no escribas más de 5 caracteres.',
range : 'Por favor , no escriba números negativos'
}, 
txtCupos:{
required:'Este campo es obligatorio.',
number:'Sólo se permite el ingreso de números.',
maxlength:'Por favor, no escribas más de 3 caracteres.',
range : 'Por favor , no escriba números negativos'
},
txtAttendant: {
required:'Este campo es obligatorio.',
maxlength:'Por favor, no escribas más de 45 caracteres.',
nuestraValidacion:'No se aceptan caracteres especiales.'

},
},
errorElement: 'em',
errorPlacement: function errorPlacement(error, element) {
error.addClass('invalid-feedback');

if (element.prop('type') === 'checkbox') {
error.insertAfter(element.parent('label'));
} else {
error.insertAfter(element);
}
},
// eslint-disable-next-line object-shorthand
highlight: function highlight(element) {
$(element).addClass('is-invalid').removeClass('is-valid');
},
// eslint-disable-next-line object-shorthand
unhighlight: function unhighlight(element) {
$(element).addClass('is-valid').removeClass('is-invalid');
}
});


