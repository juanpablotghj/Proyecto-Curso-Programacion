
function ValidarRegistro() {
    let username    = document.getElementById('emailregis').value
    let password    = document.getElementById('passwregis').value
    let nombres     = document.getElementById('nombres').value
    let apellidos   = document.getElementById('apellidos').value
    let confir      = document.getElementById('confirpassword').value
    let identificacion      = document.getElementById('identificacion').value

    let mensajes=''
    
    if(password!=confir) mensajes +='<li>Las contraseñas no son iguales</li>'
    if(username=='')    mensajes +='<li>Debes agregar un correo electronico</li>'
    if(password=='')    mensajes +='<li>Debes agregar una contraseña</li>'
    if(nombres=='')     mensajes +='<li>Debes agregar tus nombres</li>'
    if(apellidos=='')   mensajes +='<li>Debes agregar tus apellidos</li>'
    if(confir=='')      mensajes +='<li>Debes confirmar la contraseña</li>'
    if(identificacion=='')      mensajes +='<li>Debes agregar una identificacion</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forregistro.submit()
    }
    
}

function ValidarRoles() {
    let nombre    = document.getElementById('nombre').value
    let mensajes=''
    
    if(nombre=='')   mensajes +='<li>Debes ingresar nombre del rol</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forrol.submit()
    }
    
}

function ValidarSede() {
    let nombre    = document.getElementById('nombre').value
    let mensajes=''
    
    if(nombre=='')   mensajes +='<li>Debes ingresar nombre de la sede</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forsede.submit()
    }
    
}

function ValidarPaises() {
    let nombre    = document.getElementById('nombre').value
    let mensajes=''
    
    if(nombre=='')   mensajes +='<li>Debes ingresar nombre del pais</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forpais.submit()
    }
    
}

function ValidarCiudades() {
    let nombre      = document.getElementById('nombre').value
    let pais        = document.getElementById('pais').value
    let mensajes=''
    
    if(nombre=='')   mensajes +='<li>Debes ingresar nombre de la ciudad</li>'
    if(pais=='')     mensajes +='<li>Debes ingresar el pais</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forciudad.submit()
    }
    
}


function ValidarProveedor() {
    let email    = document.getElementById('email').value
    let nombres     = document.getElementById('nombres').value
    let apellidos   = document.getElementById('apellidos').value
    let identificacion      = document.getElementById('identificacion').value
    let ciudad      = document.getElementById('ciudad').value

    let mensajes=''
    
    if(email=='')       mensajes +='<li>Debes agregar un correo electronico</li>'
    if(nombres=='')     mensajes +='<li>Debes agregar tus nombres</li>'
    if(apellidos=='')   mensajes +='<li>Debes agregar tus apellidos</li>'
    if(identificacion=='')      mensajes +='<li>Debes agregar una identificacion</li>'
    if(ciudad=='')      mensajes +='<li>Debes seleccionar una ciudad</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forproveedor.submit()
    }
    
}


function ValidarEmpleados() {
    let email       = document.getElementById('email').value
    let nombres     = document.getElementById('nombres').value
    let apellidos   = document.getElementById('apellidos').value
    let identificacion      = document.getElementById('identificacion').value
    let ciudad      = document.getElementById('ciudad').value
    let sede        = document.getElementById('sede').value
    let tipo        = document.getElementById('tipo').value
    let salario     = document.getElementById('salario').value

    let mensajes=''
    
    if(email=='')       mensajes +='<li>Debes agregar un correo electronico</li>'
    if(nombres=='')     mensajes +='<li>Debes agregar tus nombres</li>'
    if(apellidos=='')   mensajes +='<li>Debes agregar tus apellidos</li>'
    if(identificacion=='')      mensajes +='<li>Debes agregar una identificacion</li>'
    if(ciudad=='')      mensajes +='<li>Debes seleccionar una ciudad</li>'
    if(sede=='')        mensajes +='<li>Debes seleccionar una sede</li>'
    if(tipo=='')        mensajes +='<li>Debes seleccionar un tipo</li>'
    if(salario=='')     mensajes +='<li>Debes escribir un salario</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forempleados.submit()
    }
    
}


function ValidarClientes() {
    let email           = document.getElementById('email').value
    let nombres         = document.getElementById('nombres').value
    let apellidos       = document.getElementById('apellidos').value
    let identificacion  = document.getElementById('identificacion').value
    let ciudad          = document.getElementById('ciudad').value
    let telefono        = document.getElementById('telefono').value
    let direccion       = document.getElementById('direccion').value

    let mensajes=''
    
    if(email=='')           mensajes +='<li>Debes agregar un correo electronico</li>'
    if(nombres=='')         mensajes +='<li>Debes agregar tus nombres</li>'
    if(apellidos=='')       mensajes +='<li>Debes agregar tus apellidos</li>'
    if(identificacion=='')  mensajes +='<li>Debes agregar una identificacion</li>'
    if(ciudad=='')          mensajes +='<li>Debes seleccionar una ciudad</li>'
    if(telefono=='')        mensajes +='<li>Debes escribir un telefono</li>'
    if(direccion=='')       mensajes +='<li>Debes escribir una direccion</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forclientes.submit()
    }
    
}

function ValidarProducto() {
    let codigo           = document.getElementById('codigo').value
    let codbarra         = document.getElementById('codbarra').value
    let nombres          = document.getElementById('nombres').value
    let descripcion      = document.getElementById('descripcion').value
    let costo            = document.getElementById('costo').value

    let mensajes=''
    
    if(codigo=='')          mensajes +='<li>Debes agregar un ccodigo</li>'
    if(codbarra=='')        mensajes +='<li>Debes agregar un codbarra</li>'
    if(nombres=='')         mensajes +='<li>Debes agregar un nombre</li>'
    if(descripcion=='')     mensajes +='<li>Debes agregar una descripcion</li>'
    if(costo=='')           mensajes +='<li>Debes agregar un costo</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forproductos.submit()
    }
    
}

function ValidarMateriaPrima() {
    let codigo           = document.getElementById('codigo').value
    let codbarra         = document.getElementById('codbarra').value
    let nombres          = document.getElementById('nombres').value
    let descripcion      = document.getElementById('descripcion').value
    let costo            = document.getElementById('costo').value

    let mensajes=''
    
    if(codigo=='')          mensajes +='<li>Debes agregar un ccodigo</li>'
    if(codbarra=='')        mensajes +='<li>Debes agregar un codbarra</li>'
    if(nombres=='')         mensajes +='<li>Debes agregar un nombre</li>'
    if(descripcion=='')     mensajes +='<li>Debes agregar una descripcion</li>'
    if(costo=='')           mensajes +='<li>Debes agregar un costo</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.formateriasprimas.submit()
    }
    
}


function ValidarProgramaciones() {
    let fechainicio   = document.getElementById('fechainicio').value
    let fechafinal    = document.getElementById('fechafinal').value
    let cantidad      = document.getElementById('cantidad').value
    let producto      = document.getElementById('producto').value

    let mensajes=''
    
    if(fechainicio=='')  mensajes +='<li>Debes agregar una fecha inicio</li>'
    if(fechafinal=='')   mensajes +='<li>Debes agregar una fecha final</li>'
    if(cantidad=='')     mensajes +='<li>Debes agregar una cantidad</li>'
    if(producto=='')     mensajes +='<li>Debes agregar un producto</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forprogramaciones.submit()
    }
    
}
