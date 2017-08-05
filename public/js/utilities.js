var utilities = (function () {
    var errorPetitAjax= function(jqXHR, textStatus, errorThrown){
        if(jqXHR.status==422)
            alert(_.pluck(jqXHR.responseJSON, '0').join("\n"));
        else if(jqXHR.status==500)
            alert("Error de conexion con el servidor.\nRevise su conexion a internet.");
        else if(jqXHR.status==403)
            alert('Acceso denegado.');
        else
            alert("No se han podido cargar los datos. Intente mas tarde.**--"+ textStatus );
    }
    var asignaValByName = function(data, contenedor, prefijo, sufijoName, arrayname ) {
        if(typeof(prefijo)=="boolean"){
            arrayname = contenedor;
            prefijo = '';
        }
        if(prefijo===undefined)prefijo='';
        if(arrayname===undefined)arrayname=false;
        var arrayname_str='';
        if(arrayname)arrayname_str='[]';
        if(sufijoName===undefined)sufijoName='';
        $.each(data, function(name, value ){
            var selector = contenedor+' [name'+sufijoName+'="'+prefijo+name+arrayname_str+'"]';
            var typeElemn = $(selector).prop('nodeName');
            var element = $(selector);
            if(element.length>0){
                if($.inArray(typeElemn, ['INPUT', 'SELECT'])!=-1){
                    element.val(value);
                    if($.inArray(typeElemn, ['SELECT'])!=-1)
                        if(element.is('[materialize]'))
                            element.material_select();
                }
                if($.inArray(typeElemn, ['DIV','H4'])!=-1) element.html(value);
                if(!element.hasClass('typeahead')){
                    inactivo = element.attr('disabled')=='disabled';
                    if(inactivo)element.removeAttr('disabled');
                    element.focus(); element.blur();
                    if(inactivo)element.attr('disabled','disabled');
                }
            }
        });
    }
    var namesToId = function(element) {
        if(element===undefined)element='body';
        $(element).find('[name]').each(function(index, element){
            var idElemento = $(this).attr('id');
            var nameElemento = $(this).attr('name');
            if(idElemento==undefined){
                if(nameElemento.search(/\[]/)==-1){
                    $(this).attr('id', nameElemento);
                }else{
                    $(this).attr('id', nameElemento.replace(/\[]/, '_'+$('[name="'+nameElemento+'"][id] ').length));
                }
            }
        });
    }
    var idToName = function(element) {
        if(element===undefined)element='body';
        $(element).find('[id]').each(function(index, element){
            if($(this).attr('name')==undefined)
                $(this).attr('name',$(this).attr('id'));
        });
    }
    // Redondea número a dos decimales por arriba
    var roundUp = function (number) {
        formatNumber = (accounting.toFixed(number, 2))*1;
        return accounting.toFixed(number - formatNumber>0?formatNumber+0.01:number,2)*1;
    }
    // Redondea cifras de 500 1302->1000, 3500->4000, 5650->6000
    var round1000 = function (number) {
        if(number<=1000){
            if(number>=500)return 1000;
            else return 0;
        }
        residuo = number%1000;
        if(residuo<500)return number - residuo;
        else return (number - residuo)+1000;
    }

    /**
     * Find by Id in array
     * @param array
     * @param id
     */
    var findById = function (array, id) {
        return _.findWhere(array, {id: id*1});
    }

    var limpiarForm = function (contenedor, except) {
        if(except==undefined)except='.select-dropdown, input[name="_token"]';
        else except+=' ,.select-dropdown, input[name="_token"]';
        $(contenedor).find('input:not('+except+')').val('');
        $(contenedor).find('textarea:not('+except+')').val('');
        $(contenedor).find('select:not('+except+')').val('');
    }
    function construct(){//Funcion que controla cuales son los metodos publicos
        return {
            asignaValByName     : asignaValByName,
            errorPetitAjax      : errorPetitAjax,
            idToName            : idToName,
            findById            : findById,
            limpiarForm         : limpiarForm,
            namesToId           : namesToId,
            roundUp             : roundUp,
            round1000           : round1000
        }
    };
    return {construct:construct};//retorna los metodos publicos
})().construct();
//Convierte a primer letra en mayuscula el resto en minuscula
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
//El :contains de Jquery diferencia entre minusculas y mayusculas, esta sección crea :icontains que no hace distinción.
jQuery.expr[':'].icontains = function(a, i, m) {
    return jQuery(a).text().toUpperCase()
            .indexOf(m[3].toUpperCase()) >= 0;
};

$.fn.sumValues = function() {
    var sum = 0;
    this.each(function() {
        if ( $(this).is(':input') ) {
            var val = $(this).val();
        } else {
            var val = $(this).text();
        }
        sum += parseFloat( ('0' + val).replace(/[^0-9-\.]/g, ''), 10 );
    });
    return accounting.formatNumber(sum,2);
};

$.fn.loading = function(label) {
    if(label==undefined)label='Loading...';
    this.each(function(index, element) {
        $(element).html(
            '<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 16px"></i>'+
            '<span>'+label+'</span>'
        );
    });
};

$.fn.unloading = function() {
    this.each(function(index, element) {
        $(element).html('');
    });
};

$.fn.disabled = function() {
    this.each(function(index, element) {
        $(element).find('*').prop('disabled', true);
    });
};

$.fn.enabled= function() {
    this.each(function(index, element) {
        $(element).find('*').prop('disabled', false);
    });
};

$.fn.renderTpl= function(data) {
    var tpl= '';
    this.each(function(index, element) {
        var template= _.template($(this).html());
        tpl+= template(data);
    });
    return tpl;
};

