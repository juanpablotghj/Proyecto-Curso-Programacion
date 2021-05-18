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

    let mensajes=''
    
    if(email=='')       mensajes +='<li>Debes agregar un correo electronico</li>'
    if(nombres=='')     mensajes +='<li>Debes agregar tus nombres</li>'
    if(apellidos=='')   mensajes +='<li>Debes agregar tus apellidos</li>'
    if(identificacion=='')      mensajes +='<li>Debes agregar una identificacion</li>'
    if(ciudad=='')      mensajes +='<li>Debes seleccionar una ciudad</li>'
    if(sede=='')        mensajes +='<li>Debes seleccionar una sede</li>'
    if(tipo=='')        mensajes +='<li>Debes seleccionar un tipo</li>'

    if(mensajes!=''){
        document.getElementById('mensaje').innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`
    }else{
        document.forempleados.submit()
    }
    
}